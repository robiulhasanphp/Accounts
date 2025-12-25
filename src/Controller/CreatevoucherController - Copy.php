<?php
	namespace App\Controller;
	
use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Network\Exception\NotFoundException;
use Cake\ORM\TableRegistry;	
	
	
	class  CreatevoucherController extends AppController{
		
/*		var $uses=array ('CompanyRoot', 'CompanyInfo', 'CompanyBranch');
		public $helpers = array('Html', 'Form', 'Session');
		public $components = array('Session');*/
		
		public function index(){
			
	$Createvoucher = $this->Createvoucher->find('all')->contain('Project')->contain('Department');
        $this->set(compact('Createvoucher'));
	
   
	
		}
		
		
		
	 
		
		
		
	  public function add()
    {
	
		$user = $this->Auth->User();
		
	$Basicdata = TableRegistry::get('Basicdata');

		$query=$Basicdata->find('list',['keyField' => ['BAS_ID'],'valueField' => 'BAS_NAME'])
		->where(['BAS_TYPE_ID' =>5]);
		$project = $query->toArray();
		 $this->set(compact('project'));
		 

		
		$query=$Basicdata->find('list',['keyField' => ['BAS_ID'],'valueField' => 'BAS_NAME'])
		->where(['BAS_TYPE_ID' =>4]);
		$department = $query->toArray();
		 $this->set(compact('department'));
		
		
		
		
			$query=$this->Createvoucher->Ledgers->find('list',['keyField' => 'LDG_ID','valueField' => 'LDG_NAME']);
		    $LDG_name = $query->toArray();
		    $this->set(compact('LDG_name'));

		 

			$query = $this->Createvoucher->find();
			$query->select(['max' => $query->func()->max('VCH_ID')]);

			$m_id=$query->toArray();
			$a=$m_id[0]['max'];
			$b=((int)$a)+1;

		
	
	
        $Createvoucher = $this->Createvoucher->newEntity();
        if ($this->request->is('post')) {
			
			
			
				$project=($this->request->data["VCH_PROJECT"]);
			$department=($this->request->data["VCH_DEPARTMENT"]);
			
		
			$debit_amount=($this->request->data["debit_amount"]);
			$credit_amount=($this->request->data["credit_amount"]);
			
			$debit_amount_2=($this->request->data["debit_amount_2"]);
			$credit_amount_2=($this->request->data["credit_amount_2"]);
			
			$add_1=$debit_amount+$debit_amount_2;
	
			
			$add_2=$credit_amount+$credit_amount_2;
			
		if($add_1!=$add_2)
		{
		
		echo "debit & credit balance is not equal,Please Correct your data";
		exit;
			
		}
		
	
			$VCH_NARRATION_1=($this->request->data["VCH_NARRATION_1"]);
			$VCH_NARRATION_2=($this->request->data["VCH_NARRATION_2"]);
			
			
			$Sales_from=($this->request->data["VCH_CR_ACCOUNTS"]);
			$items=($this->request->data["VCH_DR_ACCOUNTS"]);
			
			
			$ldg = $this->Createvoucher->Ledgers->get($Sales_from);
			
			$Sales_from_name= $ldg->LDG_NAME;
			
			$ldg = $this->Createvoucher->Ledgers->get($items);
			
			$item_name= $ldg->LDG_NAME;
			
            $Createvoucher = $this->Createvoucher->patchEntity($Createvoucher, $this->request->data);
			
			
			
			
			$Createvoucher->VCH_STATUS=0;
			$Createvoucher->VCH_CREATE_BY=$user['USR_ID'];
			
			$Createvoucher->VCH_TYPE=7;
			$Createvoucher->VCH_STATUS=13;
			$Createvoucher->VCH_STATUS_BY=$user['USR_ID'];
			$Createvoucher->VCH_LAST_EDIT_BY=$user['USR_ID'];
			$Createvoucher->VCH_SUBMIT_BY=$user['USR_ID'];
				
			$narration=$this->request->data('VCH_NARRATION');
			
			
			$full_des=$Sales_from_name.','.$item_name.','.$narration;
			
			$Createvoucher->VCH_FULL_DESCRIPTION=$full_des;
			
		
			
			$date=$this->request->data('pdate');
				$date_1 = explode('-', $date);
				$d = $date_1[0];
				$m = $date_1[1];
				$y = $date_1[2];
				$vch_date = $y.'-'.$m.'-'.$d;
				
			$Createvoucher->VCH_DATE=$vch_date;
		
		
				$month = $m;	
			
		
				$year = $d;	
		
			
			
			$Createvoucher->VCH_MONTH=$month;
			$Createvoucher->VCH_YEAR=$year;
			
			
				$vch_Full=$year.$month.'0000'.$b;
			
			$Createvoucher->VCH_NO_FULL=$vch_Full;
			
								if($debit_amount>0)
										{
											$Createvoucher->VCH_AMOUNT=$debit_amount;
											
										}
									
								else
										
										{
										$Createvoucher->VCH_AMOUNT=$credit_amount;
										}
			
			
			
            if ($this->Createvoucher->save($Createvoucher)) {
                $this->Flash->success(__('The vouchers has been saved.'));
				
				
				
				
				$VCH_NO = $Createvoucher->VCH_NO_FULL; 
				$id = $Createvoucher->VCH_ID;  //data call from table
				$new_id=$id;
				
			
				
				//insert data in another table

				
				 $Voucherdtl = $this->Createvoucher->Voucherdtl->newEntity();
				  $Voucherdtl->VCH_ID=$new_id;
				   $Voucherdtl->VDT_DATE=$vch_date;
				    $Voucherdtl->VDT_VOUCHER_NO=$VCH_NO;
					 $Voucherdtl->VDT_LOT=1;
					  $Voucherdtl->VDT_SR=1;
					    $Voucherdtl->VDT_LDG_ID=$Sales_from;
					     $Voucherdtl->VDT_DESCRIPTION=$VCH_NARRATION_1;
						   $Voucherdtl->VDT_PROJECT=$project;
					     $Voucherdtl->VDT_DEPARTMENT=$department;
					  
							
								if($debit_amount>0)
										{
											$Voucherdtl->VDT_DEBIT=$debit_amount;
											$Voucherdtl->VDT_CREDIT=0;
										}
									
								else
										
										{
										$Voucherdtl->VDT_DEBIT=0;
										$Voucherdtl->VDT_CREDIT=$credit_amount;
										}
						
				    $this->Createvoucher->Voucherdtl->save($Voucherdtl);
				   
		
		
				 $Voucherdt2 = $this->Createvoucher->Voucherdtl->newEntity();
				 
				  $Voucherdt2->VCH_ID=$new_id;
				   $Voucherdt2->VDT_DATE=$vch_date;
				    $Voucherdt2->VDT_VOUCHER_NO=$VCH_NO;
					 $Voucherdt2->VDT_LOT=1;
					  $Voucherdt2->VDT_SR=2;
					  	$Voucherdt2->VDT_LDG_ID=$items;
						$Voucherdt2->VDT_DESCRIPTION=$VCH_NARRATION_2;
						
						$Voucherdt2->VDT_PROJECT=$project;
						$Voucherdt2->VDT_DEPARTMENT=$department;
						
						
					  	if($debit_amount_2>0)
						{
						
					  	$Voucherdt2->VDT_DEBIT=$debit_amount_2;
				   		$Voucherdt2->VDT_CREDIT=0;
						}
						
						else
						{
						
					  	$Voucherdt2->VDT_DEBIT=0;
				   		$Voucherdt2->VDT_CREDIT=$credit_amount_2;
						}
						
						
				    $this->Createvoucher->Voucherdtl->save($Voucherdt2);
	 
	 				return $this->redirect(array('action' => 'index'));
			 
            }
            $this->Flash->error(__('Unable to add the vouchers.'));
        }
        $this->set('Createvoucher', $Createvoucher);
    }


		
		
		
		
public function edit($VCH_ID = null)
{
	
			
				$user = $this->Auth->User();
		
	$Basicdata = TableRegistry::get('Basicdata');

		$query=$Basicdata->find('list',['keyField' => ['BAS_ID'],'valueField' => 'BAS_NAME'])
		->where(['BAS_TYPE_ID' =>5]);
		$project = $query->toArray();
		 $this->set(compact('project'));
		 

		
		$query=$Basicdata->find('list',['keyField' => ['BAS_ID'],'valueField' => 'BAS_NAME'])
		->where(['BAS_TYPE_ID' =>4]);
		$department = $query->toArray();
		 $this->set(compact('department'));
		
		
		
		
			$query=$this->Createvoucher->Ledgers->find('list',['keyField' => 'LDG_ID','valueField' => 'LDG_NAME']);
		    $LDG_name = $query->toArray();
		    $this->set(compact('LDG_name'));

		 

			$query = $this->Createvoucher->find();
			$query->select(['max' => $query->func()->max('VCH_ID')]);

			$m_id=$query->toArray();
			$a=$m_id[0]['max'];
			$b=((int)$a)+1;

		
					
			/*	$Sales = $this->Sales->get($VCH_ID);
				
				$da=$Sales->VCH_DATE;
				*/

    if ($this->request->is(['post', 'put'])) 
	
	{
		
		
			
				$project=($this->request->data["VCH_PROJECT"]);
			$department=($this->request->data["VCH_DEPARTMENT"]);
			
		
			$debit_amount=($this->request->data["debit_amount"]);
			$credit_amount=($this->request->data["credit_amount"]);
			
			$debit_amount_2=($this->request->data["debit_amount_2"]);
			$credit_amount_2=($this->request->data["credit_amount_2"]);
			
			$add_1=$debit_amount+$debit_amount_2;
	
			
			$add_2=$credit_amount+$credit_amount_2;
			
		if($add_1!=$add_2)
		{
		
		echo "debit & credit balance is not equal,Please Correct your data";
		exit;
			
		}
		
	
			$VCH_NARRATION_1=($this->request->data["VCH_NARRATION_1"]);
			$VCH_NARRATION_2=($this->request->data["VCH_NARRATION_2"]);
			
			
			$Sales_from=($this->request->data["VCH_CR_ACCOUNTS"]);
			$items=($this->request->data["VCH_DR_ACCOUNTS"]);
			
			
			$ldg = $this->Createvoucher->Ledgers->get($Sales_from);
			
			$Sales_from_name= $ldg->LDG_NAME;
			
			$ldg = $this->Createvoucher->Ledgers->get($items);
			
			$item_name= $ldg->LDG_NAME;
			
            $Createvoucher = $this->Createvoucher->patchEntity($Createvoucher, $this->request->data);
			
			
			
			
			$Createvoucher->VCH_STATUS=0;
			$Createvoucher->VCH_CREATE_BY=$user['USR_ID'];
			
			$Createvoucher->VCH_TYPE=7;
			$Createvoucher->VCH_STATUS=13;
			$Createvoucher->VCH_STATUS_BY=$user['USR_ID'];
			$Createvoucher->VCH_LAST_EDIT_BY=$user['USR_ID'];
			$Createvoucher->VCH_SUBMIT_BY=$user['USR_ID'];
				
			$narration=$this->request->data('VCH_NARRATION');
			
			
			$full_des=$Sales_from_name.','.$item_name.','.$narration;
			
			$Createvoucher->VCH_FULL_DESCRIPTION=$full_des;
			
		
			
			$date=$this->request->data('pdate');
				$date_1 = explode('-', $date);
				$d = $date_1[0];
				$m = $date_1[1];
				$y = $date_1[2];
				$vch_date = $y.'-'.$m.'-'.$d;
				
			$Createvoucher->VCH_DATE=$vch_date;
	
				$month = $m;	
			
				$year = $d;	
		
			
			
			$Createvoucher->VCH_MONTH=$month;
			$Createvoucher->VCH_YEAR=$year;
			
			
				$vch_Full=$year.$month.'0000'.$b;
			
			$Createvoucher->VCH_NO_FULL=$vch_Full;
			
								if($debit_amount>0)
										{
											$Createvoucher->VCH_AMOUNT=$debit_amount;
											
										}
									
								else
										
										{
										$Createvoucher->VCH_AMOUNT=$credit_amount;
										}
				  
				  // saaving purchase data
				  
				  if ($this->Sales->save($Createvoucher)) 
				  
				  {
				  $this->Flash->success(__('Your article has been updated.'));
				  }
				  
				  
				  // getting voucher detqail data from voucher detail table with vch id from purchase  selection
				  
				  
				  /* first delete  then insert to detail table*/
			
			if ($this->Sales->Voucherdtl->deleteAll(['VCH_ID' =>$VCH_ID]))
				
				{
						
								
								
								
								$VCH_NO = $Sales->VCH_NO_FULL; 
								$id = $Sales->VCH_ID;  //data call from table
								$new_id=$id;
								//insert data in another table
								
								
								$Voucherdtl = $this->Sales->Voucherdtl->newEntity();
								
								$Voucherdtl->VCH_ID=$new_id;
								$Voucherdtl->VDT_DATE=$birthday;
								$Voucherdtl->VDT_VOUCHER_NO=$VCH_NO;
								$Voucherdtl->VDT_LOT=1;
								$Voucherdtl->VDT_SR=1;
								$Voucherdtl->VDT_LDG_ID=$Sales_from;
								$Voucherdtl->VDT_DEBIT=0;
								$Voucherdtl->VDT_CREDIT=$amount;
								$this->Sales->Voucherdtl->save($Voucherdtl);
								
								
								
								
								
								$Voucherdt2 = $this->Sales->Voucherdtl->newEntity();
								$Voucherdt2->VCH_ID=$new_id;
								$Voucherdt2->VDT_DATE=$birthday;
								$Voucherdt2->VDT_VOUCHER_NO=$VCH_NO;
								$Voucherdt2->VDT_LOT=1;
								$Voucherdt2->VDT_SR=2;
								$Voucherdt2->VDT_LDG_ID=$items;
								
								$Voucherdt2->VDT_DEBIT=$amount;
								$Voucherdt2->VDT_CREDIT=0;
								
								$this->Sales->Voucherdtl->save($Voucherdt2);
					
			
			
			return $this->redirect(['action' => 'index']);
					}
	}

		
			$this->Flash->error(__('Unable to update your article.'));
  
    $this->set('Sales', $Sales);
}

	
	
		
public function delete($VCH_ID = null)
{
	
	
	
    $Sales = $this->Sales->get($VCH_ID);
    if ($this->request->is(['post', 'put'])) {
		
		$delete=($this->request->data["VCH_NARRATION"]);
		
		
        $this->Sales->patchEntity($Sales, $this->request->data);
		
		$Sales->VCH_STATUS=18;
		$Sales->VCH_STATUS_DESC=$delete;
		
        if ($this->Sales->save($Sales)) {
            $this->Flash->success(__('Your article has been updated.'));
            return $this->redirect(['action' => 'index']);
        }
        $this->Flash->error(__('Unable to update your article.'));
    }

    $this->set('Sales', $Sales);
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