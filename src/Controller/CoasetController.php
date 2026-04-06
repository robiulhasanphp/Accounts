<?php
declare(strict_types=1);
namespace App\Controller;

use App\Controller\AppController;
use Cake\Http\Exception\NotFoundException;
use Cake\ORM\TableRegistry;
use Cake\Datasource\ConnectionManager;

class CoasetController extends AppController
{
    public function index(): void
    {
        $coaset = $this->Coaset->find()->all();
        $this->set(compact('coaset'));
    }

    public function view(int $id): void
    {
        $coaset = $this->Coaset->get($id);

        if (!$coaset) {
            throw new NotFoundException('Record not found');
        }

        $this->set(compact('coaset'));
    }

    public function add()
    {
        $coaset = $this->Coaset->newEmptyEntity();

        if ($this->request->is('post')) {

            $coaset = $this->Coaset->patchEntity(
                $coaset,
                $this->request->getData()
            );

            if ($this->Coaset->save($coaset)) {
                $this->Flash->success('Saved successfully');
                return $this->redirect(['action' => 'index']);
            }

            $this->Flash->error('Save failed');
        }

        $this->set(compact('coaset'));
    }

    public function chartOfAcc(int $setId)
    {
        $user = $this->Auth->user();

        $coaList = $this->Coaset->Chartofacc
            ->find('list', ['keyField' => 'COA_ID', 'valueField' => 'COA_NAME'])
            ->toArray();

        $existingLedgers = $this->Coaset->Coasetledger
            ->find('list', ['keyField' => 'LDG_ID', 'valueField' => 'LDG_ID'])
            ->where(['SET_ID' => $setId])
            ->group('LDG_ID')
            ->toArray();

        $ledgerQuery = $this->Coaset->Ledgers->find('list', [
            'keyField' => 'LDG_ID',
            'valueField' => 'LDG_NAME'
        ]);

        if (!empty($existingLedgers)) {
            $ledgerQuery->where(['LDG_ID NOT IN' => $existingLedgers]);
        }

        $ledgers = $ledgerQuery->toArray();

        $coaset = $this->Coaset->get($setId);

        $coaIds = $this->Coaset->Coasetledger
            ->find('list', ['keyField' => 'COA_ID', 'valueField' => 'COA_ID'])
            ->where(['SET_ID' => $setId])
            ->group('COA_ID')
            ->toArray();

        $coasetledger = $this->Coaset->Coasetledger
            ->find()
            ->contain(['Chartofacc', 'Ledgers'])
            ->where([
                'SET_ID' => $setId,
                'COA_ID IN' => $coaIds
            ])
            ->order(['Chartofacc.COA_NAME' => 'ASC'])
            ->all();

        if ($this->request->is('post')) {

            $data = $this->request->getData();

            $coaId = $data['Name'];
            $ledgerIds = $data['ledger'] ?? [];

            foreach ($ledgerIds as $ldgId) {

                $entity = $this->Coaset->Coasetledger->newEmptyEntity();

                $entity->SET_ID = $setId;
                $entity->COA_ID = $coaId;
                $entity->LDG_ID = $ldgId;
                $entity->SLD_BY = $user['USR_ID'];

                $this->Coaset->Coasetledger->save($entity);
            }

            $this->Flash->success('Updated successfully');
            return $this->redirect(['action' => 'index']);
        }

        $this->set(compact(
            'coaList',
            'ledgers',
            'coasetledger',
            'coaset'
        ));
    }

    public function edit(int $id)
    {
        $coaset = $this->Coaset->Coasetledger->get($id);

        if ($this->request->is(['patch', 'post', 'put'])) {

            $coaset = $this->Coaset->Coasetledger->patchEntity(
                $coaset,
                $this->request->getData()
            );

            if ($this->Coaset->Coasetledger->save($coaset)) {
                $this->Flash->success('Updated successfully');
                return $this->redirect(['action' => 'index']);
            }

            $this->Flash->error('Update failed');
        }

        $this->set(compact('coaset'));
    }

    public function delete(int $id)
    {
        $this->request->allowMethod(['post', 'delete']);

        $coaset = $this->Coaset->Coasetledger->get($id);

        if ($this->Coaset->Coasetledger->delete($coaset)) {
            $this->Flash->success('Deleted successfully');
        } else {
            $this->Flash->error('Delete failed');
        }

        return $this->redirect(['action' => 'index']);
    }

    public function isAuthorized($user): bool
    {
        if ($this->request->getParam('action') === 'add') {
            return true;
        }

        return parent::isAuthorized($user);
    }
}




