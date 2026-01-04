<?php
	namespace App\Controller;
	
	use App\Controller\AppController;
	use Cake\Event\Event;
	use Cake\Network\Exception\NotFoundException;
	use Cake\ORM\TableRegistry;
	
	
	class BankTransController extends AppController{
		
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
			
			$this->set('BankTrans', $this->BankTrans->find('all')//->contain('Voucherdtl')
			->where(['VCH_TYPE' =>VCH_TYPE_BANK])
			->andWhere(['VCH_DATE >=' =>$sdate])
			->andWhere(['VCH_DATE <=' =>$edate])
			->andWhere(['VCH_STATUS !=' =>STS_DELETED])
			->order(['VCH_DATE' =>'DESC','VCH_ID' =>'DESC'])); 
		
		    $this->set(compact('sdate'));
			$this->set(compact('edate'));
			
			//$amount = ACC_CASH;
		
		}
		
		public function view($id = null){
			$BankTrans = $this->BankTrans->get($id);
			$this->set(compact('BankTrans'));
    	}
		
		
		
		
		
		public function add_dep()
		{
			$user = $this->Auth->User();
			
			$Basicdata = TableRegistry::get('Basicdata');
	
			$query=$Basicdata->find('list',['keyField' => ['BAS_ID'],'valueField' => 'BAS_NAME'])->where(['BAS_TYPE_ID' =>5]);
			$project = $query->toArray();
			$this->set(compact('project'));
			 
	
			
			$query=$Basicdata->find('list',['keyField' => ['BAS_ID'],'valueField' => 'BAS_NAME'])->where(['BAS_TYPE_ID' =>4]);
			$department = $query->toArray();
			$this->set(compact('department'));
			
			$query=$this->BankTrans->Ledgerstype->find('list',['keyField' => ['LDG_ID'],'valueField' => 'LDG_ID']);
		
		
		
			/*->where(['LTM_ID' =>4])
			->orWhere(['LTM_ID' =>6])
			->orWhere(['LTM_ID' =>7])
			->orWhere(['LTM_ID' =>2]);
		
			$pur=$query->toArray();*/
			
			$query=$this->BankTrans->Ledgers->find('list',['keyField' => ['LDG_ID'],'valueField' => 'LDG_NAME'])
			->where(['LDG_TYPES like ' =>'%BNK%'])
			->order(['LDG_NAME'=>'ASC']);
			$bank_name = $query->toArray();
			$this->set(compact('bank_name'));
		
		
			/*$query=$this->BankTrans->Ledgers->find('list',['keyField' => ['LDG_ID'],'valueField' => 'LDG_NAME']);
			$bank_name1 = $query->toArray();
			$this->set(compact('bank_name1'));*/
	
					/*$x =5;
					$this->set(compact('x'));*/
			
			
			$BankTrans = $this->BankTrans->newEntity();
			
			if ($this->request->is('post')) {
				
				$vcr_acc = ACC_CASH;
				
				if ($this->request->data["BankTrans_mode"]==2){
					$vcr_acc =$this->request->data["VCH_CR_ACCOUNTS"];
				}
				
				
				$vdr_acc =$this->request->data["VCH_DR_ACCOUNTS"];
				if ($vdr_acc ==$vcr_acc )
				{
							$this->set('BankTrans', $BankTrans);
								$this->Flash->error(__('You cannot select same account for BankTrans'));				
								return;
				}
	
				$ldg_table= TableRegistry::get('Ledgers');
				$ldg = $ldg_table->get($vdr_acc);
				$dr_acc_name=$ldg->LDG_NAME;
				$paid_to= $ldg->LDG_CODE;
				
				$ldg =$ldg_table->get($vcr_acc);
				
				$paid_from= $ldg->LDG_CODE;
				$cr_acc_name=$ldg->LDG_NAME;
					
				$amount=($this->request->data["VCH_AMOUNT"]);
	
				
				if ($amount<=0)
				{
					$this->set('BankTrans', $BankTrans);
					$this->Flash->error(__('BankTrans Amount is not Correct'));				
					return;
				}
	
				$BankTrans = $this->BankTrans->patchEntity($BankTrans, $this->request->data);
				
			
				
				$full_des=$paid_from.'(Cr), '.$paid_to.'(Dr)';
	//			$OfficeExpenses->VCH_DR_ACCOUNTS=ACC_CASH;			
				$BankTrans->VCH_CR_ACCOUNTS=$vcr_acc;
				$BankTrans->ACC_CR_NAME=$cr_acc_name;
				$BankTrans->ACC_DR_NAME=$dr_acc_name;
				$BankTrans->VCH_FULL_DESCRIPTION=$full_des;
				
				//var_dump($BankTrans);
					//$vouchers->VCH_STATUS=0;
	
					
				$BankTrans->VCH_STATUS=STS_CREATE;
				$BankTrans->VCH_CREATE_BY=$user['USR_ID'];
				
				$BankTrans->VCH_TYPE=VCH_TYPE_BANK;
	
				$BankTrans->VCH_STATUS_BY=$user['USR_ID'];
				$BankTrans->VCH_LAST_EDIT_BY=$user['USR_ID'];
				$BankTrans->VCH_SUBMIT_BY=$user['USR_ID'];
				
				$BankTrans->VCH_CR_ACCOUNTS=$vcr_acc;
			
				
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
					
					$BankTrans->VCH_DATE=$pay_date;	
					$BankTrans->VCH_MONTH=$m;
					$BankTrans->VCH_YEAR=$y;
				}
				else
				{
							$this->set('BankTrans', $BankTrans);
								$this->Flash->error(__('BankTrans Date is not specified'));				
								return;
				}
				$check_date = $this->request->data('check_date');
				if (strlen($check_date)>8){
				$BankTrans->VCH_CHEQUE_DESC = DateToDB($check_date.'-','-');;
				}
	
					
							
				$BankTrans->VCH_FULL_DESCRIPTION=$full_des;
				
				//	$vouchers->VCH_FULL_DESCRIPTION=$full_des;
				
					
					
					
					 if ($this->BankTrans->save($BankTrans)) {
	
				  
	
					
					$id = $BankTrans->VCH_ID;  //data call from table
					$new_id=$id;
					
							
	
				$BankTrans=$this->BankTrans->get($id);


				$vch_Full=$BankTrans->VCH_NO_FULL;
	
					//$VCH_AMOUNT = $BankTrans->VCH_AMOUNT;
					
					
					
						
	
					
					 $Voucherdtl = $this->BankTrans->Voucherdtl->newEntity();
					 
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
						$this->BankTrans->Voucherdtl->save($Voucherdtl);
						
						
						
						
						
						$Voucherdt2 = $this->BankTrans->Voucherdtl->newEntity();
						
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
						$this->BankTrans->Voucherdtl->save($Voucherdt2);
					
					
					
					
					 if ($this->request->data["CONTINUE"]!=0)
			  {
				    $this->Flash->success(__('Voucher : '.$vch_Full.' [ Amount = '.$amount.']  has been saved.'));
				  return $this->redirect(array('action' => 'add_dep'));
				  
			  }
			  else
			  {
				  return $this->redirect(array('action' => 'index'));
			  }
				
				
				
	
					
				}
				$this->Flash->error(__('Unable to add your article.'));
			}
			$this->set('BankTrans', $BankTrans);
    	}
	
	
	
	
	
	
		public function edit_dep($id=null)
		{
			$user = $this->Auth->User();
			
			$Basicdata = TableRegistry::get('Basicdata');
	
			$query=$Basicdata->find('list',['keyField' => ['BAS_ID'],'valueField' => 'BAS_NAME'])->where(['BAS_TYPE_ID' =>5]);
			$project = $query->toArray();
			$this->set(compact('project'));
			 
	
			
			$query=$Basicdata->find('list',['keyField' => ['BAS_ID'],'valueField' => 'BAS_NAME'])->where(['BAS_TYPE_ID' =>4]);
			$department = $query->toArray();
			$this->set(compact('department'));
			
			$query=$this->BankTrans->Ledgerstype->find('list',['keyField' => ['LDG_ID'],'valueField' => 'LDG_ID']);
		
		
		
			/*->where(['LTM_ID' =>4])
			->orWhere(['LTM_ID' =>6])
			->orWhere(['LTM_ID' =>7])
			->orWhere(['LTM_ID' =>2]);
		
			$pur=$query->toArray();*/
			
			$query=$this->BankTrans->Ledgers->find('list',['keyField' => ['LDG_ID'],'valueField' => 'LDG_NAME'])
			->where(['LDG_TYPES like ' =>'%BNK%'])
			->order(['LDG_NAME'=>'ASC']);
			$bank_name = $query->toArray();
			$this->set(compact('bank_name'));
		
		
			/*$query=$this->BankTrans->Ledgers->find('list',['keyField' => ['LDG_ID'],'valueField' => 'LDG_NAME']);
			$bank_name1 = $query->toArray();
			$this->set(compact('bank_name1'));*/
	
					/*$x =5;
					$this->set(compact('x'));*/
			
			
			$BankTrans = $this->BankTrans->get($id);
			
			
			
			$BankTrans->pay_date=date('d-m-Y',	strtotime($BankTrans->VCH_DATE));

			
			if ($this->request->is(['post','put'])) {
				
				$vcr_acc = ACC_CASH;
				
			/*	if ($this->request->data["BankTrans_mode"]==2){
					$vcr_acc =$this->request->data["VCH_CR_ACCOUNTS"];
				}*/
				
				
				$vdr_acc =$this->request->data["VCH_DR_ACCOUNTS"];
				if ($vdr_acc ==$vcr_acc )
				{
							$this->set('BankTrans', $BankTrans);
								$this->Flash->error(__('You cannot select same account for BankTrans'));				
								return;
				}
	
				$ldg_table= TableRegistry::get('Ledgers');
				$ldg = $ldg_table->get($vdr_acc);
				$dr_acc_name=$ldg->LDG_NAME;
				$paid_to= $ldg->LDG_CODE;
				
				$ldg =$ldg_table->get($vcr_acc);
				
				$paid_from= $ldg->LDG_CODE;
				$cr_acc_name=$ldg->LDG_NAME;
					
				$amount=($this->request->data["VCH_AMOUNT"]);
	
				

			
				if ($amount<=0)
				{
					$this->set('BankTrans', $BankTrans);
					$this->Flash->error(__('BankTrans Amount is not Correct'));				
					return;
				}
	
				$BankTrans = $this->BankTrans->patchEntity($BankTrans, $this->request->data);
				

				
				$full_des=$paid_from.'(Cr), '.$paid_to.'(Dr)';
	//			$OfficeExpenses->VCH_DR_ACCOUNTS=ACC_CASH;			
				$BankTrans->VCH_CR_ACCOUNTS=$vcr_acc;
				$BankTrans->ACC_CR_NAME=$cr_acc_name;
				$BankTrans->ACC_DR_NAME=$dr_acc_name;
				$BankTrans->VCH_FULL_DESCRIPTION=$full_des;
				
				//var_dump($BankTrans);
					//$vouchers->VCH_STATUS=0;
	
					
				$BankTrans->VCH_STATUS=STS_EDIT;

				

	
				$BankTrans->VCH_STATUS_BY=$user['USR_ID'];
				$BankTrans->VCH_LAST_EDIT_BY=$user['USR_ID'];
				$BankTrans->VCH_SUBMIT_BY=$user['USR_ID'];
				
				$BankTrans->VCH_CR_ACCOUNTS=$vcr_acc;
			
				
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
					
					$BankTrans->VCH_DATE=$pay_date;	
					$BankTrans->VCH_MONTH=$m;
					$BankTrans->VCH_YEAR=$y;
				}
				else
				{
							$this->set('BankTrans', $BankTrans);
								$this->Flash->error(__('BankTrans Date is not specified'));				
								return;
				}
				$check_date = $this->request->data('check_date');
				if (strlen($check_date)>8){
				$BankTrans->VCH_CHEQUE_DESC = DateToDB($check_date.'-','-');;
				}
	
					
							
				$BankTrans->VCH_FULL_DESCRIPTION=$full_des;
				
				//	$vouchers->VCH_FULL_DESCRIPTION=$full_des;
				
					
					
					
					 if ($this->BankTrans->save($BankTrans)) {
	
				  
	
					
					$id = $BankTrans->VCH_ID;  //data call from table
					$new_id=$id;
					
							
	
				$BankTrans=$this->BankTrans->get($id);


				$vch_Full=$BankTrans->VCH_NO_FULL;
	
					//$VCH_AMOUNT = $BankTrans->VCH_AMOUNT;
					
					
					
						$this->BankTrans->Voucherdtl->deleteAll(['VCH_ID' =>$id]);
	
					
						 $Voucherdtl = $this->BankTrans->Voucherdtl->newEntity();
					 
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
						$this->BankTrans->Voucherdtl->save($Voucherdtl);
						
						
						
						
						
						$Voucherdt2 = $this->BankTrans->Voucherdtl->newEntity();
						
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
						$this->BankTrans->Voucherdtl->save($Voucherdt2);
					
					
					
					
				  return $this->redirect(array('action' => 'index'));

				
				
				
	
					
				}
				$this->Flash->error(__('Unable to add your article.'));
			}
			$this->set('BankTrans', $BankTrans);
    }
		




		public function add_with()
		{
			$user = $this->Auth->User();
			
			$Basicdata = TableRegistry::get('Basicdata');
	
			$query=$Basicdata->find('list',['keyField' => ['BAS_ID'],'valueField' => 'BAS_NAME'])->where(['BAS_TYPE_ID' =>5]);
			$project = $query->toArray();
			$this->set(compact('project'));
			 
	
			
			$query=$Basicdata->find('list',['keyField' => ['BAS_ID'],'valueField' => 'BAS_NAME'])->where(['BAS_TYPE_ID' =>4]);
			$department = $query->toArray();
			$this->set(compact('department'));
			
			$query=$this->BankTrans->Ledgerstype->find('list',['keyField' => ['LDG_ID'],'valueField' => 'LDG_ID']);
		
		
		
			/*->where(['LTM_ID' =>4])
			->orWhere(['LTM_ID' =>6])
			->orWhere(['LTM_ID' =>7])
			->orWhere(['LTM_ID' =>2]);
		
			$pur=$query->toArray();*/
			
			$query=$this->BankTrans->Ledgers->find('list',['keyField' => ['LDG_ID'],'valueField' => 'LDG_NAME'])
			->where(['LDG_TYPES like ' =>'%BNK%'])
			->order(['LDG_NAME'=>'ASC']);
			$bank_name = $query->toArray();
			$this->set(compact('bank_name'));
		
		
			/*$query=$this->BankTrans->Ledgers->find('list',['keyField' => ['LDG_ID'],'valueField' => 'LDG_NAME']);
			$bank_name1 = $query->toArray();
			$this->set(compact('bank_name1'));*/
	
					/*$x =5;
					$this->set(compact('x'));*/
			
			
			$BankTrans = $this->BankTrans->newEntity();
			
			if ($this->request->is('post')) {
				
				$vdr_acc = ACC_CASH;
				
				if ($this->request->data["BankTrans_mode"]==2){
					$vdr_acc =$this->request->data["VCH_DR_ACCOUNTS"];
				}
				
				
				$vcr_acc =$this->request->data["VCH_CR_ACCOUNTS"];
				if ($vdr_acc ==$vcr_acc )
				{
							$this->set('BankTrans', $BankTrans);
								$this->Flash->error(__('You cannot select same account for BankTrans'));				
								return;
				}
	
				$ldg_table= TableRegistry::get('Ledgers');
				$ldg = $ldg_table->get($vdr_acc);
				$dr_acc_name=$ldg->LDG_NAME;
				$dr_acc_code= $ldg->LDG_CODE;
				
				$ldg =$ldg_table->get($vcr_acc);
				
				$cr_acc_code= $ldg->LDG_CODE;
				$cr_acc_name=$ldg->LDG_NAME;
					
				$amount=($this->request->data["VCH_AMOUNT"]);
	
				
				if ($amount<=0)
				{
					$this->set('BankTrans', $BankTrans);
					$this->Flash->error(__('BankTrans Amount is not Correct'));				
					return;
				}
	
				$BankTrans = $this->BankTrans->patchEntity($BankTrans, $this->request->data);
				
			
				
				$full_des=$dr_acc_code.'(Dr), '.$cr_acc_code.'(Cr)';
	//			$OfficeExpenses->VCH_DR_ACCOUNTS=ACC_CASH;			
				$BankTrans->VCH_CR_ACCOUNTS=$vcr_acc;
				$BankTrans->ACC_CR_NAME=$cr_acc_name;
				$BankTrans->ACC_DR_NAME=$dr_acc_name;
				$BankTrans->VCH_FULL_DESCRIPTION=$full_des;
				
				//var_dump($BankTrans);
					//$vouchers->VCH_STATUS=0;
	
					
				$BankTrans->VCH_STATUS=STS_CREATE;
				$BankTrans->VCH_CREATE_BY=$user['USR_ID'];
				
				$BankTrans->VCH_TYPE=VCH_TYPE_BANK;
	
				$BankTrans->VCH_STATUS_BY=$user['USR_ID'];
				$BankTrans->VCH_LAST_EDIT_BY=$user['USR_ID'];
				$BankTrans->VCH_SUBMIT_BY=$user['USR_ID'];
				
				$BankTrans->VCH_DR_ACCOUNTS=$vdr_acc;
			
				
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
					
					$BankTrans->VCH_DATE=$pay_date;	
					$BankTrans->VCH_MONTH=$m;
					$BankTrans->VCH_YEAR=$y;
				}
				else
				{
							$this->set('BankTrans', $BankTrans);
								$this->Flash->error(__('BankTrans Date is not specified'));				
								return;
				}
				$check_date = $this->request->data('check_date');
				if (strlen($check_date)>8){
				$BankTrans->VCH_CHEQUE_DESC = DateToDB($check_date.'-','-');;
				}
	
					
							
				$BankTrans->VCH_FULL_DESCRIPTION=$full_des;
				
				//	$vouchers->VCH_FULL_DESCRIPTION=$full_des;
				
					
					
					
					 if ($this->BankTrans->save($BankTrans)) {
	
				  
	
					
					$id = $BankTrans->VCH_ID;  //data call from table
					$new_id=$id;
					
							
	
				$BankTrans=$this->BankTrans->get($id);


				$vch_Full=$BankTrans->VCH_NO_FULL;
	
					//$VCH_AMOUNT = $BankTrans->VCH_AMOUNT;
					
					
					
						

					
					 $Voucherdtl = $this->BankTrans->Voucherdtl->newEntity();
					 
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
						$this->BankTrans->Voucherdtl->save($Voucherdtl);
						
						
						
						
						
						$Voucherdt2 = $this->BankTrans->Voucherdtl->newEntity();
						
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
						$this->BankTrans->Voucherdtl->save($Voucherdt2);
					
					
	
					
			 if ($this->request->data["CONTINUE"]!=0)
			  {
				    $this->Flash->success(__('Voucher : '.$vch_Full.' [ Amount = '.$amount.']  has been saved.'));
				  return $this->redirect(array('action' => 'add_dep'));
				  
			  }
			  else
			  {
				  return $this->redirect(array('action' => 'index'));
			  }
				
				
				
	
					
				}
				$this->Flash->error(__('Unable to add your article.'));
		}
	
			$this->set('BankTrans', $BankTrans);
    
	}

	
	
	public function edit_with($id){
				$user = $this->Auth->User();
		$Basicdata = TableRegistry::get('Basicdata');

		$query=$Basicdata->find('list',['keyField' => ['BAS_ID'],'valueField' => 'BAS_NAME'])->where(['BAS_TYPE_ID' =>5]);
		$project = $query->toArray();
		$this->set(compact('project'));
		 

		
		$query=$Basicdata->find('list',['keyField' => ['BAS_ID'],'valueField' => 'BAS_NAME'])->where(['BAS_TYPE_ID' =>4]);
		$department = $query->toArray();
		$this->set(compact('department'));
		
		$query=$this->BankTrans->Ledgers->find('list',['keyField' => ['LDG_ID'],'valueField' => 'LDG_NAME'])->where(['LDG_TYPES like ' =>'%BNK%']);
		$bank_name= $query->toArray();
		$this->set(compact('bank_name'));
		
		
			
        $BankTrans = $this->BankTrans->get($id);
		
				/*$pay_date = date_format($BankTrans->VCH_DATE,'d-m-Y');
				$BankTrans->VCH_DATE=$pay_date;
				$this->set(compact('pay_date'));*/
				
				$BankTrans->pay_date=date('d-m-Y',strtotime($BankTrans->VCH_DATE));
				
				
				
				$ck_date = $BankTrans->VCH_CHEQUE_DESC;
				if(strlen($ck_date)>8)
				{
					$ck_date = explode('-', $ck_date);
					$d = $ck_date[2];
					$m = $ck_date[1];
					$y = $ck_date[0];
					$ck_date =  $d.'-'.$m.'-'.$y;
					
					$BankTrans->VCH_CHEQUE_DESC = $ck_date;
				}
				else{
				$ck_date='';	
				}
				//$check_date = $ck_date;
				$this->set(compact('ck_date'));
				
				
				
        if ($this->request->is(['post','put'])) {
				
			$vdr_acc = ACC_CASH;
			/*if ($this->request->data["BankTrans_mode"]==2){
				$vdr_acc =$this->request->data["VCH_DR_ACCOUNTS"];
			}*/
			$vcr_acc=$this->request->data["VCH_CR_ACCOUNTS"];
				
			if ($vdr_acc ==$vcr_acc)
			{
				        $this->set('BankTrans', $BankTrans);
				            $this->Flash->error(__('You cannot select same account for BankTrans'));				
							return;
			}

			
			$amount=($this->request->data["VCH_AMOUNT"]);
			
			if ($amount<=0)
			{
				        $this->set('BankTrans', $BankTrans);
				            $this->Flash->error(__('BankTrans Amount is not Correct'));				
							return;
			}

			
            $BankTrans = $this->BankTrans->patchEntity($BankTrans, $this->request->data);
			
			//var_dump($BankTrans);
				//$vouchers->VCH_STATUS=0;
			$BankTrans->VCH_STATUS=STS_EDIT;
			
			$BankTrans->VCH_TYPE=VCH_TYPE_BANK;

			$BankTrans->VCH_STATUS_BY=$user['USR_ID'];
			$BankTrans->VCH_LAST_EDIT_BY=$user['USR_ID'];
			$BankTrans->VCH_SUBMIT_BY=$user['USR_ID'];
			
			$BankTrans->VCH_CR_ACCOUNTS=$vcr_acc;
		$BankTrans->VCH_DR_ACCOUNTS=$vdr_acc;


			$vdr_acc=$BankTrans->VCH_DR_ACCOUNTS;
			
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
				
				$BankTrans->VCH_DATE=$pay_date;	
				
				$BankTrans->VCH_MONTH=$m;
				$BankTrans->VCH_YEAR=$y;
			}
			else
			{
				        $this->set('BankTrans', $BankTrans);
				            $this->Flash->error(__('BankTrans Date is not specified'));				
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
				$BankTrans->VCH_CHEQUE_DESC = $ck_date;
			
			}
			
				
					
//				$vch_Full=$year.$month.'0000'.$b;
				
	//			$BankTrans->VCH_NO_FULL=$vch_Full;
				
			
				$ldg_table= TableRegistry::get('Ledgers');
				$ldg = $ldg_table->get($vcr_acc);
			
				$paid_to= $ldg->LDG_CODE;
			
				$ldg =$ldg_table->get($vdr_acc);
			
				$paid_from= $ldg->LDG_CODE;

				$full_des=$paid_from.'(Cr), '.$paid_to.'(Dr)';				
				$BankTrans->VCH_FULL_DESCRIPTION=$full_des;
				 if ($this->BankTrans->save($BankTrans)) {				

				$project=$BankTrans->VCH_PROJECT;

				$department=$BankTrans->VCH_DEPARTMENT;
				
				/*echo "kdfjkf";
				exit();*/
					if ($this->BankTrans->Voucherdtl->deleteAll(['VCH_ID' =>$id])){
						
									$VCH_NO = $BankTrans->VCH_NO_FULL; 
									$new_id= $BankTrans->VCH_ID;  //data call from table

									
									
									//insert data in another table
					
									
									 $Voucherdtl = $this->BankTrans->Voucherdtl->newEntity();
									 
										$Voucherdtl->VCH_ID=$new_id;
										$Voucherdtl->VDT_DATE=$pay_date;
										$Voucherdtl->VDT_VOUCHER_NO=$VCH_NO;
										$Voucherdtl->VDT_DESCRIPTION=$BankTrans->VCH_NARRATION;
										$Voucherdtl->VDT_CREATE_BY=$user['USR_ID'];;
										$Voucherdtl->VDT_LOT=1;
										$Voucherdtl->VDT_SR=1;
										$Voucherdtl->VDT_LDG_ID=$vcr_acc;  //.....................................................
										
										$Voucherdtl->VDT_DEBIT=0;
										$Voucherdtl->VDT_CREDIT=$amount;
										$Voucherdtl->VDT_PROJECT=$project;
		
										$Voucherdtl->VDT_DEPARTMENT=$department;
										$this->BankTrans->Voucherdtl->save($Voucherdtl);
										
										$Voucherdt2 = $this->BankTrans->Voucherdtl->newEntity();
										
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
										$this->BankTrans->Voucherdtl->save($Voucherdt2);
									
														
										
						}
				
					return $this->redirect(['controller' => 'BankTrans', 'action' => 'index']);						
				
				}
				
				else
				{
					return $this->redirect(['controller' => 'BankTrans', 'action' => 'edit']);
				}
			$this->Flash->error(__('Unable to add your article.'));
        }
        $this->set('BankTrans', $BankTrans);
    }
	public function delete($VCH_ID = null)
{
	
	
		$user = $this->Auth->User();	
    $BankTrans = $this->BankTrans->get($VCH_ID);
    if ($this->request->is(['post', 'put'])) {
		

		
		
        $this->BankTrans->patchEntity($BankTrans, $this->request->data);
		
		$BankTrans->VCH_STATUS=STS_DELETED;
			$BankTrans->VCH_STATUS_DATE=date('Y-m-d');
			$BankTrans->VCH_STATUS_BY=$user['USR_ID'];
        if ($this->BankTrans->save($BankTrans)) {
            $this->Flash->success(__('Your article has been updated.'));
            return $this->redirect(['action' => 'index']);
        }
        $this->Flash->error(__('Unable to update your article.'));
    }

    $this->set('BankTrans', $BankTrans);
}

	}
	
	
?>
