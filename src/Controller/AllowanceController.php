<?php
declare(strict_types=1);

namespace App\Controller;

use App\Controller\AppController;
use Cake\Http\Exception\NotFoundException;
use Cake\ORM\Exception\PersistenceFailedException;

class AllowanceController extends AppController
{
    public function index(): void
    {
        $allowances = $this->Allowance
            ->find()
            ->contain(['Ledgerstype'])
            ->orderDesc('Allowance.created')
            ->all();

        $this->set(compact('allowances'));
    }

    public function view(int $id): void
    {
        try {
            $allowance = $this->Allowance->get($id, [
                'contain' => ['Ledgerstype']
            ]);
        } catch (\Exception $e) {
            throw new NotFoundException('Allowance not found');
        }

        $this->set(compact('allowance'));
    }

    public function add()
    {
        $allowance = $this->Allowance->newEmptyEntity();

        if ($this->request->is('post')) {

            $allowance = $this->Allowance->patchEntity(
                $allowance,
                $this->request->getData()
            );

            $this->applyDefaults($allowance);

            $connection = $this->Allowance->getConnection();
            $connection->begin();

            try {
                $this->Allowance->saveOrFail($allowance);

                $this->createLedgerType($allowance);

                $connection->commit();

                $this->Flash->success(__('Saved successfully'));
                return $this->redirect(['action' => 'index']);

            } catch (\Throwable $e) {
                $connection->rollback();
                $this->Flash->error(__('Save failed'));
            }
        }

        $this->set(compact('allowance'));
    }

    public function edit(int $id)
    {
        $allowance = $this->Allowance->get($id);

        if ($this->request->is(['patch', 'post', 'put'])) {

            $allowance = $this->Allowance->patchEntity(
                $allowance,
                $this->request->getData()
            );

            $allowance->bas_type_id = 6;

            if ($this->Allowance->save($allowance)) {
                $this->Flash->success(__('Updated'));
                return $this->redirect(['action' => 'index']);
            }

            $this->Flash->error(__('Update failed'));
        }

        $this->set(compact('allowance'));
    }

    public function delete(int $id)
    {
        $this->request->allowMethod(['post', 'delete']);

        $allowance = $this->Allowance->get($id);

        if ($this->Allowance->delete($allowance)) {
            $this->Flash->success(__('Deleted'));
        } else {
            $this->Flash->error(__('Delete failed'));
        }

        return $this->redirect(['action' => 'index']);
    }

    private function applyDefaults($allowance): void
    {
        $userId = $this->request->getAttribute('identity')->id ?? 0;

        $allowance->company_id = 1;
        $allowance->branch_id = 1;
        $allowance->ldg_designation = 1;
        $allowance->ldg_create_by = $userId;
        $allowance->ldg_last_edit_by = $userId;
    }

    private function createLedgerType($allowance): void
    {
        $ledgerstype = $this->Allowance->Ledgerstype->newEmptyEntity();

        $ledgerstype->ldg_id = $allowance->ldg_id;
        $ledgerstype->ltm_id = $allowance->ldg_types === 'ALW'
            ? LDG_TYPE_ALLOWANCES
            : LDG_TYPE_DEDUCTION;

        $this->Allowance->Ledgerstype->saveOrFail($ledgerstype);
    }

    public function isAuthorized($user): bool
    {
        if ($this->request->getParam('action') === 'add') {
            return true;
        }

        return parent::isAuthorized($user);
    }
}
