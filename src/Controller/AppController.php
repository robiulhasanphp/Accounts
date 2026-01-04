<?php
namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;

class AppController extends Controller
{
    //...
public function initialize()
{
    $this->loadComponent('Flash');
    $this->loadComponent('Auth', [
        'authorize' => ['Controller'], // Added this line
        'loginRedirect' => [
            'controller' => 'Dashboard',
            'action' => 'index'
        ],
		
       'logoutRedirect' => [
                'controller' => 'Users',
                'action' => 'login',
                'Dashboard'
           
        ]
    ]);
/*	$this->Auth->config('authorize', [
    AuthComponent::ALL => ['actionPath' => 'controllers/'],
    'Actions',
    'Controller'
]);*/
}




public function isAuthorized($user)
{
	
	
    // Admin can access every action
    if (isset($user['username'])) {
		/*$this->set('valid_user',$user['USR_ID']);
		$this->set('auth',$user);*/
			$user = $this->Auth->User();			
			$user_id=$user['USR_ID'];
			$this->set(compact('user_id'));
			
        return true;
    }

    // Default deny
    return false;
}





    public function beforeFilter(Event $event)
    {

		/*$this->set('valid_user',0);*/

        $this->Auth->allow(['login', 'adminuser']);
    }
    //...
}
?>