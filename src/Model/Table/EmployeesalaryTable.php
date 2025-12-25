<?php
namespace App\Model\Table;

use Cake\ORM\Table;

class EmployeesalaryTable extends Table
{

    public function initialize(array $config)
    {
	
		 $this->table('employee_salary');
		 $this->primaryKey('EMS_ID');
 		
		$this->belongsTo('Ledgerstype');
		$this->belongsTo('Ledgers', [
            'foreignKey' => 'EMPLOYEE_ID',
        ]);
		
		$this->belongsTo('Basicdata', [
            'foreignKey' => 'EMS_SALARY',
        ]);
    }
	

	
	
	
}
?>