<?php
declare(strict_types=1);

namespace Avolle\Title\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * FilesTypesFixture
 */
class FilesTypesFixture extends TestFixture
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
                'name' => 'Files type number one',
                'title' => 'Files type number one',
            ],
            [
                'id' => 2,
                'name' => 'Files type number two',
                'title' => 'Files type number two',
            ],
        ];
        parent::init();
    }
}
