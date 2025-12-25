<?php
	namespace App\Controller;
	class  VoucherDateUserSumController extends AppController{
		
/*		var $uses=array ('CompanyRoot', 'CompanyInfo', 'CompanyBranch');
		public $helpers = array('Html', 'Form', 'Session');
		public $components = array('Session');*/
		
	
		
		public function index()
		{
			
			//	ini_set('memory_limit', '256M');
				
			$user = $this->Auth->User();
			$user_id=$user["USR_ID"];
			 $this->set(compact('user_id'));
			 
			 /*today*/
	
			$today=date('Y-m-d', strtotime('now'));
			
			$query = $this->VoucherDateUserSum->find('all')
			->where(['VCH_STATUS_BY' =>$user_id])
			->andWhere(['VDT_DATE' =>$today]);
			$today_report=$query->toArray();
			$this->set(compact('today_report'));
			
			
			 /*yesterday*/
			 
			 $yesterday= date('Y-m-d', strtotime(date('Y-m-d')." -1 day"));
	
			$today=date('Y-m-d', strtotime('now'));
			
			$query = $this->VoucherDateUserSum->find('all')
			->where(['VCH_STATUS_BY' =>$user_id])
			->andWhere(['VDT_DATE' =>$yesterday]);
			$yesterday_report=$query->toArray();
			$this->set(compact('yesterday_report'));
			
			
			 /*this_month*/
			 
				$this_month = explode('-',$today);
			$day = $this_month[2];
			$month = $this_month[1];
			$year = $this_month[0];
	
		
			
			$query = $this->VoucherDateUserSum->find('all')
			->where(['VCH_STATUS_BY' =>$user_id])
			->andWhere(['MONTH(VDT_DATE)' =>$month]);
			$data=$query->select(['t_approve' => $query->func()->sum('Approved'),'t_sent' => $query->func()->sum('SentApproved'),
			't_voucher' => $query->func()->sum('TOTAL_VOUCHER'),'t_amount' => $query->func()->sum('TOTAL_CREDIT')]);
			
			$this_m_report=$query->toArray();
			$this->set(compact('this_m_report'));
			
			
			
			 /*last_month*/
			 
		
		$last_month= date('Y-m-d', strtotime(date('Y-m')." -1 month"));
		$l_month = explode('-',$last_month);
		$l_month = $l_month[1];
	
		

			
				$query = $this->VoucherDateUserSum->find('all')
			->where(['VCH_STATUS_BY' =>$user_id])
			->andWhere(['MONTH(VDT_DATE)' =>$l_month]);
			$data=$query->select(['t_approve' => $query->func()->sum('Approved'),'t_sent' => $query->func()->sum('SentApproved'),
			't_voucher' => $query->func()->sum('TOTAL_VOUCHER'),'t_amount' => $query->func()->sum('TOTAL_CREDIT')]);
			
			$last_m_report=$query->toArray();
			$this->set(compact('last_m_report'));
			
			
				 /*This Year*/
			 
				$query = $this->VoucherDateUserSum->find('all')
			->where(['VCH_STATUS_BY' =>$user_id])
			->andWhere(['YEAR(VDT_DATE)' =>$year]);
			$data=$query->select(['t_approve' => $query->func()->sum('Approved'),'t_sent' => $query->func()->sum('SentApproved'),
			't_voucher' => $query->func()->sum('TOTAL_VOUCHER'),'t_amount' => $query->func()->sum('TOTAL_CREDIT')]);
			
			$this_y_report=$query->toArray();
			$this->set(compact('this_y_report'));
			
	
	
			 /*Total report*/
			 
				$query = $this->VoucherDateUserSum->find('all')
			->where(['VCH_STATUS_BY' =>$user_id]);
			$data=$query->select(['t_approve' => $query->func()->sum('Approved'),'t_sent' => $query->func()->sum('SentApproved'),
			't_voucher' => $query->func()->sum('TOTAL_VOUCHER'),'t_amount' => $query->func()->sum('TOTAL_CREDIT')]);
			
			$this_y_report=$query->toArray();
			$this->set(compact('this_y_report'));
			
			
			
		}
		
		
	
		
		
		
		
	
}

?>