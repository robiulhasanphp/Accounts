<?php
declare(strict_types=1);
namespace App\Controller;

use App\Controller\AppController;
use Cake\Http\Exception\NotFoundException;

class CompanyInfoController extends AppController
{
    /**
     * List all company information records
     */
    public function index(): void
    {
        $companyInfoTable = $this->fetchTable('CompanyInfo');
        $companyInfo = $companyInfoTable->find()
            ->contain(['CompanyBranch'])
            ->all();

        $this->set(compact('companyInfo'));
    }

    /**
     * Display single company information record
     */
    public function view(int $id): void
    {
        if (!$id) {
            throw new NotFoundException(__('Invalid company'));
        }

        $companyInfoTable = $this->fetchTable('CompanyInfo');
        $companyInfo = $companyInfoTable->get($id);
        $this->set(compact('companyInfo'));
    }

    /**
     * Create new company information
     */
    public function add()
    {
        $companyInfoTable = $this->fetchTable('CompanyInfo');
        $companyInfo = $companyInfoTable->newEmptyEntity();

        $companyRootTable = $this->fetchTable('CompanyRoot');
        $companyRoot = $companyRootTable->find('list', [
            'keyField' => 'RT_ID',
            'valueField' => 'RT_NAME'
        ])->toArray();

        if ($this->request->is('post')) {
            $companyInfo = $companyInfoTable->patchEntity(
                $companyInfo,
                $this->request->getData()
            );

            if ($companyInfoTable->save($companyInfo)) {
                $this->Flash->success(__('Company created successfully'));
                return $this->redirect(['controller' => 'CompanyRoot', 'action' => 'index']);
            }

            $this->Flash->error(__('Failed to create company'));
        }

        $this->set(compact('companyInfo', 'companyRoot'));
    }

    /**
     * Edit company information
     */
    public function edit(int $id)
    {
        if (!$id) {
            throw new NotFoundException(__('Invalid company'));
        }

        $companyInfoTable = $this->fetchTable('CompanyInfo');
        $companyInfo = $companyInfoTable->get($id);

        $companyRootTable = $this->fetchTable('CompanyRoot');
        $companyRoot = $companyRootTable->find('list', [
            'keyField' => 'RT_ID',
            'valueField' => 'RT_NAME'
        ])->toArray();

        if ($this->request->is(['patch', 'post', 'put'])) {
            $companyInfo = $companyInfoTable->patchEntity(
                $companyInfo,
                $this->request->getData()
            );

            if ($companyInfoTable->save($companyInfo)) {
                $this->Flash->success(__('Company updated successfully'));
                return $this->redirect(['controller' => 'CompanyRoot', 'action' => 'index']);
            }

            $this->Flash->error(__('Failed to update company'));
        }

        $this->set(compact('companyInfo', 'companyRoot'));
    }

    /**
     * Delete company information
     */
    public function delete(int $id)
    {
        $this->request->allowMethod(['post', 'delete']);

        if (!$id) {
            throw new NotFoundException(__('Invalid company'));
        }

        $companyInfoTable = $this->fetchTable('CompanyInfo');
        $companyInfo = $companyInfoTable->get($id);

        if ($companyInfoTable->delete($companyInfo)) {
            $this->Flash->success(__('Company deleted successfully'));
        } else {
            $this->Flash->error(__('Failed to delete company'));
        }

        return $this->redirect(['controller' => 'CompanyRoot', 'action' => 'index']);
    }
}

        return $this->redirect([
            'controller' => 'CompanyRoot',
            'action' => 'index'
        ]);
    }
}




