<?php
	namespace App\Controller;
	
	class CompanyRootController extends AppController{
		
		public function index(){
			$this->set('CompanyRoot', $this->CompanyRoot->find('all')->contain('CompanyInfo'));
			
			
			
		}

		public function getBranches(){
				return 'xyx';
		}
		
		
		
		public function view($RT_ID){
			$this->set('CompanyRoot', $this->CompanyRoot->find('all')->where(['RT_ID'=>$RT_ID]));
		}
		
		
		
		 public function add(){
			 
			$CompanyRoot = $this->CompanyRoot->newEntity();
			if ($this->request->is('post')) {
				$CompanyRoot = $this->CompanyRoot->patchEntity($CompanyRoot, $this->request->data);
				if ($this->CompanyRoot->save($CompanyRoot)) {
					$this->Flash->success(__('Your CompanyRoot has been saved.'));
					return $this->redirect(array('action' => 'index'));
				}
				$this->Flash->error(__('Unable to add your article.'));
			}
			$this->set('CompanyRoot', $CompanyRoot);
	
			/*$query=$this->CompanyInfo->CompanyRoot->find('list',['keyField' => 'RT_ID','valueField' => 'RT_NAME']);
			$CompanyRoot = $query->toArray();
			$this->set(compact('CompanyRoot'));*/
		}
		
		
			
		
	}
?>