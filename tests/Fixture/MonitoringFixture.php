<?php
declare(strict_types=1);

namespace Avolle\Title\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * MonitoringFixture
 */
class MonitoringFixture extends TestFixture
{
    /**
     * Table name
     *
     * @var string
     */
    public $table = 'monitoring';

    /**
     * Fields
     *
     * @var array
     */
    // phpcs:disable
    public $fields = [
        'id' => ['type' => 'integer', 'length' => null, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'comment' => ['type' => 'string', 'length' => 255, 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'precision' => null],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
        ],
        '_options' => [
            'engine' => 'InnoDB',
            'collation' => 'latin1_swedish_ci'
        ],
    ];
    // phpcs:enable
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'id' => 1,
                'comment' => 'Monitor id #1',
            ],
        ];
        parent::init();
    }
}
