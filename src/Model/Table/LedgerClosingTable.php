<?php
namespace App\Model\Table;

use Cake\ORM\Table;

class LedgerClosingTable extends Table
{

    public function initialize(array $config)
    {
		$this->Table('ledger_balance');
		$this->primaryKey('LDG_ID');
 		 $this->belongsTo('Project',[		 		 
 		  
           'foreignKey' => 'VDT_PROJECT',

        ]);
		 $this->belongsTo('Department',[
          
			  'foreignKey' => 'VDT_DEPARTMENT'
        ]);
		
		
		 $this->belongsTo('Ledgerbalance',[
          
			  'foreignKey' => 'LDG_ID'
        ]);
		
		

		
		$this->belongsTo('vouchers', [
            'foreignKey' => 'VCH_ID',
        ]);
    }
	
	
	
	
	
}
?>