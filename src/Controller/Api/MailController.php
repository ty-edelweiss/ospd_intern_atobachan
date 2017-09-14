<?php
namespace App\Controller\Api;

use Cake\Core\Exception\Exception;
use Cake\Mailer\Email;
use App\Controller\AppController;

/**
 * Api Controller
 *
 *
 */
class MailController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('RequestHandler');
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->loadModel('Users');
        $email = new Email('default');
        $user = $this->Users->find('all')
            ->where(['screen_name'=>$this->request->getQuery('screen_name')])
            ->first();
        // $target = $this->request->getQuery('email');
        $target = $user['email'];
        $email->setTransport('gmail')
            ->setFrom([ 'you@localhost' => '@obachan' ])
            ->setTo($target)
            ->setSubject('@おばあちゃんユーザ登録について')
            ->setTemplate('welcome');

        $stats = 'success';
        if(!isset($target)){
            $target = '';
        }
        try {
            $email->send('ao-app://?token='.$user['access_token']);
        } catch (Exception $e) {
            $stats = 'fail';
        }

        $response = compact('target', 'stats');

        $this->viewBuilder()->setClassName('Json');
        $this->set(compact('response'));
        $this->set('_serialize', ['response']);
    }

}
