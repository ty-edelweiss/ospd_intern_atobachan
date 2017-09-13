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
        $email = new Email('default');

        $target = $this->request->getQuery('email');
        $email->setTransport('gmail')
            ->setFrom([ 'you@localhost' => '@obachan' ])
            ->setTo($target)
            ->setSubject('@おばあちゃんユーザ登録について')
            ->setTemplate('welcome');

        $stats = 'success';
        try {
            $email->send('My Message Test');
        } catch (Exception $e) {
            $stats = 'fail';
        }

        $response = compact('target', 'stats');

        $this->viewBuilder()->setClassName('Json');
        $this->set(compact('response'));
        $this->set('_serialize', ['response']);
    }

}
