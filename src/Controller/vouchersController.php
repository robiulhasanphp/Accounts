<?php
	namespace App\Controller;
	
use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Network\Exception\NotFoundException;
use Cake\ORM\TableRegistry;	
	
	
	class  vouchersController extends AppController{
		
/*		var $uses=array ('CompanyRoot', 'CompanyInfo', 'CompanyBranch');
		public $helpers = array('Html', 'Form', 'Session');
		public $components = array('Session');*/
		

		
		
		
		public function index(){
			
	$vouchers = $this->vouchers->find('all');
        $this->set(compact('vouchers'));
	
   
	
		}
		
		
	  public function view($BAS_ID)
    {
        if (!$BAS_ID) 
		{
            throw new NotFoundException(__('Invalid user'));
        }

        $Project = $this->Project->get($BAS_ID);
        $this->set(compact('Project'));
    }
		
		
		
		
		
	  public function add()
    {
	
		$user = $this->Auth->User();
		
	$Basicdata = TableRegistry::get('Basicdata');

		$query=$Basicdata->find('list',['keyField' => ['BAS_ID'],'valueField' => 'BAS_NAME'])
		->where(['BAS_TYPE_ID' =>5]);
	
		$project = $query->toArray();
		
		 $this->set(compact('project'));
		 

		
		$query=$Basicdata->find('list',['keyField' => ['BAS_ID'],'valueField' => 'BAS_NAME'])
		->where(['BAS_TYPE_ID' =>4]);
	
		$department = $query->toArray();
		
		 $this->set(compact('department'));
		


		$query=$this->vouchers->Ledgerstype->find('list',['keyField' => ['LDG_ID'],'valueField' => 'LDG_ID'])
		
		->where(['LTM_ID' =>4])
		->orWhere(['LTM_ID' =>6])
		->orWhere(['LTM_ID' =>7])
    	->orWhere(['LTM_ID' =>2]);
	
		$pur=$query->toArray();
	
	
		$query=$this->vouchers->Ledgers->find('list',['keyField' => ['LDG_NAME'],'valueField' => 'LDG_NAME'])
		->where(['LDG_ID IN ' =>$pur]);
	
		$purchase = $query->toArray();
	
		 $this->set(compact('purchase'));
	
	
			 

	$query=$this->vouchers->Ledgerstype->find('list',['keyField' => ['LDG_ID'],'valueField' => 'LDG_ID'])
		->where(['LTM_ID' =>3]);
	
	
		$itm=$query->toArray();


		
		$query=$this->vouchers->Ledgers->find('list',['keyField' => ['LDG_NAME'],'valueField' => 'LDG_NAME'])
		->where(['LDG_ID IN ' =>$itm]);
	
		$item = $query->toArray();
	
		 $this->set(compact('item'));
		 

			$query = $this->vouchers->find();
			$query->select(['max' => $query->func()->max('VCH_ID')]);

			$m_id=$query->toArray();
			$a=$m_id[0]['max'];
			$b=((int)$a)+1;

		
	
	
        $vouchers = $this->vouchers->newEntity();
        if ($this->request->is('post')) {
            $vouchers = $this->vouchers->patchEntity($vouchers, $this->request->data);
			
			
			
			$purchase=$this->request->data('VCH_CR_ACCOUNTS');
			
			$vouchers->VCH_STATUS=0;
			$vouchers->VCH_CREATE_BY=$user['USR_ID'];
			
			$vouchers->VCH_TYPE=7;
			$vouchers->VCH_STATUS=13;
			$vouchers->VCH_STATUS_BY=$user['USR_ID'];
			$vouchers->VCH_LAST_EDIT_BY=$user['USR_ID'];
			$vouchers->VCH_SUBMIT_BY=$user['USR_ID'];
			
				
		
			
		
			
			$item=$this->request->data('VCH_DR_ACCOUNTS');
			$narration=$this->request->data('VCH_NARRATION');
			
			
			$full_des=$purchase.','.$item.','.$narration;
			
			$vouchers->VCH_FULL_DESCRIPTION=$full_des;
			
			
			
			$invoice=$this->request->data('INVDATE');
			
			$birthday_in = explode('-', $invoice);
				$d = $birthday_in[0];
				$m = $birthday_in[1];
				$y = $birthday_in[2];
				$invoice_date = $y.'-'.$m.'-'.$d;
				
				$vouchers->VCH_INV_DATE=$invoice_date;
			
			$chalan=$this->request->data('CHALLANDATE');
			
			$birthday_ch = explode('-', $chalan);
				$d = $birthday_ch[0];
				$m = $birthday_ch[1];
				$y = $birthday_ch[2];
				$chalan_date = $y.'-'.$m.'-'.$d;
			
			$vouchers->VCH_CHALLAN_DATE=$chalan_date;
			
			
			$date=$this->request->data('pdate');
				$birthday_sep = explode('-', $date);
				$d = $birthday_sep[0];
				$m = $birthday_sep[1];
				$y = $birthday_sep[2];
				$birthday = $y.'-'.$m.'-'.$d;
				
			$vouchers->VCH_DATE=$birthday;

		$new_date=$birthday;
		
			$birthday_name = explode('-', $new_date);
				$d = $birthday_name[0];
				$m = $birthday_name[1];
				$y = $birthday_name[2];
				$month = $m;	
			
			
			
			
			$birthday_year = explode('-', $new_date);
				$d = $birthday_year[0];
				$m = $birthday_year[1];
				$y = $birthday_year[2];
				$year = $d;	
		
			
			
			$vouchers->VCH_MONTH=$month;
			$vouchers->VCH_YEAR=$year;
			
			
				$vch_Full=$year.$month.'0000'.$b;
			
			$vouchers->VCH_NO_FULL=$vch_Full;
			
			
            if ($this->vouchers->save($vouchers)) {
                $this->Flash->success(__('The vouchers has been saved.'));
              
			 return $this->redirect(array('action' => 'index'));
			 
            }
            $this->Flash->error(__('Unable to add the vouchers.'));
        }
        $this->set('vouchers', $vouchers);
    }


		
		
public function edit($VCH_ID = null)
{
	
	
	$user = $this->Auth->User();
		
	$Basicdata = TableRegistry::get('Basicdata');

		$query=$Basicdata->find('list',['keyField' => ['BAS_ID'],'valueField' => 'BAS_NAME'])
		->where(['BAS_TYPE_ID' =>5]);
	
		$project = $query->toArray();
		
		 $this->set(compact('project'));
		 


		$query=$Basicdata->find('list',['keyField' => ['BAS_ID'],'valueField' => 'BAS_NAME'])
		->where(['BAS_TYPE_ID' =>4]);
	
		$department = $query->toArray();
		
		 $this->set(compact('department'));
		
		$query=$this->vouchers->Ledgerstype->find('list',['keyField' => ['LDG_ID'],'valueField' => 'LDG_ID'])
		
		->where(['LTM_ID' =>4])
		->orWhere(['LTM_ID' =>6])
		->orWhere(['LTM_ID' =>7])
    	->orWhere(['LTM_ID' =>2]);
	
		$pur=$query->toArray();
	
	
		$query=$this->vouchers->Ledgers->find('list',['keyField' => ['LDG_NAME'],'valueField' => 'LDG_NAME'])
		->where(['LDG_ID IN ' =>$pur]);
	
		$purchase = $query->toArray();
	
		 $this->set(compact('purchase'));
	
	
			 

	$query=$this->vouchers->Ledgerstype->find('list',['keyField' => ['LDG_ID'],'valueField' => 'LDG_ID'])
		->where(['LTM_ID' =>3]);
	
	
		$itm=$query->toArray();


		
		$query=$this->vouchers->Ledgers->find('list',['keyField' => ['LDG_NAME'],'valueField' => 'LDG_NAME'])
		->where(['LDG_ID IN ' =>$itm]);
	
		$item = $query->toArray();
	
		 $this->set(compact('item'));
		 

			$query = $this->vouchers->find();
			$query->select(['max' => $query->func()->max('VCH_ID')]);

			$m_id=$query->toArray();
			$a=$m_id[0]['max'];
			$b=((int)$a)+1;
			
			$date2=20;
			
				
		
		
			
	
    $vouchers = $this->vouchers->get($VCH_ID);
	
	$da=$vouchers->VCH_DATE;
	
    if ($this->request->is(['post', 'put'])) {
        $this->vouchers->patchEntity($vouchers, $this->request->data);
		
		
		
		
		
		$purchase=$this->request->data('VCH_CR_ACCOUNTS');
			
			$vouchers->VCH_STATUS=0;
			$vouchers->VCH_CREATE_BY=$user['USR_ID'];
			
			$vouchers->VCH_TYPE=7;
			$vouchers->VCH_STATUS=13;
			$vouchers->VCH_STATUS_BY=$user['USR_ID'];
			$vouchers->VCH_LAST_EDIT_BY=$user['USR_ID'];
			$vouchers->VCH_SUBMIT_BY=$user['USR_ID'];
			
				
		
			
		
			
			$item=$this->request->data('VCH_DR_ACCOUNTS');
			$narration=$this->request->data('VCH_NARRATION');
			
			
			$full_des=$purchase.','.$item.','.$narration;
			
			$vouchers->VCH_FULL_DESCRIPTION=$full_des;
			
			
			
			$invoice=$this->request->data('INVDATE');
			
			$birthday_in = explode('-', $invoice);
				$d = $birthday_in[0];
				$m = $birthday_in[1];
				$y = $birthday_in[2];
				$invoice_date = $y.'-'.$m.'-'.$d;
				
				$vouchers->VCH_INV_DATE=$invoice_date;
			
			$chalan=$this->request->data('CHALLANDATE');
			
			$birthday_ch = explode('-', $chalan);
				$d = $birthday_ch[0];
				$m = $birthday_ch[1];
				$y = $birthday_ch[2];
				$chalan_date = $y.'-'.$m.'-'.$d;
			
			$vouchers->VCH_CHALLAN_DATE=$chalan_date;
			
			
			$date=$this->request->data('pdate');
				$birthday_sep = explode('-', $date);
				$d = $birthday_sep[0];
				$m = $birthday_sep[1];
				$y = $birthday_sep[2];
				$birthday = $y.'-'.$m.'-'.$d;
				
			$vouchers->VCH_DATE=$birthday;

		$new_date=$birthday;
		
			$birthday_name = explode('-', $new_date);
				$d = $birthday_name[0];
				$m = $birthday_name[1];
				$y = $birthday_name[2];
				$month = $m;	
			
			
			
			
			$birthday_year = explode('-', $new_date);
				$d = $birthday_year[0];
				$m = $birthday_year[1];
				$y = $birthday_year[2];
				$year = $d;	
		
			
			
			$vouchers->VCH_MONTH=$month;
			$vouchers->VCH_YEAR=$year;
			
			
				$vch_Full=$year.$month.'0000'.$b;
			
			$vouchers->VCH_NO_FULL=$vch_Full;
		
		
		
		
		
	
        if ($this->vouchers->save($vouchers)) {
            $this->Flash->success(__('Your article has been updated.'));
            return $this->redirect(['action' => 'index']);
        }
        $this->Flash->error(__('Unable to update your article.'));
    }

    $this->set('vouchers', $vouchers);
}

	
	
		public function delete($VCH_ID = null)
{
    $vouchers = $this->vouchers->get($VCH_ID);
        $this->request->is(['post', 'delete']);
        if ($this->vouchers->delete($vouchers)) {
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