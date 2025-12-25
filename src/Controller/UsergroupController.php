<?php
	namespace App\Controller;
	
use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Network\Exception\NotFoundException;
	
	
	
	class  UsergroupController extends AppController{
		
/*		var $uses=array ('CompanyRoot', 'CompanyInfo', 'CompanyBranch');
		public $helpers = array('Html', 'Form', 'Session');
		public $components = array('Session');*/
		

		
		
		
		public function index(){
			
	$Usergroup = $this->Usergroup->find('all')
            ->where(['BAS_TYPE_ID' => 3]);
        $this->set(compact('Usergroup'));
	
   
	
		}
		
		
	  public function view($BAS_ID)
    {
        if (!$BAS_ID) 
		{
            throw new NotFoundException(__('Invalid user'));
        }

        $Usergroup = $this->Usergroup->get($BAS_ID);
        $this->set(compact('Usergroup'));
    }
		
		
	  public function add()
    {
        $Usergroup = $this->Usergroup->newEntity();
        if ($this->request->is('post')) {
            $Usergroup = $this->Usergroup->patchEntity($Usergroup, $this->request->data);
			$Usergroup->BAS_TYPE_ID=3;
            if ($this->Usergroup->save($Usergroup)) {
                $this->Flash->success(__('The user has been saved.'));
               return $this->redirect(array('action' => 'index'));
            }
            $this->Flash->error(__('Unable to add the user.'));
        }
        $this->set('Usergroup', $Usergroup);
    }


		
		
public function edit($BAS_ID = null)
{
    $Usergroup = $this->Usergroup->get($BAS_ID);
    if ($this->request->is(['post', 'put'])) {
        $this->Usergroup->patchEntity($Usergroup, $this->request->data);
		$Usergroup->BAS_TYPE_ID=3;
        if ($this->Usergroup->save($Usergroup)) {
            $this->Flash->success(__('Your article has been updated.'));
            return $this->redirect(['action' => 'index']);
        }
        $this->Flash->error(__('Unable to update your article.'));
    }

    $this->set('Usergroup', $Usergroup);
}

	
	
		public function delete($BAS_ID = null)
{
    $Usergroup = $this->Usergroup->get($BAS_ID);
        $this->request->is(['post', 'delete']);
        if ($this->Usergroup->delete($Usergroup)) {
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