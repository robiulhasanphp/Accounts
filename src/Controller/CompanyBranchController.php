<?php
declare(strict_types=1);

namespace App\Controller;

use App\Controller\AppController;

class CompanyBranchController extends AppController
{
    public function index(): void
    {
        $companyBranch = $this->CompanyBranch->find()->all();
        $this->set(compact('companyBranch'));
    }

    public function view(int $id): void
    {
        $companyBranch = $this->CompanyBranch->get($id);
        $this->set(compact('companyBranch'));
    }

    public function showBranch(int $companyId): void
    {
        $companyBranch = $this->CompanyBranch->find()
            ->where(['CMP_ID' => $companyId])
            ->all();

        $this->set(compact('companyBranch'));
    }

    public function add()
    {
        $companyBranch = $this->CompanyBranch->newEmptyEntity();

        $companyInfo = $this->CompanyBranch->CompanyInfo
            ->find('list', [
                'keyField' => 'CMP_ID',
                'valueField' => 'CMP_NAME'
            ])
            ->toArray();

        if ($this->request->is('post')) {

            $companyBranch = $this->CompanyBranch->patchEntity(
                $companyBranch,
                $this->request->getData()
            );

            if ($this->CompanyBranch->save($companyBranch)) {
                $this->Flash->success('Saved successfully');
                return $this->redirect([
                    'controller' => 'CompanyRoot',
                    'action' => 'index'
                ]);
            }

            $this->Flash->error('Save failed');
        }

        $this->set(compact('companyBranch', 'companyInfo'));
    }

    public function edit(int $id)
    {
        $companyBranch = $this->CompanyBranch->get($id);

        $companyInfo = $this->CompanyBranch->CompanyInfo
            ->find('list', [
                'keyField' => 'CMP_ID',
                'valueField' => 'CMP_NAME'
            ])
            ->toArray();

        if ($this->request->is(['patch', 'post', 'put'])) {

            $companyBranch = $this->CompanyBranch->patchEntity(
                $companyBranch,
                $this->request->getData()
            );

            if ($this->CompanyBranch->save($companyBranch)) {
                $this->Flash->success('Updated successfully');
                return $this->redirect([
                    'controller' => 'CompanyRoot',
                    'action' => 'index'
                ]);
            }

            $this->Flash->error('Update failed');
        }

        $this->set(compact('companyBranch', 'companyInfo'));
    }

    public function delete(int $id)
    {
        $this->request->allowMethod(['post', 'delete']);

        $companyBranch = $this->CompanyBranch->get($id);

        if ($this->CompanyBranch->delete($companyBranch)) {
            $this->Flash->success('Deleted successfully');
        } else {
            $this->Flash->error('Delete failed');
        }

        return $this->redirect([
            'controller' => 'CompanyRoot',
            'action' => 'index'
        ]);
    }
}
