<?php
	namespace App\Controller;
	
use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Network\Exception\NotFoundException;
use Cake\ORM\TableRegistry;		
	
	
	class  OfficeExpensesController extends AppController{
		
/*		var $uses=array ('CompanyRoot', 'CompanyInfo', 'CompanyBranch');
		public $helpers = array('Html', 'Form', 'Session');
		public $components = array('Session');*/
		

		
		
		
		public function index(){
			$sdate='';
			$edate='';

			if ($this->request->is(['post','put']))
			{
				$sdate=$this->request->data['sdate'];
				$edate=$this->request->data['edate'];
				
				$sdate=DateToDB($sdate.'-','-');
				$edate=DateToDB($edate.'-','-');
				
			}


			if (($sdate=='') || ($edate==''))
			{
				$sdate=date('Y-m-').'01';
				$edate=date('Y-m-',strtotime("+1 month")).'01';	
				$date = date_create($edate);
				date_add($date, date_interval_create_from_date_string('-1 days'));
				$edate=date_format($date, 'Y-m-d');				
			}			
	$OfficeExpenses = $this->OfficeExpenses->find('all')
	->where(['VCH_TYPE' =>VCH_TYPE_EXPENSE])
	->andWhere(['VCH_DATE >=' =>$sdate])
	->andWhere(['VCH_DATE <=' =>$edate])
	->andWhere(['VCH_STATUS !=' =>STS_DELETED])
->order(['VCH_DATE' =>'DESC','VCH_ID' =>'DESC']);   
        $this->set(compact('OfficeExpenses'));
        $this->set(compact('sdate'));
		$this->set(compact('edate'));
	
   
	
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
    {
		
		$user = $this->Auth->User();
	
		$Basicdata = TableRegistry::get('Basicdata');

		$query=$Basicdata->find('list',['keyField' => ['BAS_ID'],'valueField' => 'BAS_NAME'])
		->where(['BAS_TYPE_ID' =>PROJECT_TYPE]);
	
		$project = $query->toArray();
		
		 $this->set(compact('project'));
		 

		
		$query=$Basicdata->find('list',['keyField' => ['BAS_ID'],'valueField' => 'BAS_NAME'])
		->where(['BAS_TYPE_ID' =>DEPARTMENT_TYPE]);
	
		$department = $query->toArray();

		 $this->set(compact('department'));
		 
		$query=$this->OfficeExpenses->Ledgers->find('list',['valueField' => 'LDG_NAME'])
		->where(['LDG_ACC_TYPE' =>5]);
	
		$LDG_name = $query->toArray();

		 $this->set(compact('LDG_name'));
		 
		
	$query=$this->OfficeExpenses->Ledgerstype->find('list',['valueField' => 'LDG_ID'])
		->where(['LTM_ID' =>LDG_TYPE_CASH]);
		$Ledgerstype_id = $query->toArray();

		 
		 
		 	$query=$this->OfficeExpenses->Ledgers->find('list',['keyField' => 'LDG_ID','valueField' => 'LDG_NAME'])
		->where(['LDG_ID IN'=>$Ledgerstype_id]);
	
		$cash_name = $query->toArray();

		 $this->set(compact('cash_name'));
		 
	
	

		
	
	
        $OfficeExpenses = $this->OfficeExpenses->newEntity();
        if ($this->request->is('post'))
		
		 {
			
			$amount=($this->request->data["VCH_AMOUNT"]);

			$from=ACC_CASH;
			$ldg_name=($this->request->data["VCH_DR_ACCOUNTS"]);
		
			
            $OfficeExpenses = $this->OfficeExpenses->patchEntity($OfficeExpenses, $this->request->data);
			
			
			$OfficeExpenses->VCH_AMOUNT=$this->request->data["VCH_AMOUNT"];

			$OfficeExpenses->VCH_CREATE_BY=$user['USR_ID'];
			$amount=$OfficeExpenses->VCH_AMOUNT;
			$OfficeExpenses->VCH_TYPE=VCH_TYPE_EXPENSE;
			$OfficeExpenses->VCH_STATUS=STS_CREATE;
			$OfficeExpenses->VCH_STATUS_BY=$user['USR_ID'];
			$OfficeExpenses->VCH_LAST_EDIT_BY=$user['USR_ID'];
			$OfficeExpenses->VCH_SUBMIT_BY=$user['USR_ID'];
			
			
			
			$invoice=$this->request->data('from_date');

			
				$birthday_in = explode('-', $invoice);
				$d = $birthday_in[0];
				$m = $birthday_in[1];
				$y = $birthday_in[2];
				$invoice_date = $y.'-'.$m.'-'.$d;
				
				$OfficeExpenses->VCH_DATE=$invoice_date;
		
			
			

		$new_date=$invoice;
		
			$birthday_name = explode('-', $new_date);
				$d = $birthday_name[0];
				$m = $birthday_name[1];
				$y = $birthday_name[2];
				$month = $m;	
				$year = $y;	
		
			
			
			$OfficeExpenses->VCH_MONTH=$month;
			$OfficeExpenses->VCH_YEAR=$year;
			
			
			//	$narration=$this->request->data('VCH_NARRATION');
			
			$purchase_from=ACC_CASH;
			$items=($this->request->data["VCH_DR_ACCOUNTS"]);
			
			
			$ldg = $this->OfficeExpenses->Ledgers->get($purchase_from);
			
			$purchase_from_name= $ldg->LDG_CODE;
			$purchase_from_fname= $ldg->LDG_NAME;
			
			
			
			$ldg = $this->OfficeExpenses->Ledgers->get($items);
			
			$item_name= $ldg->LDG_CODE;
			$item_fname= $ldg->LDG_NAME;
			
			
			$full_des=$purchase_from_name.'(Cr), '.$item_name.'(Dr)';
//			$OfficeExpenses->VCH_DR_ACCOUNTS=ACC_CASH;			
			$OfficeExpenses->VCH_CR_ACCOUNTS=ACC_CASH;
			$OfficeExpenses->VCH_FULL_DESCRIPTION=$full_des;
			
			$OfficeExpenses->ACC_CR_NAME=$purchase_from_fname;
			$OfficeExpenses->ACC_DR_NAME=$item_fname;
			
			
            if ($this->OfficeExpenses->save($OfficeExpenses)) {

              
				
			$project=$OfficeExpenses->VCH_PROJECT;

			$department=$OfficeExpenses->VCH_DEPARTMENT;
			
				
			$VCH_NO = $OfficeExpenses->VCH_NO_FULL; 
			$id = $OfficeExpenses->VCH_ID;  //data call from table
			$new_id=$id;
				
						
			
			$OfficeExpenses=$this->OfficeExpenses->get($id);
			$vch_Full=$OfficeExpenses->VCH_NO_FULL;


				//insert data in another table
	
				 $Voucherdtl = $this->OfficeExpenses->Voucherdtl->newEntity();
				 
				  $Voucherdtl->VCH_ID=$new_id;
				   $Voucherdtl->VDT_DATE=$invoice_date;
				    $Voucherdtl->VDT_VOUCHER_NO=$vch_Full;
					 $Voucherdtl->VDT_LOT=1;
					  $Voucherdtl->VDT_SR=1;
					  	$Voucherdtl->VDT_LDG_ID=$from;
					  	$Voucherdtl->VDT_DEBIT=0;
				   		$Voucherdtl->VDT_CREDIT=$amount;
						
						$Voucherdtl->VDT_PROJECT=$project;
		
						$Voucherdtl->VDT_DEPARTMENT=$department;

				    $this->OfficeExpenses->Voucherdtl->save($Voucherdtl);
				   
		
		

		
				 $Voucherdt2 = $this->OfficeExpenses->Voucherdtl->newEntity();
				 
				  $Voucherdt2->VCH_ID=$new_id;
				   $Voucherdt2->VDT_DATE=$invoice_date;
				    $Voucherdt2->VDT_VOUCHER_NO=$vch_Full;
					 $Voucherdt2->VDT_LOT=1;
					  $Voucherdt2->VDT_SR=2;
					  	$Voucherdt2->VDT_LDG_ID=$ldg_name;
						
					  	$Voucherdt2->VDT_DEBIT=$amount;
				   		$Voucherdt2->VDT_CREDIT=0;
										$Voucherdt2->VDT_PROJECT=$project;
		
						$Voucherdt2->VDT_DEPARTMENT=$department;

						
				    $this->OfficeExpenses->Voucherdtl->save($Voucherdt2);
				   
				
				
              if ($this->request->data["CONTINUE"]!=0)
			  {
				    $this->Flash->success(__('Voucher : '.$vch_Full.' [ Amount = '.$amount.']  has been saved.'));
				  return $this->redirect(array('action' => 'add'));
				  
			  }
			  else
			  {
				  return $this->redirect(array('action' => 'index'));
			  }
			 
            }
            $this->Flash->error(__('Unable to add the vouchers.'));
        }
        $this->set('OfficeExpenses', $OfficeExpenses);
    }



public function edit($VCH_ID=null)
    {
		
		$user = $this->Auth->User();
	
		$Basicdata = TableRegistry::get('Basicdata');

		$query=$Basicdata->find('list',['keyField' => ['BAS_ID'],'valueField' => 'BAS_NAME'])
		->where(['BAS_TYPE_ID' =>PROJECT_TYPE]);
	
		$project = $query->toArray();
		
		 $this->set(compact('project'));
		 

		
		$query=$Basicdata->find('list',['keyField' => ['BAS_ID'],'valueField' => 'BAS_NAME'])
		->where(['BAS_TYPE_ID' =>DEPARTMENT_TYPE]);
	
		$department = $query->toArray();

		 $this->set(compact('department'));
		 
		$query=$this->OfficeExpenses->Ledgers->find('list',['valueField' => 'LDG_NAME'])
		->where(['LDG_ACC_TYPE' =>5]);
	
		$LDG_name = $query->toArray();

		 $this->set(compact('LDG_name'));
		 
		
	$query=$this->OfficeExpenses->Ledgerstype->find('list',['valueField' => 'LDG_ID'])
		->where(['LTM_ID' =>LDG_TYPE_CASH]);
		$Ledgerstype_id = $query->toArray();

		 
		 
		 	$query=$this->OfficeExpenses->Ledgers->find('list',['keyField' => 'LDG_ID','valueField' => 'LDG_NAME'])
		->where(['LDG_ID IN'=>$Ledgerstype_id]);
	
		$cash_name = $query->toArray();

		 $this->set(compact('cash_name'));
		 
	
	

		
	
	
      				$OfficeExpenses = $this->OfficeExpenses->get($VCH_ID);
				
				$da=date('d-m-Y',strtotime($OfficeExpenses->VCH_DATE));
				
		$this->set('from_date',$da);
    if ($this->request->is(['post', 'put'])) 
		 {
			
			$amount=($this->request->data["VCH_AMOUNT"]);
			$from=ACC_CASH;
			$ldg_name=($this->request->data["VCH_DR_ACCOUNTS"]);
		
			
            $OfficeExpenses = $this->OfficeExpenses->patchEntity($OfficeExpenses, $this->request->data);
			
			
			
			


			

			$OfficeExpenses->VCH_STATUS=STS_EDIT;
			$OfficeExpenses->VCH_STATUS_BY=$user['USR_ID'];
			$OfficeExpenses->VCH_LAST_EDIT_BY=$user['USR_ID'];

			
			
			
			$invoice=$this->request->data('from_date');

			
				$birthday_in = explode('-', $invoice);
				$d = $birthday_in[0];
				$m = $birthday_in[1];
				$y = $birthday_in[2];
				$invoice_date = $y.'-'.$m.'-'.$d;
				
				$OfficeExpenses->VCH_DATE=$invoice_date;
		
			
				$OfficeExpenses->VCH_MONTH=$m;
				$OfficeExpenses->VCH_YEAR=$y;


			
			//	$narration=$this->request->data('VCH_NARRATION');
			
			$purchase_from=ACC_CASH;
			$items=($this->request->data["VCH_DR_ACCOUNTS"]);
			
			
			$ldg = $this->OfficeExpenses->Ledgers->get($purchase_from);
			
			$purchase_from_name= $ldg->LDG_CODE;
			$purchase_from_fname= $ldg->LDG_NAME;			
			
			$ldg = $this->OfficeExpenses->Ledgers->get($items);
			
			$item_name= $ldg->LDG_CODE;
			$item_fname= $ldg->LDG_NAME;
			
			
			$full_des=$purchase_from_name.'(Cr), '.$item_name.'(Dr)';
			
			$OfficeExpenses->VCH_CR_ACCOUNTS=ACC_CASH;
			$OfficeExpenses->VCH_FULL_DESCRIPTION=$full_des;
			
			
			$OfficeExpenses->ACC_CR_NAME=$purchase_from_fname;
			$OfficeExpenses->ACC_DR_NAME=$item_fname;

			
            if ($this->OfficeExpenses->save($OfficeExpenses)) {
                $this->Flash->success(__('The vouchers has been saved.'));
				

				$id = $OfficeExpenses->VCH_ID;  //data call from table
				$new_id=$id;
				
				$OfficeExpenses=$this->OfficeExpenses->get($new_id);
				$project=$OfficeExpenses->VCH_PROJECT;

			$department=$OfficeExpenses->VCH_DEPARTMENT;
				
				
				$VCH_NO = $OfficeExpenses->VCH_NO_FULL; 
				
			
				
				//insert data in another table

				$this->OfficeExpenses->Voucherdtl->deleteAll(['VCH_ID' =>$VCH_ID]);
				 $Voucherdtl = $this->OfficeExpenses->Voucherdtl->newEntity();
				 
				  $Voucherdtl->VCH_ID=$VCH_ID;
				   $Voucherdtl->VDT_DATE=$invoice_date;
				    $Voucherdtl->VDT_VOUCHER_NO=$VCH_NO;
					 $Voucherdtl->VDT_LOT=1;
					  $Voucherdtl->VDT_SR=1;
					  	$Voucherdtl->VDT_LDG_ID=$from;
					  	$Voucherdtl->VDT_DEBIT=0;
				   		$Voucherdtl->VDT_CREDIT=$amount;
						
						$Voucherdtl->VDT_PROJECT=$project;
		
						$Voucherdtl->VDT_DEPARTMENT=$department;

				    $this->OfficeExpenses->Voucherdtl->save($Voucherdtl);
				   
		
		
		
		
				 $Voucherdt2 = $this->OfficeExpenses->Voucherdtl->newEntity();
				 
				  $Voucherdt2->VCH_ID=$VCH_ID;
				   $Voucherdt2->VDT_DATE=$invoice_date;
				    $Voucherdt2->VDT_VOUCHER_NO=$VCH_NO;
					 $Voucherdt2->VDT_LOT=1;
					  $Voucherdt2->VDT_SR=2;
					  	$Voucherdt2->VDT_LDG_ID=$ldg_name;
						
					  	$Voucherdt2->VDT_DEBIT=$amount;
				   		$Voucherdt2->VDT_CREDIT=0;
										$Voucherdt2->VDT_PROJECT=$project;
		
						$Voucherdt2->VDT_DEPARTMENT=$department;

						
				    $this->OfficeExpenses->Voucherdtl->save($Voucherdt2);
				   
				
				
              
		 return $this->redirect(array('action' => 'index'));
			 
            }
            $this->Flash->error(__('Unable to add the vouchers.'));
        }
        $this->set('OfficeExpenses', $OfficeExpenses);
    }

		
		
		
/*		
public function edit($VCH_ID = null)
{
	
			
		$user = $this->Auth->User();
	
		$query=$this->OfficeExpenses->Ledgers->find('list',['valueField' => 'LDG_NAME'])
		->where(['LDG_ACC_TYPE' =>5]);
	
		$LDG_name = $query->toArray();

		 $this->set(compact('LDG_name'));
		 
		
	$query=$this->OfficeExpenses->Ledgerstype->find('list',['valueField' => 'LDG_ID'])
		->where(['LTM_ID' =>1]);
		$Ledgerstype_id = $query->toArray();

		 
		 
		 	$query=$this->OfficeExpenses->Ledgers->find('list',['keyField' => 'LDG_ID','valueField' => 'LDG_NAME'])
		->where(['LDG_ID IN'=>$Ledgerstype_id]);
	
		$cash_name = $query->toArray();

		 $this->set(compact('cash_name'));
		 
	
	
					
					$date2=20;

					
				$OfficeExpenses = $this->OfficeExpenses->get($VCH_ID);
				
				$da=$OfficeExpenses->VCH_DATE;
				

    if ($this->request->is(['post', 'put'])) 
	
	{
		
		
			$amount=($this->request->data["VCH_AMOUNT"]);
			$from=($this->request->data["VCH_CR_ACCOUNTS"]);
			$ldg_name=($this->request->data["VCH_DR_ACCOUNTS"]);
		
         
				  
				  
				  $OfficeExpenses = $this->OfficeExpenses->patchEntity($OfficeExpenses, $this->request->data);
				  
				  
				  


			

			$OfficeExpenses->VCH_STATUS=14;

			$OfficeExpenses->VCH_LAST_EDIT_BY=$user['USR_ID'];

			
			$OfficeExpenses->VCH_PROJECT=5;	
			$OfficeExpenses->VCH_DEPARTMENT=5;
			
			
			$invoice=$this->request->data('from_date');

			
				$birthday_in = explode('-', $invoice);
				$d = $birthday_in[0];
				$m = $birthday_in[1];
				$y = $birthday_in[2];
				$invoice_date = $y.'-'.$m.'-'.$d;
				
				$OfficeExpenses->VCH_DATE=$invoice_date;
		
			
			

		$new_date=$invoice;
		
			$birthday_name = explode('-', $new_date);
				$d = $birthday_name[0];
				$m = $birthday_name[1];
				$y = $birthday_name[2];
				$month = $m;	
			
			
			
			
			$birthday_year = explode('-', $new_date);
				$d = $birthday_year[0];
				$m = $birthday_year[1];
				$y = $birthday_year[2];
				$year = $y;	
		
			
			
			$OfficeExpenses->VCH_MONTH=$month;
			$OfficeExpenses->VCH_YEAR=$year;
			
			
			
			
				  
				  // saaving purchase data
				  
				  if ($this->OfficeExpenses->save($OfficeExpenses)) 
				  
				  {
				  $this->Flash->success(__('Your article has been updated.'));
				  }
				  
				  
				  // getting voucher detqail data from voucher detail table with vch id from purchase  selection
				  
				  
				  /* first delete  then insert to detail table*/
			
	/*		if ($this->OfficeExpenses->Voucherdtl->deleteAll(['VCH_ID' =>$VCH_ID]))
				
				{
						
								
				$VCH_NO = $OfficeExpenses->VCH_NO_FULL; 
				$id = $OfficeExpenses->VCH_ID;  //data call from table
				$new_id=$id;
				
			
				
				//insert data in another table

				
				 $Voucherdtl = $this->OfficeExpenses->Voucherdtl->newEntity();
				 
				  $Voucherdtl->VCH_ID=$new_id;
				   $Voucherdtl->VDT_DATE=$invoice_date;
				    $Voucherdtl->VDT_VOUCHER_NO=$VCH_NO;
					 $Voucherdtl->VDT_LOT=1;
					  $Voucherdtl->VDT_SR=1;
					  	$Voucherdtl->VDT_LDG_ID=$from;
					  	$Voucherdtl->VDT_DEBIT=0;
				   		$Voucherdtl->VDT_CREDIT=$amount;
						
				    $this->OfficeExpenses->Voucherdtl->save($Voucherdtl);
				   
		
		
		
		
				 $Voucherdt2 = $this->OfficeExpenses->Voucherdtl->newEntity();
				 
				  $Voucherdt2->VCH_ID=$new_id;
				   $Voucherdt2->VDT_DATE=$invoice_date;
				    $Voucherdt2->VDT_VOUCHER_NO=$VCH_NO;
					 $Voucherdt2->VDT_LOT=1;
					  $Voucherdt2->VDT_SR=2;
					  	$Voucherdt2->VDT_LDG_ID=$ldg_name;
						
					  	$Voucherdt2->VDT_DEBIT=$amount;
				   		$Voucherdt2->VDT_CREDIT=0;
						
				    $this->OfficeExpenses->Voucherdtl->save($Voucherdt2);
				   
			
			
			return $this->redirect(['action' => 'index']);
					}
	}

		
			$this->Flash->error(__('Unable to update your article.'));
  
    $this->set('OfficeExpenses', $OfficeExpenses);
}

	*/
		
		
public function delete($VCH_ID = null)
{
	
	
		$user = $this->Auth->User();	
    $OfficeExpenses = $this->OfficeExpenses->get($VCH_ID);
    if ($this->request->is(['post', 'put'])) {
		

		
		
        $this->OfficeExpenses->patchEntity($OfficeExpenses, $this->request->data);
		
		$OfficeExpenses->VCH_STATUS=STS_DELETED;
			$OfficeExpenses->VCH_STATUS_DATE=date('Y-m-d');
			$OfficeExpenses->VCH_STATUS_BY=$user['USR_ID'];
        if ($this->OfficeExpenses->save($OfficeExpenses)) {
            $this->Flash->success(__('Your article has been updated.'));
            return $this->redirect(['action' => 'index']);
        }
        $this->Flash->error(__('Unable to update your article.'));
    }

    $this->set('OfficeExpenses', $OfficeExpenses);
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
