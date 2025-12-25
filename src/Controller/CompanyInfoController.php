<?php	
	namespace App\Controller;
	use App\Controller\AppController;
	//$uses = array('CompanyInfo', 'CompanyBranch');
	
	class CompanyInfoController extends AppController{
		
		
		public function index(){
			$this->set('CompanyInfo', $this->CompanyInfo->find('all')->contain('CompanyBranch'));
		}


		
		public function view($CMP_ID){
			$this->set('CompanyInfo', $this->CompanyInfo->find('all')->where(['CMP_ID'=>$CMP_ID]));
		}
	
	
	
	
		 public function add(){
			 
			$CompanyInfo = $this->CompanyInfo->newEntity();
			if ($this->request->is('post')) {
				$CompanyInfo = $this->CompanyInfo->patchEntity($CompanyInfo, $this->request->data);
				if ($this->CompanyInfo->save($CompanyInfo)) {
					$this->Flash->success(__('Your CompanyInfo has been saved.'));
					return $this->redirect(array('controller'=>'CompanyRoot','action' => 'index'));
				}
				$this->Flash->error(__('Unable to add your Company.'));
			}
			$this->set('CompanyInfo', $CompanyInfo);
	
			$query=$this->CompanyInfo->CompanyRoot->find('list',['keyField' => 'RT_ID','valueField' => 'RT_NAME']);
			$CompanyRoot = $query->toArray();
			$this->set(compact('CompanyRoot'));
		}
		
		
		
		public function edit($id = null){
			$CompanyInfo = $this->CompanyInfo->get($id);
			if ($this->request->is(['post', 'put'])) {
				$this->CompanyInfo->patchEntity($CompanyInfo, $this->request->data);
				if ($this->CompanyInfo->save($CompanyInfo)) {
					$this->Flash->success(__('Your CompanyInfo has been updated.'));
					return $this->redirect(array('controller'=>'CompanyRoot','action' => 'index'));
				}
				$this->Flash->error(__('Unable to update your article.'));
			}
		
			$this->set('CompanyInfo', $CompanyInfo);
			
			
			$query=$this->CompanyInfo->CompanyRoot->find('list',['keyField' => 'RT_ID','valueField' => 'RT_NAME']);
			$CompanyRoot = $query->toArray();
			$this->set(compact('CompanyRoot'));
		}



		public function delete($id){
			$data = $this->CompanyInfo->get($id);
			$this->CompanyInfo->delete($data);
			return $this->redirect(array('controller'=>'CompanyRoot','action' => 'index'));
		}






	}
?>