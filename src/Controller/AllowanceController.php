<?php
	namespace App\Controller;
	
use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Network\Exception\NotFoundException;
	
	
	
	class  AllowanceController extends AppController{
		
/*		var $uses=array ('CompanyRoot', 'CompanyInfo', 'CompanyBranch');
		public $helpers = array('Html', 'Form', 'Session');
		public $components = array('Session');*/
		

		
		
		
		public function index(){
			
	$Allowance = $this->Allowance->find('all')->contain(['Ledgerstype']);
	echo "<pre>";
	var_dump($Allowance->ledgerstype);
/*	$Allowance=$Allowance1->Ledgerstype-find('all')		
            ->where(['LTM_ID' =>LDG_TYPE_ALLOWANCES])
			->orWhere(['LTM_ID' =>LDG_TYPE_DEDUCTION]);*/
        $this->set(compact('Allowance'));
	
   
	
		}
		
		
	  public function view($BAS_ID)
    {
        if (!$BAS_ID) 
		{
            throw new NotFoundException(__('Invalid user'));
        }

        $Allowance = $this->Allowance->get($BAS_ID);
        $this->set(compact('Allowance'));
    }
		
		
	  public function add()
    {
        $Allowance = $this->Allowance->newEntity();
        if ($this->request->is('post')) {
            $Allowance = $this->Allowance->patchEntity($Allowance, $this->request->data);
			$Allowance->COMPANY_ID=1;
						$Allowance->LDG_DESIGNATION=1;
				$Allowance->BRACH_ID=1;
						$Allowance->LDG_LAST_EDIT_BY=1;
				$Allowance->LDG_CREATE_BY=1;
			
            if ($this->Allowance->save($Allowance)) {
			
			
	
				
				$new_id=$Allowance->LDG_ID;
				 $Ledgerstype = $this->Allowance->Ledgerstype->newEntity();
				 
				  $Ledgerstype->LDG_ID=$new_id;
				  if($Allowance->LDG_TYPES=="ALW")
				  {
				   $Ledgerstype->LTM_ID=LDG_TYPE_ALLOWANCES;
				  }
				  else
				  {
					   $Ledgerstype->LTM_ID=LDG_TYPE_DEDUCTION;
				  }
				    $this->Allowance->Ledgerstype->save($Ledgerstype);
				//	exit();
                $this->Flash->success(__('The user has been saved.'));
               return $this->redirect(array('action' => 'index'));
            }
            $this->Flash->error(__('Unable to add the user.'));
        }
        $this->set('Allowance', $Allowance);
    }


		
		
public function edit($BAS_ID = null)
{
    $Allowance = $this->Allowance->get($BAS_ID);
    if ($this->request->is(['post', 'put'])) {
        $this->Allowance->patchEntity($Allowance, $this->request->data);
		$Allowance->BAS_TYPE_ID=6;
        if ($this->Allowance->save($Allowance)) {
            $this->Flash->success(__('Your article has been updated.'));
            return $this->redirect(['action' => 'index']);
        }
        $this->Flash->error(__('Unable to update your article.'));
    }

    $this->set('Allowance', $Allowance);
}

	
	
		public function delete($BAS_ID = null)
{
    $Allowance = $this->Allowance->get($BAS_ID);
        $this->request->is(['post', 'delete']);
        if ($this->Allowance->delete($Allowance)) {
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