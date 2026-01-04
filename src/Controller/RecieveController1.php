<?php
	namespace App\Controller;
	
	use App\Controller\AppController;
	use Cake\Event\Event;
	use Cake\Network\Exception\NotFoundException;
	use Cake\ORM\TableRegistry;	
	
	
	class RecieveController extends AppController{
		
		public function index(){
			$this->set('Recieve', $this->Recieve->find('all')
			->where(['VCH_TYPE' =>VCH_TYPE_RECIEPT])
->order(['VCH_DATE' =>'DESC'])   ); 
    	}
		
		public function view($id = null){
			$Recieve = $this->Recieve->get($id);
			$this->set(compact('Recieve'));
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
		
		$query=$this->Recieve->Ledgerstype->find('list',['keyField' => ['LDG_ID'],'valueField' => 'LDG_ID']);
		
		
		
		/*->where(['LTM_ID' =>4])
		->orWhere(['LTM_ID' =>6])
		->orWhere(['LTM_ID' =>7])
    	->orWhere(['LTM_ID' =>2]);
	
		$pur=$query->toArray();*/
		
		$query=$this->Recieve->Ledgers->find('list',['keyField' => ['LDG_ID'],'valueField' => 'LDG_NAME']); //->where(['LDG_ID IN ' =>$pur]);
		$paid_to = $query->toArray();
		$this->set(compact('paid_to'));
		
		
				$query = $this->Recieve->find();
			$query->select(['max' => $query->func()->max('VCH_ID')]);

			$m_id=$query->toArray();
			$a=$m_id[0]['max'];
			$b=((int)$a)+1;
			
	
			
			
			
        $Recieve = $this->Recieve->newEntity();
        if ($this->request->is('post')) {
			
			$vcr_acc = 3;
			if ($this->request->data["payment_mode"]==2){
				$vcr_acc =$this->request->data["VCH_CR_ACCOUNTS"];
			}
			
			$vdr_acc =$this->request->data["VCH_DR_ACCOUNTS"];
			
			$ldg = $this->Recieve->Ledgers->get($vdr_acc);
			
			$paid_to= $ldg->LDG_NAME;
			
			$ldg = $this->Recieve->Ledgers->get($vcr_acc);
			
			$paid_from= $ldg->LDG_NAME;
			
				
			$amount=($this->request->data["VCH_AMOUNT"]);
			
            $Recieve = $this->Recieve->patchEntity($Recieve, $this->request->data);
			
			//var_dump($Recieve);
				//$vouchers->VCH_STATUS=0;

				
					$Recieve->VCH_STATUS=STS_CREATE;
			$Recieve->VCH_CREATE_BY=$user['USR_ID'];
			
			$Recieve->VCH_TYPE=VCH_TYPE_RECIEPT;

			$Recieve->VCH_STATUS_BY=$user['USR_ID'];
			$Recieve->VCH_LAST_EDIT_BY=$user['USR_ID'];
			$Recieve->VCH_SUBMIT_BY=$user['USR_ID'];
			
				$Recieve->VCH_CR_ACCOUNTS=$vcr_acc;
		
			$vdr_acc=$Recieve->VCH_CR_ACCOUNTS;
			$pay_date=$this->request->data('pay_date');
			$vch_date = explode('-', $pay_date);
				$d = $vch_date[0];
				$m = $vch_date[1];
				$y = $vch_date[2];
				$month = $m;
				$year = $y;
				$pay_date = $y.'-'.$m.'-'.$d;
				
				$Recieve->VCH_DATE=$pay_date;	
				
				
			$check_date = $this->request->data('check_date');
			if($check_date !='')
			{
			$exp_check_date = explode('-', $check_date);
				$d = $exp_check_date[0];
				$m = $exp_check_date[1];
				$y = $exp_check_date[2];
				
				$check_date = $y.'-'.$m.'-'.$d;
				$Recieve->VCH_CHEQUE_DESC = $check_date;
			}
			
			
				
					
				$vch_Full=$year.$month.'0000'.$b;
				
				$Recieve->VCH_NO_FULL=$vch_Full;
				
				$narration=$this->request->data('VCH_FULL_DESCRIPTION');
				
				

			
			
			$full_des=$paid_to.','.$paid_from.','.$narration;
			
			$Recieve->VCH_FULL_DESCRIPTION=$full_des;
			
			//	$vouchers->VCH_FULL_DESCRIPTION=$full_des;
			
				
				
				
				 if ($this->Recieve->save($Recieve)) {
                $this->Flash->success(__('The vouchers has been saved.'));
              
			
				
				
				//$VCH_AMOUNT = $Recieve->VCH_AMOUNT;
				
				
				
				$VCH_NO = $Recieve->VCH_NO_FULL; 
				$id = $Recieve->VCH_ID;  //data call from table
				$new_id=$id;
				//insert data in another table

				
				 $Voucherdtl = $this->Recieve->Voucherdtl->newEntity();
				 
					$Voucherdtl->VCH_ID=$new_id;
					$Voucherdtl->VDT_DATE=$pay_date;
					$Voucherdtl->VDT_VOUCHER_NO=$VCH_NO;
					$Voucherdtl->VDT_LOT=1;
					$Voucherdtl->VDT_SR=1;
					$Voucherdtl->VDT_LDG_ID=$vcr_acc;
					
					$Voucherdtl->VDT_DEBIT=$amount;
					$Voucherdtl->VDT_CREDIT=0;
					
					$this->Recieve->Voucherdtl->save($Voucherdtl);
					
					
					
					
					
					$Voucherdt2 = $this->Recieve->Voucherdtl->newEntity();
					
					$Voucherdt2->VCH_ID=$new_id;
					$Voucherdt2->VDT_DATE=$pay_date;
					$Voucherdt2->VDT_VOUCHER_NO=$VCH_NO;
					$Voucherdt2->VDT_LOT=1;
					$Voucherdt2->VDT_SR=2;
					$Voucherdt2->VDT_LDG_ID=$vdr_acc;
					
					$Voucherdt2->VDT_DEBIT=0;
					$Voucherdt2->VDT_CREDIT=$amount;
					
					$this->Recieve->Voucherdtl->save($Voucherdt2);
				
				
				
				
                $this->Flash->success(__('Your Recieve has been saved.'));
								
				return $this->redirect(['controller' => 'Recieve', 'action' => 'index']);
				
            }
            $this->Flash->error(__('Unable to add your article.'));
        }
        $this->set('Recieve', $Recieve);
    }
	
	
	
	
	
	
	public function edit($id){
			
		$Basicdata = TableRegistry::get('Basicdata');

		$query=$Basicdata->find('list',['keyField' => ['BAS_ID'],'valueField' => 'BAS_NAME'])->where(['BAS_TYPE_ID' =>5]);
		$project = $query->toArray();
		$this->set(compact('project'));
		 

		
		$query=$Basicdata->find('list',['keyField' => ['BAS_ID'],'valueField' => 'BAS_NAME'])->where(['BAS_TYPE_ID' =>4]);
		$department = $query->toArray();
		$this->set(compact('department'));
		
		$query=$this->Recieve->Ledgerstype->find('list',['keyField' => ['LDG_ID'],'valueField' => 'LDG_ID'])
		
		->where(['LTM_ID' =>4])
		->orWhere(['LTM_ID' =>6])
		->orWhere(['LTM_ID' =>7])
    	->orWhere(['LTM_ID' =>2]);
	
		$pur=$query->toArray();
		
		$query=$this->Recieve->Ledgers->find('list',['keyField' => ['LDG_ID'],'valueField' => 'LDG_NAME'])->where(['LDG_ID IN ' =>$pur]);
		$paid_to = $query->toArray();
		$this->set(compact('paid_to'));
		
		
			
			
			
			
			
			
			
        $Recieve = $this->Recieve->get($id);
		
				$pay_date = date_format($Recieve->VCH_DATE,'d-m-Y');
				$Recieve->VCH_DATE=$pay_date;
				$this->set(compact('pay_date'));
				
				
				
				$ck_date = $Recieve->VCH_CHEQUE_DESC;
				$ck_date = explode('-', $ck_date);
				$d = $ck_date[2];
				$m = $ck_date[1];
				$y = $ck_date[0];
				$ck_date =  $d.'-'.$m.'-'.$y;
				
				$Recieve->VCH_CHEQUE_DESC = $ck_date;
				//$check_date = $ck_date;
				$this->set(compact('ck_date'));
				
				
				
        if ($this->request->is(['post','put'])) {
				
			$vcr_acc = 3;
			if ($this->request->data["Recieve_mode"]==2){
				$vcr_acc =$this->request->data["VCH_CR_ACCOUNTS"];
			}
			
			
			
			
			$amount=($this->request->data["VCH_AMOUNT"]);
			
            $Recieve = $this->Recieve->patchEntity($Recieve, $this->request->data);
			
			//var_dump($Recieve);
				//$vouchers->VCH_STATUS=0;
					$Recieve->VCH_STATUS=STS_EDIT;
			
			$Recieve->VCH_TYPE=VCH_TYPE_Recieve;

			$Recieve->VCH_STATUS_BY=$user['USR_ID'];
			$Recieve->VCH_LAST_EDIT_BY=$user['USR_ID'];
			$Recieve->VCH_SUBMIT_BY=$user['USR_ID'];
			
				$Recieve->VCH_CR_ACCOUNTS=$vcr_acc;
		


			$vdr_acc=$Recieve->VCH_DR_ACCOUNTS;
			
			$pay_date=$this->request->data('pay_date');
			$vch_date = explode('-', $pay_date);
				$d = $vch_date[0];
				$m = $vch_date[1];
				$y = $vch_date[2];
				$month = $m;
				$year = $y;
				$pay_date = $y.'-'.$m.'-'.$d;
				
				$Recieve->VCH_DATE=$pay_date;	
				
				
			$ck_date = $this->request->data('check_date');
			$exp_check_date = explode('-', $ck_date);
				$d = $exp_check_date[0];
				$m = $exp_check_date[1];
				$y = $exp_check_date[2];
				
				$ck_date = $y.'-'.$m.'-'.$d;
				$Recieve->VCH_CHEQUE_DESC = $ck_date;
			
			
			
				
					
//				$vch_Full=$year.$month.'0000'.$b;
				
	//			$Recieve->VCH_NO_FULL=$vch_Full;
				
				$narration=$this->request->data('VCH_FULL_DESCRIPTION');
				
				
				$full_des=$narration;
			
				$Recieve->VCH_FULL_DESCRIPTION=$full_des;
			
				
				

				 if ($this->Recieve->save($Recieve)) {				
					$this->Flash->success(__('Your Recieve has been saved.'));					
				
				
				/*echo "kdfjkf";
				exit();*/
					if ($this->Recieve->Voucherdtl->deleteAll(['VCH_ID' =>$id])){
						
									$VCH_NO = $Recieve->VCH_NO_FULL; 
									$id = $Recieve->VCH_ID;  //data call from table
									$new_id=$id;
									
									
									//insert data in another table
					
									
									 $Voucherdtl = $this->Recieve->Voucherdtl->newEntity();
									 
										$Voucherdtl->VCH_ID=$new_id;
										$Voucherdtl->VDT_DATE=$pay_date;
										$Voucherdtl->VDT_VOUCHER_NO=$VCH_NO;
										$Voucherdtl->VDT_LOT=1;
										$Voucherdtl->VDT_SR=1;
										$Voucherdtl->VDT_LDG_ID=$vcr_acc;
										
										$Voucherdtl->VDT_DEBIT=0;
										$Voucherdtl->VDT_CREDIT=$amount;
										
										$this->Recieve->Voucherdtl->save($Voucherdtl);
										
										
										
										
										
										$Voucherdt2 = $this->Recieve->Voucherdtl->newEntity();
										
										$Voucherdt2->VCH_ID=$new_id;
										$Voucherdt2->VDT_DATE=$pay_date;
										$Voucherdt2->VDT_VOUCHER_NO=$VCH_NO;
										$Voucherdt2->VDT_LOT=1;
										$Voucherdt2->VDT_SR=2;
										$Voucherdt2->VDT_LDG_ID=$vdr_acc;
										
										$Voucherdt2->VDT_DEBIT=$amount;
										$Voucherdt2->VDT_CREDIT=0;
										
										$this->Recieve->Voucherdtl->save($Voucherdt2);
									
									
									
									
										$this->Flash->success(__('Your Recieve has been saved.'));
														
										return $this->redirect(['controller' => 'Recieve', 'action' => 'index']);
						}
				
					return $this->redirect(['controller' => 'Recieve', 'action' => 'index']);						
				
				}
				
				
				
				
				
				
				
				else
				{
					return $this->redirect(['controller' => 'Recieve', 'action' => 'edit']);
				}
			$this->Flash->error(__('Unable to add your article.'));
        }
        $this->set('Recieve', $Recieve);
    }
		
		
		
	
	
	
	
	
	
	
	
		
		
		
	
	}
?>