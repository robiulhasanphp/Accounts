<?php
	namespace App\Model\Table;
	use Cake\ORM\Table;
	
	class CompanyInfoTable extends Table{
		public function initialize(array $config){
			
			$this->Table('company_info');
			$this->primaryKey('CMP_ID');
			$this->addBehavior('Timestamp');
			
			//$this->belongsTo('CompanyRoot', ['foreignKey' => 'CMP_ROOT_ID']);
			$this->belongsTo('CompanyRoot');
			$this->hasMany('CompanyBranch', ['foreignKey' => 'CMP_ID', 'dependent' => true,]);
			
		}
		
	}
?>