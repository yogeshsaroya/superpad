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

use Cake\Mailer\Mailer;
use Cake\Mailer\TransportFactory;



/**
 * Static content controller
 *
 * This controller will render views from templates/Pages/
 *
 * @link https://book.cakephp.org/4/en/controllers/pages-controller.html
 */
class CronsController extends AppController
{

    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        // methods name we can pass here which we want to allow without login
        parent::beforeFilter($event);
        /* https://book.cakephp.org/4/en/controllers/components/authentication.html#AuthComponent::allow */
        $this->Auth->allow();
        $this->autoRender = false;
    }



    public function index()
    {
    }

    public function sendEmail()
    {

        TransportFactory::setConfig('Manual', [
            'className' => 'Smtp',
            //'className' => 'Debug',
            'host' => 'mail.superpad.finance',
            'port' => 465,
            'username' => 'support@superpad.finance',
            'password' => 'super@1234!',
            'tls' => true, 'auth' => true 
            
        ]);

        $mailer = new Mailer('default');
        $mailer->setTransport('Manual');

        try {
            $res = $mailer->setFrom(['support@superpad.finance' => 'My Site'])
            ->setTo('yogeshsaroya@gmail.com')
            ->setSubject('About')
            ->deliver('My message');
        ec($res);
        } catch (\Throwable $th) {
            ec($th);
        }
        
    }
}
