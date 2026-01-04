<?php
	namespace App\Controller;
use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Network\Exception\NotFoundException;
use Cake\ORM\TableRegistry;	
	
	
	class  SalesController extends AppController{
				
/*		var $uses=array ('CompanyRoot', 'CompanyInfo', 'CompanyBranch');
		public $helpers = array('Html', 'Form', 'Session');
		public $components = array('Session');*/
		

		
		
		
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
			
				$Sales = $this->Sales->find('all')
				->where(['VCH_TYPE' =>VCH_TYPE_SALES])
				->andWhere(['VCH_DATE >=' =>$sdate])
				->andWhere(['VCH_DATE <=' =>$edate])
				->andWhere(['VCH_STATUS !=' =>STS_DELETED])
				->order(['VCH_DATE' =>'DESC','VCH_ID' =>'DESC']);      
				$this->set(compact('Sales'));
				$this->set(compact('sdate'));
				$this->set(compact('edate'));	

	
		}
		
		
		
	  public function view($VCH_ID)
    {
        if (!$VCH_ID) 
		{
            throw new NotFoundException(__('Invalid user'));
        }

        $Sales = $this->Sales->get($VCH_ID);
        $this->set(compact('Sales'));
    }
		
		
		
		
		
public function add()
    {
	
			$user = $this->Auth->User();
			
			$Basicdata = TableRegistry::get('Basicdata');
			
			$query=$Basicdata->find('list',['keyField' => ['BAS_ID'],'valueField' => 'BAS_NAME'])
			->where(['BAS_TYPE_ID' =>PROJECT_TYPE]);
			
			$project = $query->toArray();
			
			$this->set(compact('project'));
			
			
			
			$query=$Basicdata->find('list',['keyField' => ['BAS_ID'],'valueField' => 'BAS_NAME'])
			->where(['BAS_TYPE_ID' =>DEPARTMENT_TYPE]);
			
			$department = $query->toArray();
			
			$this->set(compact('department'));
			
			
			
			$Ledgerstype = TableRegistry::get('Ledgerstype');
			
			
			/*		$query=$Ledgerstype->find('list',['keyField' =>['LDG_ID'],'valueField' => 'LDG_ID']);
			
			->where(['LTM_ID' =>4])
			->orWhere(['LTM_ID' =>6])
			->orWhere(['LTM_ID' =>7])
			->orWhere(['LTM_ID' =>2]);
			
			$pur=$query->toArray();
			$this->set(compact('pur'));*/
			
			
			$query=$this->Sales->Ledgers->find('list',['keyField' => ['LDG_ID'],'valueField' => 'LDG_NAME'])
			->order(['LDG_NAME'=>'ASC']);
			//		->where(['LDG_ID IN ' =>$pur]);
			$sales_t = $query->toArray();
			$this->set(compact('sales_t'));
			
			
			
			
			$query=$Ledgerstype->find('list',['keyField' => 'LDG_ID','valueField' => 'LDG_ID'])
			->where(['LTM_ID' =>LDG_TYPE_INVENTORY]);
			$itm=$query->toArray();
			
			
			$query=$this->Sales->Ledgers->find('list',['keyField' => 'LDG_ID','valueField' => 'LDG_NAME'])
			->where(['LDG_TYPES like ' =>'%INV%'])
			->order(['LDG_NAME'=>'ASC']);

			
			$item = $query->toArray();
			
			$this->set(compact('item'));
			
			
		
	
	
        $Sales = $this->Sales->newEntity();
        if ($this->request->is('post')) {
			
			
		
			$amount=($this->request->data["VCH_AMOUNT"]);
			$Sales_from=($this->request->data["VCH_CR_ACCOUNTS"]);
			$items=($this->request->data["VCH_DR_ACCOUNTS"]);
			
			
			$ldg = $this->Sales->Ledgers->get($Sales_from);
			
			$Sales_from_name= $ldg->LDG_CODE;
			$Sales_from_fname= $ldg->LDG_NAME;
			
			$ldg = $this->Sales->Ledgers->get($items);
			
			$item_name= $ldg->LDG_CODE;
			$item_fname= $ldg->LDG_NAME;
			
            $Sales = $this->Sales->patchEntity($Sales, $this->request->data);
			
			
			
			$full_des=$Sales_from_name.'(Cr), '.$item_name.'(Dr)';

			$Sales->VCH_FULL_DESCRIPTION=$full_des;
			
			$Sales->VCH_STATUS=STS_CREATE;
			$Sales->VCH_CREATE_BY=$user['USR_ID'];
			
			$Sales->VCH_TYPE=VCH_TYPE_SALES;

			$Sales->VCH_STATUS_BY=$user['USR_ID'];
			$Sales->VCH_LAST_EDIT_BY=$user['USR_ID'];
			$Sales->VCH_SUBMIT_BY=$user['USR_ID'];
				
			$Sales->ACC_CR_NAME=$item_fname;
			$Sales->ACC_DR_NAME=$Sales_from_fname;
			
			$invoice=$this->request->data('INVDATE');

			if ($invoice<>"")
			{
				
				$invoice_date = $invoice;//$this->request->data('INVDATE');
				$Sales->VCH_INV_DATE = DateToDB($invoice_date.'-','-');
			}
			
			$chalan=$this->request->data('CHALLANDATE');
			
			if ($chalan<>"")
			{
				$chalan_date = $chalan;//$this->request->data('INVDATE');
				$Sales->VCH_CHALLAN_DATE = DateToDB($chalan_date.'-','-');			

			}
			
			$date=$this->request->data('pay_date');
			$pay_date='';
			if ($date<>"")
			{
			
			
				$date_sep = explode('-', $date);
				$d = $date_sep[0];
				$m = $date_sep[1];
				$y = $date_sep[2];
				$pay_date = $y.'-'.$m.'-'.$d;
				
				$Sales->VCH_DATE=$pay_date;
				$Sales->VCH_MONTH=$m;
				$Sales->VCH_YEAR=$y;
			}
			else
			{
				   $this->Flash->success(__('Please Specify Sales Date'));
				     $this->set('Sales', $Sales);
				   return;
			}

			$project=$Sales->VCH_PROJECT;

			$department=$Sales->VCH_DEPARTMENT;
			
		
				
			
			$Sales->VDT_VOUCHER_NO='';
			

			
			
            if ($this->Sales->save($Sales)) {

				
				 
				$new_id=$Sales->VCH_ID;
				$Sales=$this->Sales->get($new_id);
					$year=$Sales->VCH_YEAR;
					$month=$Sales->VCH_MONTH;
					$vch_Full=$Sales->VCH_NO_FULL;

				

				
				
				
				

			
				$this->Sales->Voucherdtl->deleteAll(['VCH_ID' =>$VCH_ID]);
				//insert data in another table


				 $Voucherdtl = $this->Sales->Voucherdtl->newEntity();
				 
				$Voucherdtl->VCH_ID=$new_id;
				$Voucherdtl->VDT_DATE=$pay_date;
				$Voucherdtl->VDT_VOUCHER_NO=$vch_Full;
				$Voucherdtl->VDT_LOT=1;
				$Voucherdtl->VDT_SR=1;
				$Voucherdtl->VDT_LDG_ID=$Sales_from;
				$Voucherdtl->VDT_DEBIT=0;
				$Voucherdtl->VDT_CREDIT=$amount;
//echo $project;
				$Voucherdtl->VDT_PROJECT=$project;
			//	echo $department;
				$Voucherdtl->VDT_DEPARTMENT=$department;

						
			$this->Sales->Voucherdtl->save($Voucherdtl);
				   
		
		
		
		
				 $Voucherdt2 = $this->Sales->Voucherdtl->newEntity();
				 
				  $Voucherdt2->VCH_ID=$new_id;
				   $Voucherdt2->VDT_DATE=$pay_date;
				    $Voucherdt2->VDT_VOUCHER_NO=$vch_Full;
					 $Voucherdt2->VDT_LOT=1;
					  $Voucherdt2->VDT_SR=2;
					  	$Voucherdt2->VDT_LDG_ID=$items;
						
					  	$Voucherdt2->VDT_DEBIT=$amount;
				   		$Voucherdt2->VDT_CREDIT=0;
						$Voucherdt2->VDT_PROJECT=$project;
						$Voucherdt2->VDT_DEPARTMENT=$department;
						
				    $this->Sales->Voucherdtl->save($Voucherdt2);
				   
				
				
              
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
            $this->Flash->error(__('Unable to add the vouchers.'));
        }
        $this->set('Sales', $Sales);
    }


		
		
		
		

public function edit($VCH_ID = null)
{

	
			$user = $this->Auth->User();
			
			$Basicdata = TableRegistry::get('Basicdata');
			
			$query=$Basicdata->find('list',['keyField' => ['BAS_ID'],'valueField' => 'BAS_NAME'])
			->where(['BAS_TYPE_ID' =>PROJECT_TYPE]);
			
			$project = $query->toArray();
			
			$this->set(compact('project'));
			
			
			
			$query=$Basicdata->find('list',['keyField' => ['BAS_ID'],'valueField' => 'BAS_NAME'])
			->where(['BAS_TYPE_ID' =>DEPARTMENT_TYPE]);
			
			$department = $query->toArray();
			
			$this->set(compact('department'));
			
			
			
			$Ledgerstype = TableRegistry::get('Ledgerstype');
			
			
			/*		$query=$Ledgerstype->find('list',['keyField' =>['LDG_ID'],'valueField' => 'LDG_ID']);
			
			->where(['LTM_ID' =>4])
			->orWhere(['LTM_ID' =>6])
			->orWhere(['LTM_ID' =>7])
			->orWhere(['LTM_ID' =>2]);
			
			$pur=$query->toArray();
			$this->set(compact('pur'));*/
			
			
			$query=$this->Sales->Ledgers->find('list',['keyField' => ['LDG_ID'],'valueField' => 'LDG_NAME']);
			//		->where(['LDG_ID IN ' =>$pur]);
			$sales_t = $query->toArray();
			$this->set(compact('sales_t'));
			
			
			
			
			
			
			$query=$this->Sales->Ledgers->find('list',['keyField' => 'LDG_ID','valueField' => 'LDG_NAME'])
	->where(['LDG_TYPES like ' =>'%INV%'])
			->order(['LDG_NAME'=>'ASC']);
			
			$item = $query->toArray();
			
			$this->set(compact('item'));
			
			
			
			$Sales = $this->Sales->get($VCH_ID);
			//				echo $Sales->VCH_DATE;
			$Sales->pdate=date('d-m-Y',strtotime($Sales->VCH_DATE));
			
			$Sales->INVDATE=validateDate($Sales->VCH_INV_DATE);
			
			$Sales->CHALLANDATE=validateDate($Sales->VCH_CHALLAN_DATE);


			
				
				$Sales->pay_date=validateDate($Sales->VCH_DATE);;


        if ($this->request->is(['post','put'])) {
			
			
		
			$amount=($this->request->data["VCH_AMOUNT"]);
			$Sales_from=($this->request->data["VCH_CR_ACCOUNTS"]);
			$items=($this->request->data["VCH_DR_ACCOUNTS"]);
			
			
			$ldg = $this->Sales->Ledgers->get($Sales_from);
			
			$Sales_from_name= $ldg->LDG_CODE;
			
			$ldg = $this->Sales->Ledgers->get($items);
			
			$item_name= $ldg->LDG_CODE;
			
            $Sales = $this->Sales->patchEntity($Sales, $this->request->data);
			
			
			
			$full_des=$Sales_from_name.'(Cr), '.$item_name.'(Dr)';

			$Sales->VCH_FULL_DESCRIPTION=$full_des;
			
			$Sales->VCH_STATUS=STS_EDIT;
			
			
		
			$Sales->VCH_STATUS_BY=$user['USR_ID'];
			$Sales->VCH_LAST_EDIT_BY=$user['USR_ID'];
	
				
			
			
			$invoice=$this->request->data('INVDATE');

			if ($invoice<>"")
			{
				
				$invoice_date = $invoice;//$this->request->data('INVDATE');
				$Sales->VCH_INV_DATE = DateToDB($invoice_date.'-','-');
			}
			
			$chalan=$this->request->data('CHALLANDATE');
			
			if ($chalan<>"")
			{
				$chalan_date = $chalan;//$this->request->data('INVDATE');
				$Sales->VCH_CHALLAN_DATE = DateToDB($chalan_date.'-','-');			

			}
			
			$date=$this->request->data('pay_date');
			$pay_date='';
			if ($date<>"")
			{
			
			
				$date_sep = explode('-', $date);
				$d = $date_sep[0];
				$m = $date_sep[1];
				$y = $date_sep[2];
				$pay_date = $y.'-'.$m.'-'.$d;
				
				$Sales->VCH_DATE=$pay_date;
				$Sales->VCH_MONTH=$m;
				$Sales->VCH_YEAR=$y;
			}
			else
			{
				   $this->Flash->success(__('Please Specify Sales Date'));
				     $this->set('Sales', $Sales);
				   return;
			}

			$project=$Sales->VCH_PROJECT;

			$department=$Sales->VCH_DEPARTMENT;
			
		
				
			
			
			

			
			
            if ($this->Sales->save($Sales,['validate' => false, 'associated' => false])) {
				
				
					if ($this->Sales->Voucherdtl->deleteAll(['VCH_ID' =>$VCH_ID])){
						
									$VCH_NO = $Sales->VCH_NO_FULL; 
									$new_id= $Sales->VCH_ID;  //data call from table

				//insert data in another table

				
				 $Voucherdtl = $this->Sales->Voucherdtl->newEntity();
				 
				$Voucherdtl->VCH_ID=$new_id;
				$Voucherdtl->VDT_DATE=$pay_date;
				$Voucherdtl->VDT_VOUCHER_NO=$VCH_NO;
				$Voucherdtl->VDT_LOT=1;
				$Voucherdtl->VDT_SR=1;
				$Voucherdtl->VDT_LDG_ID=$Sales_from;
				$Voucherdtl->VDT_DEBIT=0;
				$Voucherdtl->VDT_CREDIT=$amount;
//echo $project;
				$Voucherdtl->VDT_PROJECT=$project;
			//	echo $department;
				$Voucherdtl->VDT_DEPARTMENT=$department;

						
			$this->Sales->Voucherdtl->save($Voucherdtl);
				   
		
		
		
		
				 $Voucherdt2 = $this->Sales->Voucherdtl->newEntity();
				 
				  $Voucherdt2->VCH_ID=$new_id;
				   $Voucherdt2->VDT_DATE=$pay_date;
				    $Voucherdt2->VDT_VOUCHER_NO=$VCH_NO;
					 $Voucherdt2->VDT_LOT=1;
					  $Voucherdt2->VDT_SR=2;
					  	$Voucherdt2->VDT_LDG_ID=$items;
						
					  	$Voucherdt2->VDT_DEBIT=$amount;
				   		$Voucherdt2->VDT_CREDIT=0;
						$Voucherdt2->VDT_PROJECT=$project;
						$Voucherdt2->VDT_DEPARTMENT=$department;
						
				    $this->Sales->Voucherdtl->save($Voucherdt2);
				   
				
					}
		 return $this->redirect(array('action' => 'index'));
			 
            }
            $this->Flash->error(__('Unable to add the vouchers.'));
        }
        $this->set('Sales', $Sales);
    }

	
		
public function delete($VCH_ID = null)
{
	
	
		$user = $this->Auth->User();	
    $Sales = $this->Sales->get($VCH_ID);
    if ($this->request->is(['post', 'put'])) {
		

		
		
        $this->Sales->patchEntity($Sales, $this->request->data);
		
		$Sales->VCH_STATUS=STS_DELETED;
			$Sales->VCH_STATUS_DATE=date('Y-m-d');
			$Sales->VCH_STATUS_BY=$user['USR_ID'];
        if ($this->Sales->save($Sales)) {
            $this->Flash->success(__('Your Sales has been Deleted.'));
            return $this->redirect(['action' => 'index']);
        }
        $this->Flash->error(__('Unable to Delete your Sales.'));
    }

    $this->set('Sales', $Sales);
}

	
	
	
	
	
		
		
		
public function monthlyexpense()
		{
			
			

				 
if ($this->request->is(['post','put'])) 
		
			{

		 $month_name=($this->request->data["month_name"]);
		 $year=($this->request->data["year"]);
		 


$v_type=[VCH_TYPE_EXPENSE,VCH_TYPE_PAYMENT];

		$query=$this->Sales->find('all')
		
		->where(['VCH_TYPE IN ' =>$v_type])
		->andWhere(['month(VCH_DATE)' =>$month_name])
		->andWhere(['YEAR(VCH_DATE)' =>$year]);
		$PAYMENT = $query->toArray();
		$this->set(compact('PAYMENT'));
		


		
			$query = $this->Sales->find();
			$query->select(['t_salary' => $query->func()->sum('VCH_AMOUNT')])
			->where(['VCH_TYPE IN ' =>$v_type])
			->andWhere(['month(VCH_DATE)' =>$month_name])
			->andWhere(['YEAR(VCH_DATE)' =>$year]);
			$total_salary=$query->toArray();
			$this->set(compact('total_salary'));
			
			$payment_ex=$total_salary[0]->t_salary;
			
			$this->set(compact('payment_ex'));



		
		/* receive */
		
		
		
		
		$query=$this->Sales->find('all')
		->where(['VCH_TYPE' =>VCH_TYPE_RECIEPT])
		->andWhere(['month(VCH_DATE)' =>$month_name])
		->andWhere(['YEAR(VCH_DATE)' =>$year]);
		$receive = $query->toArray();
		$this->set(compact('receive'));
	
		
			$query = $this->Sales->find();
			$query->select(['t_salary' => $query->func()->sum('VCH_AMOUNT')])
			->where(['VCH_TYPE' =>VCH_TYPE_RECIEPT])
			->andWhere(['month(VCH_DATE)' =>$month_name])
			->andWhere(['YEAR(VCH_DATE)' =>$year]);
			$total_salary=$query->toArray();
			$this->set(compact('total_salary'));
			
			$receive_Amount=$total_salary[0]->t_salary;
			
			$this->set(compact('receive_Amount'));



		
		

			
			
			}
			
			
			
			
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
