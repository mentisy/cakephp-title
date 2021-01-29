<?php
declare(strict_types=1);

namespace TestApp\Model\Table;

use Cake\ORM\Table;

/**
 * Monitoring Model
 *
 * @method \TestApp\Model\Entity\Monitoring get($primaryKey, $options = [])
 * @method \TestApp\Model\Entity\Monitoring newEntity($data = null, array $options = [])
 * @method \TestApp\Model\Entity\Monitoring[] newEntities(array $data, array $options = [])
 * @method \TestApp\Model\Entity\Monitoring|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \TestApp\Model\Entity\Monitoring|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \TestApp\Model\Entity\Monitoring patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \TestApp\Model\Entity\Monitoring[] patchEntities($entities, array $data, array $options = [])
 * @method \TestApp\Model\Entity\Monitoring findOrCreate($search, callable $callback = null, $options = [])
 * @noinspection PhpFullyQualifiedNameUsageInspection
 */
class MonitoringTable extends Table
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

        $this->setTable('monitoring');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');
    }
}
