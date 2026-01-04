<?php

	namespace App\Controller;
use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Network\Exception\NotFoundException;
use Cake\ORM\TableRegistry;	
	use Cake\Datasource\ConnectionManager; 	
	
	$bArray=array();
	class  CoasetController extends AppController{
		
/*		var $uses=array ('CompanyRoot', 'CompanyInfo', 'CompanyBranch');
		public $helpers = array('Html', 'Form', 'Session');
		public $components = array('Session');*/
		

		
		
		
		public function index(){
			
	$Coaset = $this->Coaset->find('all');
        $this->set(compact('Coaset'));
	
   
	
		}
		
		
	  public function view($SET_ID)
    {
        if (!$SET_ID) 
		{
            throw new NotFoundException(__('Invalid user'));
        }

        $Coaset = $this->Coaset->get($SET_ID);
        $this->set(compact('Coaset'));
    }
		
		
	  public function add()
    {
        $Coaset = $this->Coaset->newEntity();
        if ($this->request->is('post')) 
		{
            $Coaset = $this->Coaset->patchEntity($Coaset, $this->request->data);
            if ($this->Coaset->save($Coaset)) 
			{
                $this->Flash->success(__('The user has been saved.'));
               return $this->redirect(array('action' => 'index'));
            }
            $this->Flash->error(__('Unable to add the user.'));
        }
        $this->set('Coaset', $Coaset);
    }


	
	public function chartof_acc($SET_ID = null)
{
	
		$user = $this->Auth->User();
	
				
				
				
			$query=$this->Coaset->chartofacc->find('list',['keyField' => 'COA_ID','valueField' => 'COA_NAME']);
			$name = $query->toArray();
			$this->set(compact('name'));
			
			
			$query=$this->Coaset->Coasetledger->find('list',['keyField' => ['LDG_ID'],'valueField' => 'LDG_ID'])
			->where(['SET_ID' =>$SET_ID])
			->group(['LDG_ID']);
			$ldg_id = $query->toArray();
			$this->set(compact('ldg_id'));	
			
			
			
			if (empty($ldg_id))
			{
			$query=$this->Coaset->Ledgers->find('list',['keyField' => 'LDG_ID','valueField' => 'LDG_NAME']);
			$LDG_NAME = $query->toArray();
			$this->set(compact('LDG_NAME'));
			}
			else
			{
			$query=$this->Coaset->Ledgers->find('list',['keyField' => 'LDG_ID','valueField' => 'LDG_NAME'])
			->where(['LDG_ID not in ' =>$ldg_id]);
			$LDG_NAME = $query->toArray();
			$this->set(compact('LDG_NAME'));
			}
			
			
			
		
			$query = $this->Coaset->get($SET_ID);
			$SET_NAME= $query->SET_NAME;
			  $this->set(compact('SET_NAME'));
			$SET_CODE= $query->SET_CODE;
			  $this->set(compact('SET_CODE'));
			  
			  
			  
			  
			 $query=$this->Coaset->Coasetledger->find('list',['keyField' => 'COA_ID','valueField' => 'COA_ID'])
			->where(['SET_ID' =>$SET_ID])
			->group(['COA_ID']);
			$COA_ID = $query->toArray();
			$this->set(compact('COA_ID'));
			  
			  
			  
		/*	  $query=$this->Sales->Ledgerbalance->find('all')->contain('vouchers')
			->where(['vouchers.VCH_ID IN' =>$VCH_ID]); //->contain('Basicdata');
			$query->find('all')->contain('Project')->contain('Department')->contain('Ledgers');
			$vdt_id = $query->toArray();
			$this->set(compact('vdt_id'));
			 */
		
		
		$query=$this->Coaset->Coasetledger->find('all')->contain('chartofacc')->contain('Ledgers')
		->where(['Coasetledger.SET_ID IN' =>$SET_ID])
		->andWhere(['Coasetledger.COA_ID IN' =>$COA_ID])
		->order(['chartofacc.COA_NAME' =>'ASC']);
		$Coasetledger = $query->toArray();
		$this->set(compact('Coasetledger'));	
		
		/*echo "<pre>";
		
		var_dump($Coasetledger);*/
	
        if ($this->request->is('post')) 
		{
			
			
			 $coa_Name=($this->request->data["Name"]);
			$ledger_id=($this->request->data["ledger"]);
			

		
			for($i=0;$i<count($ledger_id);$i++)
							
							{
								
								 $value=($ledger_id[$i]);
								
								
							
						
    $Coasetledger = $this->Coaset->Coasetledger->newEntity();
			
				$Coasetledger->SET_ID=$SET_ID;
				$Coasetledger->COA_ID=$coa_Name;
				$Coasetledger->	LDG_ID=$value;
				$Coasetledger->SLD_BY=$user;
							

						
			$this->Coaset->Coasetledger->save($Coasetledger); 
							}
							
			 $this->Flash->success(__('Your article has been updated.'));
            return $this->redirect(['action' => 'index']);
			 $this->Flash->error(__('Unable to update your article.'));
			 
			 
        }

    $this->set('Coasetledger',$Coasetledger);
}

	
	
  public function cash_bank()
    {
		
		
		
		if ($this->request->is(['post','put'])) 
		
			{
				
					$month_name=($this->request->data["month"]);
					$year=($this->request->data["year"]);
		
		
					if ($month_name<10) 
					{
						 $month='0'.$month_name;
					}
					else
					{
						 $month=$month_name;
					}
	
	$query=$this->Coaset->Ledgers->find('list',['keyField' => 'LDG_ID','valueField' => 'LDG_ID'])
		->where(['LDG_TYPES LIKE' =>"%BNK%"])
		->group(['LDG_ID']);
		$bank = $query->toArray();
		$this->set(compact('bank'));


		$date=$year.$month;
		
		$query=$this->Coaset->LedgerClosing->find('all');
		$query=$query->select(['last_closed_period'=>$query->func()->max('LDG_BAL_PERIOD')])
		->where(['LDG_BAL_PERIOD <'=>$date]);
		$CLOSED_PERIOD = $query->toArray();


$cl_period='201501';
if (!empty($CLOSED_PERIOD[0]->last_closed_period))
{
$cl_period=$CLOSED_PERIOD[0]->last_closed_period;
}
else
{
}



$last_m_date=$cl_period;
/*from date start_date*/					
$y=substr($cl_period,0,4);
$m=substr($cl_period,5,2);
			
		

			
/*bank data*/

	$inBank='(0';
	$i=0;
	foreach($bank as $c)
	{
	$inBank=$inBank.",".$c;
	}
	$inBank=$inBank.")";
	$this->set(compact('inBank'));
	
	$sql="SELECT (SUM(LBL_BALANCE_DR)) AS `LBL_BALANCE_DR`, (SUM(LBL_BALANCE_CR)) AS `LBL_BALANCE_CR` FROM ledger_balance LedgerClosing WHERE (LDG_BAL_PERIOD = ".$last_m_date." AND LDG_ID in ".$inBank.")";
	
	$conn = ConnectionManager::get('default');
	$end_bank_balance=	$conn->execute($sql)->fetch('assoc');
	$this->set(compact('end_bank_balance'));

		 $last_bank_dr=$end_bank_balance["LBL_BALANCE_DR"];
		$last_bank_cr=$end_bank_balance["LBL_BALANCE_CR"];



$speriod=($m+1);
if ($speriod<10)
{
	$speriod=$y.'0'.$speriod;
}

elseif ($speriod==13)
{
	$speriod=$y+'1'.'01';
}

else
{
	 $speriod=$y.$speriod;
	
}




$eperiod=$month-1;

if (($eperiod<10) && ($eperiod!=0))
{
 $eperiod=$year.'0'.$eperiod;
}


elseif ($eperiod==0)
{
	 $eperiod=$year-'1'.'12';
}

else
{
	$eperiod=$year.$eperiod;
	
}

$this->set(compact('eperiod'));


/*bank*/

	$sql="SELECT (SUM(VCH_DEBIT)) AS `b_debit`,(SUM(VCH_CREDIT)) AS `b_credit` FROM general_ledger GeneralLedger WHERE (DATE_FORMAT(VCH_DATE,'%Y%m') between '".$speriod."' AND '".$eperiod."' ) AND LDG_ID in ".$inBank."";
	

	
	$total_salary=	$conn->execute($sql)->fetch('assoc');
	$this->set(compact('total_salary'));
	
	$voucher_month_bank_debit=$total_salary["b_debit"];
	$voucher_month_bank_credit=$total_salary["b_credit"];
	
	$this->set(compact('voucher_month_bank_debit'));
	$this->set(compact('voucher_month_bank_credit'));
	


		$up_to_lastbalance_bank_debit=$last_bank_dr+$voucher_month_bank_debit;
		$this->set(compact('up_to_lastbalance_bank_debit'));
		
		
		$up_to_lastbalance_bank_credit=$last_bank_cr+$voucher_month_bank_credit;
		$this->set(compact('up_to_lastbalance_bank_credit'));
		
		
	/*cash data*/
	
	
		
		$sql="SELECT (SUM(LBL_BALANCE_DR)) AS `LBL_BALANCE_DR`, (SUM(LBL_BALANCE_CR)) AS `LBL_BALANCE_CR` FROM ledger_balance LedgerClosing WHERE (LDG_BAL_PERIOD = ".$last_m_date." AND LDG_ID=12)";
		$end_cash_balance=	$conn->execute($sql)->fetch('assoc');
		$this->set(compact('end_bank_balance'));
		
		$last_cash_dr=$end_cash_balance["LBL_BALANCE_DR"];
		$last_cash_cr=$end_cash_balance["LBL_BALANCE_CR"];
		
		
		
		
		$sql="SELECT (SUM(VCH_DEBIT)) AS `c_debit`,(SUM(VCH_CREDIT)) AS `c_credit` FROM general_ledger GeneralLedger WHERE (DATE_FORMAT(VCH_DATE,'%Y%m') between '".$speriod."' AND '".$eperiod."' ) AND LDG_ID=12";
		
		$total_salary=	$conn->execute($sql)->fetch('assoc');
		$this->set(compact('end_cash_balance'));
		
		
		$voucher_month_cash_debit=$total_salary["c_debit"];
		$voucher_month_cash_credit=$total_salary["c_credit"];


	

		$up_to_lastbalance_cash_debit=$last_cash_dr+$voucher_month_cash_debit;
		$this->set(compact('up_to_lastbalance_cash_debit'));
		
		
		$up_to_lastbalance_cash_credit=$last_cash_cr+$voucher_month_cash_credit;
		$this->set(compact('up_to_lastbalance_cash_credit'));
			
			
	
	
		
		$sql="SELECT GeneralLedger.VCH_LDG_ID AS `GeneralLedger__VCH_LDG_ID`, GeneralLedger.VCH_LDG_NAME AS `GeneralLedger__VCH_LDG_NAME`, (SUM(VCH_DEBIT)) AS `TOTAL_DEBIT`, (SUM(VCH_CREDIT)) AS `TOTAL_CREDIT` FROM general_ledger GeneralLedger WHERE ((DATE_FORMAT(VCH_DATE,'%Y%m') =".$year.$month.") AND (LDG_ID in ".$inBank." or LDG_ID=12)) GROUP BY VCH_LDG_ID, VCH_LDG_NAME ORDER BY LDG_NAME ASC";
	
	$general_ledger = $conn->execute($sql);
	$this->set(compact('general_ledger'));
	



$sql="SELECT (SUM(VCH_DEBIT)) AS `last_DEBIT`, (SUM(VCH_CREDIT)) AS `last_CREDIT` FROM general_ledger GeneralLedger WHERE (DATE_FORMAT(VCH_DATE,'%Y%m') between '".$speriod."' AND '".$year.$month."' ) AND LDG_ID in ".$inBank."";



	$last_balance_bank=	$conn->execute($sql)->fetch('assoc');
		$this->set(compact('last_balance'));
	
		$bank_debit=$last_balance_bank["last_DEBIT"];
		$bank_credit=$last_balance_bank["last_CREDIT"];
$this->set(compact('bank_debit'));
$this->set(compact('bank_credit'));


$last_date=$year.$month;
$this->set(compact('last_date'));
	
	
	$sql="SELECT (SUM(VCH_DEBIT)) AS `last_DEBIT`, (SUM(VCH_CREDIT)) AS `last_CREDIT` FROM general_ledger GeneralLedger WHERE (DATE_FORMAT(VCH_DATE,'%Y%m') between '".$speriod."' AND '".$last_date."' ) AND LDG_ID=12";



$last_balance_cash=	$conn->execute($sql)->fetch('assoc');
		$this->set(compact('last_balance'));
	
		$cash_debit=$last_balance_cash["last_DEBIT"];
		$cash_credit=$last_balance_cash["last_CREDIT"];
$this->set(compact('cash_debit'));
$this->set(compact('cash_credit'));



$cash_bank_in=($last_bank_dr-$last_bank_cr)+($bank_debit-$bank_credit);
$cash_bank_out=($last_cash_dr-$last_cash_cr)+($cash_debit-$cash_credit);
$this->set(compact('cash_bank_in'));
$this->set(compact('cash_bank_out'));

				
	/*
		$query=$this->Coaset->GeneralLedger->find('all')
		->where(['MONTH(VCH_DATE)' =>$month])
		->andWhere(['YEAR(VCH_DATE)' =>$year])
		->andWhere(['LDG_ID IN' =>$inBank])
		->andWhere(['LDG_ID' =>12])
		->order(['LDG_NAME' =>'ASC']);
		$query->select(['VCH_LDG_ID','VCH_LDG_NAME','TOTAL_DEBIT' => $query->func()->sum('VCH_DEBIT'),'TOTAL_CREDIT' => $query->				func()->sum('VCH_CREDIT')])
		
		
		->group(['VCH_LDG_ID','VCH_LDG_NAME']);
		$general_ledger = $query->toArray();
		$this->set(compact('general_ledger'));
		*/

	
			}
      
    }

	
	
		
		
public function edit($SET_ID = null)
{
    $Coaset = $this->Coaset->Coasetledger->get($SET_ID);
    if ($this->request->is(['post', 'put'])) {
        $this->Coaset->Coasetledger->patchEntity($Coaset, $this->request->data);
        if ($this->Coaset->Coasetledger->save($Coaset)) {
            $this->Flash->success(__('Your article has been updated.'));
            return $this->redirect(['action' => 'index']);
        }
        $this->Flash->error(__('Unable to update your article.'));
    }

    $this->set('Coaset', $Coaset);
}

	
	
		public function delete($SLD_ID = null)
{
    $Coaset = $this->Coaset->Coasetledger->get($SLD_ID);
        $this->request->is(['post', 'delete']);
        if ($this->Coaset->Coasetledger->delete($Coaset)) {
            $this->Flash->success('The user has been deleted.');
        } else {
            $this->Flash->error('The user could not be deleted. Please, try again.');
        }
        return $this->redirect(['action' => 'index']);
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