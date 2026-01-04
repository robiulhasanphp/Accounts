<?php
	namespace App\Controller;
	
use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Network\Exception\NotFoundException;
	

	
	class  DesignationController extends AppController{
		
/*		var $uses=array ('CompanyRoot', 'CompanyInfo', 'CompanyBranch');
		public $helpers = array('Html', 'Form', 'Session');
		public $components = array('Session');*/
		

		
		
		
		public function index(){
			
	$Designation = $this->Designation->find('all')
	 ->where(['BAS_TYPE_ID' =>2]);
        $this->set(compact('Designation'));
		
	
   
	
		}
		
		
	  public function view($BAS_ID)
    {
        if (!$BAS_ID) 
		{
            throw new NotFoundException(__('Invalid Designation'));
        }

        $Designation = $this->Designation->get($BAS_ID);
        $this->set(compact('Designation'));
    }
		
		
	  public function add()
    {
        $Designation = $this->Designation->newEntity();
        if ($this->request->is('post')) {
            $Designation = $this->Designation->patchEntity($Designation, $this->request->data);
			$Designation->BAS_TYPE_ID=2;
            if ($this->Designation->save($Designation)) {
                $this->Flash->success(__('The user has been saved.'));
               return $this->redirect(array('action' => 'index'));
            }
            $this->Flash->error(__('Unable to add the user.'));
        }
        $this->set('Designation', $Designation);
    }


		
		
public function edit($BAS_ID = null)
{
    $Designation = $this->Designation->get($BAS_ID);
    if ($this->request->is(['post', 'put'])) {
        $this->Designation->patchEntity($Designation, $this->request->data);
		$Designation->BAS_TYPE_ID=4;
        if ($this->Designation->save($Designation)) {
            $this->Flash->success(__('Your article has been updated.'));
            return $this->redirect(['action' => 'index']);
        }
        $this->Flash->error(__('Unable to update your article.'));
    }

    $this->set('Designation', $Designation);
}

	
	
		public function delete($BAS_ID = null)
{
    $Designation = $this->Designation->get($BAS_ID);
        $this->request->is(['post', 'delete']);
        if ($this->Designation->delete($Designation)) {
            $this->Flash->success('The user has been deleted.');
        } else {
            $this->Flash->error('The user could not be deleted. Please, try again.');
        }
        return $this->redirect(['action' => 'index']);
    }
	
	
	
	
	
	public function isAuthorized($user)
{
    // All registered users can add articles
    if ($this->request->action === 'add') 
	{
        return true;
    }

    // The owner of an article can edit and delete it
  /*  if (in_array($this->request->action, ['edit', 'delete']))
	 {
        $articleId = (int)$this->request->params['pass'][0];
        if ($this->Articles->isOwnedBy($articleId, $user['id'])) 
		{
            return true;
        }
    }*/

    return parent::isAuthorized($user);
}
	
	
		
		
		
		
	}

?>