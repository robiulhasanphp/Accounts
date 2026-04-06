<?php
declare(strict_types=1);

namespace App\Controller;

use App\Controller\AppController;
use Cake\Http\Exception\NotFoundException;

class BasicdataController extends AppController
{
    public function index(): void
    {
        $basicdata = $this->Basicdata->find()->all();
        $this->set(compact('basicdata'));
    }

    public function view(int $id): void
    {
        $basicdata = $this->Basicdata->get($id);

        if (!$basicdata) {
            throw new NotFoundException('Record not found');
        }

        $this->set(compact('basicdata'));
    }

    public function add()
    {
        $basicdata = $this->Basicdata->newEmptyEntity();

        if ($this->request->is('post')) {

            $basicdata = $this->Basicdata->patchEntity(
                $basicdata,
                $this->request->getData()
            );

            $basicdata->bas_type_id = 3;

            if ($this->Basicdata->save($basicdata)) {
                $this->Flash->success('Saved successfully');
                return $this->redirect(['action' => 'index']);
            }

            $this->Flash->error('Save failed');
        }

        $this->set(compact('basicdata'));
    }

    public function edit(int $id)
    {
        $basicdata = $this->Basicdata->get($id);

        if ($this->request->is(['patch', 'post', 'put'])) {

            $basicdata = $this->Basicdata->patchEntity(
                $basicdata,
                $this->request->getData()
            );

            $basicdata->bas_type_id = 3;

            if ($this->Basicdata->save($basicdata)) {
                $this->Flash->success('Updated successfully');
                return $this->redirect(['action' => 'index']);
            }

            $this->Flash->error('Update failed');
        }

        $this->set(compact('basicdata'));
    }

    public function delete(int $id)
    {
        $this->request->allowMethod(['post', 'delete']);

        $basicdata = $this->Basicdata->get($id);

        if ($this->Basicdata->delete($basicdata)) {
            $this->Flash->success('Deleted successfully');
        } else {
            $this->Flash->error('Delete failed');
        }

        return $this->redirect(['action' => 'index']);
    }

    public function isAuthorized($user): bool
    {
        if ($this->request->getParam('action') === 'add') {
            return true;
        }

        return parent::isAuthorized($user);
    }
}
