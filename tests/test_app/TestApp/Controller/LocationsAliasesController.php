<?php
declare(strict_types=1);

namespace TestApp\Controller;

/**
 * LocationsAliases Controller
 *
 * @property \TestApp\Model\Table\LocationsTable $Locations
 * @method \TestApp\Model\Entity\Location[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 * @noinspection PhpFullyQualifiedNameUsageInspection
 */
class LocationsAliasesController extends AppController
{
    /**
     * @inheritDoc
     */
    protected ?string $defaultTable = 'Locations';

    /**
     * View method
     *
     * @param string|null $id Location id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $location = $this->Locations->get($id);

        $this->set('location', $location);
    }
}
