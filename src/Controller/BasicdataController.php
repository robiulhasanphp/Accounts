<?php
declare(strict_types=1);
namespace App\Controller;

use App\Controller\AppController;
use Cake\Http\Exception\NotFoundException;

class BasicdataController extends AppController
{
    /**
     * List all basic data records
     */
    public function index(): void
    {
        $basicdataTable = $this->fetchTable('Basicdata');
        $basicdata = $basicdataTable->find()->all();
        $this->set(compact('basicdata'));
    }

    /**
     * Display single basic data record
     */
    public function view(int $id): void
    {
        if (!$id) {
            throw new NotFoundException(__('Invalid record'));
        }

        $basicdataTable = $this->fetchTable('Basicdata');
        $basicdata = $basicdataTable->get($id);
        $this->set(compact('basicdata'));
    }

    /**
     * Create new basic data record
     */
    public function add()
    {
        $basicdataTable = $this->fetchTable('Basicdata');
        $basicdata = $basicdataTable->newEmptyEntity();

        if ($this->request->is('post')) {
            $basicdata = $basicdataTable->patchEntity(
                $basicdata,
                $this->request->getData()
            );

            $basicdata->bas_type_id = 3;

            if ($basicdataTable->save($basicdata)) {
                $this->Flash->success(__('Record created successfully'));
                return $this->redirect(['action' => 'index']);
            }

            $this->Flash->error(__('Failed to create record'));
        }

        $this->set(compact('basicdata'));
    }

    /**
     * Edit basic data record
     */
    public function edit(int $id)
    {
        if (!$id) {
            throw new NotFoundException(__('Invalid record'));
        }

        $basicdataTable = $this->fetchTable('Basicdata');
        $basicdata = $basicdataTable->get($id);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $basicdata = $basicdataTable->patchEntity(
                $basicdata,
                $this->request->getData()
            );

            $basicdata->bas_type_id = 3;

            if ($basicdataTable->save($basicdata)) {
                $this->Flash->success(__('Record updated successfully'));
                return $this->redirect(['action' => 'index']);
            }

            $this->Flash->error(__('Failed to update record'));
        }

        $this->set(compact('basicdata'));
    }

    /**
     * Delete basic data record
     */
    public function delete(int $id)
    {
        $this->request->allowMethod(['post', 'delete']);

        if (!$id) {
            throw new NotFoundException(__('Invalid record'));
        }

        $basicdataTable = $this->fetchTable('Basicdata');
        $basicdata = $basicdataTable->get($id);

        if ($basicdataTable->delete($basicdata)) {
            $this->Flash->success(__('Record deleted successfully'));
        } else {
            $this->Flash->error(__('Failed to delete record'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * Check user authorization
     */
    public function isAuthorized($user): bool
    {
        if ($this->request->getParam('action') === 'add') {
            return true;
        }

        return parent::isAuthorized($user);
    }




