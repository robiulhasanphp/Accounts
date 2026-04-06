<?php
declare(strict_types=1);
namespace App\Controller;

use App\Controller\AppController;
use Cake\Http\Exception\NotFoundException;

class LedgerbalanceController extends AppController
{

    public function index()
    {
        $ledgerbalanceTable = $this->fetchTable('Ledgerbalance');
        $ledgersTable = $this->fetchTable('Ledgers');

        $query = $ledgersTable->find('list', ['keyField' => 'LDG_ID', 'valueField' => 'LDG_NAME'])
            ->order(['LDG_NAME' => 'ASC']);
        $LDG_name = $query->toArray();
        $this->set(compact('LDG_name'));

        if ($this->request->is(['post', 'put'])) {
            $data = $this->request->getData();
            $id = $data['name'];

            $date_from = $data['date_from'];
            $date_1 = explode('-', $date_from);
            $d = $date_1[0];
            $m = $date_1[1];
            $y = $date_1[2];
            $from_date = $y . '-' . $m . '-' . $d;

            $ledgerClosingTable = $this->fetchTable('LedgerClosing');
            $query = $ledgerClosingTable->find('all');
            $query = $query->select(['last_closed_period' => $query->func()->max('LDG_BAL_PERIOD')])
                ->where(['LDG_ID' => $id])
                ->andWhere(['LDG_BAL_PERIOD <' => $y . $m]);
            $CLOSED_PERIOD = $query->toArray();

            $cl_period = '201501';
            if (!empty($CLOSED_PERIOD[0]->last_closed_period)) {
                $cl_period = $CLOSED_PERIOD[0]->last_closed_period;
            }

            $last_m_date = $cl_period;
            $y = substr($cl_period, 0, 4);
            $m = substr($cl_period, 4, 2);
            $start_date = $y . '-' . $m . '-01';

            $last_date = date('Y-m-d', strtotime('-1 day', strtotime($from_date)));
            $date_last = explode('-', $last_date);
            $d = $date_last[2];
            $m = $date_last[1];
            $y = $date_last[0];
            $before_last_date = $d . '-' . $m . '-' . $y;
            $this->set(compact('before_last_date'));

            $date_to = $data['date_to'];
            $date_2 = explode('-', $date_to);
            $d = $date_2[0];
            $m = $date_2[1];
            $y = $date_2[2];
            $to_date = $y . '-' . $m . '-' . $d;

            $query = $ledgerClosingTable->find('all')
                ->where(['LDG_ID' => $id])
                ->andWhere(['LDG_BAL_PERIOD' => $last_m_date]);
            $end_balance = $query->toArray();
            $this->set(compact('end_balance'));

            $last_dr = 0;
            $last_cr = 0;
            $last_balance_date = 0;
            foreach ($end_balance as $end) {
                $last_dr = $end['LBL_BALANCE_DR'];
                $last_cr = $end['LBL_BALANCE_CR'];
                $last_balance_date = $end['LDG_BAL_PERIOD'];
            }

            $generalLedgerTable = $this->fetchTable('GeneralLedger');
            $query = $generalLedgerTable->find();
            $query->select(['t_salary' => $query->func()->sum('VCH_DEBIT')])
                ->where(['LDG_ID' => $id])
                ->andWhere(['VCH_DATE >=' => $start_date])
                ->andWhere(['VCH_DATE <=' => $last_date]);
            $total_salary = $query->toArray();
            $this->set(compact('total_salary'));
            $voucher_month_first_debit = $total_salary[0]->t_salary ?? 0;
            $this->set(compact('voucher_month_first_debit'));

            $query = $generalLedgerTable->find();
            $query->select(['t_salary' => $query->func()->sum('VCH_CREDIT')])
                ->where(['LDG_ID' => $id])
                ->andWhere(['VCH_DATE >=' => $start_date])
                ->andWhere(['VCH_DATE <=' => $last_date]);
            $total_salary = $query->toArray();
            $this->set(compact('total_salary'));
            $voucher_month_second_credit = $total_salary[0]->t_salary ?? 0;
            $this->set(compact('voucher_month_second_credit'));
            $up_to_lastbalance_debit = $last_dr + $voucher_month_first_debit;
            $this->set(compact('up_to_lastbalance_debit'));
            $up_to_lastbalance_credit = $last_cr + $voucher_month_second_credit;
            $this->set(compact('up_to_lastbalance_credit'));

            $query = $generalLedgerTable->find();
            $query->select(['t_salary' => $query->func()->sum('VCH_DEBIT')])
                ->where(['LDG_ID' => $id])
                ->andWhere(['VCH_DATE >=' => $from_date])
                ->andWhere(['VCH_DATE <=' => $to_date]);
            $total_salary = $query->toArray();
            $this->set(compact('total_salary'));
            $voucher_month_between_debit = $total_salary[0]->t_salary ?? 0;
            $this->set(compact('voucher_month_first_debit'));

            $query = $generalLedgerTable->find();
            $query->select(['t_salary' => $query->func()->sum('VCH_CREDIT')])
                ->where(['LDG_ID' => $id])
                ->andWhere(['VCH_DATE >=' => $from_date])
                ->andWhere(['VCH_DATE <=' => $to_date]);
            $total_salary = $query->toArray();
            $this->set(compact('total_salary'));
            $voucher_month_between_credit = $total_salary[0]->t_salary ?? 0;
            $this->set(compact('voucher_month_second_credit'));
            $total_voucher_debit = $voucher_month_between_debit;
            $this->set(compact('total_voucher_debit'));
            $total_voucher_credit = $voucher_month_between_credit;
            $this->set(compact('total_voucher_credit'));
            $this->set(compact('up_to_lastbalance_credit'));
            $this->set(compact('up_to_lastbalance_debit'));

            $query = $generalLedgerTable->find('list', ['keyField' => 'VCH_ID', 'valueField' => 'VCH_ID'])
                ->where(['LDG_ID' => $id])
                ->andWhere(['VCH_DATE >=' => $from_date])
                ->andWhere(['VCH_DATE <=' => $to_date]);
            $vch_id = $query->toArray();

            $vouchersTable = $this->fetchTable('Vouchers');
            $query = $generalLedgerTable->find('all')
                ->contain(['Vouchers' => function ($q) use ($vch_id) {
                    return $q->where(['VCH_ID IN' => $vch_id])
                        ->andWhere(['VCH_STATUS !=' => STS_DELETED]);
                }])
                ->where(['GeneralLedger.LDG_ID' => $id])
                ->andWhere(['GeneralLedger.VCH_DATE >=' => $from_date])
                ->andWhere(['GeneralLedger.VCH_DATE <=' => $to_date])
                ->order(['GeneralLedger.VCH_DATE' => 'ASC']);
            $vdt_id = $query->toArray();
            $this->set(compact('vdt_id'));

            $query = $ledgersTable->find('all')
                ->where(['LDG_ID' => $id]);
            $LDG_ACC_TYPE = $query->toArray();
            $type = $LDG_ACC_TYPE[0]['LDG_ACC_TYPE'] ?? null;
            $this->set(compact('type'));
        }
    }

    public function view($VCH_ID)
    {
        if (!$VCH_ID) {
            throw new NotFoundException(__('Invalid user'));
        }

        $ledgerbalanceTable = $this->fetchTable('Ledgerbalance');
        $query = $ledgerbalanceTable->find('all')
            ->contain(['Project', 'Department', 'Ledgers'])
            ->where(['VCH_ID' => $VCH_ID]);
        $vdt_id = $query->toArray();
        $this->set(compact('vdt_id'));

        $query = $ledgerbalanceTable->find();
        $query->select(['t_salary' => $query->func()->sum('VDT_DEBIT')])
            ->where(['VCH_ID' => $VCH_ID]);
        $total_debit = $query->toArray();
        $this->set(compact('total_debit'));
        $debit = $total_debit[0]->t_salary ?? 0;
        $this->set(compact('debit'));

        $query = $ledgerbalanceTable->find();
        $query->select(['t_salary' => $query->func()->sum('VDT_CREDIT')])
            ->where(['VCH_ID' => $VCH_ID]);
        $total_credit = $query->toArray();
        $this->set(compact('total_credit'));
        $credit = $total_credit[0]->t_salary ?? 0;
        $this->set(compact('credit'));
    }

    public function printer($VCH_ID)
    {
        if (!$VCH_ID) {
            throw new NotFoundException(__('Invalid user'));
        }

        $ledgerbalanceTable = $this->fetchTable('Ledgerbalance');
        $vouchersTable = $this->fetchTable('Vouchers');
        $query = $ledgerbalanceTable->find('all')
            ->contain(['Vouchers', 'Project', 'Department', 'Ledgers'])
            ->where(['VCH_ID' => $VCH_ID]);
        $vdt_id = $query->toArray();
        $this->set(compact('vdt_id'));

        $query = $ledgerbalanceTable->find();
        $query->select(['t_salary' => $query->func()->sum('VDT_DEBIT')])
            ->where(['VCH_ID' => $VCH_ID]);
        $total_debit = $query->toArray();
        $this->set(compact('total_debit'));
        $debit = $total_debit[0]->t_salary ?? 0;
        $this->set(compact('debit'));

        $query = $ledgerbalanceTable->find();
        $query->select(['t_salary' => $query->func()->sum('VDT_CREDIT')])
            ->where(['VCH_ID' => $VCH_ID]);
        $total_credit = $query->toArray();
        $this->set(compact('total_credit'));
        $credit = $total_credit[0]->t_salary ?? 0;
        $this->set(compact('credit'));
    }

    public function trialbalance()
    {
        ini_set('memory_limit', '256M');
        $user = $this->Auth->user();
        $user_id = $user['USR_ID'];
        $this->set(compact('user_id'));

        $ledgerbalanceTable = $this->fetchTable('Ledgerbalance');
        $ledgerClosingTable = $this->fetchTable('LedgerClosing');
        $query = $ledgerClosingTable->find('all');
        $query->select(['period' => $query->func()->max('LDG_BAL_PERIOD')]);
        $period = $query->toArray();
        $this->set(compact('period'));

        $end_period = 201501;
        foreach ($period as $a) {
            $end_period = $a->period;
            $this->set(compact('end_period'));
        }

        $cur_period = $end_period + 1;
        $this->set(compact('cur_period'));

        $l_year = substr((string)$cur_period, 0, 4);
        $l_month = substr((string)$cur_period, -2);
        $cur_moth = (int)$l_month;
        $cur_year = $l_year;

        $voucherDateSumTable = $this->fetchTable('VoucherDateSum');
        $query = $voucherDateSumTable->find('all')
            ->contain(['Ledgers', 'LedgerClosing'])
            ->where(['MONTH(VoucherDateSum.VDT_DATE)' => $cur_moth])
            ->andWhere(['YEAR(VoucherDateSum.VDT_DATE)' => $cur_year])
            ->andWhere(['LedgerClosing.LDG_BAL_PERIOD' => $end_period]);
        $data = $query->select([
            'VDT_LDG_ID',
            'Ledgers.LDG_NAME',
            'LedgerClosing.LBL_BALANCE_DR',
            'LedgerClosing.LBL_BALANCE_CR',
            'T_DEBIT' => $query->func()->sum('TOTAL_DEBIT'),
            'T_CREDIT' => $query->func()->sum('TOTAL_CREDIT')
        ])
        ->group(['VDT_LDG_ID', 'LDG_NAME', 'LBL_BALANCE_DR', 'LBL_BALANCE_CR'])
        ->order('LDG_NAME');
        $closing_balance = $data->toArray();
        $this->set(compact('closing_balance'));

        if ($this->request->is(['post', 'put'])) {
            $data = $this->request->getData();
            $date = $data['date'];
            $today = date('Y-m-d');

            foreach ($closing_balance as $a) {
                $VDT_LDG_ID = $a->VDT_LDG_ID;
                $ldg_name = $a->ledger->LDG_NAME;
                $lbl_balance_dr = $a->ledger_closing->LBL_BALANCE_DR ?? 0;
                $lbl_balance_cr = $a->ledger_closing->LBL_BALANCE_CR ?? 0;
                $total_debit = $a->T_DEBIT ?? 0;
                $total_credit = $a->T_CREDIT ?? 0;

                if (!empty($a->ledger_closing)) {
                    $balance = ($a->ledger_closing->LBL_BALANCE_DR - $a->ledger_closing->LBL_BALANCE_CR) + ($a->T_DEBIT - $a->T_CREDIT);
                } else {
                    $balance = ($a->T_DEBIT - $a->T_CREDIT);
                }

                $ledgerClosingEntryTable = $this->fetchTable('LedgerClosingEntry');
                $LedgerClosing = $ledgerClosingEntryTable->newEntity();
                $LedgerClosing->LDG_ID = $VDT_LDG_ID;
                $LedgerClosing->LDG_BAL_PERIOD = $cur_period;
                $LedgerClosing->LDG_BAL_DATE = $today;
                $LedgerClosing->LBL_OP_DR = $lbl_balance_dr;
                $LedgerClosing->LBL_OP_CR = $lbl_balance_cr;
                $LedgerClosing->LBL_TRN_DR = $total_debit;
                $LedgerClosing->LBL_TRN_CR = $total_credit;

                if ($balance > 0) {
                    $LedgerClosing->LBL_BALANCE_DR = $balance;
                } else {
                    $LedgerClosing->LBL_BALANCE_CR = $balance;
                }

                $ledgerClosingEntryTable->save($LedgerClosing);
            }
        }
    }
}




