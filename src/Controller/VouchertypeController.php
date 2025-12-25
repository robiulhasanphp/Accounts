<?php
	namespace App\Controller;
	
use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Network\Exception\NotFoundException;
	
	
	
	class  VouchertypeController extends AppController{
		
/*		var $uses=array ('CompanyRoot', 'CompanyInfo', 'CompanyBranch');
		public $helpers = array('Html', 'Form', 'Session');
		public $components = array('Session');*/
		

		
		
		
		public function index(){
			
	$Vouchertype = $this->Vouchertype->find('all')
            ->where(['BAS_TYPE_ID' =>VCH_TYPE]);
        $this->set(compact('Vouchertype'));
	
   
	
		}
		
		
	  public function view($BAS_ID)
    {
        if (!$BAS_ID) 
		{
            throw new NotFoundException(__('Invalid user'));
        }

        $Vouchertype = $this->Vouchertype->get($BAS_ID);
        $this->set(compact('Vouchertype'));
    }
		
		
	  public function add()
    {
        $Vouchertype = $this->Vouchertype->newEntity();
        if ($this->request->is('post')) {
            $Vouchertype = $this->Vouchertype->patchEntity($Vouchertype, $this->request->data);
			$Vouchertype->BAS_TYPE_ID=8;
            if ($this->Vouchertype->save($Vouchertype)) {
                $this->Flash->success(__('The user has been saved.'));
               return $this->redirect(array('action' => 'index'));
            }
            $this->Flash->error(__('Unable to add the user.'));
        }
        $this->set('Vouchertype', $Vouchertype);
    }


		
		
public function edit($BAS_ID = null)
{
    $Vouchertype = $this->Vouchertype->get($BAS_ID);
    if ($this->request->is(['post', 'put'])) {
        $this->Vouchertype->patchEntity($Vouchertype, $this->request->data);
		$Vouchertype->BAS_TYPE_ID=8;
        if ($this->Vouchertype->save($Vouchertype)) {
            $this->Flash->success(__('Your article has been updated.'));
            return $this->redirect(['action' => 'index']);
        }
        $this->Flash->error(__('Unable to update your article.'));
    }

    $this->set('Vouchertype', $Vouchertype);
}

	
	
		public function delete($BAS_ID = null)
{
    $Vouchertype = $this->Vouchertype->get($BAS_ID);
        $this->request->is(['post', 'delete']);
        if ($this->Vouchertype->delete($Vouchertype)) {
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