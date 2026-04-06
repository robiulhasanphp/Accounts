<?php
declare(strict_types=1);
namespace App\Controller;

use App\Controller\AppController;
use Cake\Http\Exception\NotFoundException;

class CompanyRootController extends AppController
{
    /**
     * List all company roots with associated company info
     */
    public function index(): void
    {
        $companyRootTable = $this->fetchTable('CompanyRoot');
        $companyRoot = $companyRootTable->find()
            ->contain(['CompanyInfo'])
            ->all();

        $this->set(compact('companyRoot'));
    }

    /**
     * Display single company root record
     */
    public function view(int $id): void
    {
        if (!$id) {
            throw new NotFoundException(__('Invalid company root'));
        }

        $companyRootTable = $this->fetchTable('CompanyRoot');
        $companyRoot = $companyRootTable->get($id);
        $this->set(compact('companyRoot'));
    }

    /**
     * Create new company root
     */
    public function add()
    {
        $companyRootTable = $this->fetchTable('CompanyRoot');
        $companyRoot = $companyRootTable->newEmptyEntity();

        if ($this->request->is('post')) {
            $companyRoot = $companyRootTable->patchEntity(
                $companyRoot,
                $this->request->getData()
            );

            if ($companyRootTable->save($companyRoot)) {
                $this->Flash->success(__('Company root saved successfully'));
                return $this->redirect(['action' => 'index']);
            }

            $this->Flash->error(__('Failed to save company root'));
        }

        $this->set(compact('companyRoot'));
    }

    /**
     * Get branches for selected company root
     */
    public function getBranches()
    {
        return $this->response->withStringBody('xyz');
    }
}




