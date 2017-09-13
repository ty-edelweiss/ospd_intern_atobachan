<?php
namespace App\Controller;

class UsersController extends AppController
{
    public $name = 'Users';
    public function index()
    {
        /*set*/
        if ($this->request->is('post')) {
            $screen_name = $this->request->data['screen_name'];
            $email = $this->request->data['email'];
            $access_token = $this->request->data['access_token'];
            $access_token_se = $this->request->data['access_token_se'];
            $user_type = $this->request->data['user_type'];
            $ent = $this->Users->newEntity();
            $ent = $this->Users->patchEntity($ent, array(
                'screen_name'=>$screen_name,
                'email'=>$email,
                'access_token'=>$access_token,
                'access_token_se'=>$access_token_se,
                'user_type'=>$user_type
                ));
            
            $stats = 'success';
            if(!$this->Users->save($ent)){
                $stats = 'fail';
            }      
             $response = compact('stats');
             $this->ViewBuilder()->setClassName('Json');   
             $this->set(compact('response'));
             $this->set('_serialize',['response']);
             debug($response);

        }
        
        /*get*/
        // $users= $this->Users->find();
        // $this->set(compact('users'));
        
        
    }
}