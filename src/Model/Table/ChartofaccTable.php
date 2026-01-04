<?php
namespace App\Model\Table;

use Cake\ORM\Table;

class ChartofaccTable extends Table
{

    public function initialize(array $config)
    {
		$this->Table('chart_of_account');
		$this->primaryKey('COA_ID');
    }
	
	

	
	
	
}
?>