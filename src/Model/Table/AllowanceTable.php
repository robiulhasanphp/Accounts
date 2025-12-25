<?php
namespace App\Model\Table;

use Cake\ORM\Table;

class AllowanceTable extends Table
{
	
    public function initialize(array $config)
    {
		$this->Table('Ledgers');

		$this->primaryKey('LDG_ID');
		 $this->hasMany('Ledgerstype', [
            'foreignKey' => 'LDG_ID',
			'joinType'=>'inner'
        ]);
        $this->addBehavior('Timestamp');
    }
	
	
		public function getLedgerTypes(){
			return $this->find('all')->contain(['Ledgerstype']);		
		
		}
	
	
	
}
?>