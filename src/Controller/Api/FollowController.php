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
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $consumer_key = Configure::read('Twitter.consumerKey');
        $consumer_secret = Configure::read('Twitter.consumerSecret');
        $session = $this->request->getSession();

        $session->read('Oauth.secret');

        $screen_name = '@tmukoudairenkei';
        $follow = true;

        $user_connection = new TwitterOAuth($consumer_key, $consumer_secret, $session->read('Oauth.token'), $session->read('Oauth.secret'));
        $response = $user_connection->post('friendships/create', compact('screen_name', 'follow'));

        $this->viewBuilder()->setClassName('Json');
        $this->set(compact('response'));
        $this->set('_serialize', ['response']);
    }

}
