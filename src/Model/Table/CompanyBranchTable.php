<?php
	namespace App\Model\Table;
	use Cake\ORM\Table;
	
	class CompanyBranchTable extends Table{
		public function initialize(array $config){
			
			$this->Table('company_branch');
			$this->primaryKey('BRN_ID');
			$this->addBehavior('Timestamp');
			
			//$this->belongsTo('CompanyRoot', ['foreignKey' => 'CMP_ROOT_ID']);
			$this->belongsTo('CompanyInfo', ['foreignKey' => 'CMP_ID']);
			
		}
		
	}
?>