<?php
	namespace App\Controller;
	class  BasicTypeController extends AppController{
		
/*		var $uses=array ('CompanyRoot', 'CompanyInfo', 'CompanyBranch');
		public $helpers = array('Html', 'Form', 'Session');
		public $components = array('Session');*/
		
		
		
		public function index(){
			 $CompanyRoot = $this->BasicType->find('all');
        $this->set(compact('CompanyRoot'));
//			$this->set('CompanyRoot', $this->BasicTypes->find('all'));
		}
		
		
		
		
	}

?>