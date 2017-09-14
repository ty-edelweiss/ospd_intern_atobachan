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
        $response = $this->__sendMail('old_screen_name', $this->request->getQuery('screen_name'));

        $this->viewBuilder()->setClassName('Json');
        $this->set(compact('response'));
        $this->set('_serialize', ['response']);
    }

    public function complete() {
        $session = $this->request->getSession();
        $response = $this->__sendMail('young_screen_name', $session->read('Oauth.name'));

        $session->destroy();

        $this->set('stats', $response);

        $this->render();
    }

    private function __sendMail($column_name, $screen_name) {
        $this->loadModel('Users');
        $email = new Email('default');
        $user = $this->Users->find('all')
            ->where([$column_name => $screen_name])
            ->first();
        $email->setTransport('gmail')
            ->setFrom([ 'you@localhost' => '@obachan' ])
            ->setTo($user['email'])
            ->setSubject('@おばあちゃんユーザ登録について')
            ->setTemplate('welcome');

        $stats = 'success';
        try {
            $email->send('ao-app://?' . $user['young_screen_name']);
        } catch (Exception $e) {
            $stats = 'fail';
        }

        return $stats;
    }

}
