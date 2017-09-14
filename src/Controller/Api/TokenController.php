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
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->loadModel('Users');
        $consumer_key = Configure::read('Twitter.consumerKey');
        $consumer_secret = Configure::read('Twitter.consumerSecret');

        $oauth = $this->Users->find('all')
            ->where([ 'old_screen_name' => $this->request->getQuery('screen_name') ])
            ->first('access_token', 'access_token_se');

        $response = [
            'token' => $oauth['access_token'],
            'secret' => $oauth['access_token_se']
        ];

        $this->viewBuilder()->setClassName('Json');
        $this->set(compact('response'));
        $this->set('_serialize', ['response']);
    }

    public function create() {
        $this->loadModel('Users');
        $consumer_key = Configure::read('Twitter.consumerKey');
        $consumer_secret = Configure::read('Twitter.consumerSecret');

        $session = $this->request->getSession();
        $query = $this->request->getQuery();
        $connection = new TwitterOAuth($consumer_key, $consumer_secret, $session->read('Oauth.token'), $session->read('Oauth.secret'));
        $access_token = $connection->oauth('oauth/access_token', $query);
        $session->write('Oauth.token', $access_token['oauth_token']);
        $session->write('Oauth.secret', $access_token['oauth_token_secret']);

        $user_connection = new TwitterOAuth($consumer_key, $consumer_secret, $access_token['oauth_token'], $access_token['oauth_token_secret']);
        $screen_name = $user_connection->get("account/verify_credentials")->screen_name;
        $session->write('Oauth.name', $screen_name);

        $entity = $this->Users->find('all')->where([ 'young_screen_name' => $screen_name ])->first();
        $entity = $this->Users->patchEntity($entity, [
            'access_token' => $access_token['oauth_token'],
            'access_token_se' => $access_token['oauth_token_secret']
        ]);

        if ($this->Users->save($entity)) {
            $session->write('Oauth.status', 'success');
        } else {
            $session->write('Oauth.status', 'fail');
        }

        return $this->redirect(
            ['controller' => 'Follow', 'action' => 'index']
        );
    }

}
