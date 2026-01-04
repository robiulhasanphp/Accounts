<?php
namespace App\Model\Table;

use Cake\ORM\Table;

class CoasetledgerTable extends Table
{

    public function initialize(array $config)
    {
		$this->Table('coasetledger');
		$this->primaryKey('SLD_ID');
		
				$this->belongsTo('chartofacc', [
            'foreignKey' => 'COA_ID',
        ]);
		
		
				$this->belongsTo('Ledgers', [
            'foreignKey' => 'LDG_ID',
        ]);
		
    }
	
	

	
	
	
}
?>