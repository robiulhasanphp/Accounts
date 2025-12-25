<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class LedgersTable extends Table
{ 
	
	
	public function initialize(array $config)
    {
        $this->belongsTo('Basicdata');

		 $this->belongsTo('ledgertypem');
		 $this->hasMany('Employeesalary', [
            'foreignKey' => 'EMPLOYEE_ID',
        ]);
		 
		
		 $this->belongsTo('Ledgerstype', [
            'foreignKey' => 'LDG_ID',
        ]);
		
		
		 $this->belongsTo('Ledgerendbalance', [
            'foreignKey' => 'LDG_ID',
        ]);
		
    }
		public function getLedgerTypes(){
		return $this->find('all')->contain(['Ledgerstype']);		
		
		}

    public function validationDefault(Validator $validator)
    {
        return $validator
            ->notEmpty('username', 'A username is required')
            ->notEmpty('password', 'A password is required');
	
           
    }

}
?>
