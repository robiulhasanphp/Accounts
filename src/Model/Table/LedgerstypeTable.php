<?php
namespace App\Model\Table;

use Cake\ORM\Table;

class  LedgerstypeTable extends Table
{
	var $useTable="ledger_types";
	var $name="ledger_types";
    public function initialize(array $config)
    {
		$this->Table('ledger_types');
		$this->primaryKey('LDT_ID');
		 $this->belongsTo('Ledger', [
            'foreignKey' => 'LDG_ID',
				'joinType'=>'inner'
        ]);
        $this->addBehavior('Timestamp');
		//$this->belongsTo(['Ledgers','Ledgertypem']);
    }
	
	

	
	
	
}
?>