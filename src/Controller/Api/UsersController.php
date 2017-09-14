<?php
namespace App\Controller\Api;

use App\Controller\AppController;

class UsersController extends AppController
{
    public function index()
    {
        $this->loadModel('Users');
        if ($this->request->is('post')) {
            $young_screen_name = $this->request->getData('young_screen_name');
            $old_screen_name = $this->request->getData('old_screen_name');
            $email = $this->request->getData('email');
            //$young_screen_name = $this->request->getQuery('young_screen_name');
            //$old_screen_name = $this->request->getQuery('old_screen_name');
            //$email = $this->request->getQuery('email');

            $entity = $this->Users->newEntity();
            $entity = $this->Users->patchEntity($entity, [
                'young_screen_name' => $young_screen_name,
                'old_screen_name' => $old_screen_name,
                'email' => $email
            ]);

            $stats = 'success';
            if(!$this->Users->save($entity)){
                $stats = 'fail';
            }

            $response = compact('stats');

            $this->ViewBuilder()->setClassName('Json');
            $this->set(compact('response'));
            $this->set('_serialize', ['response']);
        }

    }
}
