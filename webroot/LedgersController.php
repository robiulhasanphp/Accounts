<?php
	namespace App\Controller;
	
	use App\Controller\AppController;
	use Cake\Event\Event;
	use Cake\Network\Exception\NotFoundException;
	
	use Cake\Datasource\ConnectionManager;
	
	
	
	class  LedgersController extends AppController{
		
/*		var $uses=array ('CompanyRoot', 'CompanyInfo', 'CompanyBranch');
		public $helpers = array('Html', 'Form', 'Session');
		public $components = array('Session');*/
		

		
		
		
		public function index(){
			$Ledgers = $this->Ledgers->find('all');
			$this->set(compact('Ledgers'));
		}
		
		
		
		public function ShowList($ldg_type = null){
			$ldg_type='%'.$ldg_type.'%';
			
			$Ledgers = $this->Ledgers->find('all')->where(['LDG_TYPES like '=>$ldg_type]);
			$this->set(compact('Ledgers'));
			$conn = ConnectionManager::get('default');
			$this->set(compact('conn'));
			$this->set(compact('ldg_type'));
		}
		public function BalanceList(){
			$conn = ConnectionManager::get('default');
			$this->set(compact('conn'));
		}
		
		
	  public function view($LDG_ID)
    {
        if (!$LDG_ID) 
		{
            throw new NotFoundException(__('Invalid user'));
        }

        $Ledgers = $this->Ledgers->get($LDG_ID);
        $this->set(compact('Ledgers'));
    }
		
		
	  public function add()
    { $Ledgers = $this->Ledgers->newEntity();
		
		if (!$this->request->is('post')) {
		
		$query=$this->Ledgers->Basicdata->find('list',['keyField' => 'BAS_ID','valueField' => 'BAS_NAME'])
		->where(['BAS_TYPE_ID' =>1]);
	
		$Usergroups = $query->toArray();

		 $this->set(compact('Usergroups'));
		 
		
		
		$query=$this->Ledgers->Ledgertypem->find('list',['keyField' => ['LTM_SHORT','LTM_ID'],'valueField' => 'LTM_NAME'])
		->where(['LTM_ID >='=>4]);
	
		$Ladgertypem = $query->toArray();
		
	

		 $this->set(compact('Ladgertypem'));
		 
		 
		 	
		$query=$this->Ledgers->Ledgertypem->find('list',['keyField' => ['LTM_SHORT','LTM_ID'],'valueField' => 'LTM_NAME'])
		->where(['LTM_ID <='=>3]);
	
		$Ladgertyp = $query->toArray();

		 $this->set(compact('Ladgertyp'));
		 

	
		
		}
       
        if ($this->request->is('post')) {
			
			$chk=($this->request->data["LDG_chk"]);
			
			$lcode='';
			$lid='';
			
	
			
			
			for($i=0;$i<count($chk);$i++){
				
				
				$value=explode(';',$chk[$i]);
			
				$lcode=$lcode.",".$value[0];
				
				$lid=$lid.",".$value[1];
			
				
			}
			
			$lcode=substr($lcode,1);

			$lid=substr($lid,1);  /*  get real value 4      */
			
				
			
			
			$rdo=($this->request->data["LDG_rso"]);
			
			$rdoid_a=explode(";",$rdo);
			
			$rdoid=$rdoid_a[1];
			
		
			
			
			$lid=$lid.",".$rdoid;

			$lid_a=explode(",", $lid); /*  get real value 4 and 1     */
			
			//var_dump($lid); 
			
			
            	$Ledgers = $this->Ledgers->patchEntity($Ledgers, $this->request->data);
				$Ledgers->COMPANY_ID=1;
				$Ledgers->LDG_DESIGNATION=5;
				$Ledgers->BRACH_ID=1;
				$Ledgers->LDG_LAST_EDIT_BY=1;
				$Ledgers->LDG_CREATE_BY=1;
				$Ledgers->LDG_TYPES=$lcode.",".$rdoid_a[0];
				
				
				
				$invoice=$this->request->data('LDG_BALANCE');

				$birthday_in = explode('-', $invoice);
				$d = $birthday_in[0];
				$m = $birthday_in[1];
				$y = $birthday_in[2];
				$invoice_date = $y.'-'.$m.'-'.$d;
				
				$Ledgers->LDG_BALANCE_DATE=$invoice_date;
			
				
		
            if ($this->Ledgers->save($Ledgers)) 
			{
                $this->Flash->success(__('The user has been saved.'));
		
				$id = $Ledgers->LDG_ID;  //data call from table
			
	
				
				$new_id=$id;
				
				
				
				//insert data in another table

			for($i=0;$i<count($lid_a);$i++){
				
				 $Ledgerstype = $this->Ledgers->Ledgerstype->newEntity();
				 
				  $Ledgerstype->LDG_ID=$new_id;
				   $Ledgerstype->LTM_ID=$lid_a[$i];
				    $this->Ledgers->Ledgerstype->save($Ledgerstype);
				   
				
			}
				
				
          return $this->redirect(array('action' => 'index'));
            }
            $this->Flash->error(__('Unable to add the user.'));
        }
        $this->set('Ledgers', $Ledgers);
    }



		
public function edit($LDG_ID = null)
{
	
	
	
	
	$query=$this->Ledgers->Basicdata->find('list',['keyField' => 'BAS_ID','valueField' => 'BAS_NAME'])
		->where(['BAS_TYPE_ID' =>1]);
	
		$Usergroups = $query->toArray();

		 $this->set(compact('Usergroups'));
		 
		
		
		$query=$this->Ledgers->Ledgertypem->find('list',['keyField' => ['LTM_SHORT','LTM_ID'],'valueField' => 'LTM_NAME'])
		->where(['LTM_ID >='=>4]);
	
		$Ladgertypem = $query->toArray();
		
	

		 $this->set(compact('Ladgertypem'));
		 
		 
		 	
		$query=$this->Ledgers->Ledgertypem->find('list',['keyField' => ['LTM_SHORT','LTM_ID'],'valueField' => 'LTM_NAME'])
		->where(['LTM_ID <='=>3]);
	
		$Ladgertyp = $query->toArray();

		 $this->set(compact('Ladgertyp'));
		 
	
	
	
	
	
	
	
    $Ledgers = $this->Ledgers->get($LDG_ID);
    if ($this->request->is(['post', 'put'])) {
		
		
		
		$chk=($this->request->data["LDG_chk"]);
			
			$lcode='';
			$lid='';
			
		
			for($i=0;$i<count($chk);$i++){
				
				
				$value=explode(';',$chk[$i]);
			
				$lcode=$lcode.",".$value[0];
				
				$lid=$lid.",".$value[1];
			
				
			}
			
			$lcode=substr($lcode,1);

			$lid=substr($lid,1);  /*  get real value 4      */
			
		
			
			$rdo=($this->request->data["LDG_rso"]);
		
			$rdoid_a=explode(";",$rdo);
			
			$rdoid=$rdoid_a[1];
			
				
			
			
			$lid=$lid.",".$rdoid;

			$lid_a=explode(",", $lid); /*  get real value 4 and 1     */
			
			
			
			
		
			
			
            	$Ledgers = $this->Ledgers->patchEntity($Ledgers, $this->request->data);
				$Ledgers->COMPANY_ID=1;
				$Ledgers->LDG_DESIGNATION=5;
				$Ledgers->BRACH_ID=1;
				$Ledgers->LDG_LAST_EDIT_BY=1;
				$Ledgers->LDG_CREATE_BY=1;
				$Ledgers->LDG_TYPES=$lcode.",".$rdoid_a[0];
				
				
				
					
				$invoice=$this->request->data('LDG_BALANCE');

				$birthday_in = explode('-', $invoice);
				$d = $birthday_in[0];
				$m = $birthday_in[1];
				$y = $birthday_in[2];
				$invoice_date = $y.'-'.$m.'-'.$d;
				
				$Ledgers->LDG_BALANCE_DATE=$invoice_date;
			
		
		
	
        if ($this->Ledgers->save($Ledgers))
		 {
            $this->Flash->success(__('Your article has been updated.'));
		 }
		 
		 if ($this->Ledgers->Ledgerstype->deleteAll(['LDG_ID' =>$LDG_ID]))
				
				{
           
		   
		   $id = $Ledgers->LDG_ID;  //data call from table
			
	
				
				$new_id=$id;
			
			

				
				
				//insert data in another table

			for($i=0;$i<count($lid_a);$i++){
				
				 $Ledgerstype = $this->Ledgers->Ledgerstype->newEntity();
				 
				  $Ledgerstype->LDG_ID=$new_id;
				   $Ledgerstype->LTM_ID=$lid_a[$i];
				    $this->Ledgers->Ledgerstype->save($Ledgerstype);
				   
				
			}
				
				
            return $this->redirect(array('action' => 'index'));
        }
        $this->Flash->error(__('Unable to update your article.'));
    }

    $this->set('Ledgers', $Ledgers);
}

	
	
		public function delete($LDG_ID = null)
{
    $Ledgers = $this->Ledgers->get($LDG_ID);
        $this->request->is(['post', 'delete']);
        if ($this->Ledgers->delete($Ledgers)) {
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