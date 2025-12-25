<?php
namespace App\Model\Table;

use Cake\ORM\Table;
	
use Cake\Datasource\ConnectionManager;

class VoucherDateSumTable extends Table
{

    public function initialize(array $config)
    {
	
		 $this->table('vw_voucher_date_sum');
 		
			$this->belongsTo('LedgerClosing', [
            'foreignKey' => 'VDT_LDG_ID',
        ]);
		
		
			$this->belongsTo('Ledgers',[
          
			  'foreignKey' => 'VDT_LDG_ID'
        ] );
		
		
		
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