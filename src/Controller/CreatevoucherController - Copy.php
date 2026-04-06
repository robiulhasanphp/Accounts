<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

class CreatevoucherController extends AppController
{
    public function index(): void
    {
        $createvoucher = $this->Createvoucher->find()
            ->contain(['Project', 'Department'])
            ->all();

        $this->set(compact('createvoucher'));
    }

    public function add()
    {
        $user = $this->Auth->user();
        $createvoucher = $this->Createvoucher->newEmptyEntity();

        $basic = TableRegistry::getTableLocator()->get('Basicdata');

        $project = $basic->find('list', ['keyField' => 'BAS_ID', 'valueField' => 'BAS_NAME'])
            ->where(['BAS_TYPE_ID' => 5])
            ->toArray();

        $department = $basic->find('list', ['keyField' => 'BAS_ID', 'valueField' => 'BAS_NAME'])
            ->where(['BAS_TYPE_ID' => 4])
            ->toArray();

        $ledgers = $this->Createvoucher->Ledgers->find('list', [
            'keyField' => 'LDG_ID',
            'valueField' => 'LDG_NAME'
        ])->toArray();

        $this->set(compact('project', 'department', 'ledgers'));

        if ($this->request->is('post')) {

            $data = $this->request->getData();

            $debit1 = (float)$data['debit_amount'];
            $credit1 = (float)$data['credit_amount'];
            $debit2 = (float)$data['debit_amount_2'];
            $credit2 = (float)$data['credit_amount_2'];

            if (($debit1 + $debit2) !== ($credit1 + $credit2)) {
                $this->Flash->error('Debit and credit must match');
                return;
            }

            $createvoucher = $this->Createvoucher->patchEntity($createvoucher, $data);

            $createvoucher->VCH_TYPE = 7;
            $createvoucher->VCH_STATUS = 13;
            $createvoucher->VCH_CREATE_BY = $user['USR_ID'];

            $date = $this->formatDate($data['pdate']);
            if (!$date) {
                $this->Flash->error('Invalid date');
                return;
            }

            $createvoucher->VCH_DATE = $date;

            if ($this->Createvoucher->save($createvoucher)) {

                $this->saveVoucherDetails($createvoucher, $data);

                $this->Flash->success('Voucher saved');
                return $this->redirect(['action' => 'index']);
            }

            $this->Flash->error('Save failed');
        }

        $this->set(compact('createvoucher'));
    }

    public function edit(int $id)
    {
        $user = $this->Auth->user();
        $createvoucher = $this->Createvoucher->get($id);

        if ($this->request->is(['patch', 'post', 'put'])) {

            $data = $this->request->getData();

            $createvoucher = $this->Createvoucher->patchEntity($createvoucher, $data);

            $createvoucher->VCH_STATUS = STS_EDIT;
            $createvoucher->VCH_LAST_EDIT_BY = $user['USR_ID'];

            if ($this->Createvoucher->save($createvoucher)) {

                $this->Createvoucher->Voucherdtl->deleteAll(['VCH_ID' => $id]);
                $this->saveVoucherDetails($createvoucher, $data);

                $this->Flash->success('Updated successfully');
                return $this->redirect(['action' => 'index']);
            }

            $this->Flash->error('Update failed');
        }

        $this->set(compact('createvoucher'));
    }

    public function delete(int $id)
    {
        $this->request->allowMethod(['post', 'delete']);

        $voucher = $this->Createvoucher->get($id);

        $voucher->VCH_STATUS = 18;

        if ($this->Createvoucher->save($voucher)) {
            $this->Flash->success('Deleted successfully');
        } else {
            $this->Flash->error('Delete failed');
        }

        return $this->redirect(['action' => 'index']);
    }

    private function saveVoucherDetails($voucher, array $data): void
    {
        $details = [
            [
                'ldg' => $data['VCH_CR_ACCOUNTS'],
                'debit' => $data['debit_amount'],
                'credit' => $data['credit_amount'],
                'desc' => $data['VCH_NARRATION_1']
            ],
            [
                'ldg' => $data['VCH_DR_ACCOUNTS'],
                'debit' => $data['debit_amount_2'],
                'credit' => $data['credit_amount_2'],
                'desc' => $data['VCH_NARRATION_2']
            ]
        ];

        foreach ($details as $i => $row) {

            $entity = $this->Createvoucher->Voucherdtl->newEmptyEntity();

            $entity->VCH_ID = $voucher->VCH_ID;
            $entity->VDT_DATE = $voucher->VCH_DATE;
            $entity->VDT_VOUCHER_NO = $voucher->VCH_NO_FULL;
            $entity->VDT_SR = $i + 1;
            $entity->VDT_LDG_ID = $row['ldg'];
            $entity->VDT_DESCRIPTION = $row['desc'];
            $entity->VDT_DEBIT = (float)$row['debit'];
            $entity->VDT_CREDIT = (float)$row['credit'];

            $this->Createvoucher->Voucherdtl->save($entity);
        }
    }

    private function formatDate(?string $date): ?string
    {
        if (!$date || strlen($date) < 8) {
            return null;
        }

        [$d, $m, $y] = explode('-', $date);
        return "$y-$m-$d";
    }

    public function isAuthorized($user): bool
    {
        if ($this->request->getParam('action') === 'add') {
            return true;
        }

        return parent::isAuthorized($user);
    }
}
