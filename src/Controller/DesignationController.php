<?php
declare(strict_types=1);
namespace App\Controller;

use App\Controller\AppController;
use Cake\Http\Exception\NotFoundException;

class DesignationController extends AppController
{
    /**
     * List all designations
     */
    public function index(): void
    {
        $designationTable = $this->fetchTable('Designation');
        $designation = $designationTable->find()
            ->where(['BAS_TYPE_ID' => 2])
            ->all();

        $this->set(compact('designation'));
    }

    /**
     * Display single designation
     */
    public function view(int $id)
    {
        if (!$id) {
            throw new NotFoundException(__('Invalid designation'));
        }

        $designationTable = $this->fetchTable('Designation');
        $designation = $designationTable->get($id);
        $this->set(compact('designation'));
    }

    /**
     * Create new designation
     */
    public function add()
    {
        $designationTable = $this->fetchTable('Designation');
        $designation = $designationTable->newEmptyEntity();

        if ($this->request->is('post')) {
            $designation = $designationTable->patchEntity($designation, $this->request->getData());
            $designation->BAS_TYPE_ID = 2;

            if ($designationTable->save($designation)) {
                $this->Flash->success(__('Designation created successfully'));
                return $this->redirect(['action' => 'index']);
            }

            $this->Flash->error(__('Failed to create designation'));
        }

        $this->set(compact('designation'));
    }

    /**
     * Edit designation
     */
    public function edit(int $id)
    {
        if (!$id) {
            throw new NotFoundException(__('Invalid designation'));
        }

        $designationTable = $this->fetchTable('Designation');
        $designation = $designationTable->get($id);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $designation = $designationTable->patchEntity($designation, $this->request->getData());
            $designation->BAS_TYPE_ID = 2;

            if ($designationTable->save($designation)) {
                $this->Flash->success(__('Designation updated successfully'));
                return $this->redirect(['action' => 'index']);
            }

            $this->Flash->error(__('Failed to update designation'));
        }

        $this->set(compact('designation'));
    }

    /**
     * Delete designation
     */
    public function delete(int $id)
    {
        $this->request->allowMethod(['post', 'delete']);

        if (!$id) {
            throw new NotFoundException(__('Invalid designation'));
        }

        $designationTable = $this->fetchTable('Designation');
        $designation = $designationTable->get($id);

        if ($designationTable->delete($designation)) {
            $this->Flash->success(__('Designation deleted successfully'));
        } else {
            $this->Flash->error(__('Failed to delete designation'));
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
}




