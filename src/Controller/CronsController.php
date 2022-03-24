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
        $setting = $this->Data->get_settings();
        if (isset($setting['email_sender']) && isset($setting['email_address']) && isset($setting['email_password']) && isset($setting['email_host'])) {
            TransportFactory::setConfig('Manual', [
                'className' => 'Smtp', //'Debug',
                'tls' => true,
                'port' => 587, 'host' => $setting['email_host'], 'username' => $setting['email_address'], 'password' => $setting['email_password']
            ]);
            $mailer = new Mailer('default');
            $mailer->setTransport('Manual');

            $query = $this->EmailServers->find('all')->where(['EmailServers.status' => 0])->limit(10);
            $data = $query->all()->toArray();
            if (!empty($data)) {
                foreach ($data as $list) {
                    try {
                        $res = $mailer
                        ->setEmailFormat('both')
                        ->setFrom([$setting['email_address'] => $setting['email_sender']])
                        ->setTo($list->email_to)
                        ->setSubject($list->subject)
                        ->deliver($list->message);
                        $mailer->reset();
                        
                        $up_arr = ['id' => $list->id, 'status' => 1];
                        $saveData = $this->EmailServers->newEntity($up_arr, ['validate' => false]);
                        $this->EmailServers->save($saveData);
                        ec('<div style="color: green;">Email has been sent to '.$list->email_to.'</div>');
                    } catch (\Throwable $th) {
                        $mailer->reset();
                        $up_arr = ['id' => $list->id, 'status' => 3];
                        $saveData = $this->EmailServers->newEntity($up_arr, ['validate' => false]);
                        $this->EmailServers->save($saveData);
                        ec('Email has been failed to '.$list->email_to);
                        ec('<div style="color: green;"><b>Email has been failed to '.$list->email_to.'</b></div>');
                    }
                }
            }
        }
        exit;
    }
}
