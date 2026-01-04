<?php
namespace App\Model\Table;

use Cake\ORM\Table;

class LedgerendbalanceTable extends Table
{

	public function initialize(array $config)
    {
		$this->Table('Ledgers');
        $this->belongsTo('Basicdata');

		 $this->belongsTo('ledgertypem');
		
		 
		
		 $this->belongsTo('Ledgerstype', [
            'foreignKey' => 'LDG_ID',
        ]);
		
		
		 $this->belongsTo('LedgerClosing', [
            'foreignKey' => 'LDG_ID',
        ]);
		 $this->belongsTo('Ledgerbalance',[
          
			  'foreignKey' => 'VDT_LDG_ID'
        ]);
		
    }

	
	
}
?>