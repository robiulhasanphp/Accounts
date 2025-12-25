<?php
namespace App\Model\Table;

use Cake\ORM\Table;

class PurchaseTable extends Table
{

    public function initialize(array $config)
    {
	
		 $this->table('vouchers');
		 $this->primaryKey('VCH_ID');
 		
		$this->belongsTo('Ledgers');
		$this->belongsTo('Ledgerstype');
		$this->belongsTo('Voucherdtl', [
            'foreignKey' => 'VCH_ID',
        ]);
		
		
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