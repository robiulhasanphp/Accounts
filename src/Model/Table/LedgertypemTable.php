<?php
namespace App\Model\Table;

use Cake\ORM\Table;

class LedgertypemTable extends Table
{
	var $useTable="ledger_type_m";
	var $name="ledger_type_m";
    public function initialize(array $config)
    {
		$this->Table('ledger_type_m');
		$this->primaryKey('LTM_ID');
        $this->addBehavior('Timestamp');
    }
	
	

	
	
	
}
?>