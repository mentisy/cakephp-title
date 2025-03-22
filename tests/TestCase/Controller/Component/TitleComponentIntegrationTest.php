<?php
/** @noinspection PhpMissingFieldTypeInspection */
declare(strict_types=1);

namespace Avolle\Title\Test\TestCase\Controller\Component;

use Cake\Routing\Router;
use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;

/**
 * Avolle\Title\Controller\Component\TitleComponent Test Case
 *
 * @uses \TestApp\Controller\FilesTypesController
 * @uses \TestApp\Controller\LocationsController
 * @uses \TestApp\Controller\Admin\MonitoringController
 */
class TitleComponentIntegrationTest extends TestCase
{
    use IntegrationTestTrait;

    /**
     * Fixtures
     *
     * @var string[]
     */
    public array $fixtures = [
        'plugin.Avolle/Title.FilesTypes',
        'plugin.Avolle/Title.Locations',
        'plugin.Avolle/Title.Monitoring',
    ];

    protected function setUp(): void
    {
        Router::reload();
        parent::setUp();
    }

    /**
     * Test title on request
     * Basic test
     *
     * @return void
     * @uses \Avolle\Title\Controller\Component\TitleComponent::formatTitle()
     */
    public function testTitle(): void
    {
        $expected = '<title>Locations - Index - </title>';
        $this->get(['controller' => 'Locations', 'action' => 'index']);
        $this->assertTitle($expected);
    }

    /**
     * Test title on request
     * Basic test - prefixed
     *
     * @return void
     * @uses \Avolle\Title\Controller\Component\TitleComponent::formatTitle()
     */
    public function testTitlePrefixed(): void
    {
        $expected = '<title>Admin - Monitoring - Add - </title>';
        $this->get(['prefix' => 'Admin', 'controller' => 'Monitoring', 'action' => 'add']);
        $this->assertTitle($expected);
    }

    /**
     * Test title on request
     * Display field should be shown - Display field is a string value
     *
     * @return void
     * @uses \Avolle\Title\Controller\Component\TitleComponent::formatTitle()
     */
    public function testTitleDisplayFieldString(): void
    {
        $expected = '<title>Locations - View - Ålesund</title>';
        $this->get(['controller' => 'Locations', 'action' => 'view', 1]);
        $this->assertTitle($expected);
    }

    /**
     * Test title on request
     * Display field should be shown - Display field is an integer value
     *
     * @return void
     * @uses \Avolle\Title\Controller\Component\TitleComponent::formatTitle()
     */
    public function testTitleDisplayFieldInteger(): void
    {
        $expected = '<title>Admin - Monitoring - View - 1</title>';
        $this->get(['prefix' => 'Admin', 'controller' => 'Monitoring', 'action' => 'view', 1]);
        $this->assertTitle($expected);
    }

    /**
     * Test title on request
     * Display field should be shown - Display field is an array value
     *
     * @return void
     * @uses \Avolle\Title\Controller\Component\TitleComponent::formatTitle()
     */
    public function testTitleDisplayFieldArray(): void
    {
        $expected = '<title>Files Types - View - 1 - Files type number one</title>';
        $this->get(['controller' => 'FilesTypes', 'action' => 'view', 1]);
        $this->assertTitle($expected);
    }

    /**
     * Test title on request
     * Model is multiple words (FilesTypes) should be spaced
     *
     * @return void
     * @uses \Avolle\Title\Controller\Component\TitleComponent::formatTitle()
     */
    public function testTitleEntityIsMultipleWords(): void
    {
        $expected = '<title>Files Types - View - 1 - Files type number one</title>';
        $this->get(['controller' => 'FilesTypes', 'action' => 'view', 1]);
        $this->assertTitle($expected);
    }

    /**
     * Test testTitleWithNonDefaultTableName method
     *
     * If you have a controller that changes the `defaultTable` property, then this test will assert that works OK
     *
     * @return void
     * @covers \Avolle\Title\Controller\Component\TitleComponent::formatTitle()
     */
    public function testTitleWithNonDefaultTableName(): void
    {
        $expected = '<title>Locations Aliases - View - Ålesund</title>';
        $this->get(['controller' => 'LocationsAliases', 'action' => 'view', 1]);
        $this->assertTitle($expected);
    }

    /**
     * Assert that title is set as expected
     * Will show actual title if assertion is wrong
     *
     * @param string $expected Expected title
     * @return void
     */
    protected function assertTitle(string $expected): void
    {
        preg_match('/<title>.*?<\/title>/', (string)$this->_response, $matches);
        $this->assertResponseContains($expected, 'Actual title: ' . ($matches[0] ?? 'No title found'));
    }
}
