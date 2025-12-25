<?php	
	namespace App\Controller;

	use App\Controller\AppController;
	
	class CompanyBranchController extends AppController{
		public function index(){
			$this->set('CompanyBranch', $this->CompanyBranch->find('all'));
		}
		
		
		public function view($BRN_ID){
			$this->set('CompanyBranch', $this->CompanyBranch->find('all')->where(['BRN_ID'=>$BRN_ID]));
		}
		public function showbranch($CMP_ID){
			//return $this->CompanyBranch->find('all')->where(['CMP_ID'=>$CMP_ID]);
				$this->set('CompanyBranch', $this->CompanyBranch->find('all')->where(['CMP_ID'=>$CMP_ID]));
		}
		
		 public function add(){
			 
			$CompanyBranch = $this->CompanyBranch->newEntity();
			if ($this->request->is('post')) {
				$CompanyBranch = $this->CompanyBranch->patchEntity($CompanyBranch, $this->request->data);
				if ($this->CompanyBranch->save($CompanyBranch)) {
					$this->Flash->success(__('Your CompanyBranch has been saved.'));
					return $this->redirect(array('controller'=>'CompanyRoot','action' => 'index'));
				}
				$this->Flash->error(__('Unable to add your article.'));
			}
			$this->set('CompanyBranch', $CompanyBranch);
	
			$query=$this->CompanyBranch->CompanyInfo->find('list',['keyField' => 'CMP_ID','valueField' => 'CMP_NAME']);
			$CompanyInfo = $query->toArray();
			$this->set(compact('CompanyInfo'));
		}
		
		
		
		public function edit($id = null){
			$CompanyBranch = $this->CompanyBranch->get($id);
			if ($this->request->is(['post', 'put'])) {
				$this->CompanyBranch->patchEntity($CompanyBranch, $this->request->data);
				if ($this->CompanyBranch->save($CompanyBranch)) {
					$this->Flash->success(__('Your CompanyBranch has been updated.'));
				return $this->redirect(array('controller'=>'CompanyRoot','action' => 'index'));
				}
				$this->Flash->error(__('Unable to update your CompanyBranch.'));
			}
		
			$this->set('CompanyBranch', $CompanyBranch);
			
			
			$query=$this->CompanyBranch->CompanyInfo->find('list',['keyField' => 'CMP_ID','valueField' => 'CMP_NAME']);
			$CompanyInfo = $query->toArray();
			$this->set(compact('CompanyInfo'));
		}
		
		
		
		
		public function delete($id){
			$data = $this->CompanyBranch->get($id);
			$this->CompanyBranch->delete($data);
			return $this->redirect(array('controller'=>'CompanyRoot','action' => 'index'));
		}
		
		
		
		
		
		
	}
	
	
	
	
	
	
	
	
	
	/*namespace App\Controller;
	use App\Controller\AppController;
	$uses = array('CompanyRoot', 'CompanyInfo');
	
	class CompanyInfoController extends AppController{
		
		
		public function index(){
			$this->set('CompanyInfo', $this->CompanyInfo->find('all'));
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
					return $this->redirect(array('action' => 'index'));
				}
				$this->Flash->error(__('Unable to add your article.'));
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
					return $this->redirect(['action' => 'index']);
				}
				$this->Flash->error(__('Unable to update your article.'));
			}
		
			$this->set('CompanyInfo', $CompanyInfo);
			
			
			$query=$this->CompanyInfo->CompanyRoot->find('list',['keyField' => 'RT_ID','valueField' => 'RT_NAME']);
			$CompanyRoot = $query->toArray();
			$this->set(compact('CompanyRoot'));
		}










	}*/
?>