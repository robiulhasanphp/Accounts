<?php
	namespace App\Controller;
	
use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Network\Exception\NotFoundException;
	
		
	class   LedgerstypeController extends AppController{
			
		public function index(){
			
	$Ledgertypes = $this-> Ledgerstype->find('all');
        $this->set(compact('Ledgertypes'));
	
   
	
		}
		
		
		
		
		  public function add()
    {
        $Ledgerstype = $this->Ledgerstype->newEntity();
        if ($this->request->is('post')) {
            $Ledgerstype = $this->Ledgerstype->patchEntity($Ledgerstype, $this->request->data);
		
            if ($this->Ledgerstype->save($Ledgerstype)) {
                $this->Flash->success(__('The user has been saved.'));
               return $this->redirect(array('action' => 'index'));
            }
            $this->Flash->error(__('Unable to add the user.'));
        }
        $this->set('Ledgerstype', $Ledgerstype);
    }


		
		
		
		
	}

?>