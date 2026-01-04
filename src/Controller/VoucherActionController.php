<?php
	namespace App\Controller;
	
use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Network\Exception\NotFoundException;
use Cake\ORM\TableRegistry;	
	
	
	class  VoucherActionController extends AppController{
				
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
			
			
				$VoucherAction = $this->VoucherAction->find('all')->contain('Users')
				->where(['VCH_DATE >=' =>$sdate])
				->andWhere(['VCH_DATE <=' =>$edate])
				->andWhere(['VCH_STATUS !=' =>STS_DELETED])
				->order(['VCH_DATE' =>'DESC','VCH_ID' =>'DESC']);
				
				$this->set(compact('VoucherAction'));
				$this->set(compact('sdate'));
				$this->set(compact('edate'));	
   //echo "<pre>";
				//var_dump($VoucherAction);
		}
		
		
		
	  public function view($VCH_ID)
    {
        if (!$VCH_ID) 
		{
            throw new NotFoundException(__('Invalid user'));
        }

        $VoucherAction = $this->VoucherAction->get($VCH_ID);
        $this->set(compact('VoucherAction'));
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
			
			
			
			$Ledgerstype = TableRegistry::get('Ledgerstype');
			
			
			/*		$query=$Ledgerstype->find('list',['keyField' =>['LDG_ID'],'valueField' => 'LDG_ID']);
			
			->where(['LTM_ID' =>4])
			->orWhere(['LTM_ID' =>6])
			->orWhere(['LTM_ID' =>7])
			->orWhere(['LTM_ID' =>2]);
			
			$pur=$query->toArray();
			$this->set(compact('pur'));*/
			
			
			$query=$this->VoucherAction->Ledgers->find('list',['keyField' => ['LDG_ID'],'valueField' => 'LDG_NAME'])
			->order(['LDG_NAME'=>'ASC']);
			//		->where(['LDG_ID IN ' =>$pur]);
			$VoucherAction_t = $query->toArray();
			$this->set(compact('VoucherAction_t'));
			
			
			
			
			$query=$Ledgerstype->find('list',['keyField' => 'LDG_ID','valueField' => 'LDG_ID'])
			->where(['LTM_ID' =>LDG_TYPE_INVENTORY]);
			$itm=$query->toArray();
			
			
			$query=$this->VoucherAction->Ledgers->find('list',['keyField' => 'LDG_ID','valueField' => 'LDG_NAME'])
			->where(['LDG_TYPES like ' =>'%INV%'])
			->order(['LDG_NAME'=>'ASC']);

			
			$item = $query->toArray();
			
			$this->set(compact('item'));
			
			
		
	
	
        $VoucherAction = $this->VoucherAction->newEntity();
        if ($this->request->is('post')) {
			
			
		
			$amount=($this->request->data["VCH_AMOUNT"]);
			$VoucherAction_from=($this->request->data["VCH_CR_ACCOUNTS"]);
			$items=($this->request->data["VCH_DR_ACCOUNTS"]);
			
			
			$ldg = $this->VoucherAction->Ledgers->get($VoucherAction_from);
			
			$VoucherAction_from_name= $ldg->LDG_CODE;
			
			$ldg = $this->VoucherAction->Ledgers->get($items);
			
			$item_name= $ldg->LDG_CODE;
			
            $VoucherAction = $this->VoucherAction->patchEntity($VoucherAction, $this->request->data);
			
			
			
			$full_des=$VoucherAction_from_name.'(Cr), '.$item_name.'(Dr)';

			$VoucherAction->VCH_FULL_DESCRIPTION=$full_des;
			
			$VoucherAction->VCH_STATUS=STS_CREATE;
			$VoucherAction->VCH_CREATE_BY=$user['USR_ID'];
			
			$VoucherAction->VCH_TYPE=VCH_TYPE_VoucherAction;

			$VoucherAction->VCH_STATUS_BY=$user['USR_ID'];
			$VoucherAction->VCH_LAST_EDIT_BY=$user['USR_ID'];
			$VoucherAction->VCH_SUBMIT_BY=$user['USR_ID'];
				
			
			
			$invoice=$this->request->data('INVDATE');

			if ($invoice<>"")
			{
				
				$invoice_date = $invoice;//$this->request->data('INVDATE');
				$VoucherAction->VCH_INV_DATE = DateToDB($invoice_date.'-','-');
			}
			
			$chalan=$this->request->data('CHALLANDATE');
			
			if ($chalan<>"")
			{
				$chalan_date = $chalan;//$this->request->data('INVDATE');
				$VoucherAction->VCH_CHALLAN_DATE = DateToDB($chalan_date.'-','-');			

			}
			
			$date=$this->request->data('pay_date');
			$pay_date='';
			if ($date<>"")
			{
			
			
				$date_sep = explode('-', $date);
				$d = $date_sep[0];
				$m = $date_sep[1];
				$y = $date_sep[2];
				$pay_date = $y.'-'.$m.'-'.$d;
				
				$VoucherAction->VCH_DATE=$pay_date;
				$VoucherAction->VCH_MONTH=$m;
				$VoucherAction->VCH_YEAR=$y;
			}
			else
			{
				   $this->Flash->success(__('Please Specify VoucherAction Date'));
				     $this->set('VoucherAction', $VoucherAction);
				   return;
			}

			$project=$VoucherAction->VCH_PROJECT;
			$department=$VoucherAction->VCH_DEPARTMENT;
			$VoucherAction->VDT_VOUCHER_NO='';
			
            if ($this->VoucherAction->save($VoucherAction)) {

				
				 
				$new_id=$VoucherAction->VCH_ID;
				$VoucherAction=$this->VoucherAction->get($new_id);
					$year=$VoucherAction->VCH_YEAR;
					$month=$VoucherAction->VCH_MONTH;
					$vch_Full=$VoucherAction->VCH_NO_FULL;

				
				
				//insert data in another table


				 $Voucherdtl = $this->VoucherAction->Voucherdtl->newEntity();
				 
				$Voucherdtl->VCH_ID=$new_id;
				$Voucherdtl->VDT_DATE=$pay_date;
				$Voucherdtl->VDT_VOUCHER_NO=$vch_Full;
				$Voucherdtl->VDT_LOT=1;
				$Voucherdtl->VDT_SR=1;
				$Voucherdtl->VDT_LDG_ID=$VoucherAction_from;
				$Voucherdtl->VDT_DEBIT=0;
				$Voucherdtl->VDT_CREDIT=$amount;
//echo $project;
				$Voucherdtl->VDT_PROJECT=$project;
			//	echo $department;
				$Voucherdtl->VDT_DEPARTMENT=$department;

						
			$this->VoucherAction->Voucherdtl->save($Voucherdtl);
				   
		
		
		
		
				 $Voucherdt2 = $this->VoucherAction->Voucherdtl->newEntity();
				 
				  $Voucherdt2->VCH_ID=$new_id;
				   $Voucherdt2->VDT_DATE=$pay_date;
				    $Voucherdt2->VDT_VOUCHER_NO=$vch_Full;
					 $Voucherdt2->VDT_LOT=1;
					  $Voucherdt2->VDT_SR=2;
					  	$Voucherdt2->VDT_LDG_ID=$items;
					  	$Voucherdt2->VDT_DEBIT=$amount;
				   		$Voucherdt2->VDT_CREDIT=0;
						$Voucherdt2->VDT_PROJECT=$project;
						$Voucherdt2->VDT_DEPARTMENT=$department;
						
				    $this->VoucherAction->Voucherdtl->save($Voucherdt2);
				   
				
				
              
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
        $this->set('VoucherAction', $VoucherAction);
    }


		
		
		
		

public function edit($VCH_ID = null)
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
			
			
			
			$Ledgerstype = TableRegistry::get('Ledgerstype');
			
			
			/*		$query=$Ledgerstype->find('list',['keyField' =>['LDG_ID'],'valueField' => 'LDG_ID']);
			
			->where(['LTM_ID' =>4])
			->orWhere(['LTM_ID' =>6])
			->orWhere(['LTM_ID' =>7])
			->orWhere(['LTM_ID' =>2]);
			
			$pur=$query->toArray();
			$this->set(compact('pur'));*/
			
			
			$query=$this->VoucherAction->Ledgers->find('list',['keyField' => ['LDG_ID'],'valueField' => 'LDG_NAME']);
			//		->where(['LDG_ID IN ' =>$pur]);
			$VoucherAction_t = $query->toArray();
			$this->set(compact('VoucherAction_t'));
			
			
			
			
			
			
			$query=$this->VoucherAction->Ledgers->find('list',['keyField' => 'LDG_ID','valueField' => 'LDG_NAME'])
	->where(['LDG_TYPES like ' =>'%INV%'])
			->order(['LDG_NAME'=>'ASC']);
			
			$item = $query->toArray();
			
			$this->set(compact('item'));
			
			
			
			$VoucherAction = $this->VoucherAction->get($VCH_ID);
			//				echo $VoucherAction->VCH_DATE;
			$VoucherAction->pdate=date('d-m-Y',strtotime($VoucherAction->VCH_DATE));
			
			$VoucherAction->INVDATE=validateDate($VoucherAction->VCH_INV_DATE);
			
			$VoucherAction->CHALLANDATE=validateDate($VoucherAction->VCH_CHALLAN_DATE);


			
				
				$VoucherAction->pay_date=validateDate($VoucherAction->VCH_DATE);;


        if ($this->request->is(['post','put'])) {
			
			
		
			$amount=($this->request->data["VCH_AMOUNT"]);
			$VoucherAction_from=($this->request->data["VCH_CR_ACCOUNTS"]);
			$items=($this->request->data["VCH_DR_ACCOUNTS"]);
			
			
			$ldg = $this->VoucherAction->Ledgers->get($VoucherAction_from);
			
			$VoucherAction_from_name= $ldg->LDG_CODE;
			
			$ldg = $this->VoucherAction->Ledgers->get($items);
			
			$item_name= $ldg->LDG_CODE;
			
            $VoucherAction = $this->VoucherAction->patchEntity($VoucherAction, $this->request->data);
			
			
			
			$full_des=$VoucherAction_from_name.'(Cr), '.$item_name.'(Dr)';

			$VoucherAction->VCH_FULL_DESCRIPTION=$full_des;
			
			$VoucherAction->VCH_STATUS=STS_EDIT;
			
			
		
			$VoucherAction->VCH_STATUS_BY=$user['USR_ID'];
			$VoucherAction->VCH_LAST_EDIT_BY=$user['USR_ID'];
	
				
			
			
			$invoice=$this->request->data('INVDATE');

			if ($invoice<>"")
			{
				
				$invoice_date = $invoice;//$this->request->data('INVDATE');
				$VoucherAction->VCH_INV_DATE = DateToDB($invoice_date.'-','-');
			}
			
			$chalan=$this->request->data('CHALLANDATE');
			
			if ($chalan<>"")
			{
				$chalan_date = $chalan;//$this->request->data('INVDATE');
				$VoucherAction->VCH_CHALLAN_DATE = DateToDB($chalan_date.'-','-');			

			}
			
			$date=$this->request->data('pay_date');
			$pay_date='';
			if ($date<>"")
			{
			
			
				$date_sep = explode('-', $date);
				$d = $date_sep[0];
				$m = $date_sep[1];
				$y = $date_sep[2];
				$pay_date = $y.'-'.$m.'-'.$d;
				
				$VoucherAction->VCH_DATE=$pay_date;
				$VoucherAction->VCH_MONTH=$m;
				$VoucherAction->VCH_YEAR=$y;
			}
			else
			{
				   $this->Flash->success(__('Please Specify VoucherAction Date'));
				     $this->set('VoucherAction', $VoucherAction);
				   return;
			}

			$project=$VoucherAction->VCH_PROJECT;

			$department=$VoucherAction->VCH_DEPARTMENT;
			
		
				
			
			
			

			
			
            if ($this->VoucherAction->save($VoucherAction,['validate' => false, 'associated' => false])) {
				
				
					if ($this->VoucherAction->Voucherdtl->deleteAll(['VCH_ID' =>$VCH_ID])){
						
									$VCH_NO = $VoucherAction->VCH_NO_FULL; 
									$new_id= $VoucherAction->VCH_ID;  //data call from table

				//insert data in another table

				
				 $Voucherdtl = $this->VoucherAction->Voucherdtl->newEntity();
				 
				$Voucherdtl->VCH_ID=$new_id;
				$Voucherdtl->VDT_DATE=$pay_date;
				$Voucherdtl->VDT_VOUCHER_NO=$VCH_NO;
				$Voucherdtl->VDT_LOT=1;
				$Voucherdtl->VDT_SR=1;
				$Voucherdtl->VDT_LDG_ID=$VoucherAction_from;
				$Voucherdtl->VDT_DEBIT=0;
				$Voucherdtl->VDT_CREDIT=$amount;
//echo $project;
				$Voucherdtl->VDT_PROJECT=$project;
			//	echo $department;
				$Voucherdtl->VDT_DEPARTMENT=$department;

						
			$this->VoucherAction->Voucherdtl->save($Voucherdtl);
				   
		
		
		
		
				 $Voucherdt2 = $this->VoucherAction->Voucherdtl->newEntity();
				 
				  $Voucherdt2->VCH_ID=$new_id;
				   $Voucherdt2->VDT_DATE=$pay_date;
				    $Voucherdt2->VDT_VOUCHER_NO=$VCH_NO;
					 $Voucherdt2->VDT_LOT=1;
					  $Voucherdt2->VDT_SR=2;
					  	$Voucherdt2->VDT_LDG_ID=$items;
						
					  	$Voucherdt2->VDT_DEBIT=$amount;
				   		$Voucherdt2->VDT_CREDIT=0;
						$Voucherdt2->VDT_PROJECT=$project;
						$Voucherdt2->VDT_DEPARTMENT=$department;
						
				    $this->VoucherAction->Voucherdtl->save($Voucherdt2);
				   
				
					}
		 return $this->redirect(array('action' => 'index'));
			 
            }
            $this->Flash->error(__('Unable to add the vouchers.'));
        }
        $this->set('VoucherAction', $VoucherAction);
    }

	
		
public function delete($VCH_ID = null)
{
	
	
		$user = $this->Auth->User();
		
		//$user_id=$user
		
			
    $VoucherAction = $this->VoucherAction->get($VCH_ID);
    if ($this->request->is(['post', 'put'])) {
		

		
		
        $this->VoucherAction->patchEntity($VoucherAction, $this->request->data);
		
		$VoucherAction->VCH_STATUS=STS_DELETED;
			$VoucherAction->VCH_STATUS_DATE=date('Y-m-d');
			$VoucherAction->VCH_STATUS_BY=$user['USR_ID'];
        if ($this->VoucherAction->save($VoucherAction)) {
            $this->Flash->success(__('Your VoucherAction has been Deleted.'));
            return $this->redirect(['action' => 'index']);
        }
        $this->Flash->error(__('Unable to Delete your VoucherAction.'));
    }

    $this->set('VoucherAction', $VoucherAction);
}







	
public function SendForApproval($VCH_ID)
    {
		
		
				$user = $this->Auth->User();
				
			
				/*login id*/							
	$user_id=$user["USR_ID"];
	
	
				$this->set(compact('user'));
					$Users=TableRegistry::get('users');
				$query=$Users->find('list',['keyField' => 'USR_ID','valueField' => 'username'])
					->where(['USR_ID !=' =>$user_id]);
				
				$user_name = $query->toArray();
				
				$this->set(compact('user_name'));
				
				$Basicdata=$Users=TableRegistry::get('Basicdata');
				
				$query=$Basicdata->find('list',['keyField' => 'BAS_ID','valueField' => 'BAS_NAME'])
				->where(['BAS_TYPE_ID' =>7])
				->andWhere(['BAS_ID' =>15]);
				
				$Usergroups = $query->toArray();
				
				$this->set(compact('Usergroups'));


				if (!$VCH_ID) 
				{
					throw new NotFoundException(__('Invalid user'));
				}



			
			$query=$this->VoucherAction->Ledgerbalance->find('all')->contain('vouchers')
			->where(['vouchers.VCH_ID IN' =>$VCH_ID]); //->contain('Basicdata');
			$query->find('all')->contain('Project')->contain('Department')->contain('Ledgers');
			$vdt_id = $query->toArray();
			$this->set(compact('vdt_id'));
			
			
			
			
			



			
			$today=date('Y-m-d', strtotime('now'));

/*check*/



			
			$query=$this->VoucherAction->voucherstatuslog->find('all')
			->where(['VCH_ID' =>$VCH_ID]); //->contain('Basicdata');
			$stslog = $query->toArray();
			$this->set(compact('stslog'));

	
	
		 
		  foreach($vdt_id as $a):
		   endforeach;
		
		 $vch_id=$VCH_ID;
		 

				 
						
		
	
			if ($this->request->is(['post','put'])) 
		
			{		
	
				$id=($this->request->data["name"]);
				
		
				$TEXT=($this->request->data["DESC"]);
				$ACC_TYPE=STS_SENT;
				
									


								$voucherstatuslog=$this->VoucherAction->voucherstatuslog->newEntity();

								
								$voucherstatuslog->VCH_ID=$vch_id;
								$voucherstatuslog->STS_ID=$ACC_TYPE;
								$voucherstatuslog->STS_DATE=$today;
								$voucherstatuslog->STS_BY=$user_id;
								$voucherstatuslog->STS_TEXT=$TEXT;
								$voucherstatuslog->STS_BY_TEXT='hi';
								$voucherstatuslog->STS_TO=$id;
								
	
	

								
								$this->VoucherAction->voucherstatuslog->save($voucherstatuslog);

								/* voucher table*/
										
										
								$newvoucher = $this->VoucherAction->get($VCH_ID);
										
        					$this->VoucherAction->patchEntity($newvoucher, $this->request->data);
							
											$newvoucher->VCH_STATUS=$ACC_TYPE;
		 									$newvoucher->VCH_STATUS_BY=$user_id;
											$newvoucher->VCH_STATUS_DATE=$today;
											$newvoucher->VCH_STATUS_BY_TEXT=$TEXT;
											$newvoucher->VCH_STATUS_TO=$id;

										if ($this->VoucherAction->save($newvoucher))
										{
											 $this->set('Approve', 1);
											$this->Flash->success(__('Your Voucher has been sent for Approval.'));
									
										}
										else
										{
											$this->Flash->error(__('Unable to update your Voucher Status.'));
										}
				}
				
    	}
	
	
		
	
	
	
	
	
	
	public function Approve($VCH_ID)
    {
		
	$user = $this->Auth->User();
	/*login id*/							
	$user_id=$user["USR_ID"];
							 		
		$query=$this->VoucherAction->Ledgerbalance->find('all')->contain('vouchers')
		->where(['vouchers.VCH_ID' =>$VCH_ID])
		->where(['VCH_STATUS' =>STS_SENT]);
		 //->contain('Basicdata');
		$vdt_id = $query->toArray();
		 $this->set(compact('vdt_id'));
		 
		 
		
			$vch_id=0;
			$VCH_STS_TO=0;
			$not_authorize=0;

		  foreach($vdt_id as $a):
			$vch_id=$a->voucher->VCH_ID;
			$VCH_STS_TO =$a->voucher->VCH_STATUS_TO;
		   endforeach;

		   if(($VCH_STS_TO!=$user_id))
		   {
			   $not_authorize=1;
			   $this->Flash->error(__('You Are Not Authorized To Approve This Voucher'));



            
			
		   }
            $this->set('not_authorize',$not_authorize);	
			 $this->set('vch_id',$vch_id);			
			
		
		
	
						
						
						
		
						
				
		
		
        if (!$VCH_ID) 
		{
            throw new NotFoundException(__('Invalid VOUCHER'));
        }
		
	
		 
		
		 $query=$this->VoucherAction->Ledgerbalance->find('all')->contain('vouchers')
		->where(['vouchers.VCH_ID IN' =>$VCH_ID]); //->contain('Basicdata');
		$query->find('all')->contain('Project')->contain('Department')->contain('Ledgers');
		 $vdt_id = $query->toArray();
		 $this->set(compact('vdt_id'));
		
		
		 
		
		$today=date('Y-m-d', strtotime('now'));
		
	/*check*/
	

			
			
				
					$LDG_NAME_1=$vdt_id[0]->ledger->LDG_NAME;
			
					$LDG_NAME_2=$vdt_id[1]->ledger->LDG_NAME;
					
					$LDG_ID_1=$vdt_id[0]->ledger->LDG_ID;
			
					$LDG_ID_2=$vdt_id[1]->ledger->LDG_ID;
					
				
	
				
				$VCH_DATE=$vdt_id[0]->voucher->VCH_DATE;
				$VCH_time=$vdt_id[0]->voucher->VCH_DATE;
				
				$VCH_CREATE_BY=$vdt_id[0]->voucher->VCH_CREATE_BY;
				$VCH_CREATE_BY_TEXT=$vdt_id[0]->voucher->VCH_CREATE_BY_TEXT;
				
				
				
				
				$VCH_NARRATION=$vdt_id[0]->voucher->VCH_NARRATION;
				
				
				$VCH_INV=$vdt_id[0]->voucher->VCH_INV_NO;
				$VCH_CHALAN=$vdt_id[0]->voucher->VCH_CHALLAN_NO;
				$VCH_MR_NO=$vdt_id[0]->voucher->VCH_MR_NO;
				
				
				$VCH_CHEQUE=$vdt_id[0]->voucher->VCH_IS_CHEQUE;
				$VCH_AMOUNT=$vdt_id[0]->voucher->VCH_AMOUNT;
		
				$VDT_DEBIT_1=$vdt_id[0]->VDT_DEBIT;
				$VDT_CREDIT_1=$vdt_id[0]->VDT_CREDIT;
			
				$VDT_DEBIT_2=$vdt_id[1]->VDT_DEBIT;
				$VDT_CREDIT_2=$vdt_id[1]->VDT_CREDIT;
			
				
				$VCH_DESCRIPTION=$vdt_id[0]->voucher->VCH_FULL_DESCRIPTION;
		 
					$VCH_NO=$vdt_id[0]->voucher->VCH_NO;
					$VCH_NO_FULL=$vdt_id[0]->voucher->VCH_NO_FULL;
					$PROJECT_ID=$vdt_id[0]->VDT_PROJECT;
					//echo "<pre>";
					//var_dump($vdt_id[0]);
					$PRJ_NAME=$vdt_id[0]->project->BAS_CODE;
					$VCH_TYPE=$vdt_id[0]->voucher->VCH_TYPE;
					$DEPT_ID=$vdt_id[0]->VDT_DEPARTMENT;
					$DEPT_NAME=$vdt_id[0]->department->BAS_CODE;
					$VCH_FULL_DESCRIPTION=$vdt_id[0]->voucher->VCH_FULL_DESCRIPTION;
			
		
		if ($this->request->is(['post','put'])) 
		
			{
$ACC_TYPE=0;
$DENIED=0;
		  $TEXT=($this->request->data["DESC"]);
		  if(isset($this->request->data["APPROVE"]))
		  $ACC_TYPE=($this->request->data["APPROVE"]);
		  
		
		  if(isset($this->request->data["DENIED"]))
  		  $DENIED=($this->request->data["DENIED"]);
		  
		  echo $ACC_TYPE.' '.$DENIED;
		  $isApprove=false;
		if ($ACC_TYPE>0) $isApprove=true;		  
		if ($DENIED>0) $ACC_TYPE=$DENIED;
		
							
			
					$voucherstatuslog=$this->VoucherAction->voucherstatuslog->NewEntity();
							
										$voucherstatuslog->STS_ID=$ACC_TYPE;
										$voucherstatuslog->VCH_ID=$vch_id;
										$voucherstatuslog->STS_DATE=$today;
										$voucherstatuslog->STS_BY=$user_id;
										$voucherstatuslog->STS_TO=0;
										$voucherstatuslog->STS_TEXT=$TEXT;
										$voucherstatuslog->STS_BY_TEXT=$user['username'];
									
								
								
									$this->VoucherAction->voucherstatuslog->save($voucherstatuslog);
		   
		   						$newvoucher = $this->VoucherAction->get($vch_id);
   
   
							
											$newvoucher->VCH_STATUS=$ACC_TYPE;
		 									$newvoucher->VCH_STATUS_BY=$user_id;
											$newvoucher->VCH_STATUS_DATE=$today;
											$newvoucher->VCH_STATUS_BY_TEXT=$user['username'];
											$newvoucher->VCH_STATUS_BY_DESC=$TEXT;
											
								$this->VoucherAction->save($newvoucher) ;
								
								
								
								
								

								
								
							if ($isApprove==true)	
							{
								$generalledger=$this->VoucherAction->generalledger->newEntity();

								
								$generalledger->LDG_ID=$LDG_ID_1;
								$generalledger->LDG_NAME=$LDG_NAME_1;
								$generalledger->VCH_DATE=$VCH_DATE;
								$generalledger->VCH_CREATE_TIME=$VCH_DATE;
								$generalledger->VCH_CREATE_BY_ID=$VCH_CREATE_BY;
								$generalledger->VCH_CREATE_BY_TEXT=$VCH_CREATE_BY_TEXT;
								$generalledger->VCH_APPROVE_BY_ID=$user_id;
								
								$generalledger->VCH_ID=$VCH_ID;
								
								$generalledger->VCH_APPROVE_DATE=date('Y-m-d');
								$generalledger->VCH_APPROVE_BY_TEXT= $user['username'];
								$generalledger->VCH_NARRATION=$VCH_NARRATION;
								$generalledger->VCH_INV=$VCH_INV;
								$generalledger->VCH_CHALAN=$VCH_CHALAN;
								$generalledger->VCH_MR=$VCH_MR_NO;
								$generalledger->VCH_CHEQUE=$VCH_CHEQUE;
								
								$generalledger->VCH_LDG_ID=$LDG_ID_2;
								$generalledger->VCH_LDG_NAME=$LDG_NAME_2;
								
								
								
								
								
								$generalledger->VCH_DESCRIPTION=$VCH_FULL_DESCRIPTION;

								$generalledger->VCH_NO=$VCH_NO;
								$generalledger->VCH_NO_FULL=$VCH_NO_FULL;
								$generalledger->VCH_PROJ_ID=$PROJECT_ID;
								
								$generalledger->VCH_PROJ_CODE=$PRJ_NAME;
								$generalledger->VCH_TYPE=$VCH_TYPE;
								$generalledger->VCH_DEPT_ID=$DEPT_ID;
								$generalledger->VCH_DEPT_NAME=$DEPT_NAME;
								$generalledger->VCH_APPROVE_TEXT=$TEXT;
								
								
								
								
							
								
								if($VDT_DEBIT_1>0)
								{
								
									
								$generalledger->VCH_DEBIT=$VDT_DEBIT_1;
								$generalledger->VCH_CREDIT=0;
								}
								
								if($VDT_CREDIT_1>0)
								{
								
								$generalledger->VCH_DEBIT=0;
								$generalledger->VCH_CREDIT=$VDT_CREDIT_1;
								}
							
								
								$generalledger->VCH_BALANE_DR=0;
								$generalledger->VCH_BALANE_CR=0;
								

								
							
		
							
								$this->VoucherAction->generalledger->save($generalledger);
								
								
								$generalledger=$this->VoucherAction->generalledger->newEntity();

								
								$generalledger->LDG_ID=$LDG_ID_2;
								$generalledger->LDG_NAME=$LDG_NAME_2;
								$generalledger->VCH_DATE=$VCH_DATE;
								$generalledger->VCH_CREATE_TIME=$VCH_DATE;
								$generalledger->VCH_CREATE_BY_ID=$VCH_CREATE_BY;
								$generalledger->VCH_CREATE_BY_TEXT=$VCH_CREATE_BY_TEXT;
								$generalledger->VCH_APPROVE_BY_ID=$user_id;
								
								$generalledger->VCH_ID=$VCH_ID;
								
								$generalledger->VCH_APPROVE_DATE=date('Y-m-d');
								$generalledger->VCH_APPROVE_BY_TEXT= $user['username'];
								$generalledger->VCH_NARRATION=$VCH_NARRATION;
								$generalledger->VCH_INV=$VCH_INV;
								$generalledger->VCH_CHALAN=$VCH_CHALAN;
								$generalledger->VCH_MR=$VCH_MR_NO;
								$generalledger->VCH_CHEQUE=$VCH_CHEQUE;
								
								$generalledger->VCH_LDG_ID=$LDG_ID_1;
								$generalledger->VCH_LDG_NAME=$LDG_NAME_1;
							
								$generalledger->VCH_DESCRIPTION=$VCH_FULL_DESCRIPTION;

								$generalledger->VCH_NO=$VCH_NO;
								$generalledger->VCH_NO_FULL=$VCH_NO_FULL;
								$generalledger->VCH_PROJ_ID=$PROJECT_ID;
								
								$generalledger->VCH_PROJ_CODE=$PRJ_NAME;
								$generalledger->VCH_TYPE=$VCH_TYPE;
								$generalledger->VCH_DEPT_ID=$DEPT_ID;
								$generalledger->VCH_DEPT_NAME=$DEPT_NAME;
								$generalledger->VCH_APPROVE_TEXT=$TEXT;
								
								if($VDT_DEBIT_2>0)
								{
								
									
								$generalledger->VCH_DEBIT=$VDT_DEBIT_2;
								$generalledger->VCH_CREDIT=0;
								}
								
								if($VDT_CREDIT_2>0)
								{
								
								$generalledger->VCH_DEBIT=0;
								$generalledger->VCH_CREDIT=$VDT_CREDIT_2;
								}
							
								
								$generalledger->VCH_BALANE_DR=0;
								$generalledger->VCH_BALANE_CR=0;
								
								$generalledger->VCH_DESCRIPTION=$VCH_DESCRIPTION;
								
							
		
							
								$this->VoucherAction->generalledger->save($generalledger);
									
									
									
										
								
		
							}
								
							
							return $this->redirect(array('action' => 'Approve',$VCH_ID));
								
			
			}
	
		
    }
	



	public function ApproveSelf($VCH_ID)
    {
		
	$user = $this->Auth->User();
	/*login id*/							
	$user_id=$user["USR_ID"];
							 		
		

		 
         
        if (!$VCH_ID) 
		{
            throw new NotFoundException(__('Invalid VOUCHER'));
        }
		
	
		 
		
		 $query=$this->VoucherAction->Ledgerbalance->find('all')->contain('vouchers')
		->where(['vouchers.VCH_ID IN' =>$VCH_ID]); //->contain('Basicdata');
		$query->find('all')->contain('Project')->contain('Department')->contain('Ledgers');
		 $vdt_id = $query->toArray();
		 $this->set(compact('vdt_id'));
		
		
		 
		
		$today=date('Y-m-d', strtotime('now'));
		
	/*check*/
	

			
			
				
					$LDG_NAME_1=$vdt_id[0]->ledger->LDG_NAME;
			
					$LDG_NAME_2=$vdt_id[1]->ledger->LDG_NAME;
					
					$LDG_ID_1=$vdt_id[0]->ledger->LDG_ID;
			
					$LDG_ID_2=$vdt_id[1]->ledger->LDG_ID;
					
				
	
				
				$VCH_DATE=$vdt_id[0]->voucher->VCH_DATE;
				$VCH_time=$vdt_id[0]->voucher->VCH_DATE;
				
				$VCH_CREATE_BY=$vdt_id[0]->voucher->VCH_CREATE_BY;
				$VCH_CREATE_BY_TEXT=$vdt_id[0]->voucher->VCH_CREATE_BY_TEXT;
				
				
				
				
				$VCH_NARRATION=$vdt_id[0]->voucher->VCH_NARRATION;
				
				
				$VCH_INV=$vdt_id[0]->voucher->VCH_INV_NO;
				$VCH_CHALAN=$vdt_id[0]->voucher->VCH_CHALLAN_NO;
				$VCH_MR_NO=$vdt_id[0]->voucher->VCH_MR_NO;
				
				
				$VCH_CHEQUE=$vdt_id[0]->voucher->VCH_IS_CHEQUE;
				$VCH_AMOUNT=$vdt_id[0]->voucher->VCH_AMOUNT;
		
				$VDT_DEBIT_1=$vdt_id[0]->VDT_DEBIT;
				$VDT_CREDIT_1=$vdt_id[0]->VDT_CREDIT;
			
				$VDT_DEBIT_2=$vdt_id[1]->VDT_DEBIT;
				$VDT_CREDIT_2=$vdt_id[1]->VDT_CREDIT;
			
				
				$VCH_DESCRIPTION=$vdt_id[0]->voucher->VCH_FULL_DESCRIPTION;
		 
					$VCH_NO=$vdt_id[0]->voucher->VCH_NO;
					$VCH_NO_FULL=$vdt_id[0]->voucher->VCH_NO_FULL;
					$PROJECT_ID=$vdt_id[0]->VDT_PROJECT;
					//echo "<pre>";
					//var_dump($vdt_id[0]);
					$PRJ_NAME=$vdt_id[0]->project->BAS_CODE;
					$VCH_TYPE=$vdt_id[0]->voucher->VCH_TYPE;
					$DEPT_ID=$vdt_id[0]->VDT_DEPARTMENT;
					$DEPT_NAME=$vdt_id[0]->department->BAS_CODE;
					$VCH_FULL_DESCRIPTION=$vdt_id[0]->voucher->VCH_FULL_DESCRIPTION;
			
		
		
$ACC_TYPE=STS_APPROVED;
		
							
			
					$voucherstatuslog=$this->VoucherAction->voucherstatuslog->NewEntity();
							
										$voucherstatuslog->STS_ID=$ACC_TYPE;
										$voucherstatuslog->VCH_ID=$VCH_ID;
										$voucherstatuslog->STS_DATE=$today;
										$voucherstatuslog->STS_BY=$user_id;
										$voucherstatuslog->STS_TO=0;
										$voucherstatuslog->STS_TEXT='SELF APPROVED';
										$voucherstatuslog->STS_BY_TEXT=$user['username'];
									
								
								
									$this->VoucherAction->voucherstatuslog->save($voucherstatuslog);
		   
		   						$newvoucher = $this->VoucherAction->get($VCH_ID);
   
   
							
											$newvoucher->VCH_STATUS=$ACC_TYPE;
		 									$newvoucher->VCH_STATUS_BY=$user_id;
											$newvoucher->VCH_STATUS_DATE=$today;
											$newvoucher->VCH_STATUS_BY_TEXT=$user['username'];
											$newvoucher->VCH_STATUS_BY_DESC='SELF APPROVED';
											
								$this->VoucherAction->save($newvoucher) ;
								
								
								
								
								

								
								

								$generalledger=$this->VoucherAction->generalledger->newEntity();

								
								$generalledger->LDG_ID=$LDG_ID_1;
								$generalledger->LDG_NAME=$LDG_NAME_1;
								$generalledger->VCH_DATE=$VCH_DATE;
								$generalledger->VCH_CREATE_TIME=$VCH_DATE;
								$generalledger->VCH_CREATE_BY_ID=$VCH_CREATE_BY;
								$generalledger->VCH_CREATE_BY_TEXT=$VCH_CREATE_BY_TEXT;
								$generalledger->VCH_APPROVE_BY_ID=$user_id;
								
								$generalledger->VCH_ID=$VCH_ID;
								
								$generalledger->VCH_APPROVE_DATE=date('Y-m-d');
								$generalledger->VCH_APPROVE_BY_TEXT= $user['username'];
								$generalledger->VCH_NARRATION=$VCH_NARRATION;
								$generalledger->VCH_INV=$VCH_INV;
								$generalledger->VCH_CHALAN=$VCH_CHALAN;
								$generalledger->VCH_MR=$VCH_MR_NO;
								$generalledger->VCH_CHEQUE=$VCH_CHEQUE;
								
								$generalledger->VCH_LDG_ID=$LDG_ID_2;
								$generalledger->VCH_LDG_NAME=$LDG_NAME_2;
								
								
								
								
								
								$generalledger->VCH_DESCRIPTION=$VCH_FULL_DESCRIPTION;

								$generalledger->VCH_NO=$VCH_NO;
								$generalledger->VCH_NO_FULL=$VCH_NO_FULL;
								$generalledger->VCH_PROJ_ID=$PROJECT_ID;
								
								$generalledger->VCH_PROJ_CODE=$PRJ_NAME;
								$generalledger->VCH_TYPE=$VCH_TYPE;
								$generalledger->VCH_DEPT_ID=$DEPT_ID;
								$generalledger->VCH_DEPT_NAME=$DEPT_NAME;
								$generalledger->VCH_APPROVE_TEXT='SELF APPROVE';
								
								
								
								
							
								
								if($VDT_DEBIT_1>0)
								{
								
									
								$generalledger->VCH_DEBIT=$VDT_DEBIT_1;
								$generalledger->VCH_CREDIT=0;
								}
								
								if($VDT_CREDIT_1>0)
								{
								
								$generalledger->VCH_DEBIT=0;
								$generalledger->VCH_CREDIT=$VDT_CREDIT_1;
								}
							
								
								$generalledger->VCH_BALANE_DR=0;
								$generalledger->VCH_BALANE_CR=0;
								

								
							
		
							
								$this->VoucherAction->generalledger->save($generalledger);
								
								
								$generalledger=$this->VoucherAction->generalledger->newEntity();

								
								$generalledger->LDG_ID=$LDG_ID_2;
								$generalledger->LDG_NAME=$LDG_NAME_2;
								$generalledger->VCH_DATE=$VCH_DATE;
								$generalledger->VCH_CREATE_TIME=$VCH_DATE;
								$generalledger->VCH_CREATE_BY_ID=$VCH_CREATE_BY;
								$generalledger->VCH_CREATE_BY_TEXT=$VCH_CREATE_BY_TEXT;
								$generalledger->VCH_APPROVE_BY_ID=$user_id;
								
								$generalledger->VCH_ID=$VCH_ID;
								
								$generalledger->VCH_APPROVE_DATE=date('Y-m-d');
								$generalledger->VCH_APPROVE_BY_TEXT= $user['username'];
								$generalledger->VCH_NARRATION=$VCH_NARRATION;
								$generalledger->VCH_INV=$VCH_INV;
								$generalledger->VCH_CHALAN=$VCH_CHALAN;
								$generalledger->VCH_MR=$VCH_MR_NO;
								$generalledger->VCH_CHEQUE=$VCH_CHEQUE;
								
								$generalledger->VCH_LDG_ID=$LDG_ID_1;
								$generalledger->VCH_LDG_NAME=$LDG_NAME_1;
							
								$generalledger->VCH_DESCRIPTION=$VCH_FULL_DESCRIPTION;

								$generalledger->VCH_NO=$VCH_NO;
								$generalledger->VCH_NO_FULL=$VCH_NO_FULL;
								$generalledger->VCH_PROJ_ID=$PROJECT_ID;
								
								$generalledger->VCH_PROJ_CODE=$PRJ_NAME;
								$generalledger->VCH_TYPE=$VCH_TYPE;
								$generalledger->VCH_DEPT_ID=$DEPT_ID;
								$generalledger->VCH_DEPT_NAME=$DEPT_NAME;
								$generalledger->VCH_APPROVE_TEXT='SELF APPROVE';
								
								if($VDT_DEBIT_2>0)
								{
								
									
								$generalledger->VCH_DEBIT=$VDT_DEBIT_2;
								$generalledger->VCH_CREDIT=0;
								}
								
								if($VDT_CREDIT_2>0)
								{
								
								$generalledger->VCH_DEBIT=0;
								$generalledger->VCH_CREDIT=$VDT_CREDIT_2;
								}
							
								
								$generalledger->VCH_BALANE_DR=0;
								$generalledger->VCH_BALANE_CR=0;
								
								$generalledger->VCH_DESCRIPTION=$VCH_DESCRIPTION;
								
							
		
							
								$this->VoucherAction->generalledger->save($generalledger);
									
									
									
										
								
		
							
								
							
							$this->redirect($this->referer());
								
			
			
	
		
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