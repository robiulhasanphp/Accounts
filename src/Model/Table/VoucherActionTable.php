<?php
namespace App\Model\Table;

use Cake\ORM\Table;

class VoucherActionTable extends Table
{

    public function initialize(array $config)
    {
	
		$this->table('vouchers');
 		$this->belongsTo('Basicdata');
		
		$this->belongsTo('Ledgerbalance',[
            'foreignKey' => 'VCH_ID',
        ]);
		
		$this->belongsTo('Ledgerstype');
		$this->belongsTo('Ledgers');
	
		$this->belongsTo('Voucherdtl',[
            'foreignKey' => 'VCH_ID',
        ]);
		
		
		$this->belongsTo('Users',[
            'foreignKey' => 'VCH_STATUS_BY',
        ]);
		
		$this->belongsTo('GeneralLedger',[
            'foreignKey' => 'VCH_ID',
        ]);
		
	
		
		$this->belongsTo('voucherstatuslog');
		
    }
	
	
		
		
		
		
		
	
	
	
}
?>