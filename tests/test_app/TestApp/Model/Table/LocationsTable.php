<?php
declare(strict_types=1);

namespace TestApp\Model\Table;

use Cake\ORM\Table;

/**
 * Locations Model
 *
 * @method \TestApp\Model\Entity\Location get($primaryKey, $options = [])
 * @method \TestApp\Model\Entity\Location newEntity($data = null, array $options = [])
 * @method \TestApp\Model\Entity\Location[] newEntities(array $data, array $options = [])
 * @method \TestApp\Model\Entity\Location|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \TestApp\Model\Entity\Location|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \TestApp\Model\Entity\Location patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \TestApp\Model\Entity\Location[] patchEntities($entities, array $data, array $options = [])
 * @method \TestApp\Model\Entity\Location findOrCreate($search, callable $callback = null, $options = [])
 * @noinspection PhpFullyQualifiedNameUsageInspection
 */
class LocationsTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('locations');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');
    }
}
