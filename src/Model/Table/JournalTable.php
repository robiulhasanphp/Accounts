<?php
namespace App\Model\Table;

use Cake\ORM\Table;

class JournalTable extends Table
{

    public function initialize(array $config)
    {
	
		 $this->table('vouchers');
 		 $this->belongsTo('Basicdata');

		 $this->belongsTo('Ledgerstype');
		
	
		 $this->belongsTo('Ledgers',[
           'foreignKey' => 'VCH_CR_ACCOUNTS',

        ]);
		
		
			
		
		$this->belongsTo('Voucherdtl', [
            'foreignKey' => 'VCH_ID',
        ]);
		
		
		$this->belongsTo('Project',[
		 		 
 		  
           'foreignKey' => 'VCH_PROJECT',

        ]);
		 $this->belongsTo('Department',[
          
			  'foreignKey' => 'VCH_DEPARTMENT'
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