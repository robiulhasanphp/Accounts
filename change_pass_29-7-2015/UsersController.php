<?php

// src/Controller/UsersController.php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Network\Exception\NotFoundException;

class UsersController extends AppController
{

    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->Auth->allow('add');
    }
	
	

    public function index(){
			$this->set('userlist', $this->Users->find('all'));
		}
	
	
	
	

    public function view($id)
    {
        if (!$id)
		 {
            throw new NotFoundException(__('Invalid user'));
        }

        $user = $this->Users->get($id);
        $this->set(compact('user'));
    }

 public function add()
    { 
		
	
		$query=$this->Users->UserGroup->find('list',['keyField' => 'BAS_ID','valueField' => 'BAS_NAME'])
		->where(['BAS_TYPE_ID' => 3]);
	
		$Usergroups = $query->toArray();

		 $this->set(compact('Usergroups'));
		
		
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) 
		{
            $user = $this->Users->patchEntity($user, $this->request->data);
			
		$user->USR_GROUP=6;
			$user->USR_DESIGNATION=6;
			
            if ($this->Users->save($user))
			 {
                $this->Flash->success(__('The user has been saved.'));
                return $this->redirect(['action' => 'add']);
             }
            $this->Flash->error(__('Unable to add the user.'));
        }
        $this->set('user', $user);
    }




public function edit($USR_ID = null)
{
	
	
	$query=$this->Users->UserGroup->find('list',['keyField' => 'BAS_ID','valueField' => 'BAS_NAME'])
		->where(['BAS_TYPE_ID' => 3]);
		$Usergroups = $query->toArray();
		$this->set(compact('Usergroups'));
   
	
    $Users=$this->Users->get($USR_ID);
    if ($this->request->is(['post', 'put'])) {
        $this->Users->patchEntity($Users, $this->request->data);
        if ($this->Users->save($Users)) {
            $this->Flash->success(__('Your article has been updated.'));
            return $this->redirect(['action' => 'index']);
        }
        $this->Flash->error(__('Unable to update your article.'));
    }

    $this->set('Users', $Users);
}





public function status($id = null) 
{
			if (!$id) 
			{
				throw new NotFoundException(__('Invalid post'));
			}
		
			$post = $this->Users->get($id);
		
			if (!$post) 
			{
				throw new NotFoundException(__('Invalid post'));
			}
	
	
			if($post->USR_STATUS==0)
			{
				$post->USR_STATUS=1;
			}
	
			else
			{
				$post->USR_STATUS=0;
			}

		
			if ($this->Users->save($post))
			 {
				
				$this->set('post', $this->Users->get($id));
				return $this->redirect(array('action' => 'index'));
			}
			
 }
		




	


public function login()
{
    if ($this->request->is('post')) {
        $user = $this->Auth->identify();
		

        if ($user) {
            $this->Auth->setUser($user);
            return $this->redirect($this->Auth->redirectUrl());
        }
        $this->Flash->error(__('Invalid username or password, try again'));
    }
}





public function logout()
{
    return $this->redirect($this->Auth->logout());
}




public function change_pass($USR_ID = null)
    { 
		
        $Users = $this->Users->get($USR_ID);
		//echo "<pre>";
		//var_dump($Users);
		$db_pass = $Users['password'];
		
		//echo "</pre>";
		
		
		$this->set(compact('Users'));
       
		if ($this->request->is(['post','put'])) 
		{
			
			$old_pass = $this->request->data['old_pass'];
			$new_pass = $this->request->data['new_pass'];
			$retype_pass = $this->request->data['retype_pass'];
			
			/*echo " db_pass =  ".$db_pass."<br />";
			echo "old ".$old_pass."<br />";
			echo " new ".$new_pass."<br />";
			echo " re-new ".$retype_pass."<br /><br />";*/
			//echo password_hash($retype_pass, PASSWORD_DEFAULT)."\n";
			
			//$hash = password_hash($retype_pass, PASSWORD_DEFAULT)."\n";
			
			if(password_verify($old_pass, $db_pass))
			{
				//echo "old_pass Same";
				
				if($new_pass == $retype_pass){
					if(($new_pass != $old_pass) && ($retype_pass != $old_pass))
					{
						if(($new_pass != "") && ($retype_pass != ""))
						{
							//echo "pass ok";
							$Users['password'] = $new_pass;
							
							$Users = $this->Users->patchEntity($Users, $this->request->data);
			
							if ($this->Users->save($Users))
							 {
								$this->Flash->success(__('The user has been saved.'));
								//return $this->redirect(['action' => 'change_pass']);
							 }
							//$this->Flash->error(__('Unable to add the user.'));

						}
						else
						{
							echo "field should not be blank";
						}
					}
					else
					{
						echo "old pass is not accepted as new_pass and retype_pass";
					}
				}
				
				else
				{
					echo "new_pass and retype_pass NOT Same";
				}
				
			}
			else
			{
				echo "old_pass Not Same";
			}
			
        }
        $this->set('Users', $Users);
    }







}
?>