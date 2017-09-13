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
class TwitterController extends AppController
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
        $callback_uri = Configure::read('Twitter.callbackUri');

        $connection = new TwitterOAuth($consumer_key, $consumer_secret);
        $request_token = $connection->oauth('oauth/request_token',  [
            'oauth_callback' => $callback_uri
        ]);
        $session = $this->request->getSession();
        $session->write('Oauth.token', $request_token['oauth_token']);
        $session->write('Oauth.secret', $request_token['oauth_token_secret']);

        $url = $connection->url("oauth/authenticate", [ "oauth_token" => $request_token['oauth_token'] ]);

        $test = $url;

        $format = mb_strtolower($this->request->getQuery('format'));
        $formats = [
            'xml' => 'Xml',
            'json' => 'Json'
        ];
        if (!isset($formats[$format])) {
            throw new NotFoundException(__('Unknown format.'));
        }

        $this->viewBuilder()->setClassName($formats[$format]);
        $this->set(compact('test'));
        $this->set('_serialize', ['test']);
    }

}