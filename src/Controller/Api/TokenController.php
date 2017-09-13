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
class TokenController extends AppController
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
        $consumer_key = Configure::read('Twitter.consumerKey');
        $consumer_secret = Configure::read('Twitter.consumerSecret');

        $session = $this->request->getSession();
        $query = $this->request->getQuery();
        $connection = new TwitterOAuth($consumer_key, $consumer_secret, $session->read('Oauth.token'), $session->read('Oauth.secret'));
        $access_token = $connection->oauth('oauth/access_token', $query);
        $session->write('Oauth.token', $access_token['oauth_token']);
        $session->write('Oauth.secret', $access_token['oauth_token_secret']);

        $user_connection = new TwitterOAuth($consumer_key, $consumer_secret, $access_token['oauth_token'], $access_token['oauth_token_secret']);
        /*
        $response = $user_connection->get('account/verify_credentials');

        $this->viewBuilder()->setClassName('Json');
        $this->set(compact('response'));
        $this->set('_serialize', ['response']);
        */
        return $this->redirect(
            ['controller' => 'Follow', 'action' => 'index']
        );
    }

}
