<?php
	namespace App\Controller;
	
use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Network\Exception\NotFoundException;
/*for row php*/
use Cake\Datasource\ConnectionManager;	
	
	
	class  LedgersController extends AppController{
		
/*		var $uses=array ('CompanyRoot', 'CompanyInfo', 'CompanyBranch');
		public $helpers = array('Html', 'Form', 'Session');
		public $components = array('Session');*/
		

		
		
		
		public function index(){
			
			
	$Ledgers = $this->Ledgers->find('all');
        $this->set(compact('Ledgers'));
	
   
	
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
		
		
		
		
		
		
	  public function add()
   		 { 
	
				
				$Ledgers = $this->Ledgers->newEntity();
				
				if (!$this->request->is('post'))
				
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
						
				}
       
					if ($this->request->is('post')) 
					{
					
						$chk=($this->request->data["LDG_chk"]);
						
						
						$c_balance=($this->request->data["LDG_CURRENT_BALANCE"]);
					
				
						
						$balance_date=($this->request->data["balance_date"]);
							
							$balance_start_date = explode('-', $balance_date);
							$d = $balance_start_date[0];
							$m = $balance_start_date[1];
							$y = $balance_start_date[2];
							$balance_first_date = $y.'-'.$m.'-'.$d;
							
							$balance_first_period= $y.$m;
							
							
						
				$Acc_type=($this->request->data["LDG_ACC_TYPE"]);
				
				
				
						
						$lcode='';
						$lid='';
						
						
						
							for($i=0;$i<count($chk);$i++)
							
							{
								
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
							
							
							
							$invoice=$this->request->data('balance_date');
							
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
		
					for($i=0;$i<count($lid_a);$i++)
					{
						
						$Ledgerstype = $this->Ledgers->Ledgerstype->newEntity();
						$Ledgerstype->LDG_ID=$new_id;
						$Ledgerstype->LTM_ID=$lid_a[$i];
						$this->Ledgers->Ledgerstype->save($Ledgerstype);
						   
						
					}
					
				
				
				//insert data in ledger_balance table

				
				 $leder_balance = $this->Ledgers->LedgerClosing->newEntity();
				 
				$leder_balance->LDG_BAL_PERIOD=$balance_first_period;
				$leder_balance->LDG_BAL_DATE=$balance_first_date;
				
			
				
				if($Acc_type==1)
				{
					
					
				$leder_balance->LDG_BALANCE_DR=$c_balance;
				$leder_balance->LDG_BALANCE_CR=0;
				}
				else if($Acc_type==2)
				{
					$leder_balance->LDG_BALANCE_CR=$c_balance;
					$leder_balance->LDG_BALANCE_DR=0;
				}
				
				else if($Acc_type==3)
				{
					$leder_balance->LDG_BALANCE_CR=$c_balance;
					$leder_balance->LDG_BALANCE_DR=0;
				}
				else
				{
						$leder_balance->LDG_BALANCE_CR=0;
					$leder_balance->LDG_BALANCE_DR=0;
				}
				
			
				
				
				$leder_balance->LDG_ID=$new_id;


				
					
						
			$this->Ledgers->Ledgerendbalance->save($leder_balance);
				   
		
				
        return $this->redirect(array('action' => 'index'));
            }
           $this->Flash->error(__('Unable to add the user.'));
        }
        $this->set('Ledgers', $Ledgers);
    }



		
public function edit($LDG_ID = null)
{
	
	
			$Ledgers = $this->Ledgers->newEntity();
				
						if (!$this->request->is('post'))
						
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
					 
						}
						
						
						
						
						
						$query=$this->Ledgers->find('all')
								->where(['LDG_ID' =>$LDG_ID]);
								$leger_all = $query->toArray();
								$this->set(compact('leger_all'));
								
								$balance_date=$leger_all["0"]["LDG_BALANCE_DATE"];
								
								$balance_just_date=date('d-m-Y',strtotime($balance_date));
								$this->set(compact('balance_just_date'));
						
						
			
				   
			$Ledgers = $this->Ledgers->get($LDG_ID);
			if ($this->request->is(['post', 'put'])) 
			  
			 	{
					
					
			  
								  $chk=($this->request->data["LDG_chk"]);
								  
								  
								 
								  
								  $lcode='';
								  $lid='';
								  for($i=0;$i<count($chk);$i++)
								  {
								  
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
								  
								  
								  
								  
								  
								  $invoice=$this->request->data('balance_date');
								  
								  $birthday_in = explode('-', $invoice);
								  $d = $birthday_in[0];
								  $m = $birthday_in[1];
								  $y = $birthday_in[2];
								  $invoice_date = $y.'-'.$m.'-'.$d;
								  
								  $Ledgers->LDG_BALANCE_DATE=$invoice_date;
							  
		
	
        if ($this->Ledgers->save($Ledgers))
				 {
					$this->Flash->success(__('Your article has been updated.'));
			
				
					$this->Ledgers->Ledgerstype->deleteAll(['LDG_ID' =>$LDG_ID]);
				
				
				
							$id = $Ledgers->LDG_ID;  //data call from table
							$new_id=$id;
							//insert data in another table
							
							for($i=0;$i<count($lid_a);$i++)
							{
							
							$Ledgerstype = $this->Ledgers->Ledgerstype->newEntity();
							
							$Ledgerstype->LDG_ID=$new_id;
							
							
							if($chk=='')
							{
								
								$this->set('Ledgers', $Ledgers);
								return;
								
							}
							
							else
							{
							$Ledgerstype->LTM_ID=$lid_a[$i];
							}
							$this->Ledgers->Ledgerstype->save($Ledgerstype);
							
							
							}
				
				  return $this->redirect(array('action' => 'index'));
        
            		}
            $this->Flash->error(__('Unable to add the user.'));
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