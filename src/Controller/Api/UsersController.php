<?php
namespace App\Controller\Api;

use App\Controller\AppController;

class UsersController extends AppController
{
    public function index()
    {
        $this->loadModel('Users');
        if ($this->request->is('post')) {
            $screen_name = $this->request->getData('screen_name');
            $email = $this->request->getData('email');

            $entity = $this->Users->newEntity();
            $entity = $this->Users->patchEntity($entity, [
                'screen_name' => $screen_name,
                'email' => $email,
                'user_type' => '0'
            ]);

            $stats = 'success';
            if(!$this->Users->save($entity)){
                $stats = 'fail';
            }
            $response = compact('stats');
            $this->ViewBuilder()->setClassName('Json');
            $this->set(compact('response'));
            $this->set('_serialize',['response']);
        }

    }
}
