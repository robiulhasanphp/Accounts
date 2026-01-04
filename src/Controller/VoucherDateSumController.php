<?php
	namespace App\Controller;
	use Cake\Datasource\ConnectionManager;
	class  VoucherDateSumController extends AppController{
		
/*		var $uses=array ('CompanyRoot', 'CompanyInfo', 'CompanyBranch');
		public $helpers = array('Html', 'Form', 'Session');
		public $components = array('Session');*/
		
	
		
		public function index(){
			
			//	ini_set('memory_limit', '256M');
				
			$user = $this->Auth->User();
			 $user_id=$user["USR_ID"];
			 $this->set(compact('user_id'));
			 
			 
			 
		$query=$this->VoucherDateSum->Ledgers->find('list',['keyField' => 'LDG_ID','valueField' => 'LDG_NAME'])->order(['LDG_NAME'=>'ASC']);
		$LDG_name = $query->toArray();
		 $this->set(compact('LDG_name'));
				 
				 
			 
		if ($this->request->is(['post','put'])) 
		
			{
				
				//var_dump($this->request); 
		
				$ldg_id=$this->request->data["name"];
				$from_month=$this->request->data["from_month"];
				$from_year=$this->request->data["from_year"];
				$to_month=$this->request->data["to_month"];
				$to_year=$this->request->data["to_year"];
				$today=date('Y-m-d', strtotime('now'));
			
			 $from_date=$from_year.$from_month;
			 $to_date=$to_year.$to_month;
			 
			 	
	
		
		if($from_month==01)
		{
			
			$year=$from_year-1;
			$month=12;
		 $last_period=$year.$month;
		}
		
		else
		{
			$last_period=$from_date-1;
		}
		
		
	
			
			$query=$this->VoucherDateSum->find('all')
			->where(['VDT_LDG_ID' =>$ldg_id])
			->andWhere(['PERIOD >=' =>$from_date])
			->andWhere(['PERIOD <=' =>$to_date])
			->group('VDT_DATE')
			->order(['VDT_DATE'=>'ASC']);
			$cash_data = $query->toArray();
			$this->set(compact('cash_data'));
			
			
			$query = $this->VoucherDateSum->find();
			$query->select(['t_salary' => $query->func()->sum('TOTAL_DEBIT')])
			->where(['VDT_LDG_ID' =>$ldg_id])
			->andWhere(['PERIOD <=' =>$last_period]);
			$total_salary=$query->toArray();
			$this->set(compact('total_salary'));
			
		  $voucher_month_between_debit=$total_salary[0]->t_salary;
			
		
			
			
				$query = $this->VoucherDateSum->find();
			$query->select(['t_salary' => $query->func()->sum('TOTAL_CREDIT')])
			->where(['VDT_LDG_ID' =>$ldg_id])
			->andWhere(['PERIOD <=' =>$last_period]);
			$total_salary=$query->toArray();
			$this->set(compact('total_salary'));
	 $voucher_month_between_credit=$total_salary[0]->t_salary;
			
			
			
			$voucher_between=$voucher_month_between_debit-$voucher_month_between_credit;
			$this->set(compact('voucher_between'));
	
		
		$query=$this->VoucherDateSum->LedgerClosing->find('all');
	$query->select(['LDG_BAL_PERIOD','LBL_BALANCE_DR','LBL_BALANCE_CR','period' => $query->func()->max('LDG_BAL_PERIOD')])
			->where(['LDG_ID' =>$ldg_id])
			->andWhere(['LDG_BAL_PERIOD <=' =>$last_period]);
			$end_balance = $query->toArray();
			$this->set(compact('end_balance'));

		
/*ladger balance data*/
		
		
				$last_dr=0;
				$last_cr=0;
				
				
				
			
			foreach($end_balance as $end)
						{
			
							
							$last_dr=$end["LBL_BALANCE_DR"];
							$this->set(compact('last_dr'));
							
							
							$last_cr=$end["LBL_BALANCE_CR"];
							$this->set(compact('last_cr'));
				
						}
				
			}
			
	}
		
		
		
		
		
		
		
	
		public function monthreport(){
			
			//	ini_set('memory_limit', '256M');
				
			$user = $this->Auth->User();
			 $user_id=$user["USR_ID"];
			 $this->set(compact('user_id'));
			 
		$conn = ConnectionManager::get('default');
			$this->set(compact('conn'));
			
				 
			 
		if ($this->request->is(['post','put'])) 
		
			{
				
				//var_dump($this->request); 
		
					
					$from_month=$this->request->data["from_month"];
					
					$this->set(compact('from_month'));
					
					$from_year=$this->request->data["from_year"];
					
					$this->set(compact('from_year'));	
					
		
		
		
				
	
			}
	}
		
		
		
	
}

?>