<?php
	namespace App\Controller;
	
	use App\Controller\AppController;
	use Cake\Event\Event;
	use Cake\Network\Exception\NotFoundException;
	use Cake\ORM\TableRegistry;	
	
	
	class CashWithdrawController extends AppController{
		
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
				$sdate=date('Y-m-d');
				$edate=date('Y-m-d');				
			}
			
			$this->set('CashWithdraw', $this->CashWithdraw->find('all')
			->where(['VCH_TYPE' =>VCH_TYPE_BANK])
			->andWhere(['VCH_DATE >=' =>$sdate])
			->andWhere(['VCH_DATE <=' =>$edate])
			->andWhere(['VCH_STATUS !=' =>STS_DELETED])
			->order(['VCH_DATE' =>'DESC','VCH_ID' =>'DESC'])); 
		
		    $this->set(compact('sdate'));
			$this->set(compact('edate'));
			
		}
		
		public function view($id = null){
			$CashWithdraw = $this->CashWithdraw->get($id);
			$this->set(compact('CashWithdraw'));
    	}
		
		
		
		
		
		public function add()
		{
			$user = $this->Auth->User();
			
			$Basicdata = TableRegistry::get('Basicdata');
	
			$query=$Basicdata->find('list',['keyField' => ['BAS_ID'],'valueField' => 'BAS_NAME'])->where(['BAS_TYPE_ID' =>5]);
			$project = $query->toArray();
			$this->set(compact('project'));
			 
	
			
			$query=$Basicdata->find('list',['keyField' => ['BAS_ID'],'valueField' => 'BAS_NAME'])->where(['BAS_TYPE_ID' =>4]);
			$department = $query->toArray();
			$this->set(compact('department'));
			
			$query=$this->CashWithdraw->Ledgerstype->find('list',['keyField' => ['LDG_ID'],'valueField' => 'LDG_ID']);
			
			$query=$this->CashWithdraw->Ledgers->find('list',['keyField' => ['LDG_ID'],'valueField' => 'LDG_NAME'])->where(['LDG_TYPES like ' =>'%BNK%']);
			$bank_name = $query->toArray();
			$this->set(compact('bank_name'));
		
		
			
			
			$CashWithdraw = $this->CashWithdraw->newEntity();
			
			if ($this->request->is('post')) {
				
				$vdr_acc = ACC_CASH;
				
				if ($this->request->data["CashWithdraw_mode"]==2){
					$vdr_acc =$this->request->data["VCH_DR_ACCOUNTS"];
				}
				
				
				$vcr_acc =$this->request->data["VCH_CR_ACCOUNTS"];
				if ($vdr_acc==$vcr_acc )
				{
							$this->set('CashWithdraw', $CashWithdraw);
								$this->Flash->error(__('You cannot select same account for CashWithdraw'));				
								return;
				}
	
				$ldg_table= TableRegistry::get('Ledgers');  //............................................
				$ldg = $ldg_table->get($vcr_acc);
				
				$paid_to= $ldg->LDG_CODE;
				
				$ldg =$ldg_table->get($vdr_acc);
				
				$paid_from= $ldg->LDG_CODE;
				
					echo $vcr_acc.','.$vdr_acc;
					
				$amount=($this->request->data["VCH_AMOUNT"]);
	
				
				if ($amount<=0)
				{
					$this->set('CashWithdraw', $CashWithdraw);
					$this->Flash->error(__('CashWithdraw Amount is not Correct'));				
					return;
				}
	
			
				$CashWithdraw = $this->CashWithdraw->patchEntity($CashWithdraw, $this->request->data);
				
			
				
				$full_des=$paid_from.'(Cr), '.$paid_to.'(Dr)';
				//echo $full_des;
				//exit();
	//			$OfficeExpenses->VCH_DR_ACCOUNTS=ACC_CASH;			
				$CashWithdraw->VCH_DR_ACCOUNTS=$vdr_acc;
				$CashWithdraw->VCH_FULL_DESCRIPTION=$full_des;
				
				//var_dump($CashWithdraw);
					//$vouchers->VCH_STATUS=0;
	
					
				$CashWithdraw->VCH_STATUS=STS_CREATE;
				$CashWithdraw->VCH_CREATE_BY=$user['USR_ID'];
				
				$CashWithdraw->VCH_TYPE=VCH_TYPE_BANK;
	
				$CashWithdraw->VCH_STATUS_BY=$user['USR_ID'];
				$CashWithdraw->VCH_LAST_EDIT_BY=$user['USR_ID'];
				$CashWithdraw->VCH_SUBMIT_BY=$user['USR_ID'];
				

			
				
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
					
					$CashWithdraw->VCH_DATE=$pay_date;	
					$CashWithdraw->VCH_MONTH=$m;
					$CashWithdraw->VCH_YEAR=$y;
				}
				else
				{
							$this->set('CashWithdraw', $CashWithdraw);
								$this->Flash->error(__('CashWithdraw Date is not specified'));				
								return;
				}
				$check_date = $this->request->data('check_date');
				if (strlen($check_date)>8){
				$CashWithdraw->VCH_CHEQUE_DESC = DateToDB($check_date.'-','-');;
				}
	
					
							
				$CashWithdraw->VCH_FULL_DESCRIPTION=$full_des;
				
				//	$vouchers->VCH_FULL_DESCRIPTION=$full_des;
				
					
					
					
					 if ($this->CashWithdraw->save($CashWithdraw)) {
	
				  
	
					
					$id = $CashWithdraw->VCH_ID;  //data call from table
					$new_id=$id;
					
							
	
				$CashWithdraw=$this->CashWithdraw->get($id);
				$CashWithdraw->VCH_NO_FULL = $year.$month.'0000'.$id;
				$this->CashWithdraw->save($CashWithdraw);
				$vch_Full=$CashWithdraw->VCH_NO_FULL;
	
					//$VCH_AMOUNT = $CashWithdraw->VCH_AMOUNT;
					
					
					
						
	
					
					 $Voucherdtl = $this->CashWithdraw->Voucherdtl->newEntity();
					 
						$Voucherdtl->VCH_ID=$new_id;
						$Voucherdtl->VDT_DATE=$pay_date;
						$Voucherdtl->VDT_VOUCHER_NO=$vch_Full;
						$Voucherdtl->VDT_LOT=1;
						$Voucherdtl->VDT_SR=1;
						$Voucherdtl->VDT_LDG_ID=$vcr_acc;   //..................................................
						
						$Voucherdtl->VDT_DEBIT=0;
						$Voucherdtl->VDT_CREDIT=$amount;
						$Voucherdtl->VDT_PROJECT=$project;
						
						$Voucherdtl->VDT_DEPARTMENT=$department;
						$this->CashWithdraw->Voucherdtl->save($Voucherdtl);
						
						
						
						
						
						$Voucherdt2 = $this->CashWithdraw->Voucherdtl->newEntity();
						
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
						$this->CashWithdraw->Voucherdtl->save($Voucherdt2);
					
					
					
					
					/*          if ($this->request->data["CONTINUE"]!=0)
				  {
						$this->Flash->success(__('Voucher : '.$vch_Full.' [ Amount = '.$amount.']  has been saved.'));
					  return $this->redirect(array('action' => 'add'));
					  
				  }
				  else
				  {*/
					  return $this->redirect(array('controller' => 'BankTrans', 'action' => 'index'));
				// }
	
					
				}
				$this->Flash->error(__('Unable to add your article.'));
			}
			$this->set('CashWithdraw', $CashWithdraw);
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
		
		$query=$this->CashWithdraw->Ledgers->find('list',['keyField' => ['LDG_ID'],'valueField' => 'LDG_NAME'])->where(['LDG_TYPES like ' =>'%BNK%']);
		$bank_name= $query->toArray();
		$this->set(compact('bank_name'));
		
		
			
        $CashWithdraw = $this->CashWithdraw->get($id);
		
				/*$pay_date = date_format($CashWithdraw->VCH_DATE,'d-m-Y');
				$CashWithdraw->VCH_DATE=$pay_date;
				$this->set(compact('pay_date'));*/
				
				$CashWithdraw->pay_date=date('d-m-Y',strtotime($CashWithdraw->VCH_DATE));
				
				
				
				$ck_date = $CashWithdraw->VCH_CHEQUE_DESC;
				if(strlen($ck_date)>8)
				{
					$ck_date = explode('-', $ck_date);
					$d = $ck_date[2];
					$m = $ck_date[1];
					$y = $ck_date[0];
					$ck_date =  $d.'-'.$m.'-'.$y;
					
					$CashWithdraw->VCH_CHEQUE_DESC = $ck_date;
				}
				else{
				$ck_date='';	
				}
				//$check_date = $ck_date;
				$this->set(compact('ck_date'));
				
				
				
        if ($this->request->is(['post','put'])) {
				
			$vcr_acc = ACC_CASH;
			if ($this->request->data["CashWithdraw_mode"]==2){
				$vdr_acc =$this->request->data["VCH_DR_ACCOUNTS"];
			}
			$vcr_acc=$this->request->data["VCH_CR_ACCOUNTS"];
				
			if ($vdr_acc ==$vcr_acc)
			{
				        $this->set('CashWithdraw', $CashWithdraw);
				            $this->Flash->error(__('You cannot select same account for CashWithdraw'));				
							return;
			}

			
			$amount=($this->request->data["VCH_AMOUNT"]);
			
			if ($amount<=0)
			{
				        $this->set('CashWithdraw', $CashWithdraw);
				            $this->Flash->error(__('CashWithdraw Amount is not Correct'));				
							return;
			}

			
            $CashWithdraw = $this->CashWithdraw->patchEntity($CashWithdraw, $this->request->data);
			
			//var_dump($CashWithdraw);
				//$vouchers->VCH_STATUS=0;
			$CashWithdraw->VCH_STATUS=STS_EDIT;
			
			$CashWithdraw->VCH_TYPE=VCH_TYPE_BANK;

			$CashWithdraw->VCH_STATUS_BY=$user['USR_ID'];
			$CashWithdraw->VCH_LAST_EDIT_BY=$user['USR_ID'];
			$CashWithdraw->VCH_SUBMIT_BY=$user['USR_ID'];
			
			$CashWithdraw->VCH_CR_ACCOUNTS=$vcr_acc;
		


			$vdr_acc=$CashWithdraw->VCH_DR_ACCOUNTS;
			
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
				
				$CashWithdraw->VCH_DATE=$pay_date;	
				
				$CashWithdraw->VCH_MONTH=$m;
				$CashWithdraw->VCH_YEAR=$y;
			}
			else
			{
				        $this->set('CashWithdraw', $CashWithdraw);
				            $this->Flash->error(__('CashWithdraw Date is not specified'));				
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
				$CashWithdraw->VCH_CHEQUE_DESC = $ck_date;
			
			}
			
				
					
//				$vch_Full=$year.$month.'0000'.$b;
				
	//			$CashWithdraw->VCH_NO_FULL=$vch_Full;
				
			
							$ldg_table= TableRegistry::get('Ledgers');
			$ldg = $ldg_table->get($vcr_acc);
			
			$paid_to= $ldg->LDG_CODE;
			
			$ldg =$ldg_table->get($vdr_acc);
			
			$paid_from= $ldg->LDG_CODE;

				$full_des=$paid_from.'(Cr), '.$paid_to.'(Dr)';				
				$CashWithdraw->VCH_FULL_DESCRIPTION=$full_des;
				 if ($this->CashWithdraw->save($CashWithdraw)) {				

				$project=$CashWithdraw->VCH_PROJECT;

				$department=$CashWithdraw->VCH_DEPARTMENT;
				
				/*echo "kdfjkf";
				exit();*/
					if ($this->CashWithdraw->Voucherdtl->deleteAll(['VCH_ID' =>$id])){
						
									$VCH_NO = $CashWithdraw->VCH_NO_FULL; 
									$new_id= $CashWithdraw->VCH_ID;  //data call from table

									
									
									//insert data in another table
					
									
									 $Voucherdtl = $this->CashWithdraw->Voucherdtl->newEntity();
									 
										$Voucherdtl->VCH_ID=$new_id;
										$Voucherdtl->VDT_DATE=$pay_date;
										$Voucherdtl->VDT_VOUCHER_NO=$VCH_NO;
										$Voucherdtl->VDT_DESCRIPTION=$CashWithdraw->VCH_NARRATION;
										$Voucherdtl->VDT_CREATE_BY=$user['USR_ID'];;
										$Voucherdtl->VDT_LOT=1;
										$Voucherdtl->VDT_SR=1;
										$Voucherdtl->VDT_LDG_ID=$vdr_acc;  //.....................................................
										
										$Voucherdtl->VDT_DEBIT=0;
										$Voucherdtl->VDT_CREDIT=$amount;
										$Voucherdtl->VDT_PROJECT=$project;
		
										$Voucherdtl->VDT_DEPARTMENT=$department;
										$this->CashWithdraw->Voucherdtl->save($Voucherdtl);
										
										$Voucherdt2 = $this->CashWithdraw->Voucherdtl->newEntity();
										
										$Voucherdt2->VCH_ID=$new_id;
										$Voucherdt2->VDT_DATE=$pay_date;
										$Voucherdt2->VDT_VOUCHER_NO=$VCH_NO;
										$Voucherdt2->VDT_LOT=1;
										$Voucherdt2->VDT_SR=2;
										$Voucherdt2->VDT_LDG_ID=$vcr_acc;
										
										$Voucherdt2->VDT_DEBIT=$amount;
										$Voucherdt2->VDT_CREDIT=0;
											$Voucherdt2->VDT_PROJECT=$project;
		
										$Voucherdt2->VDT_DEPARTMENT=$department;
										$this->CashWithdraw->Voucherdtl->save($Voucherdt2);
									
														
										return $this->redirect(array('controller' => 'BankTrans', 'action' => 'index'));
						}
				
					return $this->redirect(['controller' => 'CashWithdraw', 'action' => 'index']);						
				
				}
				
				else
				{
					return $this->redirect(['controller' => 'CashWithdraw', 'action' => 'edit']);
				}
			$this->Flash->error(__('Unable to add your article.'));
        }
        $this->set('CashWithdraw', $CashWithdraw);
    }
		


	
	}
	
	
?>