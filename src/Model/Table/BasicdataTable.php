<?php
namespace App\Model\Table;

use Cake\ORM\Table;

class BasicdataTable extends Table
{
	var $useTable="basic_data";
	var $name="basic_data";
    public function initialize(array $config)
    {
		$this->Table('basic_data');
		$this->primaryKey('BAS_ID');
        $this->addBehavior('Timestamp');
	
		
    }
	
	

	
	
	
}
?>