<?php


namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

class CashWithdrawController extends AppController
{
    public function index(): void
    {
        $sdate = $this->request->getData('sdate');
        $edate = $this->request->getData('edate');

        if (!$sdate || !$edate) {
            $sdate = date('Y-m-d');
            $edate = date('Y-m-d');
        } else {
            $sdate = DateToDB($sdate . '-', '-');
            $edate = DateToDB($edate . '-', '-');
        }

        $cashWithdraw = $this->CashWithdraw->find()
            ->where([
                'VCH_TYPE' => VCH_TYPE_BANK,
                'VCH_DATE >=' => $sdate,
                'VCH_DATE <=' => $edate,
                'VCH_STATUS !=' => STS_DELETED
            ])
            ->order(['VCH_DATE' => 'DESC', 'VCH_ID' => 'DESC'])
            ->all();

        $this->set(compact('cashWithdraw', 'sdate', 'edate'));
    }

    public function view(int $id): void
    {
        $cashWithdraw = $this->CashWithdraw->get($id);
        $this->set(compact('cashWithdraw'));
    }

    public function add()
    {
        $user = $this->Auth->user();
        $cashWithdraw = $this->CashWithdraw->newEmptyEntity();

        $basic = TableRegistry::getTableLocator()->get('Basicdata');

        $project = $basic->find('list', ['keyField' => 'BAS_ID', 'valueField' => 'BAS_NAME'])
            ->where(['BAS_TYPE_ID' => 5])
            ->toArray();

        $department = $basic->find('list', ['keyField' => 'BAS_ID', 'valueField' => 'BAS_NAME'])
            ->where(['BAS_TYPE_ID' => 4])
            ->toArray();

        $bank = $this->CashWithdraw->Ledgers->find('list', [
            'keyField' => 'LDG_ID',
            'valueField' => 'LDG_NAME'
        ])->where(['LDG_TYPES LIKE' => '%BNK%'])->toArray();

        $this->set(compact('project', 'department', 'bank'));

        if ($this->request->is('post')) {

            $data = $this->request->getData();

            $vdr = $data['VCH_DR_ACCOUNTS'] ?? ACC_CASH;
            $vcr = $data['VCH_CR_ACCOUNTS'];

            if ($vdr === $vcr) {
                $this->Flash->error('Invalid accounts');
                return;
            }

            $amount = (float)$data['VCH_AMOUNT'];
            if ($amount <= 0) {
                $this->Flash->error('Invalid amount');
                return;
            }

            $cashWithdraw = $this->CashWithdraw->patchEntity($cashWithdraw, $data);

            $cashWithdraw->VCH_STATUS = STS_CREATE;
            $cashWithdraw->VCH_TYPE = VCH_TYPE_BANK;
            $cashWithdraw->VCH_CREATE_BY = $user['USR_ID'];

            $payDate = $this->formatDate($data['pay_date']);
            if (!$payDate) {
                $this->Flash->error('Invalid date');
                return;
            }

            $cashWithdraw->VCH_DATE = $payDate;

            if ($this->CashWithdraw->save($cashWithdraw)) {
                return $this->redirect(['controller' => 'BankTrans', 'action' => 'index']);
            }

            $this->Flash->error('Save failed');
        }

        $this->set(compact('cashWithdraw'));
    }

    public function edit(int $id)
    {
        $user = $this->Auth->user();
        $cashWithdraw = $this->CashWithdraw->get($id);

        $cashWithdraw->pay_date = date('d-m-Y', strtotime($cashWithdraw->VCH_DATE));

        if ($this->request->is(['patch', 'post', 'put'])) {

            $data = $this->request->getData();

            $amount = (float)$data['VCH_AMOUNT'];
            if ($amount <= 0) {
                $this->Flash->error('Invalid amount');
                return;
            }

            $cashWithdraw = $this->CashWithdraw->patchEntity($cashWithdraw, $data);

            $cashWithdraw->VCH_STATUS = STS_EDIT;
            $cashWithdraw->VCH_LAST_EDIT_BY = $user['USR_ID'];

            $payDate = $this->formatDate($data['pay_date']);
            if (!$payDate) {
                $this->Flash->error('Invalid date');
                return;
            }

            $cashWithdraw->VCH_DATE = $payDate;

            if ($this->CashWithdraw->save($cashWithdraw)) {
                return $this->redirect(['action' => 'index']);
            }

            $this->Flash->error('Update failed');
        }

        $this->set(compact('cashWithdraw'));
    }

    private function formatDate(?string $date): ?string
    {
        if (!$date || strlen($date) < 8) {
            return null;
        }

        [$d, $m, $y] = explode('-', $date);
        return "$y-$m-$d";
    }
}
