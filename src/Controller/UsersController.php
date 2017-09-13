<?php
namespace App\Controller;

class UsersController extends AppController
{
    public $name = 'Users';
    public function index()
    {
        $users= $this->Users->find();
        $this->set(compact('users'));
        $this->render();
        
    }
}