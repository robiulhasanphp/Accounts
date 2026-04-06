<?php
declare(strict_types=1);

namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

class DashboardController extends AppController
{
    public function index(): void
    {
        $today = date('Y-m-d');

        $types = [
            'jurnal' => VCH_TYPE_JOURNAL,
            'purchase' => VCH_TYPE_PURCHASE,
            'sales' => VCH_TYPE_SALES,
            'payment' => VCH_TYPE_PAYMENT,
            'receipt' => VCH_TYPE_RECIEPT,
            'salary' => VCH_TYPE_SALARY,
            'expense' => VCH_TYPE_EXPENSE,
        ];

        foreach ($types as $key => $type) {
            $this->set($key, $this->Dashboard->find()
                ->where([
                    'VCH_TYPE' => $type,
                    'VCH_STATUS !=' => STS_DELETED,
                    'VCH_DATE >=' => $today
                ])
                ->all());
        }

        $adjustment = $this->Dashboard->find()
            ->where(['VCH_TYPE' => VCH_TYPE_ADJUSTMENT])
            ->all();

        $this->set(compact('adjustment'));
    }

    public function search()
    {
        $ledgerList = $this->Dashboard->Ledgers->find('list', [
            'keyField' => 'LDG_ID',
            'valueField' => 'LDG_NAME'
        ])->toArray();

        $this->set(compact('ledgerList'));

        if (!$this->request->is(['post', 'put'])) return;

        $data = $this->request->getData();
        $query = $this->Dashboard->find();

        if (!empty($data['name'])) {
            $query->where(['VCH_CR_ACCOUNTS' => $data['name']]);
        }

        if (!empty($data['date_from']) && !empty($data['date_to'])) {
            $query->where([
                'VCH_DATE >=' => $this->formatDate($data['date_from']),
                'VCH_DATE <=' => $this->formatDate($data['date_to'])
            ]);
        }

        if (!empty($data['amount'])) {
            $query->where(['VCH_AMOUNT' => (float)$data['amount']]);
        }

        $this->set('search_result', $query->all());
    }

    public function approve(int $id)
    {
        $voucher = $this->Dashboard->get($id);
        $user = $this->Auth->user();

        if ($this->request->is(['post', 'put'])) {

            $voucher->VCH_STATUS = (int)$this->request->getData('ACC_TYPE');
            $voucher->VCH_STATUS_BY = $user['USR_ID'];
            $voucher->VCH_STATUS_DATE = date('Y-m-d');

            if ($this->Dashboard->save($voucher)) {
                $this->Flash->success('Approved');
                return $this->redirect(['action' => 'index']);
            }

            $this->Flash->error('Failed');
        }

        $this->set(compact('voucher'));
    }

    public function sendForApprove(int $id)
    {
        $voucher = $this->Dashboard->get($id);
        $user = $this->Auth->user();

        if ($this->request->is(['post', 'put'])) {

            $voucher->VCH_STATUS = 15;
            $voucher->VCH_STATUS_BY = $user['USR_ID'];
            $voucher->VCH_STATUS_DATE = date('Y-m-d');

            if ($this->Dashboard->save($voucher)) {
                $this->Flash->success('Sent for approval');
                return $this->redirect(['action' => 'index']);
            }

            $this->Flash->error('Failed');
        }

        $this->set(compact('voucher'));
    }

    public function voucherReport(): void
    {
        $today = date('Y-m-d');

        $report = $this->Dashboard->find()
            ->select([
                'VCH_TYPE',
                'total' => $this->Dashboard->find()->func()->sum('VCH_AMOUNT')
            ])
            ->where(['VCH_STATUS' => 16])
            ->group(['VCH_TYPE'])
            ->all();

        $this->set(compact('report', 'today'));
    }

    private function formatDate(?string $date): ?string
    {
        if (!$date || strlen($date) < 8) return null;

        [$d, $m, $y] = explode('-', $date);
        return "$y-$m-$d";
    }

    public function isAuthorized($user): bool
    {
        if ($this->request->getParam('action') === 'index') return true;
        return parent::isAuthorized($user);
    }
}
