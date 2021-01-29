# Title plugin for CakePHP

[![Build Status](https://img.shields.io/github/workflow/status/cakephp/app/CakePHP%20App%20CI/master?style=flat-square)](https://github.com/cakephp/app/actions)
[![PHPStan](https://img.shields.io/badge/PHPStan-level%207-brightgreen.svg?style=flat-square)](https://github.com/phpstan/phpstan)
![Title Plugin CI](https://github.com/mentisy/cakephp-title/workflows/Title%20Plugin%20CI/badge.svg)

A plugin to automatically generate titles for web pages using routes from the HTTP request url.

This plugin will automatically generate a working title using values such as the request's `controller`, `action`, `prefix` if there is one and the `app name` if you provide one.

You can set our own format by configuring the Component when loading it in your application.

### Configuration options:
* `format` - How the generated title should be formatted. See valid placeholders below.
    * Default format: `{{prefix} - }{{controller} - }{{action} - }{{displayField}}{ &raquo; {appName}}`
    * Example generated: Admin - Files Types - View - PDF &raquo; CakePHP application
* `appName` - Your application's name. Used as replacement for the `appName` placeholder.
* `ignoreIndex` - If true, and the requested action is `index`, then the action will not be placed in the title
* `showDisplayFieldOnView` - If true, the display field value (e.g. the files type's name) will be placed in the title.

### Valid placeholders:
* `appName` - Will be replaced by the app's name, if you provide one in the component's configuration
* `controller` - Will be replaced by the requested controller
* `action` - Will be replaced by the requested action
* `prefix` - Will be replaced by the requested prefix, if there is one.
* `displayField` - If your action stores an entity variable in the view, the component attempts to get the entity's display field value to display in the title
    * For example: If you have a table called Tools and the display field is the tool's name, if will place the tool's name in the title.
    * The display field value is not fetched on its own from the database. It attempts to find a view var in which to get the value from.
    * Please note that the entity variable must be named using cake's convention. A Tool entity variable must be `$tool`. A FilesType entity must be named `$filesType`.

### Usage:

#### In your Application.php file:
```
    // On the top, with your other use statements
    use Avolle\Title\Plugin as TitlePlugin;

    /**
     * Boostrap method. Load required plugins
     *
     * @return void
     */
    public function bootstrap(): void
    {
        $this->addPlugin(TitlePlugin::class, ['autload' => true]);
    }
```

#### In your AppController.php file:
```
    /**
     * Initialization hook method.
     *
     * @return void
     * @throws \Exception
     */
    public function initialize(): void
    {
        parent::initialize();

        $this->loadComponent('Avolle/Title.Title', [
            'appName' => 'Title App',
            'format' => '{{prefix} - }{{controller} - }{{action} - }{{displayField}}{ &raquo; {appName}}',
            'ignoreIndex' => false,
            'showDisplayFieldOnView' => true,
        ]);
    }
```

#### In your layout file
```
<head>
<title><?= $title; ?></title>
</head>
```
