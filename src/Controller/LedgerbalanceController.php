<?php
	namespace App\Controller;
	
	
	class  LedgerbalanceController extends AppController{
		

		
		
		
		public function index()
		{
			
		
		
			$query=$this->Ledgerbalance->Ledgers->find('list',['keyField' => 'LDG_ID','valueField' => 'LDG_NAME'])->order(['LDG_NAME'=>'ASC']);
			$LDG_name = $query->toArray();
			$this->set(compact('LDG_name'));
				 
if ($this->request->is(['post','put'])) 
		
			{

		 $id=($this->request->data["name"]);
		 
/*search code*/

			$date_from=($this->request->data["date_from"]);
			
			$date_1 = explode('-', $date_from);
			$d = $date_1[0];
			$m = $date_1[1];
			$y = $date_1[2];
			$from_date = $y.'-'.$m.'-'.$d;
			

	$query=$this->Ledgerbalance->LedgerClosing->find('all');
	$query=$query->select(['last_closed_period'=>$query->func()->max('LDG_BAL_PERIOD')])
		->where(['LDG_ID' =>$id])
		->andWhere(['LDG_BAL_PERIOD <' =>$y.$m]);
		$CLOSED_PERIOD = $query->toArray();
/*		$this->set(compact('CLOSED_PERIOD'));*/
//var_dump ($CLOSED_PERIOD); 
$cl_period='201501';
if (!empty($CLOSED_PERIOD[0]->last_closed_period))
{
$cl_period=$CLOSED_PERIOD[0]->last_closed_period;
}
//echo $cl_period;//['last_closed_period'];

			
			/*last month*/
			
			
			/*
			if($m==1)
			{
				$update_month=12;
				$y=$year-1;
				$last_m_date = $y.$update_month;
			}
			else
			{
			 $last_m_date=$last_m_date-1;
			}
			*/
$last_m_date=$cl_period;
/*from date start_date*/					
$y=substr($cl_period,0,4);
$m=substr($cl_period,5,2);
			$start_date = ("{$y}-{$m}-01");
			
/*last date of from date*/

		$last_date=date('Y-m-d', strtotime('-1 day', strtotime($from_date)));
		
		
			
			$date_last = explode('-', $last_date);
			$d = $date_last[2];
			$m = $date_last[1];
			$y = $date_last[0];
			$before_last_date = $d.'-'.$m.'-'.$y;
			
			
				$this->set(compact('before_last_date'));
				
				

/*end*/	


			$date_to=($this->request->data["date_to"]);
			
			
			
			$date_2 = explode('-', $date_to);
			$d = $date_2[0];
			$m = $date_2[1];
			$y = $date_2[2];
			$to_date = $y.'-'.$m.'-'.$d;
		


			
			$date_between_1=$from_date;	
			$date_between_1=$to_date;




$query=$this->Ledgerbalance->LedgerClosing->find('all')
		->where(['LDG_ID' =>$id])
		->andWhere(['LDG_BAL_PERIOD' =>$last_m_date]);
		$end_balance = $query->toArray();
		$this->set(compact('end_balance'));



/*ladger balance data*/
		
		
				$last_dr=0;
				$last_cr=0;
				$last_balance_date=0;
			foreach($end_balance as $end){
//				echo "<pre>";
	//			var_dump($end);

				
				$last_dr=$end["LBL_BALANCE_DR"];
				$last_cr=$end["LBL_BALANCE_CR"];
				$last_balance_date=$end["LDG_BAL_PERIOD"];
			}
		
		
/*end*/	
					


			
			$query = $this->Ledgerbalance->GeneralLedger->find();
			$query->select(['t_salary' => $query->func()->sum('VCH_DEBIT')])
			->where(['LDG_ID' =>$id])
			->andWhere(['VCH_DATE >=' =>$start_date])
			->andWhere(['VCH_DATE <=' =>$last_date]);
			$total_salary=$query->toArray();
			$this->set(compact('total_salary'));
			
			$voucher_month_first_debit=$total_salary[0]->t_salary;
			
			$this->set(compact('voucher_month_first_debit'));


			
			$query = $this->Ledgerbalance->GeneralLedger->find();
			$query->select(['t_salary' => $query->func()->sum('VCH_CREDIT')])
			->where(['LDG_ID' =>$id])
			->andWhere(['VCH_DATE >=' =>$start_date])
			->andWhere(['VCH_DATE <=' =>$last_date]);
			$total_salary=$query->toArray();
			$this->set(compact('total_salary'));
			
			$voucher_month_second_credit=$total_salary[0]->t_salary;
			
			$this->set(compact('voucher_month_second_credit'));





		$up_to_lastbalance_debit=$last_dr+$voucher_month_first_debit;
		$this->set(compact('up_to_lastbalance_debit'));
		
		
		$up_to_lastbalance_credit=$last_cr+$voucher_month_second_credit;
		$this->set(compact('up_to_lastbalance_credit'));
		
		 

			
			$query = $this->Ledgerbalance->GeneralLedger->find();
			$query->select(['t_salary' => $query->func()->sum('VCH_DEBIT')])
			->where(['LDG_ID' =>$id])
			->andWhere(['VCH_DATE >=' =>$from_date])
			->andWhere(['VCH_DATE <=' =>$to_date]);
			$total_salary=$query->toArray();
			$this->set(compact('total_salary'));
			
		$voucher_month_between_debit=$total_salary[0]->t_salary;
			
			$this->set(compact('voucher_month_first_debit'));
			
			
			
			
				$query = $this->Ledgerbalance->GeneralLedger->find();
			$query->select(['t_salary' => $query->func()->sum('VCH_CREDIT')])
			->where(['LDG_ID' =>$id])
			->andWhere(['VCH_DATE >=' =>$from_date])
			->andWhere(['VCH_DATE <=' =>$to_date]);
			$total_salary=$query->toArray();
			$this->set(compact('total_salary'));
			 $voucher_month_between_credit=$total_salary[0]->t_salary;
			
			$this->set(compact('voucher_month_second_credit'));
			
			

		
			
		
			 

$total_voucher_debit=$voucher_month_between_debit;

$this->set(compact('total_voucher_debit'));


$total_voucher_credit=$voucher_month_between_credit;
	
$this->set(compact('total_voucher_credit'));	
$this->set(compact('up_to_lastbalance_credit'));	
$this->set(compact('up_to_lastbalance_debit'));	

	
	
		
		 $query=$this->Ledgerbalance->GeneralLedger->find('list',['keyField' =>['VCH_ID'],'valueField' => 'VCH_ID'])
		->where(['LDG_ID' =>$id])
		->andWhere(['VCH_DATE >='=>$from_date])
		->andWhere(['VCH_DATE <='=>$to_date]);

		
		 $vch_id = $query->toArray();
	
		 
	
		
		 $query=$this->Ledgerbalance->GeneralLedger->find('all')->contain('vouchers')
		->where(['vouchers.VCH_ID IN' =>$vch_id])
		->andWhere(['vouchers.VCH_STATUS !=' =>STS_DELETED])
		->andWhere(['GeneralLedger.LDG_ID'=>$id])
		->andWhere(['GeneralLedger.VCH_DATE >='=>$from_date])
		->andWhere(['GeneralLedger.VCH_DATE <='=>$to_date])
			->order(['GeneralLedger.VCH_DATE' =>'Asc']);     //->contain('Basicdata');
		//$query->find('all')->contain('Project')->contain('Department')->contain("ledgers");
		
		 $vdt_id = $query->toArray();
		 $this->set(compact('vdt_id'));
		 
		 
		 
		 
		 
				$query=$this->Ledgerbalance->Ledgers->find('all')
				->where(['LDG_ID' =>$id]);
				$LDG_ACC_TYPE = $query->toArray();
				 $type=$LDG_ACC_TYPE["0"]["LDG_ACC_TYPE"];
				
				  $this->set(compact('type'));
		

		
					
			
			}
		}
		
		
	
		
		
		

		
		
		
		
		
		
		
		
		
		
	  public function view($VCH_ID)
    {
        if (!$VCH_ID) 
		{
            throw new NotFoundException(__('Invalid user'));
        }
		
	
		 
		
		 $query=$this->Ledgerbalance->find('all')
		 
		->where(['vouchers.VCH_ID IN' =>$VCH_ID]); //->contain('Basicdata');
		
		$query->find('all')->contain('Project')->contain('Department')->contain('Ledgers');
		
		 $vdt_id = $query->toArray();
		 $this->set(compact('vdt_id'));
		 
		 
		 
		 
		 
		$query = $this->Ledgerbalance->find();
		$query->select(['t_salary' => $query->func()->sum('VDT_DEBIT')])
		->where(['VCH_ID IN' =>$VCH_ID]);
		$total_debit=$query->toArray();
		$this->set(compact('total_debit'));

		$debit=$total_debit[0]->t_salary;
		
		$this->set(compact('debit'));
		
		 
		 
		
		
					$query = $this->Ledgerbalance->find();
		$query->select(['t_salary' => $query->func()->sum('VDT_CREDIT')])
		->where(['VCH_ID IN' =>$VCH_ID]);
		$total_credit=$query->toArray();
		$this->set(compact('total_credit'));

		$credit=$total_credit[0]->t_salary;
		
		$this->set(compact('credit'));
		
		 
		 
		
		
    }
	
	
	
	
	
	
	 public function printer($VCH_ID)
    {
        if (!$VCH_ID) 
		{
            throw new NotFoundException(__('Invalid user'));
        }
		
	
		 
		
		 $query=$this->Ledgerbalance->find('all')->contain('vouchers')
		->where(['vouchers.VCH_ID IN' =>$VCH_ID]); //->contain('Basicdata');
		
		$query->find('all')->contain('Project')->contain('Department')->contain('Ledgers');
		
		 $vdt_id = $query->toArray();
		 $this->set(compact('vdt_id'));
		 
		 
		 
		 
		 
		$query = $this->Ledgerbalance->find();
		$query->select(['t_salary' => $query->func()->sum('VDT_DEBIT')])
		->where(['VCH_ID IN' =>$VCH_ID]);
		$total_debit=$query->toArray();
		$this->set(compact('total_debit'));

		$debit=$total_debit[0]->t_salary;
		
		$this->set(compact('debit'));
		
		 
		 
		
		
					$query = $this->Ledgerbalance->find();
		$query->select(['t_salary' => $query->func()->sum('VDT_CREDIT')])
		->where(['VCH_ID IN' =>$VCH_ID]);
		$total_credit=$query->toArray();
		$this->set(compact('total_credit'));

		$credit=$total_credit[0]->t_salary;
		
		$this->set(compact('credit'));
		
		
    }
		
		
		
		
				
	public function trialbalance()
		{
			
			ini_set('memory_limit', '256M');
				
			$user = $this->Auth->User();
			 $user_id=$user["USR_ID"];
			 $this->set(compact('user_id'));
			 
			 
			 
			 $query=$this->Ledgerbalance->LedgerClosing->find('all');
			$query->select(['period' => $query->func()->max('LDG_BAL_PERIOD')]);
			
			$period = $query->toArray();
			$this->set(compact('period'));
			
			$end_period=201501;
			
			foreach($period as $a):
			 $end_period=$a->period;
			 $this->set(compact('end_period'));
			endforeach;
			
			
			
		
			 
			 $cur_period=$end_period+1;
			 $this->set(compact('cur_period'));
			 
			 
			  $l_year = substr($cur_period, 0, 4);
			 $l_month = substr($cur_period, -2);
			 
			 $cur_moth=(int)$l_month;
			 $cur_year=$l_year;
			 
		$query=$this->Ledgerbalance->VoucherDateSum->find('all')->contain('Ledgers')->contain('LedgerClosing')
		->where(['Month(VoucherDateSum.VDT_DATE)'=>$cur_moth])
		->andwhere(['year(VoucherDateSum.VDT_DATE)'=>$cur_year])
		->andwhere(['(LedgerClosing.LDG_BAL_PERIOD)'=>$end_period]);
		$data=$query->select(['VDT_LDG_ID','Ledgers.LDG_NAME','LedgerClosing.LBL_BALANCE_DR','LedgerClosing.LBL_BALANCE_CR',
		'T_DEBIT' => $query->func()->sum('TOTAL_DEBIT'),'T_CREDIT' => $query->func()->sum('TOTAL_CREDIT')])
		->group(['VDT_LDG_ID','LDG_NAME','LBL_BALANCE_DR','LBL_BALANCE_CR'])
		->order('LDG_NAME');

		$closing_balance = $data->toArray();
		$this->set(compact('closing_balance'));
	

			 							
	if ($this->request->is(['post','put'])) 
		
			{
				
				//var_dump($this->request); 
		
				$date=$this->request->data["date"];
				$today=date('Y-m-d', strtotime('now'));
	
				
			foreach($closing_balance as $a):
						
								
								
								$VDT_LDG_ID=$a->VDT_LDG_ID;
								$ldg_name=$a->ledger->LDG_NAME;
								$lbl_balance_dr=$a->ledger_closing->LBL_BALANCE_DR;
								$lbl_balance_cr=$a->ledger_closing->LBL_BALANCE_CR;
								$total_debit=$a->T_DEBIT;
								$total_credit=$a->T_CREDIT;
								
								if(!empty($a->ledger_closing))
								{
								$balance=($a->ledger_closing->LBL_BALANCE_DR-$a->ledger_closing->LBL_BALANCE_CR)+($a->T_DEBIT-$a->T_CREDIT);
								}
								
								else
								{
								$balance=($a->T_DEBIT-$a->T_CREDIT);
								}
								$LedgerClosing=$this->Ledgerbalance->LedgerClosingEntry->newEntity();
									
									
								$LedgerClosing->LDG_ID=$VDT_LDG_ID;
								$LedgerClosing->LDG_BAL_PERIOD=$cur_period;
								$LedgerClosing->LDG_BAL_DATE=$today;
								$LedgerClosing->LBL_OP_DR=$lbl_balance_dr;
								$LedgerClosing->LBL_OP_CR=$lbl_balance_cr;
								$LedgerClosing->LBL_TRN_DR=$total_debit;
								$LedgerClosing->LBL_TRN_CR=$total_credit;
								
							if($balance>0)
							{
								$LedgerClosing->LBL_BALANCE_DR=$balance;
							}
							else
							{
								$LedgerClosing->LBL_BALANCE_CR=$balance;
							}
								
										$this->Ledgerbalance->LedgerClosingEntry->save($LedgerClosing);
						
											
		 endforeach;	
		 		
						
						
								
    		}

				

	}
	
	
}

?>