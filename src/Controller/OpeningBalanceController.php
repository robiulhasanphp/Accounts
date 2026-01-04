<?php
	namespace App\Controller;
	
	use App\Controller\AppController;
	use Cake\Event\Event;
	use Cake\Network\Exception\NotFoundException;
	use Cake\ORM\TableRegistry;	
	
	class  OpeningBalanceController extends AppController{
		
		
		public function index()
		{
			
			
			
			
			$query=$this->OpeningBalance->find('list',['keyField' => 'LDG_BAL_PERIOD', 'valueField' => 'LDG_BAL_PERIOD'])->group('LDG_BAL_PERIOD')->order(['LDG_BAL_PERIOD'=>'DESC']);
			$LDG_period = $query->toArray();
			$this->set(compact('LDG_period'));
			
			$query=$this->OpeningBalance->find('all');
			
			
			$xx = $query->select([
				'maxm' => $query->func()->max('LDG_BAL_PERIOD')
				
			])->order(['LDG_BAL_PERIOD'=>'DESC']);


			$last_period = $xx->toArray();
			$this->set(compact('last_period'));
			//var_dump( $last_period);

		
		$search_period=$last_period[0]["maxm"];
		
		if ($this->request->is(['post', 'put'])) {
			$search_period=$this->request->data['LDG_BAL_PERIOD'];
		}
	
		$this->set('OpeningBalance', $this->OpeningBalance->find('all')->contain('Ledgers')
			->where(['LDG_BAL_PERIOD' => $search_period])->order(['Ledgers.LDG_NAME'=>'ASC']));		
			
			



	
       $OfficeExpenses = $this->OpeningBalance->newEntity();
        if ($this->request->is('post')) 
		{

	
            $OfficeExpenses = $this->OpeningBalance->patchEntity($OfficeExpenses, $this->request->data);
           /* if ($this->OpeningBalance->save($OfficeExpenses)) 
			{
                $this->Flash->success(__('The user has been saved.'));
               return $this->redirect(array('action' => 'index'));
            }
            $this->Flash->error(__('Unable to add the user.'));*/
        }
        $this->set('OfficeExpenses', $OfficeExpenses);
    }




	public function view($id = null){
		$OpeningBalance = $this->OpeningBalance->find('all')->contain('Ledgers')
		->where(['LDG_BAL_ID'=>$id]);
		$this->set(compact('OpeningBalance'));
		
		//echo "<pre>";
		//var_dump($OpeningBalance);
		//exit();
	}

		
		
		
	 public function add()
		{
		//var_dump($this->OpeningBalance->find('all')->contain('Ledgers'));
		$query=$this->OpeningBalance->Ledgers->find('list',['keyField' => 'LDG_ID','valueField' => 'LDG_NAME'])->order(['LDG_NAME'=>'ASC']);
	
		$LDG_name = $query->toArray();
		$this->set(compact('LDG_name'));
			
			$OpeningBalance = $this->OpeningBalance->newEntity();
			
			
			
			if ($this->request->is('post')) {
				
				
				
				$OpeningBalance = $this->OpeningBalance->patchEntity($OpeningBalance, $this->request->data);
				
				
				$b_date = $this->request->data('balance_date');
				$b_date_change = explode('-', $b_date);
				
				$d = $b_date_change[0];
				$m = $b_date_change[1];
				$y = $b_date_change[2];
				$lb_date = $y.'-'.$m.'-'.$d;
				$period = $y.$m;
				$OpeningBalance->LDG_BAL_DATE = $lb_date;
				
				
				$OpeningBalance->LDG_BAL_PERIOD = $period;
				
				$ldg_id = $this->request->data['LDG_ID'];
				
				$query = $this->OpeningBalance->find('all')
				->where(['LDG_BAL_PERIOD'=>$period])
				->andWhere(['LDG_ID'=>$ldg_id]);
				
				$qa = $query->toArray();
				if(count($qa)>0){
					$this->set('OpeningBalance', $OpeningBalance);
					$this->Flash->error(__('Unable to add your article.'));
					return;
					
				}
				
				
					if ($this->OpeningBalance->save($OpeningBalance)) {
						$this->Flash->success(__('Your article has been saved.'));
						return $this->redirect(['action' => 'index']);
					}
				//}
				$this->Flash->error(__('Unable to add your article.'));
			}
			$this->set('OpeningBalance', $OpeningBalance);
		}	
		
		
		
		
		
		public function edit($LDG_BAL_ID = null)
		{
			
			$query=$this->OpeningBalance->Ledgers->find('list',['keyField' => ['LDG_ID'],'valueField' => 'LDG_NAME'])->order(['LDG_NAME'=>'ASC']);
	//		->where(['LDG_ID IN ' =>$pur]);
			$lgd_name1 = $query->toArray();
			 $this->set(compact('lgd_name1'));
			
			
			$OpeningBalance = $this->OpeningBalance->get($LDG_BAL_ID);
			
			$OpeningBalance->balance_date=date('d-m-Y',strtotime($OpeningBalance->LDG_BAL_DATE));
			
			
			
			
			if ($this->request->is(['post', 'put'])) {
				
				
				$OpeningBalance->LDG_BAL_DATE=date('Y-m-d',strtotime($this->request->data['balance_date']));
				
				
				
				
				
				
				
				$b_date = $this->request->data('balance_date');
				$b_date_change = explode('-', $b_date);
				
				$d = $b_date_change[0];
				$m = $b_date_change[1];
				$y = $b_date_change[2];
				$lb_date = $y.'-'.$m.'-'.$d;
				$period = $y.$m;
				$OpeningBalance->LDG_BAL_DATE = $lb_date;
				
				
				$OpeningBalance->LDG_BAL_PERIOD = $period;
				
				$ldg_id = $this->request->data['LDG_ID'];
				
				$lgd_bal_id = $this->request->data('LDG_BAL_ID');
				
				
				$query = $this->OpeningBalance->find('all')
				->where(['LDG_BAL_PERIOD'=>$period])
				->andWhere(['LDG_ID'=>$ldg_id])
				->andWhere(['LDG_BAL_ID !='=>$lgd_bal_id]);				
				
				$qa = $query->toArray();
				
				
				
				
				if(count($qa)>0){
					$this->set('OpeningBalance', $OpeningBalance);
					$this->Flash->error(__('Unable to add your article.'));
					return;
					
				}

				
				
				$this->OpeningBalance->patchEntity($OpeningBalance, $this->request->data);
								
				if ($this->OpeningBalance->save($OpeningBalance)) {
					$this->Flash->success(__('Your OpeningBalance has been updated.'));
					return $this->redirect(['action' => 'index']);
				}
				$this->Flash->error(__('Unable to update your OpeningBalance.'));
			}
		
			$this->set('OpeningBalance', $OpeningBalance);
		}
		
		
		
		
		
		
		
		public function delete($id)
		{
			//$this->request->allowMethod(['post', 'delete']);
		
			$OpeningBalance = $this->OpeningBalance->get($id);
			if ($this->OpeningBalance->delete($OpeningBalance)) {
				$this->Flash->success(__('The Opening Balance has been deleted.', h($id)));
				return $this->redirect(['action' => 'index']);
			}
		}
	
	
	
		
		
		
		
	}

?>