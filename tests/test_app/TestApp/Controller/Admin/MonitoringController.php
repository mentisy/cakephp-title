<?php
declare(strict_types=1);

namespace TestApp\Controller\Admin;

use TestApp\Controller\AppController;

/**
 * Monitoring Controller
 *
 * @property \TestApp\Model\Table\MonitoringTable $Monitoring
 * @method \TestApp\Model\Entity\Monitoring[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 * @noinspection PhpFullyQualifiedNameUsageInspection
 */
class MonitoringController extends AppController
{
    /**
     * View method
     *
     * @param string|null $id Monitoring id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $monitoring = $this->Monitoring->get($id);

        $this->set('monitoring', $monitoring);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $monitoring = $this->Monitoring->newEmptyEntity();
        if ($this->request->is('post')) {
            $monitoring = $this->Monitoring->patchEntity($monitoring, $this->getRequest()->getData());
            if ($this->Monitoring->save($monitoring)) {
                $this->Flash->success(__('The monitoring has been saved.'));

                return $this->redirect(['action' => 'view', $monitoring->id]);
            }
            $this->Flash->error(__('The monitoring could not be saved. Please, try again.'));
        }
        $this->set(compact('monitoring'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Monitoring id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $monitoring = $this->Monitoring->get($id);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $monitoring = $this->Monitoring->patchEntity($monitoring, $this->getRequest()->getData());
            if ($this->Monitoring->save($monitoring)) {
                $this->Flash->success(__('The monitoring has been saved.'));

                return $this->redirect(['action' => 'view', $monitoring->id]);
            }
            $this->Flash->error(__('The monitoring could not be saved. Please, try again.'));
        }
        $this->set(compact('monitoring'));
    }
}
