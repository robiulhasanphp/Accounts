<?php
	namespace App\Controller;
	
use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Network\Exception\NotFoundException;
use Cake\ORM\TableRegistry;	
	
	
	class  PurchaseController extends AppController{
		
/*		var $uses=array ('CompanyRoot', 'CompanyInfo', 'CompanyBranch');
		public $helpers = array('Html', 'Form', 'Session');
		public $components = array('Session');*/
		

		
		
		
		public function index(){
			
			$sdate='';//date('Y-m-').'01';
			$edate='';//date("Y-m-", strtotime("+1 month"));

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
		
				$Purchase = $this->Purchase->find('all')
				->where(['VCH_TYPE' =>VCH_TYPE_PURCHASE])
				->andWhere(['VCH_DATE >=' =>$sdate])
				->andWhere(['VCH_DATE <=' =>$edate])
				->andWhere(['VCH_STATUS !=' =>STS_DELETED])
				->order(['VCH_DATE' =>'DESC','VCH_ID' =>'DESC']);      
				$this->set(compact('Purchase'));
				$this->set(compact('sdate'));
				$this->set(compact('edate'));	
		
	
		}
		
		
		
public function view($VCH_ID)
    {
        if (!$VCH_ID) 
		{
            throw new NotFoundException(__('Invalid user'));
        }

        $Purchase = $this->Purchase->get($VCH_ID);
        $this->set(compact('Purchase'));
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
			
			
			$query=$this->Purchase->Ledgers->find('list',['keyField' => ['LDG_ID'],'valueField' => 'LDG_NAME'])			->order(['LDG_NAME'=>'ASC']);
			//		->where(['LDG_ID IN ' =>$pur]);
			$purchase_f = $query->toArray();
			$this->set(compact('purchase_f'));
			
			
			
			
			
			
			$query=$this->Purchase->Ledgers->find('list',['keyField' => 'LDG_ID','valueField' => 'LDG_NAME'])
	->where(['LDG_TYPES like ' =>'%INV%'])
			->order(['LDG_NAME'=>'ASC']);
			
			$item = $query->toArray();
			
			$this->set(compact('item'));
			
			
		
	
	
        $Purchase = $this->Purchase->newEntity();
        if ($this->request->is('post')) {
			
			
		
			$amount=($this->request->data["VCH_AMOUNT"]);
			$purchase_from=($this->request->data["VCH_CR_ACCOUNTS"]);
			$items=($this->request->data["VCH_DR_ACCOUNTS"]);
			
			
			$ldg = $this->Purchase->Ledgers->get($purchase_from);
			
			$purchase_from_code= $ldg->LDG_CODE;
			$purchase_from_name= $ldg->LDG_NAME;
			
			$ldg = $this->Purchase->Ledgers->get($items);
			
			$item_code= $ldg->LDG_CODE;
			$item_name= $ldg->LDG_NAME;
			
            $Purchase = $this->Purchase->patchEntity($Purchase, $this->request->data);
			
			
			
			$full_des=$purchase_from_code.'(Cr), '.$item_code.'(Dr)';

			$Purchase->VCH_FULL_DESCRIPTION=$full_des;

			$Purchase->ACC_DR_NAME=$item_name;
			$Purchase->ACC_CR_NAME=$purchase_from_name;
			
			$Purchase->VCH_STATUS=STS_CREATE;
			$Purchase->VCH_CREATE_BY=$user['USR_ID'];
			
			$Purchase->VCH_TYPE=VCH_TYPE_PURCHASE;

			$Purchase->VCH_STATUS_BY=$user['USR_ID'];
			$Purchase->VCH_LAST_EDIT_BY=$user['USR_ID'];
			$Purchase->VCH_SUBMIT_BY=$user['USR_ID'];
				
			
			
			$invoice=$this->request->data('INVDATE');

			if ($invoice<>"")
			{
				
				$invoice_date = $invoice;//$this->request->data('INVDATE');
				$Purchase->VCH_INV_DATE = DateToDB($invoice_date.'-','-');
			}
			
			$chalan=$this->request->data('CHALLANDATE');
			
			if ($chalan<>"")
			{
				$chalan_date = $chalan;//$this->request->data('INVDATE');
				$Purchase->VCH_CHALLAN_DATE = DateToDB($chalan_date.'-','-');			

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
				
				$Purchase->VCH_DATE=$pay_date;
				$Purchase->VCH_MONTH=$m;
				$Purchase->VCH_YEAR=$y;
			}
			else
			{
				   $this->Flash->success(__('Please Specify Purchase Date'));
				     $this->set('Purchase', $Purchase);
				   return;
			}

			$project=$Purchase->VCH_PROJECT;

			$department=$Purchase->VCH_DEPARTMENT;
			
		
				
			
			$Purchase->VDT_VOUCHER_NO='';
			

			
			
            if ($this->Purchase->save($Purchase,['validate' => false, 'associated' => false])) {
				
				
				$id = $Purchase->VCH_ID;  //data call from table
				$new_id=$id;
				
				$year=$Purchase->VCH_YEAR;
				$month=$Purchase->VCH_MONTH;
				
				$Purchase=$this->Purchase->get($id);
				
				$vch_Full=$Purchase->VCH_NO_FULL;

				//insert data in another table

				
			    $Voucherdtl = $this->Purchase->Voucherdtl->newEntity();
				 
				$Voucherdtl->VCH_ID=$new_id;
				$Voucherdtl->VDT_DATE=$pay_date;
				$Voucherdtl->VDT_VOUCHER_NO=$vch_Full;
				$Voucherdtl->VDT_LOT=1;
				$Voucherdtl->VDT_SR=1;
				$Voucherdtl->VDT_LDG_ID=$purchase_from;
				$Voucherdtl->VDT_DEBIT=0;
				$Voucherdtl->VDT_CREDIT=$amount;
//echo $project;
				$Voucherdtl->VDT_PROJECT=$project;
			//	echo $department;
				$Voucherdtl->VDT_DEPARTMENT=$department;

						
			$this->Purchase->Voucherdtl->save($Voucherdtl);
				   
		
		
		
		
				 $Voucherdt2 = $this->Purchase->Voucherdtl->newEntity();
				 
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
						
				    $this->Purchase->Voucherdtl->save($Voucherdt2);
				   
				
				
              
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
        $this->set('Purchase', $Purchase);
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
			
			
			$query=$this->Purchase->Ledgers->find('list',['keyField' => ['LDG_ID'],'valueField' => 'LDG_NAME']);
			//		->where(['LDG_ID IN ' =>$pur]);
			$purchase_f = $query->toArray();
			$this->set(compact('purchase_f'));
			
			
			
			
			
			
			
			$query=$this->Purchase->Ledgers->find('list',['keyField' => 'LDG_ID','valueField' => 'LDG_NAME'])
			->where(['LDG_TYPES like ' =>'%INV%'])
			->order(['LDG_NAME'=>'ASC']);
			
			$item = $query->toArray();
			
			$this->set(compact('item'));
			
			
			
			$Purchase = $this->Purchase->get($VCH_ID);
			//				echo $Purchase->VCH_DATE;
			$Purchase->pdate=date('d-m-Y',strtotime($Purchase->VCH_DATE));
			
			$Purchase->INVDATE=validateDate($Purchase->VCH_INV_DATE);
			
			$Purchase->CHALLANDATE=validateDate($Purchase->VCH_CHALLAN_DATE);


			
				
				$Purchase->pay_date=validateDate($Purchase->VCH_DATE);;


        if ($this->request->is(['post','put'])) {
			
			
		
			$amount=($this->request->data["VCH_AMOUNT"]);
			$purchase_from=($this->request->data["VCH_CR_ACCOUNTS"]);
			$items=($this->request->data["VCH_DR_ACCOUNTS"]);
			
			
			$ldg = $this->Purchase->Ledgers->get($purchase_from);
			
			$purchase_from_code= $ldg->LDG_CODE;
			$purchase_from_name= $ldg->LDG_NAME;			
			
			$ldg = $this->Purchase->Ledgers->get($items);
			
			$item_code= $ldg->LDG_CODE;
			$item_name= $ldg->LDG_NAME;
			
            $Purchase = $this->Purchase->patchEntity($Purchase, $this->request->data);
			
			
			
			$full_des=$purchase_from_code.'(Cr), '.$item_code.'(Dr)';

			$Purchase->VCH_FULL_DESCRIPTION=$full_des;
			
			$Purchase->ACC_DR_NAME=$item_name;
			$Purchase->ACC_CR_NAME=$purchase_from_name;

			$Purchase->VCH_STATUS=STS_EDIT;
			
			
		
			$Purchase->VCH_STATUS_BY=$user['USR_ID'];
			$Purchase->VCH_LAST_EDIT_BY=$user['USR_ID'];
	
				
			
			
			$invoice=$this->request->data('INVDATE');

			if ($invoice<>"")
			{
				
				$invoice_date = $invoice;//$this->request->data('INVDATE');
				$Purchase->VCH_INV_DATE = DateToDB($invoice_date.'-','-');
			}
			
			$chalan=$this->request->data('CHALLANDATE');
			
			if ($chalan<>"")
			{
				$chalan_date = $chalan;//$this->request->data('INVDATE');
				$Purchase->VCH_CHALLAN_DATE = DateToDB($chalan_date.'-','-');			

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
				
				$Purchase->VCH_DATE=$pay_date;
				$Purchase->VCH_MONTH=$m;
				$Purchase->VCH_YEAR=$y;
			}
			else
			{
				   $this->Flash->success(__('Please Specify Purchase Date'));
				     $this->set('Purchase', $Purchase);
				   return;
			}

			$project=$Purchase->VCH_PROJECT;

			$department=$Purchase->VCH_DEPARTMENT;
			
		
				
			
			
			

			
			
            if ($this->Purchase->save($Purchase,['validate' => false, 'associated' => false])) {
				
					$this->Purchase->Voucherdtl->deleteAll(['VCH_ID' =>$VCH_ID]);
						
									$VCH_NO = $Purchase->VCH_NO_FULL; 
									$new_id= $Purchase->VCH_ID;  //data call from table

				//insert data in another table

				
				 $Voucherdtl = $this->Purchase->Voucherdtl->newEntity();
				 
				$Voucherdtl->VCH_ID=$new_id;
				$Voucherdtl->VDT_DATE=$pay_date;
				$Voucherdtl->VDT_VOUCHER_NO=$VCH_NO;
				$Voucherdtl->VDT_LOT=1;
				$Voucherdtl->VDT_SR=1;
				$Voucherdtl->VDT_LDG_ID=$purchase_from;
				$Voucherdtl->VDT_DEBIT=0;
				$Voucherdtl->VDT_CREDIT=$amount;
//echo $project;
				$Voucherdtl->VDT_PROJECT=$project;
			//	echo $department;
				$Voucherdtl->VDT_DEPARTMENT=$department;

						
			$this->Purchase->Voucherdtl->save($Voucherdtl);
				   
		
		
		
		
				 $Voucherdt2 = $this->Purchase->Voucherdtl->newEntity();
				 
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
						
				    $this->Purchase->Voucherdtl->save($Voucherdt2);
				   
				
					
		 return $this->redirect(array('action' => 'index'));
			 
            }
            $this->Flash->error(__('Unable to add the vouchers.'));
        }
        $this->set('Purchase', $Purchase);
    }

	
		
public function delete($VCH_ID = null)
{
	
	
		$user = $this->Auth->User();	
    $Purchase = $this->Purchase->get($VCH_ID);
    if ($this->request->is(['post', 'put'])) {
		

		
		
        $this->Purchase->patchEntity($Purchase, $this->request->data);
		
		$Purchase->VCH_STATUS=STS_DELETED;
			$Purchase->VCH_STATUS_DATE=date('Y-m-d');
			$Purchase->VCH_STATUS_BY=$user['USR_ID'];
        if ($this->Purchase->save($Purchase)) {
            $this->Flash->success(__('Your Purchase has been Deleted.'));
            return $this->redirect(['action' => 'index']);
        }
        $this->Flash->error(__('Unable to Delete your Purchase.'));
    }

    $this->set('Purchase', $Purchase);
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
