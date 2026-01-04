<?php

	namespace App\Model\Table;
	
	use Cake\ORM\Table;
	
	class CashWithdrawTable extends Table
	{
		public function initialize(array $config)
		{
			$this->Table('vouchers');
			
			$this->belongsTo('Basicdata');
			$this->belongsTo('Ledgerstype');
			$this->belongsTo('Ledgers');
			$this->belongsTo('Voucherdtl',['foreignKey' => 'VCH_ID']);
			
			//$this->addBehavior('Timestamp');
		}
		
		
		
		
		public function getVoucherdtl()
		{
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