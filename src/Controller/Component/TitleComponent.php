<?php
declare(strict_types=1);

namespace Avolle\Title\Controller\Component;

use Cake\Controller\Component;
use Cake\Datasource\EntityInterface;
use Cake\Event\Event;
use Cake\Utility\Inflector;

/**
 * Title component
 */
class TitleComponent extends Component
{
    /**
     * Default configuration.
     * - format: How the title will be formatted. Placeholders will be replaced with the related content
     *    Placeholders may contain content that is not replaced, by placing content inside the outer curly brace.
     *    Example: {{prefix} - } will replace prefix with the requested prefix, but will maintain the spaced dash after.
     *    If there is no prefix, then everything inside both curly braces are replaced with an empty string.
     *    Valid placeholders:
     *    - {{appName}}: Replaced with the application's name
     *    - {{prefix}}: Replaced with the requested prefix (eg. Admin)
     *    - {{controller}}: Replaced with the requested controller (eg. Users)
     *    - {{action}}: Replaced with the requested action (eg. View). If option ignoreIndex is true, the placeholder will be omitted.
     *    - {{displayField}}: Replaced with the requested controller's related model's display field (eg. name from the UsersTable)
     * - appName: Your application's name (human friendly)
     * - ignoreIndex : Whether to omit the controller action in the format if the requested action is index
     * - showDisplayFieldOnView : Whether to append the displayField when the requested controller action is view
     *
     * @var array<string, mixed>
     */
    protected $_defaultConfig = [
        'appName' => '',
        'format' => '{{prefix} - }{{controller} - }{{action} - }{{displayField}}{ &raquo; {appName}}',
        'ignoreIndex' => false,
        'showDisplayFieldOnView' => true,
    ];

    /**
     * If title not already set in the action, create and set a title based on controller, controller action and
     * controller related model class' display field (if action is view and option showDisplayFieldOnView is true
     *
     * @param \Cake\Event\Event $event Event
     * @return void
     * @noinspection PhpUnusedParameterInspection
     */
    public function beforeRender(Event $event): void
    {
        if (!$this->isTitleSet()) {
            $title = $this->formatTitle();
            $this->getController()->viewBuilder()->setVar('title', $title);
        }
    }

    /**
     * Checks to see if a view var with the title is already set.
     * This will allow developers to set their own title in selected actions
     *
     * @return bool
     */
    protected function isTitleSet(): bool
    {
        return $this->getController()->viewBuilder()->hasVar('title');
    }

    /**
     * Format the title with the provided options in the config. Will replace the placeholders with actual variables
     * The display field is guesstimated from the controller's related model class
     *
     * @return string
     */
    protected function formatTitle(): string
    {
        $format = $this->getConfig('format');
        $action = $this->getController()->getRequest()->getParam('action');

        if ($this->getConfig('ignoreIndex') && $action === 'index') {
            $format = $this->replaceAttribute('action', '', $format);
        }
        if ($this->getConfig('showDisplayFieldOnView') && $action === 'view') {
            $format = $this->replaceAttribute('displayField', $this->getDisplayFieldValue(), $format);
        } else {
            $format = $this->replaceAttribute('displayField', '', $format);
        }

        return $this->replaceAttributes($format);
    }

    /**
     * Get prefix from request
     *
     * @return string
     */
    protected function getPrefix(): string
    {
        return $this->humanize($this->getController()->getRequest()->getParam('prefix'));
    }

    /**
     * Attempt to get the value of the display field in the entity related to this controller
     *
     * @return string
     */
    protected function getDisplayFieldValue(): string
    {
        $model = $this->getController()->getName();
        $entityVar = $this->getEntityVar($model);
        $entity = $this->getEntity($entityVar);
        if (is_null($entity)) {
            return '';
        }
        $displayField = $this->getDisplayField($model);

        if (is_null($displayField)) {
            return '';
        }
        if (is_array($displayField)) {
            return implode(' - ', array_map(fn ($field) => (string)$entity->get($field), $displayField));
        }

        return (string)$entity->get($displayField) ?? '';
    }

    /**
     * Get the Controller guesstimated related Model Class' Display Field
     *
     * @param string $model Model go get display field from
     * @return string|string[]|null
     */
    protected function getDisplayField(string $model)
    {
        return $this->getController()->getTableLocator()->get($model)->getDisplayField();
    }

    /**
     * Return a "view var" guesstimated compatible string. Eg. Referees will return referee
     *
     * @param string $model Model to inflect
     * @return string
     */
    protected function getEntityVar(string $model): string
    {
        return Inflector::variable(Inflector::singularize($model));
    }

    /**
     * Attempt to fetch the view var that contains the Controller related Entity. Return null if none can be fetched
     *
     * @param string $entityVar Entity to get from viewVars
     * @return \Cake\Datasource\EntityInterface|null
     */
    protected function getEntity(string $entityVar): ?EntityInterface
    {
        return $this->getController()->viewBuilder()->getVar($entityVar) ?? null;
    }

    /**
     * Replace attributes of the formatted string
     *
     * @param string $format Format
     * @return string
     */
    protected function replaceAttributes(string $format): string
    {
        $replacements = [
            'appName' => $this->getConfig('appName'),
            'prefix' => $this->getPrefix(),
            'controller' => __($this->humanize($this->getController()->getName())),
            'action' => __($this->humanize($this->getController()->getRequest()->getParam('action'))),
        ];

        foreach ($replacements as $search => $replace) {
            $format = $this->replaceAttribute($search, $replace, $format);
        }

        return $format;
    }

    /**
     * Replace a given attribute with the replacement string
     * Will check if attribute is of special type = not only {{attribute}},
     * but with a prefixed/suffixed symbol (i.e.: {{attribute} - }.
     * Should it be a special attribute, only the attribute is replaced and the character remains.
     *
     * Example: {{controller} - } will turn into `Tools - `
     *
     * @param string $attribute Attribute to search
     * @param string $replacement Replacement string
     * @param string $title Current formatted title
     * @return string
     */
    protected function replaceAttribute(string $attribute, string $replacement, string $title): string
    {
        $isSpecialAttribute = strpos($title, '{{' . $attribute . '}}') === false;

        if (!$isSpecialAttribute) {
            return str_replace('{{' . $attribute . '}}', $replacement, $title);
        }

        $regex = '/{([^{]*){(' . $attribute . ')}([^}]*)}/';
        if (empty($replacement)) {
            return preg_replace($regex, '', $title);
        }

        return preg_replace($regex, '$1' . $replacement . '$3', $title);
    }

    /**
     * Humanize a string - Turning a CamelCased word into a spaced Camel Cased sentence
     *
     * @param string|null $string String to humanize
     * @return string
     */
    protected function humanize(?string $string): string
    {
        return Inflector::humanize(Inflector::underscore($string ?? ''));
    }
}
