<?php
	namespace App\Controller;
		use Cake\ORM\TableRegistry;	
	class  DashboardController extends AppController{
		
/*		var $uses=array ('CompanyRoot', 'CompanyInfo', 'CompanyBranch');
		public $helpers = array('Html', 'Form', 'Session');
		public $components = array('Session');*/
		
		
		
		public function index(){
			
			
			  $jurnal = $this->Dashboard->find('all')
			->where(['VCH_TYPE' =>VCH_TYPE_JOURNAL])
			->andWhere(['VCH_STATUS !=' =>STS_DELETED])
			->andWhere(['VCH_DATE >=' =>date('Y-m-d')]);
     $this->set(compact('jurnal'));
			
				$purchase = $this->Dashboard->find('all')
			->where(['VCH_TYPE' =>VCH_TYPE_PURCHASE])
				->andWhere(['VCH_STATUS !=' =>STS_DELETED])
			->andWhere(['VCH_DATE >=' =>date('Y-m-d')]);
     $this->set(compact('purchase'));
	 
	 $sales = $this->Dashboard->find('all')
			->where(['VCH_TYPE' =>VCH_TYPE_SALES])
				->andWhere(['VCH_STATUS !=' =>STS_DELETED])
			->andWhere(['VCH_DATE >=' =>date('Y-m-d')]);
     $this->set(compact('sales'));
	 
	  $paymeny = $this->Dashboard->find('all')
			->where(['VCH_TYPE' =>VCH_TYPE_PAYMENT])
				->andWhere(['VCH_STATUS !=' =>STS_DELETED])
			->andWhere(['VCH_DATE >=' =>date('Y-m-d')]);
     $this->set(compact('paymeny'));
	 
	  $receipt = $this->Dashboard->find('all')
			->where(['VCH_TYPE' =>VCH_TYPE_RECIEPT])
				->andWhere(['VCH_STATUS !=' =>STS_DELETED])
			->andWhere(['VCH_DATE >=' =>date('Y-m-d')]);
     $this->set(compact('receipt'));
	 
	  $salary = $this->Dashboard->find('all')
			->where(['VCH_TYPE' =>VCH_TYPE_SALARY])
				->andWhere(['VCH_STATUS !=' =>STS_DELETED])
			->andWhere(['VCH_DATE >=' =>date('Y-m-d')]);
     $this->set(compact('salary'));
	 
	  $adjustment = $this->Dashboard->find('all')
			->where(['VCH_TYPE' =>VCH_TYPE_ADJUSTMENT]);
     $this->set(compact('adjustment'));
	 
	  $type_expense = $this->Dashboard->find('all')
			->where(['VCH_TYPE' =>VCH_TYPE_EXPENSE])	
			->andWhere(['VCH_STATUS !=' =>STS_DELETED])
			->andWhere(['VCH_DATE >=' =>date('Y-m-d')]);
     $this->set(compact('type_expense'));
	 

/*report*/




 
	
	
	
		}
		
	
		
		
		public function search()
		{
			
		
		
		


$query=$this->Dashboard->Ledgers->find('list',['keyField' => 'LDG_ID','valueField' => 'LDG_NAME']);

$LDG_name = $query->toArray();

$this->set(compact('LDG_name'));

		if ($this->request->is(['post','put'])) 
		
			{
		$id=($this->request->data["name"]);
				
		$date_from=($this->request->data["date_from"]);
		
		$date_1 = explode('-', $date_from);
						$d = $date_1[0];
						$m = $date_1[1];
						$y = $date_1[2];
						$from_date = $y.'-'.$m.'-'.$d;
							
		$date_to=($this->request->data["date_to"]);
		
		$date_2 = explode('-', $date_to);
						$d = $date_2[0];
						$m = $date_2[1];
						$y = $date_2[2];
						$to_date = $y.'-'.$m.'-'.$d;
					
			$amount=($this->request->data["amount"]);
			
			if($id>0)
			{
				
					if($amount>0)
					{
						
						$query=$this->Dashboard->find('all')
						
						->where(['VCH_CR_ACCOUNTS' =>$id])
						
						->andWhere(['VCH_DATE >=' =>$from_date])
						->andWhere(['VCH_DATE <=' =>$to_date])
						->andWhere(['VCH_AMOUNT' =>$amount]);
					}
		
			else
					{
					
					$query=$this->Dashboard->find('all')
					
					->where(['VCH_CR_ACCOUNTS' =>$id])
					
					->andWhere(['VCH_DATE >=' =>$from_date])
					->andWhere(['VCH_DATE <=' =>$to_date]);
					
					
					}
			
					$search_result = $query->toArray();
					
					$this->set(compact('search_result'));
			}
			
			
			
			
			
			else
			
			{
				
				if($amount>0)
				{
	
		
			
			$query=$this->Dashboard->find('all')
			
			
			
			->where(['VCH_DATE >=' =>$from_date])
			->andWhere(['VCH_DATE <=' =>$to_date])
			->andWhere(['VCH_AMOUNT' =>$amount]);
			
			
			$search_result = $query->toArray();
			
			$this->set(compact('search_result'));
				}
				
				
				
				else
				{
	
	
			
			$query=$this->Dashboard->find('all')
			
			
			
			->where(['VCH_DATE >=' =>$from_date])
			->andWhere(['VCH_DATE <=' =>$to_date]);
			
			
			$search_result = $query->toArray();
			
			$this->set(compact('search_result'));
				}
				
			}
			
			
 }
		 
		 
		 
	
       $Dashboard = $this->Dashboard->newEntity();
        if ($this->request->is('post')) 
		{

	
            $Dashboard = $this->Dashboard->patchEntity($Dashboard, $this->request->data);
           /* if ($this->Ledgerbalance->save($OfficeExpenses)) 
			{
                $this->Flash->success(__('The user has been saved.'));
               return $this->redirect(array('action' => 'index'));
            }
            $this->Flash->error(__('Unable to add the user.'));*/
        }
        $this->set('Dashboard', $Dashboard);
    }


		
	
	
	
	public function approve($VCH_ID)
    {
		
		
				$user = $this->Auth->User();
				
			
				/*login id*/							
	$user_id=$user["USR_ID"];
	
	
				$this->set(compact('user'));
				
				$query=$this->Sales->Users->find('list',['keyField' => 'USR_ID','valueField' => 'username'])
					->where(['USR_ID !=' =>$user_id]);
				
				$user_name = $query->toArray();
				
				$this->set(compact('user_name'));
				
				
				
				$query=$this->Sales->Basicdata->find('list',['keyField' => 'BAS_ID','valueField' => 'BAS_NAME'])
				->where(['BAS_TYPE_ID' =>7])
				->andWhere(['BAS_ID' =>15]);
				
				$Usergroups = $query->toArray();
				
				$this->set(compact('Usergroups'));


				if (!$VCH_ID) 
				{
				throw new NotFoundException(__('Invalid user'));
				}



			
			$query=$this->Sales->Ledgerbalance->find('all')->contain('vouchers')
			->where(['vouchers.VCH_ID IN' =>$VCH_ID]); //->contain('Basicdata');
			$query->find('all')->contain('Project')->contain('Department')->contain('Ledgers');
			$vdt_id = $query->toArray();
			$this->set(compact('vdt_id'));
			
			
			
			
			$query = $this->Sales->Ledgerbalance->find();
			$query->select(['t_salary' => $query->func()->sum('VDT_DEBIT')])
			->where(['VCH_ID IN' =>$VCH_ID]);
			$total_debit=$query->toArray();
			$this->set(compact('total_debit'));
			$debit=$total_debit[0]->t_salary;
			$this->set(compact('debit'));



			$query = $this->Sales->Ledgerbalance->find();
			$query->select(['t_salary' => $query->func()->sum('VDT_CREDIT')])
			->where(['VCH_ID IN' =>$VCH_ID]);
			$total_credit=$query->toArray();
			$this->set(compact('total_credit'));
			
			$credit=$total_credit[0]->t_salary;
			
			$this->set(compact('credit'));
			
			$today=date('Y-m-d', strtotime('now'));

/*check*/



			
			$query=$this->Sales->voucherstatuslog->find('all')
			->where(['VCH_ID' =>$VCH_ID]); //->contain('Basicdata');
			$stslog = $query->toArray();
			$this->set(compact('stslog'));

	
	
		 
		  foreach($vdt_id as $a):
		   endforeach;
		
		 $vch_id=$a->voucher->VCH_ID;
		 

				 
						
		
	
			if ($this->request->is(['post','put'])) 
		
			{		
	
				$id=($this->request->data["name"]);
				
		
				  $TEXT=($this->request->data["TEXT"]);
				$ACC_TYPE=($this->request->data["ACC_TYPE"]);
				
									

		
							
								$voucherstatuslog=$this->Sales->voucherstatuslog->newEntity();

								
								$voucherstatuslog->VCH_ID=$vch_id;
								$voucherstatuslog->STS_ID=$ACC_TYPE;
								$voucherstatuslog->STS_DATE=$today;
								$voucherstatuslog->STS_BY=$user_id;
								$voucherstatuslog->STS_TEXT=$TEXT;
								$voucherstatuslog->STS_BY_TEXT='hi';
								$voucherstatuslog->STS_TO=$id;
								
	
	

	
			foreach($stslog as $b):
			endforeach;
			
		if(isset($b))
		{	  
			
				 $vch_insertid=$b->VCH_ID;
				 $insertid=$b->STS_BY;
			
	 
				
							
								if($user_id==$insertid)
								{
									
									if($VCH_ID==$vch_insertid)
									{
										echo "you already reported this voucher";
									}
									
									
								}
							
							
		}
									
							
									else
									{
									
										$this->Sales->voucherstatuslog->save($voucherstatuslog);


										/* voucher table*/
										
										
										$newvoucher = $this->Sales->get($VCH_ID);
										
        					$this->Sales->patchEntity($newvoucher, $this->request->data);
							
											$newvoucher->VCH_STATUS=$ACC_TYPE;
		 									$newvoucher->VCH_STATUS_BY=$user_id;
											$newvoucher->VCH_STATUS_DATE=$today;
											$newvoucher->VCH_STATUS_BY_TEXT=$TEXT;
										
										if ($this->Sales->save($newvoucher))
												{
												$this->Flash->success(__('Your article has been updated.'));
												return $this->redirect(['action' => 'index']);
												}
											
										}
									
										$this->Flash->error(__('Unable to update your article.'));
										
				}
				
    	}
	
	
		
	
	
	
	

	
	
  public function sendfor_approve($VCH_ID)
    {
		
	$user = $this->Auth->User();
	/*login id*/							
	$user_id=$user["USR_ID"];
							 		
			
		
		
						
						
						
						
	/*	$query=$this->Dashboard->Users->find('all')
						->where(['USR_ID' =>$user_id]);
						$usertable = $query->toArray();
						$this->set(compact('usertable'));
						
					$user_name=$usertable[0]["username"];*/
						
				
		
		
        if (!$VCH_ID) 
		{
            throw new NotFoundException(__('No Voucher Selected'));
        }
		
	
		 
		
		 $query=$this->Dashboard->vouchers
		->where(['VCH_ID IN' =>$VCH_ID]); //->contain('Basicdata');
		$query->find('all')->contain('Project')->contain('Department')->contain('Ledgers');
		 $voucher_info = $query->toArray();
		 $this->set(compact('voucher_info'));
		
		
		 
		
		$today=date('Y-m-d', strtotime('now'));
		
	/*check*/
	

			
	 $query=$this->Dashboard->voucherstatuslog->find('all')
		->where(['VCH_ID' =>$VCH_ID]); //->contain('Basicdata');
		$stslog = $query->toArray();
		 $this->set(compact('stslog'));
		 
		 
		


		   
		 
							
		
		if ($this->request->is(['post','put'])) 
		
			{

		  $TEXT=($this->request->data["TEXT"]);
		  $ACC_TYPE=($this->request->data["ACC_TYPE"]);
		  
		 
		  
		 
		   
		   if(isset($b))
		   {
	 $VCH_STS_ID=$b->VCH_STS_ID;
		
							
			$voucherstatuslog = $this->Sales->voucherstatuslog->get($VCH_STS_ID);
			
        	$this->Sales->voucherstatuslog->patchEntity($voucherstatuslog, $this->request->data);
							
										$voucherstatuslog->STS_ID=$ACC_TYPE;
										$voucherstatuslog->VCH_ID=$vch_id;
										$voucherstatuslog->STS_DATE=$today;
										$voucherstatuslog->STS_BY=$user_id;
										$voucherstatuslog->STS_TO=0;
									
								
								
									$this->Sales->voucherstatuslog->save($voucherstatuslog);
		   }
									
									
									/* voucher table*/
									
									
									$newvoucher = $this->Sales->get($vch_id);
   
        					$this->Sales->patchEntity($newvoucher, $this->request->data);
							
											$newvoucher->VCH_STATUS=$ACC_TYPE;
		 									$newvoucher->VCH_STATUS_BY=$user_id;
											$newvoucher->VCH_STATUS_DATE=$today;
											$newvoucher->VCH_STATUS_BY_TEXT=$user_name;
											
								$this->Sales->save($newvoucher) ;
								
								
								
								
								
								/*general_ledger*/
								
								
								
								$generalledger=$this->Sales->generalledger->newEntity();

								
								$generalledger->LDG_ID=$LDG_ID_1;
								$generalledger->LDG_NAME=$LDG_NAME_1;
								$generalledger->VCH_DATE=$VCH_DATE;
								$generalledger->VCH_CREATE_TIME=$VCH_DATE;
								$generalledger->VCH_CREATE_BY_ID=$VCH_CREATE_BY;
								$generalledger->VCH_CREATE_BY_TEXT=$VCH_CREATE_BY_TEXT;
								$generalledger->VCH_APPROVE_BY_ID=$VCH_APPROVE_BY_ID;
								
								$generalledger->VCH_ID=$VCH_ID;
								
								$generalledger->VCH_APPROVE_DATE=$VCH_APPROVE_DATE;
								$generalledger->VCH_APPROVE_BY_TEXT=$VCH_APPROVE_BY_TEXT;
								$generalledger->VCH_NARRATION=$VCH_NARRATION;
								$generalledger->VCH_INV=$VCH_INV;
								$generalledger->VCH_CHALAN=$VCH_CHALAN;
								$generalledger->VCH_MR=$VCH_MR_NO;
								$generalledger->VCH_CHEQUE=$VCH_CHEQUE;
								
								$generalledger->VCH_LDG_ID=$lgd_id_dr;
								$generalledger->VCH_LDG_NAME=$LDG_NAME_2;
							
								
								if($debit>0)
								{
								
									
								$generalledger->VCH_DEBIT=$debit;
								$generalledger->VCH_CREDIT=0;
								}
								
								if($credit>0)
								{
								
								$generalledger->VCH_DEBIT=0;
								$generalledger->VCH_CREDIT=$credit;
								}
							
								
								if($VDT_DEBIT>0)
								{
								
								$generalledger->VCH_BALANE_DR=0;
								$generalledger->VCH_BALANE_CR=$VCH_AMOUNT;
								}
								
								if($VDT_CREDIT>0)
								{
								
								$generalledger->VCH_BALANE_DR=$VCH_AMOUNT;
								$generalledger->VCH_BALANE_CR=0;
								}
								
								$generalledger->VCH_DESCRIPTION=$VCH_DESCRIPTION;
								
							
		
							
									if($ACC_TYPE==16)
									{
								$this->Sales->generalledger->save($generalledger);
									
									
									
										
								$generalledger=$this->Sales->generalledger->newEntity();

								
								$generalledger->LDG_ID=$LDG_ID_2;
								$generalledger->LDG_NAME=$LDG_NAME_2;
								$generalledger->VCH_DATE=$VCH_DATE;
								$generalledger->VCH_CREATE_TIME=$VCH_DATE;
								$generalledger->VCH_CREATE_BY_ID=$VCH_CREATE_BY;
								$generalledger->VCH_CREATE_BY_TEXT=$VCH_CREATE_BY_TEXT;
								$generalledger->VCH_APPROVE_BY_ID=$VCH_APPROVE_BY_ID;
								$generalledger->VCH_ID=$VCH_ID;
								$generalledger->VCH_APPROVE_DATE=$VCH_APPROVE_DATE;
								$generalledger->VCH_APPROVE_BY_TEXT=$VCH_APPROVE_BY_TEXT;
								$generalledger->VCH_NARRATION=$VCH_NARRATION;
								$generalledger->VCH_INV=$VCH_INV;
								$generalledger->VCH_CHALAN=$VCH_CHALAN;
								$generalledger->VCH_MR=$VCH_MR_NO;
								$generalledger->VCH_CHEQUE=$VCH_CHEQUE;
								
								$generalledger->VCH_LDG_ID=$lgd_id_dr;
								$generalledger->VCH_LDG_NAME=$LDG_NAME_1;
							
								if($debit>0)
								{
								
									
								$generalledger->VCH_DEBIT=$debit;
								$generalledger->VCH_CREDIT=0;
								}
								
								else
								{
								
								$generalledger->VCH_DEBIT=0;
								$generalledger->VCH_CREDIT=$credit;
								}
								
								if($VDT_DEBIT>0)
								{
								
								$generalledger->VCH_BALANE_DR=$VCH_AMOUNT;
								$generalledger->VCH_BALANE_CR=0;
								}
								
								if($VDT_CREDIT>0)
								{
								
								$generalledger->VCH_BALANE_DR=0;
								$generalledger->VCH_BALANE_CR=$VCH_AMOUNT;
								}
								
								$generalledger->VCH_DESCRIPTION=$VCH_DESCRIPTION;
								
							
		
							
								if($this->Sales->generalledger->save($generalledger))
								{
									
            $this->Flash->success(__('Your article has been updated.'));
            return $this->redirect(['action' => 'index']);
								}
        							
        $this->Flash->error(__('Unable to update your article.'));
									
									}
									
									
								
								
							
									
									
									else
									{
										
													
            $this->Flash->success(__('Your article has been updated.'));
            return $this->redirect(['action' => 'index']);
        						
        $this->Flash->error(__('Unable to update your article.'));
										
									}
								
					
			}
			
	}
	
	
	
	
				public function voucher_report1(){
			
			
			
			
			$user = $this->Auth->User();
			 $user_id=$user["USR_ID"];
			 $this->set(compact('user_id'));
		
		$today=date('Y-m-d', strtotime('now'));

		$Basicdata = TableRegistry::get('Basicdata');
			
			$query=$Basicdata->find('all')
			->where(['BAS_TYPE_ID' =>VCH_TYPE]);
		 
		 /*today*/
		 	$VOUCHER_TYPE= $query->toArray();

		$this->set(compact('VOUCHER_TYPE'));
		
		
			$query=$this->Dashboard->find('all')
			->where(['VCH_STATUS' =>16])
			->andWhere(['VCH_STATUS_DATE' =>$today]);
		$data=$query->select(['VCH_TYPE',
		't_salary' => $query->func()->sum('VCH_AMOUNT'),'t_type' => $query->func()->count('VCH_TYPE')])
		->group(['VCH_TYPE']);
		
		$today_voucher= $data->toArray();

		$this->set(compact('today_voucher'));
		
		
		
		
			$this_month = explode('-',$today);
			$day = $this_month[2];
			$month = $this_month[1];
			$year = $this_month[0];
			
			 // 'MONTH(date_created ) >='=> $month,
			
			
			
			/*this month*/
			
			
			
					$query=$this->Dashboard->find('all')
			->where(['VCH_STATUS' =>16])
			->andWhere(['MONTH(VCH_STATUS_DATE)' =>$month]);
		$data=$query->select(['VCH_TYPE',
		't_salary' => $query->func()->sum('VCH_AMOUNT'),'t_type' => $query->func()->count('VCH_TYPE')])
		->group(['VCH_TYPE']);

		$Month_Voucher = $data->toArray();
		$this->set(compact('Month_Voucher'));
		
		
		/*last month*/
		
		
		$last_month= date('Y-m-d', strtotime(date('Y-m')." -1 month"));
		$l_month = explode('-',$last_month);
		$l_month = $l_month[1];
		
		
					$query=$this->Dashboard->find('all')
			->where(['VCH_STATUS' =>16])
			->andWhere(['MONTH(VCH_STATUS_DATE)' =>$l_month]);
	
	
	

		$last_m_trial_balance = $data->toArray();
		$this->set(compact('last_m_trial_balance'));
		
		
		
		
		/*this year*/
	
			
				
					$query=$this->Dashboard->find('all')
			->where(['VCH_STATUS' =>16])
			->andWhere(['YEAR(VCH_STATUS_DATE)' =>$year]);
		$data=$query->select(['VCH_TYPE',
		't_salary' => $query->func()->sum('VCH_AMOUNT'),'t_type' => $query->func()->count('VCH_TYPE')])
		->group(['VCH_TYPE']);

		$this_y_trial_balance = $data->toArray();
		$this->set(compact('this_y_trial_balance'));
			
		
		

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