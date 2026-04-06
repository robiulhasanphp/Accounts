<?php
declare(strict_types=1);
namespace App\Controller;

use App\Controller\AppController;
use Cake\Http\Exception\NotFoundException;

class GLController extends AppController
{
    public function index()
    {
        $glTable = $this->fetchTable('GL');
        $ledgersTable = $this->fetchTable('Ledgers');
        $ledgerClosingTable = $this->fetchTable('LedgerClosing');

        $ledgers = $ledgersTable->find('list', [
            'keyField' => 'LDG_ID',
            'valueField' => 'LDG_NAME'
        ])
        ->order(['LDG_NAME' => 'ASC'])
        ->toArray();

        $this->set(compact('ledgers'));

        if (!$this->request->is(['post', 'put'])) {
            return;
        }

        $data = $this->request->getData();

        $ledgerId = $data['name'] ?? null;
        $from = $this->formatDate($data['date_from'] ?? null);
        $to = $this->formatDate($data['date_to'] ?? null);

        if (!$ledgerId || !$from || !$to) {
            $this->Flash->error('Invalid input');
            return;
        }

        $closing = $ledgerClosingTable->find()
            ->where(['LDG_ID' => $ledgerId])
            ->first();

        $openingDebit = $closing ? ($closing->LDG_BALANCE_DR ?? 0) : 0;
        $openingCredit = $closing ? ($closing->LDG_BALANCE_CR ?? 0) : 0;

        $entries = $glTable->find()
            ->where([
                'VDT_LDG_ID' => $ledgerId,
                'VDT_DATE >=' => $from,
                'VDT_DATE <=' => $to
            ])
            ->order(['VDT_DATE' => 'ASC'])
            ->all();

        $this->set(compact(
            'entries',
            'openingDebit',
            'openingCredit',
            'ledgerId',
            'from',
            'to'
        ));
    }

    public function view(int $id)
    {
        $ledgerbalanceTable = $this->fetchTable('Ledgerbalance');

        $entries = $ledgerbalanceTable->find()
            ->contain(['Vouchers', 'Project', 'Department', 'Ledgers'])
            ->where(['VCH_ID' => $id])
            ->all();

        if ($entries->isEmpty()) {
            throw new NotFoundException('Voucher not found');
        }

        $query = $ledgerbalanceTable->find();
        $totals = $query->select([
            'debit' => $query->func()->sum('VDT_DEBIT'),
            'credit' => $query->func()->sum('VDT_CREDIT')
        ])
        ->where(['VCH_ID' => $id])
        ->first();

        $this->set([
            'entries' => $entries,
            'debit' => $totals ? ($totals->debit ?? 0) : 0,
            'credit' => $totals ? ($totals->credit ?? 0) : 0
        ]);
    }

    public function printer(int $id)
    {
        return $this->view($id); // reuse logic
    }

    private function formatDate(?string $date): ?string
    {
        if (!$date) {
            return null;
        }

        $parts = explode('-', $date);
        if (count($parts) !== 3) {
            return null;
        }

        return "{$parts[2]}-{$parts[1]}-{$parts[0]}";
    }
}




