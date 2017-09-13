<?php
namespace App\Controller;

class UsersController extends AppController
{
    public $name = 'Users';
    public function index()
    {
        /*set*/
        $username = $this->request->data['username'];
        $ent = $this->Users->newEntity($this->request->data);
        $this->Users->save($ent);
        $this->set(array(
            'username'=>$username));
        
        /*get*/
        // $users= $this->Users->find();
        // $this->set(compact('users'));

        
        
    }
}