<?php
namespace App\Model\Table;

use Cake\ORM\Table;

class SalesTable extends Table
{

    public function initialize(array $config)
    {
	
		 $this->table('vouchers');
 		 $this->belongsTo('Basicdata');

		 $this->belongsTo('Ledgerstype');
		$this->belongsTo('Ledgers');
	
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