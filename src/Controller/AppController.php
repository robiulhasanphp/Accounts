<?php
declare(strict_types=1);
namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\EventInterface;

class AppController extends Controller
{
    public function initialize(): void
    {
        parent::initialize();

        $this->loadComponent('Flash');

        $this->loadComponent('Auth', [
            'authorize' => ['Controller'],
            'loginRedirect' => [
                'controller' => 'Dashboard',
                'action' => 'index',
            ],
            'logoutRedirect' => [
                'controller' => 'Users',
                'action' => 'login',
            ],
        ]);
    }

    public function beforeFilter(EventInterface $event): void
    {
        parent::beforeFilter($event);

        $this->Auth->allow(['login', 'adminuser']);
    }

    public function isAuthorized($user): bool
    {
        if (!empty($user['USR_ID'])) {

            $userId = $user['USR_ID'];
            $this->set(compact('userId'));

            return true;
        }

        return false;
    }
}




