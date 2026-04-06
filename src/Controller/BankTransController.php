<?php
declare(strict_types=1);
namespace App\Controller;

use App\Controller\AppController;
use Cake\Http\Exception\NotFoundException;
use Cake\ORM\TableRegistry;

class BankTransController extends AppController
{
    public function index(): void
    {
        [$sdate, $edate] = $this->resolveDateRange();

        $bankTrans = $this->BankTrans->find()
            ->where([
                'VCH_TYPE' => VCH_TYPE_BANK,
                'VCH_DATE >=' => $sdate,
                'VCH_DATE <=' => $edate,
                'VCH_STATUS !=' => STS_DELETED
            ])
            ->orderDesc('VCH_DATE')
            ->orderDesc('VCH_ID')
            ->all();

        $this->set(compact('bankTrans', 'sdate', 'edate'));
    }

    public function view(int $id): void
    {
        $bankTrans = $this->BankTrans->get($id);
        $this->set(compact('bankTrans'));
    }

    public function addDep()
    {
        $userId = $this->Auth->user('USR_ID');
        $bankTrans = $this->BankTrans->newEmptyEntity();

        $this->loadFormData();

        if ($this->request->is('post')) {

            $data = $this->request->getData();

            if (!$this->validateTransaction($data)) {
                $this->Flash->error('Invalid transaction');
                return;
            }

            $bankTrans = $this->BankTrans->patchEntity($bankTrans, $data);

            $this->prepareTransaction($bankTrans, $data, $userId);

            if ($this->BankTrans->save($bankTrans)) {

                $this->createVoucherDetails($bankTrans, $data);

                return $this->redirect(['action' => 'index']);
            }

            $this->Flash->error('Save failed');
        }

        $this->set(compact('bankTrans'));
    }

    public function delete(int $id)
    {
        $userId = $this->Auth->user('USR_ID');

        $bankTrans = $this->BankTrans->get($id);

        $bankTrans->vch_status = STS_DELETED;
        $bankTrans->vch_status_by = $userId;
        $bankTrans->vch_status_date = date('Y-m-d');

        $this->BankTrans->save($bankTrans);

        return $this->redirect(['action' => 'index']);
    }

    private function resolveDateRange(): array
    {
        $data = $this->request->getData();

        if (!empty($data['sdate']) && !empty($data['edate'])) {
            return [
                DateToDB($data['sdate'].'-','-'),
                DateToDB($data['edate'].'-','-')
            ];
        }

        $start = date('Y-m-01');
        $end = date('Y-m-t');

        return [$start, $end];
    }

    private function validateTransaction(array $data): bool
    {
        if ($data['VCH_AMOUNT'] <= 0) {
            return false;
        }

        if ($data['VCH_CR_ACCOUNTS'] === $data['VCH_DR_ACCOUNTS']) {
            return false;
        }

        return true;
    }

    private function prepareTransaction($entity, array $data, int $userId): void
    {
        $entity->vch_type = VCH_TYPE_BANK;
        $entity->vch_status = STS_CREATE;
        $entity->vch_create_by = $userId;
        $entity->vch_status_by = $userId;
        $entity->vch_last_edit_by = $userId;
        $entity->vch_submit_by = $userId;

        if (!empty($data['pay_date'])) {
            [$d,$m,$y] = explode('-', $data['pay_date']);
            $entity->vch_date = "$y-$m-$d";
            $entity->vch_month = $m;
            $entity->vch_year = $y;
        }
    }

    private function createVoucherDetails($bankTrans, array $data): void
    {
        $amount = $data['VCH_AMOUNT'];

        $details = [
            ['debit' => 0, 'credit' => $amount, 'ldg' => $data['VCH_CR_ACCOUNTS']],
            ['debit' => $amount, 'credit' => 0, 'ldg' => $data['VCH_DR_ACCOUNTS']]
        ];

        foreach ($details as $i => $row) {
            $entity = $this->BankTrans->Voucherdtl->newEmptyEntity();

            $entity->vch_id = $bankTrans->vch_id;
            $entity->vdt_lot = 1;
            $entity->vdt_sr = $i + 1;
            $entity->vdt_ldg_id = $row['ldg'];
            $entity->vdt_debit = $row['debit'];
            $entity->vdt_credit = $row['credit'];

            $this->BankTrans->Voucherdtl->save($entity);
        }
    }

    private function loadFormData(): void
    {
        $basic = TableRegistry::getTableLocator()->get('Basicdata');

        $project = $basic->find('list')
            ->where(['BAS_TYPE_ID' => 5])
            ->toArray();

        $department = $basic->find('list')
            ->where(['BAS_TYPE_ID' => 4])
            ->toArray();

        $banks = $this->BankTrans->Ledgers->find('list')
            ->where(['LDG_TYPES LIKE' => '%BNK%'])
            ->order(['LDG_NAME' => 'ASC'])
            ->toArray();

        $this->set(compact('project', 'department', 'banks'));
    }
}




