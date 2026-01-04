<?php
namespace App\Model\Table;

use Cake\ORM\Table;

class GLTable extends Table
{

    public function initialize(array $config)
    {
		$this->Table('vwGL2');
			 $this->primaryKey('VDT_ID');
 		 $this->belongsTo('Project',[
		 		 
 		  
           'foreignKey' => 'VDT_PROJECT',

        ]);
		 $this->belongsTo('Department',[
          
			  'foreignKey' => 'VDT_DEPARTMENT'
        ]);
		
		
		
		 $this->belongsTo('Ledgerstype');
	
$this->belongsTo('Ledgers',[
          
			  'foreignKey' => 'VDT_LDG_ID'
        ] );


$this->belongsTo('LedgerClosing',[        
			  'foreignKey' => 'LDG_ID'
        ]);
		

		$this->belongsTo('vouchers', [
            'foreignKey' => 'VCH_ID'
        ]);
    }
	
	
	
	
	
}
?>