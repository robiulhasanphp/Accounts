<?php
declare(strict_types=1);
namespace App\Controller;

use App\Controller\AppController;

class EmployeesalaryController extends AppController
{
    public function index(): void
    {
        $salary = $this->Employeesalary->find()
            ->contain(['Basicdata'])
            ->all();

        $this->set(compact('salary'));
    }

    public function salaryProcess(): void
    {
        $employees = $this->Employeesalary->find('list', [
            'valueField' => 'EMPLOYEE_ID'
        ])->toArray();

        $total = $this->Employeesalary->find()
            ->select(['total' => $this->Employeesalary->find()->func()->sum('EMS_AMOUNT')])
            ->where(['EMPLOYEE_ID IN' => $employees])
            ->first();

        $monthlySalary = $total->total ?? 0;

        $this->set(compact('employees', 'monthlySalary'));
    }

    public function employeeSelect()
    {
        $ledgerIds = $this->Employeesalary->Ledgerstype->find('list', [
            'valueField' => 'LDG_ID'
        ])
        ->where(['LTM_ID IN' => [2, 4, 6, 7]])
        ->toArray();

        $employees = $this->Employeesalary->Ledgers->find('list', [
            'keyField' => 'LDG_ID',
            'valueField' => 'LDG_NAME'
        ])
        ->where(['LDG_ID IN' => $ledgerIds])
        ->toArray();

        $this->set(compact('employees'));

        if ($this->request->is('post')) {
            $id = $this->request->getData('EMPLOYEE_ID');
            return $this->redirect(['action' => 'add', $id]);
        }
    }

    public function add(int $employeeId)
    {
        $employee = $this->Employeesalary->Ledgers->get($employeeId);

        $allowance = $this->Employeesalary->Basicdata->find('list', [
            'keyField' => 'BAS_ID',
            'valueField' => 'BAS_NAME'
        ])
        ->where(['BAS_TYPE_ID' => 6])
        ->toArray();

        $existing = $this->Employeesalary->find()
            ->contain(['Basicdata'])
            ->where(['EMPLOYEE_ID' => $employeeId])
            ->all();

        $total = $this->Employeesalary->find()
            ->select(['total' => $this->Employeesalary->find()->func()->sum('EMS_AMOUNT')])
            ->where(['EMPLOYEE_ID' => $employeeId])
            ->first();

        $empSalary = $this->Employeesalary->newEmptyEntity();

        if ($this->request->is('post')) {

            $data = $this->request->getData();

            $exists = $this->Employeesalary->exists([
                'EMPLOYEE_ID' => $employeeId,
                'EMS_SALARY' => $data['EMS_SALARY']
            ]);

            if ($exists) {
                $this->Flash->error('Duplicate allowance');
                return $this->redirect(['action' => 'add', $employeeId]);
            }

            $empSalary = $this->Employeesalary->patchEntity($empSalary, $data);

            if ($this->Employeesalary->save($empSalary)) {
                $this->Flash->success('Saved');
                return $this->redirect(['action' => 'add', $employeeId]);
            }

            $this->Flash->error('Failed');
        }

        $this->set([
            'employee' => $employee,
            'employeeId' => $employeeId,
            'allowance' => $allowance,
            'existing' => $existing,
            'monthlySalary' => $total->total ?? 0,
            'empSalary' => $empSalary
        ]);
    }

    public function edit(int $id)
    {
        $empSalary = $this->Employeesalary->get($id);
        $employeeId = $empSalary->EMPLOYEE_ID;

        $allowance = $this->Employeesalary->Basicdata->find('list', [
            'keyField' => 'BAS_ID',
            'valueField' => 'BAS_NAME'
        ])
        ->where(['BAS_TYPE_ID' => 6])
        ->toArray();

        if ($this->request->is(['patch', 'post', 'put'])) {

            $data = $this->request->getData();

            $exists = $this->Employeesalary->exists([
                'EMPLOYEE_ID' => $employeeId,
                'EMS_SALARY' => $data['EMS_SALARY'],
                'EMS_ID !=' => $id
            ]);

            if ($exists) {
                $this->Flash->error('Duplicate allowance');
                return $this->redirect(['action' => 'add', $employeeId]);
            }

            $empSalary = $this->Employeesalary->patchEntity($empSalary, $data);

            if ($this->Employeesalary->save($empSalary)) {
                $this->Flash->success('Updated');
                return $this->redirect(['action' => 'add', $employeeId]);
            }

            $this->Flash->error('Failed');
        }

        $this->set(compact('empSalary', 'employeeId', 'allowance'));
    }

    public function delete(int $id)
    {
        $this->request->allowMethod(['post', 'delete']);

        $salary = $this->Employeesalary->get($id);
        $employeeId = $salary->EMPLOYEE_ID;

        if ($this->Employeesalary->delete($salary)) {
            $this->Flash->success('Deleted');
        } else {
            $this->Flash->error('Failed');
        }

        return $this->redirect(['action' => 'add', $employeeId]);
    }

    public function isAuthorized($user): bool
    {
        if ($this->request->getParam('action') === 'add') return true;
        return parent::isAuthorized($user);
    }
}




