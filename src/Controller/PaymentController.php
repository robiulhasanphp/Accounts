<?php
	namespace App\Controller;
	
	use App\Controller\AppController;
	use Cake\Event\Event;
	use Cake\Network\Exception\NotFoundException;
	use Cake\ORM\TableRegistry;	
	
	
	class PaymentController extends AppController{
		
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
			
		$this->set('Payment', $this->Payment->find('all')
		->where(['VCH_TYPE' =>VCH_TYPE_PAYMENT])
		->andWhere(['VCH_DATE >=' =>$sdate])
		->andWhere(['VCH_DATE <=' =>$edate])
		->andWhere(['VCH_STATUS !=' =>STS_DELETED])
		->order(['VCH_DATE' =>'DESC','VCH_ID' =>'DESC'])   ); 
		
		    $this->set(compact('sdate'));
		$this->set(compact('edate'));
		
		}
		
		public function view($id = null){
			$Payment = $this->Payment->get($id);
			$this->set(compact('Payment'));
    	}
		
		
		public function add(){
				$user = $this->Auth->User();
			
		$Basicdata = TableRegistry::get('Basicdata');

		$query=$Basicdata->find('list',['keyField' => ['BAS_ID'],'valueField' => 'BAS_NAME'])->where(['BAS_TYPE_ID' =>5]);
		$project = $query->toArray();
		$this->set(compact('project'));
		 

		
		$query=$Basicdata->find('list',['keyField' => ['BAS_ID'],'valueField' => 'BAS_NAME'])->where(['BAS_TYPE_ID' =>4]);
		$department = $query->toArray();
		$this->set(compact('department'));
		
		$query=$this->Payment->Ledgerstype->find('list',['keyField' => ['LDG_ID'],'valueField' => 'LDG_ID']);
		
		
		
		/*->where(['LTM_ID' =>4])
		->orWhere(['LTM_ID' =>6])
		->orWhere(['LTM_ID' =>7])
    	->orWhere(['LTM_ID' =>2]);
	
		$pur=$query->toArray();*/
		
		$query=$this->Payment->Ledgers->find('list',['keyField' => ['LDG_ID'],'valueField' => 'LDG_NAME'])			->order(['LDG_NAME'=>'ASC']); //->where(['LDG_ID IN ' =>$pur]);
		$paid_to = $query->toArray();
		$this->set(compact('paid_to'));
		
		
				
	
			
			
			
        $Payment = $this->Payment->newEntity();
        if ($this->request->is('post')) {
			
			$vcr_acc = ACC_CASH;
			if ($this->request->data["payment_mode"]==2){
				$vcr_acc =$this->request->data["VCH_CR_ACCOUNTS"];
			}
			
			
			$vdr_acc =$this->request->data["VCH_DR_ACCOUNTS"];
			if ($vdr_acc ==$vcr_acc )
			{
				        $this->set('Payment', $Payment);
				            $this->Flash->error(__('You cannot select same account for payment'));				
							return;
			}

			$ldg_table= TableRegistry::get('Ledgers');
			$ldg = $ldg_table->get($vdr_acc);
			
			$paid_to= $ldg->LDG_CODE;
			$paid_to_name= $ldg->LDG_NAME;
			
			$ldg =$ldg_table->get($vcr_acc);
			
			$paid_from= $ldg->LDG_CODE;
			$paid_from_name= $ldg->LDG_NAME;
			
				
			$amount=($this->request->data["VCH_AMOUNT"]);

			
			if ($amount<=0)
			{
				        $this->set('Payment', $Payment);
				            $this->Flash->error(__('Payment Amount is not Correct'));				
							return;
			}

            $Payment = $this->Payment->patchEntity($Payment, $this->request->data);
			
			
			
			$full_des=$paid_from.'(Cr), '.$paid_to.'(Dr)';
//			$OfficeExpenses->VCH_DR_ACCOUNTS=ACC_CASH;			
			$Payment->VCH_CR_ACCOUNTS=$vcr_acc;
			$Payment->VCH_FULL_DESCRIPTION=$full_des;
			$Payment->ACC_DR_NAME=$paid_to_name;
			$Payment->ACC_CR_NAME=$paid_from_name;
			
			//var_dump($Payment);
				//$vouchers->VCH_STATUS=0;

				
			$Payment->VCH_STATUS=STS_CREATE;
			$Payment->VCH_CREATE_BY=$user['USR_ID'];
			
			$Payment->VCH_TYPE=VCH_TYPE_PAYMENT;

			$Payment->VCH_STATUS_BY=$user['USR_ID'];
			$Payment->VCH_LAST_EDIT_BY=$user['USR_ID'];
			$Payment->VCH_SUBMIT_BY=$user['USR_ID'];
			
			$Payment->VCH_CR_ACCOUNTS=$vcr_acc;
		
			
			$pay_date=$this->request->data('pay_date');
			if(strlen($pay_date)>8)
			{
			$vch_date = explode('-', $pay_date);
				$d = $vch_date[0];
				$m = $vch_date[1];
				$y = $vch_date[2];
				$month = $m;
				$year = $y;
				$pay_date = $y.'-'.$m.'-'.$d;
				
				$Payment->VCH_DATE=$pay_date;	
				$Payment->VCH_MONTH=$m;
				$Payment->VCH_YEAR=$y;
			}
			else
			{
				        $this->set('Payment', $Payment);
				            $this->Flash->error(__('Payment Date is not specified'));				
							return;
			}
			$check_date = $this->request->data('check_date');
			if (strlen($check_date)>8){
			$Payment->VCH_CHEQUE_DESC = DateToDB($check_date.'-','-');;
			}

				
			$full_des=$paid_to.'(Dr), '.$paid_from.'(Cr)';
			
			$Payment->VCH_FULL_DESCRIPTION=$full_des;
			
			//	$vouchers->VCH_FULL_DESCRIPTION=$full_des;
			
				
				
				
				 if ($this->Payment->save($Payment)) {

              

				
				$id = $Payment->VCH_ID;  //data call from table
				$new_id=$id;
				
						

			$Payment=$this->Payment->get($id);
			$vch_Full=$Payment->VCH_NO_FULL;

				//$VCH_AMOUNT = $Payment->VCH_AMOUNT;
				
				
				
					

				
				 $Voucherdtl = $this->Payment->Voucherdtl->newEntity();
				 
					$Voucherdtl->VCH_ID=$new_id;
					$Voucherdtl->VDT_DATE=$pay_date;
					$Voucherdtl->VDT_VOUCHER_NO=$vch_Full;
					$Voucherdtl->VDT_LOT=1;
					$Voucherdtl->VDT_SR=1;
					$Voucherdtl->VDT_LDG_ID=$vcr_acc;
					
					$Voucherdtl->VDT_DEBIT=0;
					$Voucherdtl->VDT_CREDIT=$amount;
					$Voucherdtl->VDT_PROJECT=$project;
					
					$Voucherdtl->VDT_DEPARTMENT=$department;
					$this->Payment->Voucherdtl->save($Voucherdtl);
					
					
					
					
					
					$Voucherdt2 = $this->Payment->Voucherdtl->newEntity();
					
					$Voucherdt2->VCH_ID=$new_id;
					$Voucherdt2->VDT_DATE=$pay_date;
					$Voucherdt2->VDT_VOUCHER_NO=$vch_Full;
					$Voucherdt2->VDT_LOT=1;
					$Voucherdt2->VDT_SR=2;
					$Voucherdt2->VDT_LDG_ID=$vdr_acc;
					
					$Voucherdt2->VDT_DEBIT=$amount;
					$Voucherdt2->VDT_CREDIT=0;
					$Voucherdt2->VDT_PROJECT=$project;
					
					$Voucherdt2->VDT_DEPARTMENT=$department;
					$this->Payment->Voucherdtl->save($Voucherdt2);
				
				
				
				
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
            $this->Flash->error(__('Unable to add your article.'));
        }
        $this->set('Payment', $Payment);
    }
	
	
	
	
	
	
	public function edit($id){
				$user = $this->Auth->User();
		$Basicdata = TableRegistry::get('Basicdata');

		$query=$Basicdata->find('list',['keyField' => ['BAS_ID'],'valueField' => 'BAS_NAME'])->where(['BAS_TYPE_ID' =>5]);
		$project = $query->toArray();
		$this->set(compact('project'));
		 

		
		$query=$Basicdata->find('list',['keyField' => ['BAS_ID'],'valueField' => 'BAS_NAME'])->where(['BAS_TYPE_ID' =>4]);
		$department = $query->toArray();
		$this->set(compact('department'));
		
		/*$query=$this->Payment->Ledgerstype->find('list',['keyField' => ['LDG_ID'],'valueField' => 'LDG_ID']);
		
		->where(['LTM_ID' =>4])
		->orWhere(['LTM_ID' =>6])
		->orWhere(['LTM_ID' =>7])
    	->orWhere(['LTM_ID' =>2]);
	
		$pur=$query->toArray();
		*/
		$query=$this->Payment->Ledgers->find('list',['keyField' => ['LDG_ID'],'valueField' => 'LDG_NAME'])			->order(['LDG_NAME'=>'ASC']);
		//->where(['LDG_ID IN ' =>$pur]);
		$paid_to = $query->toArray();
		$this->set(compact('paid_to'));
		
		
			
			
			
			
			
			
			
        $Payment = $this->Payment->get($id);
		
				$pay_date = date_format($Payment->VCH_DATE,'d-m-Y');
				$Payment->VCH_DATE=$pay_date;
				$this->set(compact('pay_date'));
				
				
				
				$ck_date = $Payment->VCH_CHEQUE_DESC;
							if(strlen($ck_date)>8)
							{
				$ck_date = explode('-', $ck_date);
				$d = $ck_date[2];
				$m = $ck_date[1];
				$y = $ck_date[0];
				$ck_date =  $d.'-'.$m.'-'.$y;
				
				$Payment->VCH_CHEQUE_DESC = $ck_date;
							}
							else{
							$ck_date='';	
							}
				//$check_date = $ck_date;
				$this->set(compact('ck_date'));
				
				
				
        if ($this->request->is(['post','put'])) {
				
			$vcr_acc = ACC_CASH;
			if ($this->request->data["payment_mode"]==2){
				$vcr_acc =$this->request->data["VCH_CR_ACCOUNTS"];
			}
			$vdr_acc=$this->request->data["VCH_DR_ACCOUNTS"];
				
			if ($vdr_acc ==$vcr_acc )
			{
				        $this->set('Payment', $Payment);
				            $this->Flash->error(__('You cannot select same account for payment'));				
							return;
			}

			
			$amount=($this->request->data["VCH_AMOUNT"]);
			
			if ($amount<=0)
			{
				        $this->set('Payment', $Payment);
				            $this->Flash->error(__('Payment Amount is not Correct'));				
							return;
			}

			
            $Payment = $this->Payment->patchEntity($Payment, $this->request->data);
			
			//var_dump($Payment);
				//$vouchers->VCH_STATUS=0;
			$Payment->VCH_STATUS=STS_EDIT;
			
			$Payment->VCH_TYPE=VCH_TYPE_PAYMENT;

			$Payment->VCH_STATUS_BY=$user['USR_ID'];
			$Payment->VCH_LAST_EDIT_BY=$user['USR_ID'];
			$Payment->VCH_SUBMIT_BY=$user['USR_ID'];
			
			$Payment->VCH_CR_ACCOUNTS=$vcr_acc;
		


			$vdr_acc=$Payment->VCH_DR_ACCOUNTS;
			
			$pay_date=$this->request->data('pay_date');
			if(strlen($pay_date)>8)
			{
			$vch_date = explode('-', $pay_date);
				$d = $vch_date[0];
				$m = $vch_date[1];
				$y = $vch_date[2];
				$month = $m;
				$year = $y;
				$pay_date = $y.'-'.$m.'-'.$d;
				
				$Payment->VCH_DATE=$pay_date;	
				
				$Payment->VCH_MONTH=$m;
				$Payment->VCH_YEAR=$y;
			}
			else
			{
				        $this->set('Payment', $Payment);
				            $this->Flash->error(__('Payment Date is not specified'));				
							return;
			}
			
			
			$ck_date = $this->request->data('check_date');
			if(strlen($ck_date)>8)
			{
			$exp_check_date = explode('-', $ck_date);
				$d = $exp_check_date[0];
				$m = $exp_check_date[1];
				$y = $exp_check_date[2];
				
				$ck_date = $y.'-'.$m.'-'.$d;
				$Payment->VCH_CHEQUE_DESC = $ck_date;
			
			}
			
				
					
//				$vch_Full=$year.$month.'0000'.$b;
				
	//			$Payment->VCH_NO_FULL=$vch_Full;
				
			
							$ldg_table= TableRegistry::get('Ledgers');
			$ldg = $ldg_table->get($vdr_acc);
			
			$paid_to= $ldg->LDG_CODE;
			$paid_to_name = $ldg->LDG_NAME;			
			
			$ldg =$ldg_table->get($vcr_acc);
			
			$paid_from= $ldg->LDG_CODE;
			$paid_from_name= $ldg->LDG_NAME;			

				$full_des=$paid_from.'(Cr), '.$paid_to.'(Dr)';				
				$Payment->VCH_FULL_DESCRIPTION=$full_des;
				
				
				$Payment->ACC_DR_NAME=$paid_to_name;
				$Payment->ACC_CR_NAME=$paid_from_name;

				
				
				 if ($this->Payment->save($Payment)) {				

				$project=$Payment->VCH_PROJECT;

				$department=$Payment->VCH_DEPARTMENT;
				
				/*echo "kdfjkf";
				exit();*/
				$this->Payment->Voucherdtl->deleteAll(['VCH_ID' =>$id]);
						
									$VCH_NO = $Payment->VCH_NO_FULL; 
									$new_id= $Payment->VCH_ID;  //data call from table

									
									
									//insert data in another table
					
									
									 $Voucherdtl = $this->Payment->Voucherdtl->newEntity();
									 
										$Voucherdtl->VCH_ID=$new_id;
										$Voucherdtl->VDT_DATE=$pay_date;
										$Voucherdtl->VDT_VOUCHER_NO=$VCH_NO;
										$Voucherdtl->VDT_DESCRIPTION=$Payment->VCH_NARRATION;
										$Voucherdtl->VDT_CREATE_BY=$user['USR_ID'];;
										$Voucherdtl->VDT_LOT=1;
										$Voucherdtl->VDT_SR=1;
										$Voucherdtl->VDT_LDG_ID=$vcr_acc;
										
										$Voucherdtl->VDT_DEBIT=0;
										$Voucherdtl->VDT_CREDIT=$amount;
										$Voucherdtl->VDT_PROJECT=$project;
		
										$Voucherdtl->VDT_DEPARTMENT=$department;
										$this->Payment->Voucherdtl->save($Voucherdtl);
										
										
										
										
										
										$Voucherdt2 = $this->Payment->Voucherdtl->newEntity();
										
										$Voucherdt2->VCH_ID=$new_id;
										$Voucherdt2->VDT_DATE=$pay_date;
										$Voucherdt2->VDT_VOUCHER_NO=$VCH_NO;
										$Voucherdt2->VDT_LOT=1;
										$Voucherdt2->VDT_SR=2;
										$Voucherdt2->VDT_LDG_ID=$vdr_acc;
										
										$Voucherdt2->VDT_DEBIT=$amount;
										$Voucherdt2->VDT_CREDIT=0;
											$Voucherdt2->VDT_PROJECT=$project;
		
										$Voucherdt2->VDT_DEPARTMENT=$department;
										$this->Payment->Voucherdtl->save($Voucherdt2);
									
									
									
									

														
						
						
				
					return $this->redirect(['controller' => 'Payment', 'action' => 'index']);						
				
				}
				
				
				
				
				
				
				
				else
				{
					return $this->redirect(['controller' => 'Payment', 'action' => 'edit']);
				}
			$this->Flash->error(__('Unable to add your article.'));
        }
        $this->set('Payment', $Payment);
    }
		
		
		
	
	
	
	
	
	
	
	public function delete($VCH_ID = null)
{
	
	
		$user = $this->Auth->User();	
    $Payment = $this->Payment->get($VCH_ID);
    if ($this->request->is(['post', 'put'])) {
		

		
		
        $this->Payment->patchEntity($Payment, $this->request->data);
		
		$Payment->VCH_STATUS=STS_DELETED;
			$Payment->VCH_STATUS_DATE=date('Y-m-d');
			$Payment->VCH_STATUS_BY=$user['USR_ID'];
        if ($this->Payment->save($Payment)) {
            $this->Flash->success(__('Your Payment has been updated.'));
            return $this->redirect(['action' => 'index']);
        }
        $this->Flash->error(__('Unable to update your article.'));
    }

    $this->set('Payment', $Payment);
}

		
		
		
	
	}
	
	
?>
