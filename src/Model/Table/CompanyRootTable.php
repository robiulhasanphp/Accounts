<?php

	namespace App\Model\Table;
	
	use Cake\ORM\Table;
	
	class CompanyRootTable extends Table{
		public function initialize(array $config){
			
			
			$this->Table('company_root');
			$this->primaryKey('RT_ID');
			$this->addBehavior('Timestamp');
			$this->addBehavior('Tree');
			$this->hasMany('CompanyInfo', ['foreignKey' => 'CMP_ROOT_ID', 'dependent' => true,]);
		}
	}


?>