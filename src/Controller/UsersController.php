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

/* public function add()
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
*/






 public function add() {
	 
	 
	 
	 
	 
		$query=$this->Users->UserGroup->find('list',['keyField' => 'BAS_ID','valueField' => 'BAS_NAME'])
		->where(['BAS_TYPE_ID' => 3]);
	
		$Usergroups = $query->toArray();

		 $this->set(compact('Usergroups'));
		
	 	 $user = $this->Users->newEntity();
	 
  if ($this->request->is('post')) {
	  
	  
	  	$name=($this->request->data["username"]);
	  
	
            if ($this->request->data["Image"]) {
                $image = $this->request->data['Image'];
                //allowed image types
                $imageTypes = array("image/gif", "image/jpeg", "image/png");
                //upload folder - make sure to create one in webroot
                $uploadFolder = "gallery/user";
                //full path to upload folder
                $uploadPath = WWW_ROOT . $uploadFolder;
               

                //check if image type fits one of allowed types
                foreach ($imageTypes as $type) {
                    if ($type == $image['type']) {
                      //check if there wasn't errors uploading file on serwer
                        if ($image['error'] == 0) {
                             //image file name
                            $imageName = $image['name'];
                            //check if file exists in upload folder
                            if (file_exists($uploadPath . '/' . $imageName)) {
    						                //create full filename with timestamp
                                $imageName = date('His') . $imageName;
                            }
                            //create full path with image name
                            $full_image_path = $uploadPath . '/' . $name.'.png';
                            //upload image to upload folder
							
                            if (move_uploaded_file($image['tmp_name'], $full_image_path))
							
							 {
                               // $this->Session->setFlash('File saved successfully');
                                $this->set('imageName',$imageName);
								
								/*database insert*/
							
								 
								 $user = $this->Users->patchEntity($user, $this->request->data);
			
								$user->USR_GROUP=6;
								$user->USR_DESIGNATION=6;
			
        						 $this->Users->save($user);
								 
								  $this->Flash->success(__('The user has been saved.'));
                return $this->redirect(['action' => 'add']);
								 
								 
								 
                            } 
							
							
							else 
							
							
							{
                                $this->Session->setFlash('There was a problem uploading file. Please try again.');
                            }
                        }
						
						
						 else 
						 {
                            $this->Session->setFlash('Error uploading file.');
                        }
                        break;
                    } else {
                       // $this->Session->setFlash('Unacceptable file type');
                    }
                }
            }
        }
		$this->render('add');
		
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




}
?>