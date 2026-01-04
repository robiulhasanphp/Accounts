<?php
namespace App\Model\Table;

use Cake\ORM\Table;

class BasicTypeTable extends Table
{
	var $useTable="basic_types";
	var $name="basic_type";
    public function initialize(array $config)
    {
		$this->Table('basic_types');
		$this->primaryKey('BST_ID');
	
        $this->addBehavior('Timestamp');
    }
}
?>