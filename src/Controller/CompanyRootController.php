<?php

namespace App\Controller;

use App\Controller\AppController;

class CompanyRootController extends AppController
{
    public function index(): void
    {
        $companyRoot = $this->CompanyRoot->find()
            ->contain(['CompanyInfo'])
            ->all();

        $this->set(compact('companyRoot'));
    }

    public function view(int $id): void
    {
        $companyRoot = $this->CompanyRoot->get($id);
        $this->set(compact('companyRoot'));
    }

    public function add()
    {
        $companyRoot = $this->CompanyRoot->newEmptyEntity();

        if ($this->request->is('post')) {

            $companyRoot = $this->CompanyRoot->patchEntity(
                $companyRoot,
                $this->request->getData()
            );

            if ($this->CompanyRoot->save($companyRoot)) {
                $this->Flash->success('Saved successfully');
                return $this->redirect(['action' => 'index']);
            }

            $this->Flash->error('Save failed');
        }

        $this->set(compact('companyRoot'));
    }

    public function getBranches()
    {
        return $this->response->withStringBody('xyz');
    }
}
