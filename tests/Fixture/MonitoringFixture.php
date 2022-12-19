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
    public string $table = 'monitoring';

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
