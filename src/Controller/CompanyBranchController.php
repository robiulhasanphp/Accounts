<?php
declare(strict_types=1);
namespace App\Controller;

use App\Controller\AppController;
use Cake\Http\Exception\NotFoundException;

class CompanyBranchController extends AppController
{
    /**
     * List all company branches
     */
    public function index(): void
    {
        $companyBranchTable = $this->fetchTable('CompanyBranch');
        $companyBranch = $companyBranchTable->find()->all();
        $this->set(compact('companyBranch'));
    }

    /**
     * Display single company branch
     */
    public function view(int $id): void
    {
        if (!$id) {
            throw new NotFoundException(__('Invalid branch'));
        }

        $companyBranchTable = $this->fetchTable('CompanyBranch');
        $companyBranch = $companyBranchTable->get($id);
        $this->set(compact('companyBranch'));
    }

    /**
     * Show branches for selected company
     */
    public function showBranch(int $companyId): void
    {
        $companyBranchTable = $this->fetchTable('CompanyBranch');
        $companyBranch = $companyBranchTable->find()
            ->where(['CMP_ID' => $companyId])
            ->all();

        $this->set(compact('companyBranch'));
    }

    /**
     * Create new company branch
     */
    public function add()
    {
        $companyBranchTable = $this->fetchTable('CompanyBranch');
        $companyBranch = $companyBranchTable->newEmptyEntity();

        $companyInfoTable = $this->fetchTable('CompanyInfo');
        $companyInfo = $companyInfoTable->find('list', [
            'keyField' => 'CMP_ID',
            'valueField' => 'CMP_NAME'
        ])->toArray();

        if ($this->request->is('post')) {
            $companyBranch = $companyBranchTable->patchEntity(
                $companyBranch,
                $this->request->getData()
            );

            if ($companyBranchTable->save($companyBranch)) {
                $this->Flash->success(__('Branch created successfully'));
                return $this->redirect(['controller' => 'CompanyRoot', 'action' => 'index']);
            }

            $this->Flash->error(__('Failed to create branch'));
        }

        $this->set(compact('companyBranch', 'companyInfo'));
    }

    /**
     * Edit company branch
     */
    public function edit(int $id)
    {
        if (!$id) {
            throw new NotFoundException(__('Invalid branch'));
        }

        $companyBranchTable = $this->fetchTable('CompanyBranch');
        $companyBranch = $companyBranchTable->get($id);

        $companyInfoTable = $this->fetchTable('CompanyInfo');
        $companyInfo = $companyInfoTable->find('list', [
            'keyField' => 'CMP_ID',
            'valueField' => 'CMP_NAME'
        ])->toArray();

        if ($this->request->is(['patch', 'post', 'put'])) {
            $companyBranch = $companyBranchTable->patchEntity(
                $companyBranch,
                $this->request->getData()
            );

            if ($companyBranchTable->save($companyBranch)) {
                $this->Flash->success(__('Branch updated successfully'));
                return $this->redirect(['controller' => 'CompanyRoot', 'action' => 'index']);
            }

            $this->Flash->error(__('Failed to update branch'));
        }

        $this->set(compact('companyBranch', 'companyInfo'));
    }

    /**
     * Delete company branch
     */
    public function delete(int $id)
    {
        $this->request->allowMethod(['post', 'delete']);

        if (!$id) {
            throw new NotFoundException(__('Invalid branch'));
        }

        $companyBranchTable = $this->fetchTable('CompanyBranch');
        $companyBranch = $companyBranchTable->get($id);

        if ($companyBranchTable->delete($companyBranch)) {
            $this->Flash->success(__('Branch deleted successfully'));
        } else {
            $this->Flash->error(__('Failed to delete branch'));
        }

        return $this->redirect(['controller' => 'CompanyRoot', 'action' => 'index']);
    }
}




