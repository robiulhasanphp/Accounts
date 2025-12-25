<?php
namespace App\Model\Table;

use Cake\ORM\Table;

class LedgerClosingEntryTable extends Table
{

    public function initialize(array $config)
    {
		$this->Table('ledger_balance');
		$this->primaryKey('LDG_BAL_ID');
 		
    }
	
	
	
	
	
}
?>