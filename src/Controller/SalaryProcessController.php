<?php
	namespace App\Controller;
	
use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Network\Exception\NotFoundException;
use Cake\ORM\TableRegistry;	
	
	
	class  SalaryProcessController extends AppController{
		
/*		var $uses=array ('CompanyRoot', 'CompanyInfo', 'CompanyBranch');
		public $helpers = array('Html', 'Form', 'Session');
		public $components = array('Session');*/
		

		
		
		
		
		public function index(){
			
	$Project = $this->Project->find('all')
            ->where(['BAS_TYPE_ID' =>5]);
        $this->set(compact('Project'));
	
   
	
		}
		
		
	  public function view($BAS_ID)
    {
        if (!$BAS_ID) 
		{
            throw new NotFoundException(__('Invalid user'));
        }

        $Project = $this->Project->get($BAS_ID);
        $this->set(compact('Project'));
    }
		
		
	  public function add()
    {
        $Project = $this->Project->newEntity();
        if ($this->request->is('post')) {
            $Project = $this->Project->patchEntity($Project, $this->request->data);
			$Project->BAS_TYPE_ID=5;
            if ($this->Project->save($Project)) {
                $this->Flash->success(__('The user has been saved.'));
               return $this->redirect(array('action' => 'index'));
            }
            $this->Flash->error(__('Unable to add the user.'));
        }
        $this->set('Project', $Project);
    }


		
		
public function edit($BAS_ID = null)
{
    $Project = $this->Project->get($BAS_ID);
    if ($this->request->is(['post', 'put'])) {
        $this->Project->patchEntity($Project, $this->request->data);
		$Project->BAS_TYPE_ID=5;
        if ($this->Project->save($Project)) {
            $this->Flash->success(__('Your article has been updated.'));
            return $this->redirect(['action' => 'index']);
        }
        $this->Flash->error(__('Unable to update your article.'));
    }

    $this->set('Project', $Project);
}

	
	
		public function delete($BAS_ID = null)
{
    $Project = $this->Project->get($BAS_ID);
        $this->request->is(['post', 'delete']);
        if ($this->Project->delete($Project)) {
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