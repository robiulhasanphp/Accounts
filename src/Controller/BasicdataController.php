<?php
	namespace App\Controller;
	
use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Network\Exception\NotFoundException;
	
	
	
	class  BasicdataController extends AppController{
		
/*		var $uses=array ('CompanyRoot', 'CompanyInfo', 'CompanyBranch');
		public $helpers = array('Html', 'Form', 'Session');
		public $components = array('Session');*/
		

		
		
		
		public function index(){
			
	$Basicdata = $this->Basicdata->find('all');
        $this->set(compact('Basicdata'));
	
   
	
		}
		
		
	  public function view($BAS_ID)
    {
        if (!$BAS_ID) 
		{
            throw new NotFoundException(__('Invalid user'));
        }

        $Basicdata = $this->Basicdata->get($BAS_ID);
        $this->set(compact('Basicdata'));
    }
		
		
	  public function add()
    {
        $Basicdata = $this->Basicdata->newEntity();
        if ($this->request->is('post')) {
            $Basicdata = $this->Basicdata->patchEntity($Basicdata, $this->request->data);
			$Basicdata->BAS_TYPE_ID=3;
            if ($this->Basicdata->save($Basicdata)) {
                $this->Flash->success(__('The user has been saved.'));
               return $this->redirect(array('action' => 'index'));
            }
            $this->Flash->error(__('Unable to add the user.'));
        }
        $this->set('Basicdata', $Basicdata);
    }


		
		
public function edit($BAS_ID = null)
{
    $Basicdata = $this->Basicdata->get($BAS_ID);
    if ($this->request->is(['post', 'put'])) {
        $this->Basicdata->patchEntity($Basicdata, $this->request->data);
		$Basicdata->BAS_TYPE_ID=3;
        if ($this->Basicdata->save($Basicdata)) {
            $this->Flash->success(__('Your article has been updated.'));
            return $this->redirect(['action' => 'index']);
        }
        $this->Flash->error(__('Unable to update your article.'));
    }

    $this->set('Basicdata', $Basicdata);
}

	
	
		public function delete($BAS_ID = null)
{
    $Basicdata = $this->Basicdata->get($BAS_ID);
        $this->request->is(['post', 'delete']);
        if ($this->Basicdata->delete($Basicdata)) {
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