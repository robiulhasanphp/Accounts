<?php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class OpeningBalanceTable extends Table
{

    public function initialize(array $config)
    {
		$this->Table('ledger_balance');
		$this->belongsTo('Ledgers',[
			  'foreignKey' => 'LDG_ID'
        ]);
 		$this->belongsTo('Project',[
           'foreignKey' => 'VDT_PROJECT',
        ]);
		 $this->belongsTo('Department',[
			  'foreignKey' => 'VDT_DEPARTMENT'
        ]);
		$this->belongsTo('Ledgerstype');
		

		$this->belongsTo('vouchers', [
            'foreignKey' => 'VCH_ID',
        ]);
    }
	
	
	
	
	
}
?>