<?php
declare(strict_types=1);
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\EventInterface;
use Cake\Http\Exception\NotFoundException;
use Cake\ORM\TableRegistry;

class JournalController extends AppController
{
    public function beforeFilter(EventInterface $event): void
    {
        parent::beforeFilter($event);
    }

    public function index()
    {
        $journalTable = $this->fetchTable('Journal');
        $sdate = '';
        $edate = '';

        if ($this->request->is(['post', 'put'])) {
            $data = $this->request->getData();
            $sdate = $data['sdate'] ?? '';
            $edate = $data['edate'] ?? '';

            $sdate = $this->dateToDB($sdate . '-', '-');
            $edate = $this->dateToDB($edate . '-', '-');
        }

        if (empty($sdate) || empty($edate)) {
            $sdate = date('Y-m-') . '01';
            $edate = date('Y-m-', strtotime('+1 month')) . '01';
            $date = date_create($edate);
            date_add($date, date_interval_create_from_date_string('-1 days'));
            $edate = date_format($date, 'Y-m-d');
        }

        $journals = $journalTable->find('all')
            ->where(['VCH_TYPE' => VCH_TYPE_JOURNAL])
            ->andWhere(['VCH_DATE >=' => $sdate])
            ->andWhere(['VCH_DATE <=' => $edate])
            ->andWhere(['VCH_STATUS !=' => STS_DELETED])
            ->order(['VCH_DATE' => 'DESC', 'VCH_ID' => 'DESC']);

        $this->set('Journal', $journals);
        $this->set(compact('sdate', 'edate'));
    }

    public function add()
    {
        $user = $this->Auth->user();
        $basicdataTable = $this->fetchTable('Basicdata');
        $journalTable = $this->fetchTable('Journal');

        $query = $basicdataTable->find('list', ['keyField' => 'BAS_ID', 'valueField' => 'BAS_NAME'])
            ->where(['BAS_TYPE_ID' => 5]);
        $project = $query->toArray();
        $this->set(compact('project'));

        $query = $basicdataTable->find('list', ['keyField' => 'BAS_ID', 'valueField' => 'BAS_NAME'])
            ->where(['BAS_TYPE_ID' => 4]);
        $department = $query->toArray();
        $this->set(compact('department'));

        $query = $journalTable->Ledgers->find('list', ['keyField' => 'LDG_ID', 'valueField' => 'LDG_NAME']);
        $LDG_name = $query->toArray();
        $this->set(compact('LDG_name'));

        $Journal = $journalTable->newEntity();
        if ($this->request->is('post')) {
            $data = $this->request->getData();
            $Journal = $journalTable->patchEntity($Journal, $data);

            $project = $data['VCH_PROJECT'] ?? null;
            $department = $data['VCH_DEPARTMENT'] ?? null;

            $invoice = $data['INVDATE'] ?? '';
            if (!empty($invoice)) {
                $Journal->VCH_INV_DATE = $this->dateToDB($invoice . '-', '-');
            }

            $chalan = $data['CHALLANDATE'] ?? '';
            if (!empty($chalan)) {
                $Journal->VCH_CHALLAN_DATE = $this->dateToDB($chalan . '-', '-');
            }

            $date = $data['pay_date'] ?? '';
            if (!empty($date)) {
                $dateParts = explode('-', $date);
                if (count($dateParts) === 3) {
                    $d = $dateParts[0];
                    $m = $dateParts[1];
                    $y = $dateParts[2];
                    $pay_date = $y . '-' . $m . '-' . $d;
                    $Journal->VCH_DATE = $pay_date;
                    $Journal->VCH_MONTH = $m;
                    $Journal->VCH_YEAR = $y;
                } else {
                    $this->Flash->error(__('Please Specify Journal Date'));
                    $this->set('Journal', $Journal);
                    return;
                }
            } else {
                $this->Flash->error(__('Please Specify Journal Date'));
                $this->set('Journal', $Journal);
                return;
            }

            // Main account info
            $ACCOUNT_MAIN = $data['VCH_ACCOUNTS_MAIN'] ?? null;
            $ldg = $journalTable->Ledgers->get($ACCOUNT_MAIN);
            $ACCOUNT_MAIN_NAME = $ldg->LDG_CODE;
            $ACCOUNT_MAIN_DR = (float)($data['VCH_DR_AMOUNT_MAIN'] ?? 0);
            $ACCOUNT_MAIN_CR = (float)($data['VCH_CR_AMOUNT_MAIN'] ?? 0);
            $VCH_NARRATION_MAIN = $data['VCH_NARRATION_MAIN'] ?? '';

            // Dest accounts
            $accounts = $data['VCH_ACCOUNTS'] ?? [];
            $narration = $data['VCH_NARRATIONS'] ?? [];
            $debit_amount = $data['VCH_DR_AMOUNT'] ?? [];
            $credit_amount = $data['VCH_CR_AMOUNT'] ?? [];

            $iDest = 0;
            $t_debit = 0.0;
            $t_credit = 0.0;
            $ldg_codes = '';
            foreach ($accounts as $d) {
                $Ledger_id = $accounts[$iDest] ?? 0;
                $Description = $narration[$iDest] ?? '';
                if ($Ledger_id > 0) {
                    $ldg = $journalTable->Ledgers->get($Ledger_id);
                    $ldg_codes .= ',' . $ldg->LDG_CODE;
                    $debit = (float)($debit_amount[$iDest] ?? 0);
                    $credit = (float)($credit_amount[$iDest] ?? 0);
                    if (abs($debit - $credit) > 0) {
                        $t_debit += $debit;
                        $t_credit += $credit;
                    }
                }
                $iDest++;
            }

            if ((abs($t_debit - $t_credit) != abs($ACCOUNT_MAIN_DR - $ACCOUNT_MAIN_CR)) && abs($t_debit - $t_credit) > 0) {
                $this->Flash->error(__('Debit And Credit Amounts Are Mismatch'));
                $this->set('Journal', $Journal);
                return;
            }

            $full_desc = '';
            if ($ACCOUNT_MAIN_DR > 0) {
                $full_desc = $ACCOUNT_MAIN_NAME . ' (Dr), ' . $ldg_codes . ' (Cr)';
                $Journal->VCH_AMOUNT = $ACCOUNT_MAIN_DR;
            } else {
                $full_desc = $ACCOUNT_MAIN_NAME . ' (Cr), ' . $ldg_codes . ' (Dr)';
                $Journal->VCH_AMOUNT = $ACCOUNT_MAIN_CR;
            }
            $Journal->VCH_FULL_DESCRIPTION = $full_desc;
            $Journal->VCH_STATUS = STS_CREATE;
            $Journal->VCH_CREATE_BY = $user['USR_ID'];
            $Journal->VCH_TYPE = VCH_TYPE_JOURNAL;
            $Journal->VCH_STATUS_BY = $user['USR_ID'];
            $Journal->VCH_LAST_EDIT_BY = $user['USR_ID'];
            $Journal->VCH_SUBMIT_BY = $user['USR_ID'];

            if ($journalTable->save($Journal)) {
                $id = $Journal->VCH_ID;
                $new_id = $id;
                $year = $Journal->VCH_YEAR;
                $month = $Journal->VCH_MONTH;
                $vch_date = $Journal->VCH_DATE;
                $Journal = $journalTable->get($id);
                $VCH_NO = $Journal->VCH_NO_FULL;

                // Save main account to Voucherdtl
                $voucherdtlTable = $this->fetchTable('Voucherdtl');
                $Voucherdtl = $voucherdtlTable->newEntity();
                $Voucherdtl->VCH_ID = $new_id;
                $Voucherdtl->VDT_DATE = $vch_date;
                $Voucherdtl->VDT_VOUCHER_NO = $VCH_NO;
                $Voucherdtl->VDT_LOT = 1;
                $Voucherdtl->VDT_SR = 1;
                $Voucherdtl->VDT_LDG_ID = $ACCOUNT_MAIN;
                $Voucherdtl->VDT_DESCRIPTION = !empty($VCH_NARRATION_MAIN) ? $VCH_NARRATION_MAIN : '';
                $Voucherdtl->VDT_PROJECT = $project;
                $Voucherdtl->VDT_DEPARTMENT = $department;
                if ($ACCOUNT_MAIN_DR > 0) {
                    $Voucherdtl->VDT_DEBIT = $ACCOUNT_MAIN_DR;
                    $Voucherdtl->VDT_CREDIT = 0;
                } else {
                    $Voucherdtl->VDT_DEBIT = 0;
                    $Voucherdtl->VDT_CREDIT = $ACCOUNT_MAIN_CR;
                }
                $voucherdtlTable->save($Voucherdtl);

                // Save dest accounts
                $iDest = 0;
                foreach ($accounts as $d) {
                    $Ledger_id = $accounts[$iDest] ?? 0;
                    $Description = $narration[$iDest] ?? '';
                    if ($Ledger_id > 0) {
                        $debit = (float)($debit_amount[$iDest] ?? 0);
                        $credit = (float)($credit_amount[$iDest] ?? 0);
                        if (abs($debit - $credit) > 0) {
                            $Voucherdtl = $voucherdtlTable->newEntity();
                            $Voucherdtl->VCH_ID = $new_id;
                            $Voucherdtl->VDT_DATE = $vch_date;
                            $Voucherdtl->VDT_VOUCHER_NO = $VCH_NO;
                            $Voucherdtl->VDT_LOT = 1;
                            $Voucherdtl->VDT_SR = $iDest + 2;
                            $Voucherdtl->VDT_LDG_ID = $Ledger_id;
                            $Voucherdtl->VDT_DESCRIPTION = $Description;
                            $Voucherdtl->VDT_PROJECT = $project;
                            $Voucherdtl->VDT_DEPARTMENT = $department;
                            if ($ACCOUNT_MAIN_DR > 0) {
                                $Voucherdtl->VDT_DEBIT = 0;
                                $Voucherdtl->VDT_CREDIT = $credit;
                            } else {
                                $Voucherdtl->VDT_DEBIT = $debit;
                                $Voucherdtl->VDT_CREDIT = 0;
                            }
                            $voucherdtlTable->save($Voucherdtl);
                        }
                    }
                    $iDest++;
                }

                if (!empty($data['CONTINUE'])) {
                    $this->Flash->success(__('Voucher : ' . $VCH_NO . ' [ Amount = ' . abs($t_debit - $t_credit) . '] has been saved.'));
                    return $this->redirect(['action' => 'add']);
                } else {
                    return $this->redirect(['action' => 'index']);
                }
            }
            $this->Flash->error(__('Unable to add the vouchers.'));
        }
        $this->set('Journal', $Journal);
    }

    public function delete($VCH_ID = null)
    {
        $user = $this->Auth->user();
        $journalTable = $this->fetchTable('Journal');
        $Journal = $journalTable->get($VCH_ID);
        if ($this->request->is(['post', 'put'])) {
            $data = $this->request->getData();
            $Journal = $journalTable->patchEntity($Journal, $data);
            $Journal->VCH_STATUS = STS_DELETED;
            $Journal->VCH_STATUS_DATE = date('Y-m-d');
            $Journal->VCH_STATUS_BY = $user['USR_ID'];
            if ($journalTable->save($Journal)) {
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Unable to update your article.'));
        }
        $this->set('Journal', $Journal);
    }

    public function isAuthorized($user): bool
    {
        if ($this->request->getParam('action') === 'add') {
            return true;
        }
        return parent::isAuthorized($user);
    }

    private function dateToDB(string $date): string
    {
        // Assuming DateToDB converts dd-mm-yyyy to yyyy-mm-dd
        $parts = explode('-', $date);
        if (count($parts) === 3) {
            return $parts[2] . '-' . $parts[1] . '-' . $parts[0];
        }
        return $date;
    }
}




