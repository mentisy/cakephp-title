<?php
declare(strict_types=1);

namespace TestApp\Controller;

/**
 * FilesTypes Controller
 *
 * @property \TestApp\Model\Table\FilesTypesTable $FilesTypes
 * @method \TestApp\Model\Entity\FilesType[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 * @noinspection PhpFullyQualifiedNameUsageInspection
 */
class FilesTypesController extends AppController
{
    /**
     * View method
     *
     * @param string|null $id Files Type id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $filesType = $this->FilesTypes->get($id);

        $this->set(compact('filesType'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Files Type id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $filesType = $this->FilesTypes->get($id, [
            'contain' => [],
        ]);
        if ($this->getRequest()->is(['patch', 'post', 'put'])) {
            $filesType = $this->FilesTypes->patchEntity($filesType, $this->getRequest()->getData());
            if ($this->FilesTypes->save($filesType)) {
                $this->Flash->success(__('The files type has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The files type could not be saved. Please, try again.'));
        }
        $this->set(compact('filesType'));
    }
}
