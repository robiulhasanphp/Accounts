<?php
namespace App\Model\Table;

use Cake\ORM\Table;

class GeneralLedgerTable extends Table
{

    public function initialize(array $config)
    {
	
		 $this->table('general_ledger');
 		 $this->belongsTo('Basicdata');
		 
		

		 $this->belongsTo('Ledgerstype');
		$this->belongsTo('Ledgers', [
            'foreignKey' => 'LDG_ID',
        ]);
		$this->belongsTo('Voucherdtl', [
            'foreignKey' => 'VCH_ID',
        ]);
		
		
		$this->belongsTo('vouchers', [
            'foreignKey' => 'VCH_ID',
        ]);
		
		
			$this->belongsTo('Ledgerbalance', [
            'foreignKey' => 'LDG_ID',
        ]);
		
		
		$this->belongsTo('Users');
		
		
		
		
		
		
		
		
		 $this->belongsTo('Project',[
           'foreignKey' => 'VDT_PROJECT',

        ]);
		 $this->belongsTo('Department',[
          
			  'foreignKey' => 'VDT_DEPARTMENT'
        ]);
		
		
		 $this->belongsTo('Ledgerstype');
		
		$this->belongsTo('Ledgers',[
          
			  'foreignKey' => 'LDG_ID'
        ] );

		
		$this->belongsTo('vouchers', [
            'foreignKey' => 'VCH_ID'
        ]);
		
		$this->belongsTo('LedgerClosing', [
            'foreignKey' => 'LDG_ID'
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