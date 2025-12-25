<?php
namespace App\Model\Table;

use Cake\ORM\Table;

class voucherstatuslogTable extends Table
{

    public function initialize(array $config)
    {
	
		 $this->table('voucher_status_log');
 		 $this->belongsTo('Basicdata');

		 $this->belongsTo('Ledgerstype');
		$this->belongsTo('Ledgers');
	
		$this->belongsTo('Voucherdtl', [
            'foreignKey' => 'VCH_ID',
        ]);
		
		
	
		
		
		$this->belongsTo('vouchers', [
            'foreignKey' => 'VCH_ID',
        ]);
		
		
			$this->belongsTo('Ledgerbalance', [
            'foreignKey' => 'VCH_ID',
        ]);
		
		
		$this->belongsTo('Users');
	
		
		
    }
	
	
		public function getVoucherdtl(){
		return $this->find('all')->contain(['Voucherdtl']);		
		
		}
		
		
		
		
		public $validate = array(
			'VCH_DATE' => array(
				'rule' => 'notEmpty'
			),
			'CMP_CODE' => array(
				'VCH_AMOUNT' => 'notEmpty'
			),
			'CMP_NAME' => array(
				'VCH_NARRATION' => 'notEmpty'
			)
			
		);
	
	
	
}
?>