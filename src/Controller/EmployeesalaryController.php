<?php
	namespace App\Controller;
	
use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Network\Exception\NotFoundException;
	
	
	
	class  EmployeesalaryController extends AppController{
		
/*		var $uses=array ('CompanyRoot', 'CompanyInfo', 'CompanyBranch');
		public $helpers = array('Html', 'Form', 'Session');
		public $components = array('Session');*/
		

		
		
		
		public function index(){
			
	$salary = $this->Employeesalary->find('all')->contain('Basicdata');
        $this->set(compact('salary'));
	
   
 
	
		}
		
		
	  public function salary_process()
    	{
			
			
			
		$query=$this->Employeesalary->Basicdata->find('all')
		->where(['BAS_ID >=' =>22]);
		$name = $query->toArray();
		 $this->set(compact('name'));
		 
			
			
			
		$query=$this->Employeesalary->find('list',['valueField' => 'EMPLOYEE_ID']);
		$id = $query->toArray();
		 $this->set(compact('id'));
        		



	$query=$this->Employeesalary->Ledgers->find('all')->contain('Employeesalary')
	->where(['LDG_ID IN' =>$id]);
		$emp_name = $query->toArray();
		 $this->set(compact('emp_name'));


		 


		$query = $this->Employeesalary->find();
		$query->select(['t_salary' => $query->func()->sum('EMS_AMOUNT')])
		->where(['EMPLOYEE_ID IN' =>$id]);
		$total_salary=$query->toArray();
		$this->set(compact('total_salary'));

		$monthly_salary=$total_salary[0]->t_salary;
		
		$this->set(compact('monthly_salary'));

		echo $monthly_salary;
    	}
		
		
		
		
		
		public function EmployeeSelect($EMS_ID = null)
    	{
		
		$query=$this->Employeesalary->Ledgerstype->find('list',['keyField' => ['LDG_ID'],'valueField' => 'LDG_ID'])
		
		->where(['LTM_ID' =>4])
		->orWhere(['LTM_ID' =>6])
		->orWhere(['LTM_ID' =>7])
    	->orWhere(['LTM_ID' =>2]);
	
		$pur=$query->toArray();


		$query=$this->Employeesalary->Ledgers->find('list',['keyField' => ['LDG_ID'],'valueField' => 'LDG_NAME'])
		->where(['LDG_ID IN ' =>$pur]);
		$name = $query->toArray();
		 $this->set(compact('name'));
		 
		 
		 
		if ($this->request->is('post')) {


		
		$emp_id=($this->request->data["EMPLOYEE_ID"]);
		 $this->set(compact('emp_id'));
		 
		 
		 return $this->redirect(['action' => 'add',$emp_id]);
		 
  			
		}
		 
		
		
		}
		
	  public function add($EMS_ID = null)
    	{
		
		
			$query=$this->Employeesalary->Ledgers->find('all')
		->where(['LDG_ID IN ' =>$EMS_ID]);
		$name = $query->toArray();
		 $this->set(compact('name'));
		
		
		
		
		$this->set(compact('EMS_ID'));		
		/** Allowance list **/
		$query=$this->Employeesalary->Basicdata->find('list',['keyField' => ['BAS_ID'],'valueField' => 'BAS_NAME'])
		->where(['BAS_TYPE_ID' =>6]);
		
		$allowance =$query->toArray();
		$this->set(compact('allowance'));
		
		
		/** end Allowance List*/
		
		
		
		$emp_salary_data = $this->Employeesalary->find('all')->contain('Basicdata')
		->where(['EMPLOYEE_ID' =>$EMS_ID]);
        $this->set(compact('emp_salary_data'));
		
	
	
	
		$query = $this->Employeesalary->find();
		$query->select(['t_salary' => $query->func()->sum('EMS_AMOUNT')])
		->where(['EMPLOYEE_ID' =>$EMS_ID]);
		$total_salary=$query->toArray();
		$this->set(compact('total_salary'));

		$monthly_salary=$total_salary[0]->t_salary;
		
		$this->set(compact('monthly_salary'));
		


	
	
		$emp_salary = $this->Employeesalary->newEntity();

		if ($this->request->is('post')) {
			
			

				
		$e_salary=($this->request->data["EMS_SALARY"]);
		 $this->set(compact('e_salary'));
		
		
					
				
		$query=$this->Employeesalary->find('list',['valueField' => 'EMS_SALARY'])
		->where(['EMPLOYEE_ID' =>$EMS_ID])
		->andWhere(['EMS_SALARY' =>$e_salary]);
		$e_salray_id =$query->toArray();
		$this->set(compact('e_salray_id'));
		
		
			
		
		if(count($e_salray_id)>0)
		{
			
			$this->Flash->success(__('duplicate allowance.'));
						return $this->redirect(['action' => 'add',$EMS_ID]);
		}
		else
			{
			
		$emp_salary = $this->Employeesalary->patchEntity($emp_salary, $this->request->data);
			
            if ($this->Employeesalary->save($emp_salary))
					 {

						$this->Flash->success(__('The user has been saved.'));
						// return $this->redirect(['action' => 'add',$EMS_ID]);
					 }
			}
		}
	
			
		
        $this->set('emp_salary', $emp_salary);
  
	}




		
public function edit($EMS_ID = null)
{
	

		
	
	$query=$this->Employeesalary->Basicdata->find('list',['keyField' => ['BAS_ID'],'valueField' => 'BAS_NAME'])
		->where(['BAS_TYPE_ID' =>6]);
		
		$allowance =$query->toArray();
		$this->set(compact('allowance'));
		
	
    $emp_salary = $this->Employeesalary->get($EMS_ID);
    $empsalary_id=$emp_salary->EMPLOYEE_ID;
	
		
		$this->set(compact('empsalary_id'));
	if ($this->request->is(['post', 'put'])) {
		
		
		
		$e_salary=($this->request->data["EMS_SALARY"]);
		 $this->set(compact('e_salary'));
		
		
					
				
		$query=$this->Employeesalary->find('list',['valueField' => 'EMS_SALARY'])
		->where(['EMPLOYEE_ID' =>$empsalary_id])
		->andWhere(['EMS_SALARY' =>$e_salary])
		->andWhere(['EMS_ID <>' =>$EMS_ID]);
		$e_salray_id =$query->toArray();
		$this->set(compact('e_salray_id'));
		
		
			
		
		if(count($e_salray_id)>0)
		{
			
			$this->Flash->success(__('duplicate allowance.'));
						return $this->redirect(['action' => 'add',$empsalary_id]);
		}
		else
			{
			
		$emp_salary = $this->Employeesalary->patchEntity($emp_salary, $this->request->data);
			
            if ($this->Employeesalary->save($emp_salary))
					 {

						$this->Flash->success(__('The user has been saved.'));
						 return $this->redirect(['action' => 'add',$empsalary_id]);
					 }
			}
		}
	
			
		
        $this->set('emp_salary', $emp_salary);
  
	}

		

	
	
		public function delete($EMS_ID = null)
{
    $employee_salary = $this->Employeesalary->get($EMS_ID);
	
	 $empsalary_id=$employee_salary->EMPLOYEE_ID;
	
        $this->request->is(['post', 'delete']);
        if ($this->Employeesalary->delete($employee_salary)) {
            $this->Flash->success('The user has been deleted.');
        } else {
            $this->Flash->error('The user could not be deleted. Please, try again.');
        }
        return $this->redirect(['action' => 'add',$empsalary_id]);
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