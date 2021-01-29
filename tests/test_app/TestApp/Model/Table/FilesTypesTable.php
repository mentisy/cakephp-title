<?php
declare(strict_types=1);

namespace TestApp\Model\Table;

use Cake\ORM\Table;

/**
 * FilesTypes Model
 *
 * @method \TestApp\Model\Entity\FilesType get($primaryKey, $options = [])
 * @method \TestApp\Model\Entity\FilesType newEntity($data = null, array $options = [])
 * @method \TestApp\Model\Entity\FilesType[] newEntities(array $data, array $options = [])
 * @method \TestApp\Model\Entity\FilesType|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \TestApp\Model\Entity\FilesType patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \TestApp\Model\Entity\FilesType[] patchEntities($entities, array $data, array $options = [])
 * @method \TestApp\Model\Entity\FilesType findOrCreate($search, callable $callback = null, $options = [])
 * @noinspection PhpFullyQualifiedNameUsageInspection
 */
class FilesTypesTable extends Table
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

        $this->setTable('files_types');
        $this->setDisplayField(['id', 'name']);
        $this->setPrimaryKey('id');
    }
}
