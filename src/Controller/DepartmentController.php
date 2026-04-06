<?php
declare(strict_types=1);
namespace App\Controller;

use App\Controller\AppController;
use Cake\Http\Exception\NotFoundException;

class DepartmentController extends AppController
{
    /**
     * List all departments
     */
    public function index(): void
    {
        $departmentTable = $this->fetchTable('Department');
        $department = $departmentTable->find()
            ->where(['BAS_TYPE_ID' => DEPARTMENT_TYPE])
            ->all();

        $this->set(compact('department'));
    }

    /**
     * Display single department
     */
    public function view(int $id)
    {
        if (!$id) {
            throw new NotFoundException(__('Invalid department'));
        }

        $departmentTable = $this->fetchTable('Department');
        $department = $departmentTable->get($id);
        $this->set(compact('department'));
    }

    /**
     * Create new department
     */
    public function add()
    {
        $departmentTable = $this->fetchTable('Department');
        $department = $departmentTable->newEmptyEntity();

        if ($this->request->is('post')) {
            $department = $departmentTable->patchEntity($department, $this->request->getData());
            $department->BAS_TYPE_ID = DEPARTMENT_TYPE;

            if ($departmentTable->save($department)) {
                $this->Flash->success(__('Department created successfully'));
                return $this->redirect(['action' => 'index']);
            }

            $this->Flash->error(__('Failed to create department'));
        }

        $this->set(compact('department'));
    }

    /**
     * Edit department
     */
    public function edit(int $id)
    {
        if (!$id) {
            throw new NotFoundException(__('Invalid department'));
        }

        $departmentTable = $this->fetchTable('Department');
        $department = $departmentTable->get($id);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $department = $departmentTable->patchEntity($department, $this->request->getData());
            $department->BAS_TYPE_ID = DEPARTMENT_TYPE;

            if ($departmentTable->save($department)) {
                $this->Flash->success(__('Department updated successfully'));
                return $this->redirect(['action' => 'index']);
            }

            $this->Flash->error(__('Failed to update department'));
        }

        $this->set(compact('department'));
    }

    /**
     * Delete department
     */
    public function delete(int $id)
    {
        $this->request->allowMethod(['post', 'delete']);

        if (!$id) {
            throw new NotFoundException(__('Invalid department'));
        }

        $departmentTable = $this->fetchTable('Department');
        $department = $departmentTable->get($id);

        if ($departmentTable->delete($department)) {
            $this->Flash->success(__('Department deleted successfully'));
        } else {
            $this->Flash->error(__('Failed to delete department'));
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




