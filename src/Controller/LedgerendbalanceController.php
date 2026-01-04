<?php
	namespace App\Controller;
	
	
	class  LedgerendbalanceController extends AppController{
		

		
		
		
		public function index()
		{
			
		
		if ($this->request->is(['post','put'])) 
		
			{

		
		 $date=($this->request->data["date"]);
		 
		  $this->set(compact('date'));
	
	$year = substr($date, 0, 4);
	$month = substr($date, 5, 2);
	
	
	
	if($month==01)
	{
	$last_month=12;
	
	$end_balance_date=$year.$last_month;
	
		
		
	}
	else
	{
		$last_month=$month-1;
		
		$end_balance_date=$year.'0'.$last_month;
		
		
	}
	
	
	
		 $query=$this->Ledgerendbalance->find('all')->contain("LedgerClosing")
		->Where(['LDG_BAL_PERIOD'=>$end_balance_date])
		->orWhere(['LDG_BAL_PERIOD IS '=>null])		;
		 $end_balance = $query->toArray();
		 $this->set(compact('end_balance'));
		 
	
	
	//var_dump($end_balance);
	
	
	
$query = $this->Ledgerendbalance->Ledgerbalance->find('all');
		$query->select(['VDT_LDG_ID','t_debit' => $query->func()->sum('VDT_DEBIT'),'t_credit' => $query->func()->sum('VDT_CREDIT')])
		->Where(['MONTH(VDT_DATE)'=>$month])
		->andWhere(['YEAR(VDT_DATE)'=>$year])
		->group('VDT_LDG_ID');
		
		$total_balance=$query->toArray();
		$this->set(compact('total_balance'));
		
	

		
		
			
			}
		}
		
		
		
		
		
		
		
		
	
	
	
		
	}

?>