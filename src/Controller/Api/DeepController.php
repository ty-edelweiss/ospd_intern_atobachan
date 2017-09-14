<?php
namespace App\Controller\Api;

use Cake\Core\Exception\Exception;
use App\Controller\AppController;

/**
 * Api Controller
 *
 *
 */
class DeepController extends AppController
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
        $deep_link = $this->request->getQuery('deep_link');
        return $this->redirect($deep_link);
    }

}
