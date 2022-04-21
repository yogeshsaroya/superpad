<?php
declare(strict_types=1);

/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Controller\Controller;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link https://book.cakephp.org/4/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{
    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('FormProtection');`
     *
     * @return void
     */
    public function initialize(): void
    {
        parent::initialize();

        $this->loadComponent('RequestHandler');
        $this->loadComponent('Flash');
        $this->loadComponent('Auth');
        $this->loadComponent('Data');
        

        /*
         * Enable the following component for recommended CakePHP form protection settings.
         * see https://book.cakephp.org/4/en/controllers/components/form-protection.html
         */
        //$this->loadComponent('FormProtection');
    }
    
    public function beforeFilter(\Cake\Event\EventInterface $event){
        parent::beforeFilter($event);
        $this->loadModel('Users');
        $this->loadModel('Pages');
        $this->loadModel('Settings');
        $this->loadModel('EmailTemplates');
        $this->loadModel('EmailServers');
        $this->loadModel('Blockchains');
        $this->loadModel('Partners');
        $this->loadModel('Roadmaps');
        $this->loadModel('Projects');
        $this->loadModel('Features');
        $this->loadModel('Teams');
        $this->loadModel('Newsletters');
        $this->loadModel('Countries');
        $this->loadModel('SmAccounts');
        $this->loadModel('Applications');
        $this->loadModel('NewProjects');
        $this->loadModel('Levels');
        $this->loadModel('Stakes');
        $this->loadModel('Influencers');
        $this->loadModel('UserStakes');
        $this->loadModel('Tickets');
        $this->loadModel('TokenDistributions');
        
        
               
                
        $Setting = $this->Data->get_settings();
        $session = $this->getRequest()->getSession();
        $session->write('Setting', $Setting ); 
        $this->set(compact('Setting'));
    }
    
    function beforeRender(\Cake\Event\EventInterface $event) {

        if($this->request->isAjax())
        {
            $this->viewBuilder()->setLayout('ajax');

        }
        
        // store user data to Auth variable.
        // we will use this Auth variable to get user data
        if( $this->Auth->user() !== null ){ 
            $userData = $this->Data->getUser($this->Auth->user('id'));
            $this->Auth->setUser($userData);
            $this->set("Auth", $this->Auth->user()); 
        }
    }
}
