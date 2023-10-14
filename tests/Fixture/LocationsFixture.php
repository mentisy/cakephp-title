<?php
declare(strict_types=1);

namespace Avolle\Title\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * LocationsFixture
 */
class LocationsFixture extends TestFixture
{
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
                'name' => 'Ålesund',
                'city' => 'Ålesund',
            ],
        ];
        parent::init();
    }
}
