<?php
	namespace App\Controller;
	
use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Network\Exception\NotFoundException;
	
	
	
	class  VoucherdtlController extends AppController{
		
/*		var $uses=array ('CompanyRoot', 'CompanyInfo', 'CompanyBranch');
		public $helpers = array('Html', 'Form', 'Session');
		public $components = array('Session');*/
		

		
		
		
		public function index(){
			
	$Voucherstatus = $this->Voucherdtl->find('all');
        $this->set(compact('Voucherstatus'));
	
   
	
		}
		
	 
	 
	  public function add()
    {
        $Voucherstatus = $this->Voucherdtl->newEntity();
        if ($this->request->is('post')) {
            $Voucherstatus = $this->Voucherdtl->patchEntity($Voucherstatus, $this->request->data);
	
            if ($this->Voucherdtl->save($Voucherstatus)) {
                $this->Flash->success(__('The user has been saved.'));
               return $this->redirect(array('action' => 'index'));
            }
            $this->Flash->error(__('Unable to add the user.'));
        }
        $this->set('Voucherstatus', $Voucherstatus);
    }

		
		
		
		
	}

?>