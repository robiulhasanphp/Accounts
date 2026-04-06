<?php
declare(strict_types=1);

namespace App\Controller;

use App\Controller\AppController;

class CompanyInfoController extends AppController
{
    public function index(): void
    {
        $companyInfo = $this->CompanyInfo->find()
            ->contain(['CompanyBranch'])
            ->all();

        $this->set(compact('companyInfo'));
    }

    public function view(int $id): void
    {
        $companyInfo = $this->CompanyInfo->get($id);
        $this->set(compact('companyInfo'));
    }

    public function add()
    {
        $companyInfo = $this->CompanyInfo->newEmptyEntity();

        $companyRoot = $this->CompanyInfo->CompanyRoot
            ->find('list', [
                'keyField' => 'RT_ID',
                'valueField' => 'RT_NAME'
            ])
            ->toArray();

        if ($this->request->is('post')) {

            $companyInfo = $this->CompanyInfo->patchEntity(
                $companyInfo,
                $this->request->getData()
            );

            if ($this->CompanyInfo->save($companyInfo)) {
                $this->Flash->success('Saved successfully');
                return $this->redirect([
                    'controller' => 'CompanyRoot',
                    'action' => 'index'
                ]);
            }

            $this->Flash->error('Save failed');
        }

        $this->set(compact('companyInfo', 'companyRoot'));
    }

    public function edit(int $id)
    {
        $companyInfo = $this->CompanyInfo->get($id);

        $companyRoot = $this->CompanyInfo->CompanyRoot
            ->find('list', [
                'keyField' => 'RT_ID',
                'valueField' => 'RT_NAME'
            ])
            ->toArray();

        if ($this->request->is(['patch', 'post', 'put'])) {

            $companyInfo = $this->CompanyInfo->patchEntity(
                $companyInfo,
                $this->request->getData()
            );

            if ($this->CompanyInfo->save($companyInfo)) {
                $this->Flash->success('Updated successfully');
                return $this->redirect([
                    'controller' => 'CompanyRoot',
                    'action' => 'index'
                ]);
            }

            $this->Flash->error('Update failed');
        }

        $this->set(compact('companyInfo', 'companyRoot'));
    }

    public function delete(int $id)
    {
        $this->request->allowMethod(['post', 'delete']);

        $companyInfo = $this->CompanyInfo->get($id);

        if ($this->CompanyInfo->delete($companyInfo)) {
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
