<?php
namespace App\Model\Table;

use Cake\ORM\Table;

class vouchersTable extends Table
{
	var $useTable="vouchers";
	var $name="vouchers";
    public function initialize(array $config)
    {
	
		
 		$this->belongsTo('Basicdata');
		$this->primaryKey('VCH_ID');
		$this->belongsTo('Ledgerstype');
		$this->belongsTo('Ledgers');
		$this->hasMany('Ledgerbalance');
    }
	
	

	
	
	
}
?>