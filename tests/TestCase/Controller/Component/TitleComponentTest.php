<?php
declare(strict_types=1);

namespace Avolle\Title\Test\TestCase\Controller\Component;

use Avolle\Title\Controller\Component\TitleComponent;
use Cake\Controller\ComponentRegistry;
use Cake\Event\Event;
use Cake\Http\ServerRequest;
use Cake\TestSuite\TestCase;
use TestApp\Controller\LocationsController;

/**
 * Avolle\Title\Controller\Component\TitleComponent Test Case
 */
class TitleComponentTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \Avolle\Title\Controller\Component\TitleComponent
     */
    protected TitleComponent $Title;

    /**
     * @var \Cake\Controller\ComponentRegistry
     */
    protected ComponentRegistry $registry;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $request = new ServerRequest();
        $this->registry = new ComponentRegistry(new LocationsController($request));
        $this->Title = new TitleComponent($this->registry);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Title);

        parent::tearDown();
    }

    /**
     * Test title method
     * No app name provided
     *
     * @return void
     * @uses \Avolle\Title\Controller\Component\TitleComponent::formatTitle()
     */
    public function testTitleWithoutAppName(): void
    {
        $expected = 'Locations - Index - ';
        $this->setRequest('Locations', 'index');
        $this->Title->beforeRender(new Event('beforeRender', $this->registry->getController()));
        $this->assertSame($expected, $this->Title->getController()->viewBuilder()->getVar('title'));
    }

    /**
     * Test title method
     * App name provided
     *
     * @return void
     * @uses \Avolle\Title\Controller\Component\TitleComponent::formatTitle()
     */
    public function testTitleWithAppName(): void
    {
        $this->Title = new TitleComponent($this->registry, [
            'appName' => 'TestApp',
        ]);
        $expected = 'Locations - Add -  &raquo; TestApp';
        $this->setRequest('Locations', 'add');
        $this->Title->beforeRender(new Event('beforeRender', $this->registry->getController()));
        $this->assertSame($expected, $this->Title->getController()->viewBuilder()->getVar('title'));
    }

    /**
     * Test title method
     * Prefix provided
     *
     * @return void
     * @uses \Avolle\Title\Controller\Component\TitleComponent::formatTitle()
     */
    public function testTitleWithPrefix(): void
    {
        $expected = 'Admin - Locations - Index - ';
        $this->setRequest('Locations', 'index', 'Admin');
        $this->Title->beforeRender(new Event('beforeRender', $this->registry->getController()));
        $this->assertSame($expected, $this->Title->getController()->viewBuilder()->getVar('title'));
    }

    /**
     * Test title method
     * Option `ignoreIndex` provided
     *
     * @return void
     * @uses \Avolle\Title\Controller\Component\TitleComponent::formatTitle()
     */
    public function testTitleWithIgnoredIndex(): void
    {
        $this->Title = new TitleComponent($this->registry, [
            'ignoreIndex' => true,
        ]);
        $expected = 'Admin - Locations - ';
        $this->setRequest('Locations', 'index', 'Admin');
        $this->Title->beforeRender(new Event('beforeRender', $this->registry->getController()));
        $this->assertSame($expected, $this->Title->getController()->viewBuilder()->getVar('title'));
    }

    /**
     * Test title method
     * Option `ignoreIndex` provided - but action is not index, so action should be shown
     *
     * @return void
     * @uses \Avolle\Title\Controller\Component\TitleComponent::formatTitle()
     */
    public function testTitleWithIgnoredIndexMakeSureNonIndexActionsShown(): void
    {
        $this->Title = new TitleComponent($this->registry, [
            'ignoreIndex' => true,
        ]);
        $expected = 'Admin - Locations - Add - ';
        $this->setRequest('Locations', 'add', 'Admin');
        $this->Title->beforeRender(new Event('beforeRender', $this->registry->getController()));
        $this->assertSame($expected, $this->Title->getController()->viewBuilder()->getVar('title'));
    }

    /**
     * Test title method
     * Should not replace an already set title variable
     *
     * @return void
     * @uses \Avolle\Title\Controller\Component\TitleComponent::formatTitle()
     */
    public function testTitleWhenTitleAlreadySet(): void
    {
        $expected = 'This should not be replaced';
        $this->Title->getController()->viewBuilder()->setVar('title', $expected);
        $this->setRequest('Locations', 'index');
        $this->Title->beforeRender(new Event('beforeRender', $this->registry->getController()));
        $this->assertSame($expected, $this->Title->getController()->viewBuilder()->getVar('title'));
    }

    /**
     * Test title method
     * Using a custom format
     *
     * @return void
     * @uses \Avolle\Title\Controller\Component\TitleComponent::formatTitle()
     */
    public function testTitleWithCustomFormat(): void
    {
        $this->Title = new TitleComponent($this->registry, [
            'format' => '{{appName}} - {{controller}}',
            'appName' => 'Hey',
        ]);
        $expected = 'Hey - Locations';
        $this->setRequest('Locations', 'add', 'Admin');
        $this->Title->beforeRender(new Event('beforeRender', $this->registry->getController()));
        $this->assertSame($expected, $this->Title->getController()->viewBuilder()->getVar('title'));
    }

    /**
     * Test title method
     * Do not show display field value on view
     *
     * @return void
     * @uses \Avolle\Title\Controller\Component\TitleComponent::formatTitle()
     */
    public function testTitleWithShowDisplayFieldOnViewAsFalse(): void
    {
        $this->Title = new TitleComponent($this->registry, [
            'format' => '{{controller} - }{{displayField}}',
            'showDisplayFieldOnView' => false,
        ]);
        $expected = 'Locations - ';
        $this->setRequest('Locations', 'view', 'Admin');
        $this->Title->beforeRender(new Event('beforeRender', $this->registry->getController()));
        $this->assertSame($expected, $this->Title->getController()->viewBuilder()->getVar('title'));
    }

    /**
     * Set the request to emulatee
     *
     * @param string $controller Controller
     * @param string $action Action
     * @param string|null $prefix Prefix
     */
    protected function setRequest(string $controller, string $action, ?string $prefix = null): void
    {
        $request = (new ServerRequest())
            ->withParam('controller', $controller)
            ->withParam('action', $action);

        if (isset($prefix)) {
            $request = $request->withParam('prefix', $prefix);
        }

        $this->Title->getController()->setRequest($request);
    }
}
