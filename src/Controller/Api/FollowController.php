<?php
namespace App\Controller\Api;

use Cake\Core\Configure;
use App\Controller\AppController;
use Abraham\TwitterOAuth\TwitterOAuth;

/**
 * Api Controller
 *
 *
 */
class FollowController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('RequestHandler');
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->loadModel('Users');
        $consumer_key = Configure::read('Twitter.consumerKey');
        $consumer_secret = Configure::read('Twitter.consumerSecret');
        $session = $this->request->getSession();

        $screen_name = $this->Users->find('all')->where(['young_screen_name' => $session->read('Oauth.name')])->first()['old_screen_name'];
        $follow = true;

        $user_connection = new TwitterOAuth($consumer_key, $consumer_secret, $session->read('Oauth.token'), $session->read('Oauth.secret'));
        $user_connection->post('friendships/create', compact('screen_name', 'follow'));

        $response = [
            'token' => $session->read('Oauth.token'),
            'secret' => $session->read('Oauth.secret')
        ];

        /*
        $session->destroy();

        $this->viewBuilder()->setClassName('Json');
        $this->set(compact('response'));
        $this->set('_serialize', ['response']);
        */
        return $this->redirect(
            ['controller' => 'Mail', 'action' => 'complete']
        );
    }

}
