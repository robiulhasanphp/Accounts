<?php
namespace App\Model\Table;

use Cake\ORM\Table;

class CoasetTable extends Table
{

    public function initialize(array $config)
    {
		$this->Table('coaset');
		$this->primaryKey('SET_ID');
		
			
			
				$this->belongsTo('Chartofacc', [
            'foreignKey' => 'SET_ID',
        ]);
		
		
				
				$this->belongsTo('GeneralLedger');
		
				$this->belongsTo('LedgerClosing');
			$this->belongsTo('Ledgers');
			
			
	
		
			
				$this->belongsTo('Coasetledger', [
            'foreignKey' => 'SET_ID',
        ]);
		
    }
	
	

	
	
	
}
?>