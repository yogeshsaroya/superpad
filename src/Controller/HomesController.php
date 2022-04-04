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

use Cake\Core\Configure;
use Cake\Http\Exception\ForbiddenException;
use Cake\Http\Exception\NotFoundException;
use Cake\Http\Response;
use Cake\View\Exception\MissingTemplateException;

/**
 * Static content controller
 *
 * This controller will render views from templates/Pages/
 *
 * @link https://book.cakephp.org/4/en/controllers/pages-controller.html
 */
class HomesController extends AppController
{

    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        // methods name we can pass here which we want to allow without login
        parent::beforeFilter($event);
        /* https://book.cakephp.org/4/en/controllers/components/authentication.html#AuthComponent::allow */
        $this->Auth->allow();
    }

    public function display()
    {
    }

    public function index()
    {
        /*
        $this->paginate = ['limit' => 10, 'order' => ['created' => 'desc']];
        $data = $this->paginate($this->Consultants->find('all'));

        $this->paginate = ['limit' => 10, 'order' => ['created' => 'desc']];
        $blog_data = $this->paginate($this->Blogs->find('all'));

        $this->set(compact('data', 'blog_data'));*/
    }
    public function page($id = null)
    {
        $get_data = null;
        if (!empty($id)) {
            $data = $this->Pages
                ->find()
                ->where(['slug' => $id, 'status' => 1])
                ->first();
            if (!empty($data)) {
                $this->set(compact('data'));
            } else {
                $this->viewBuilder()->setLayout('error_404');
            }
        }
    }

    public function allocation()
    {
    }

    public function stake()
    {
    }

    public function spad()
    {
    }

    public function team()
    {

        $query = $this->Teams->find('all', ['conditions' => ['Teams.status' => 1,'Teams.type' => 1], 'limit' => 100, 'order' => ['Teams.position' => 'ASC']]);
        $data = $query->all();
        $this->set(compact('data'));
    }

    public function explore($id = null)
    {
        $q = $this->request->getQuery();
        if (isset($q['redirect']) && !empty($q['redirect'])) {
            //$q['redirect']
        }

        if (!empty($id)) {
            $query = $this->Projects->find('all', [
                'contain' => [
                    'Blockchains' => ['conditions' => ['Blockchains.status' => 1]],
                    'Teams' => ['conditions' => ['Teams.status' => 1]],
                    'SmAccounts'=>['conditions' => ['SmAccounts.featured' => 2]],
                    'Partners' => ['conditions' => ['Partners.status' => 1]],
                ],
                'conditions' => ['Projects.slug' => $id, 'Projects.status' => 1]
            ]);
            $data =  $query->first();
            if (!empty($data)) {
                $data_app = null;
                if ($this->Auth->User('id') != "") {
                    $data_app = $this->Applications
                        ->find()
                        ->where(['project_id' => $data->id,'user_id'=>$this->Auth->User('id')])
                        ->first();
                }

                $this->set(compact('data','data_app'));
                $this->render('project_details');
            } else {
                $this->viewBuilder()->setLayout('error_404');
            }
        }
    }
    public function contact()
    {
        if ($this->request->is('ajax') && !empty($this->request->getData())) {
            $postData = $this->request->getData();
            $data = array_map('trim', $postData);
            if (empty($data['full_name'])) {
                echo '<div class="alert alert-danger">Please enter full name</div>';
                exit;
            } elseif (empty($data['email'])) {
                echo '<div class="alert alert-danger">Please enter email address</div>';
                exit;
            } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                echo '<div class="alert alert-danger">Please enter valid email address</div>';
                exit;
            } elseif (empty($data['sujbect'])) {
                echo '<div class="alert alert-danger">Please enter subject</div>';
                exit;
            } elseif (empty($data['msg'])) {
                echo '<div class="alert alert-danger">Please enter message</div>';
                exit;
            } else {
                $ticket = rand(111111111, 999999999);

                $admin = 'support@superpad.finance';
                $this->Data->AppMail($admin, 5, ['SUBJECT' => $data['sujbect'], 'TICKET_NUMBER' => $ticket, 'MESSAGE' => $data['msg'], 'NAME' => $data['full_name'], 'EMAIL' => $data['email']]);
                $this->Data->AppMail($data['email'], 6, ['SUBJECT' => $data['sujbect'], 'TICKET_NUMBER' => $ticket, 'MESSAGE' => $data['msg'], 'NAME' => $data['full_name'], 'EMAIL' => $data['email']]);
                echo '<script>$("#e_frm")[0].reset();</script>';
                echo '<div class="alert alert-success">Thank you for submitting your request we will get in touch with you shortly</div>';
                exit;
            }
            exit;
        }
    }

    public function ajSub()
    {
        $this->autoRender = false;
        if ($this->request->is('ajax') && !empty($this->request->getData())) {
            $postData = $this->request->getData();

            $query = $this->Newsletters->find('all', ['conditions' => ['Newsletters.email' => $postData['email']]]);
            $data =  $query->first();
            if (empty($data)) {
                $user_data = ['id' => null, 'email' => $postData['email'], 'name' => $postData['name']];
                $user1 = $this->Newsletters->newEntity($user_data, ['validate' => true]);
                if ($user1->getErrors()) {
                    echo "<div class='alert alert-danger'>Server error, please try again later</div>";
                    exit;
                } else {
                    if ($this->Newsletters->save($user1)) {
                        echo "<script>$('#newsletter_div').html('<center><h3 class=\"form-title\">THANKS FOR SIGNING UP!</h3><p>We hope you find great value in the stories we publish.</p></center>');</script>";
                    } else {
                        echo "<div class='alert alert-danger'>Server error, please try again later.</div>";
                        exit;
                    }
                }
            } else {
                echo "<div class='alert alert-danger'>The email address you have entered is already registered</div>";
                exit;
            }
        }
        exit;
    }

    public function applyNow( $id = null ){
        if ($this->request->is('ajax') && !empty($this->request->getData())) {
            if ($this->Auth->User('id') != "") {
                $postData = $this->request->getData();

                $query = $this->Projects->find('all', ['conditions' => ['Projects.id' => $postData['project_id'], 'Projects.status' => 1,'Projects.product_status'=>'Whitelist Open'] ]);
                $proData =  $query->first();
                if(empty($proData)){
                    echo '<div class="alert alert-danger" role="alert">Internal server error. please try again </div>'; exit;   
                }
                

                $postData['user_id'] = $this->Auth->User('id');
                $total = $this->Applications->find()->where(['project_id' =>$postData['project_id'],'user_id'=>$postData['user_id']])->count();
                if( $total === 0 ){
                    $getEnt = $this->Applications->newEmptyEntity();
                    $chkEnt = $this->Applications->patchEntity($getEnt, $postData, ['validate' => true]);
                    if ($chkEnt->getErrors()) {
                        $st = null;
                        foreach ($chkEnt->getErrors() as $elist) {
                            foreach ($elist as $k => $v); {
                                $st .= "<div class='alert alert-danger'>" . ucwords($v) . "</div>";
                            }
                        }
                        echo $st;
                        exit;
                    } else {
                        if ($this->Applications->save($chkEnt)) {
                            $u = SITEURL."users/application_status";
                            echo "<script>$('#save_frm').remove();</script>";
                            echo "<div class='alert alert-success'>Your application is successfully submitted </div>";
                            echo "<script> setTimeout(function(){ window.location.href ='" . $u . "'; }, 2000);</script>";
                        } else {
                            echo '<div class="alert alert-danger" role="alert">Internal server error. please try again </div>'; exit;
                        }
                    }
                }else{
                    echo '<div class="alert alert-danger">You have already applied to this job. Please check application status <a href="'.SITEURL.'allocation">here</a> </div>'; exit; 
                }
            }else{
                echo '<div class="alert alert-danger">Please login or register to apply.</div>'; exit; 
            }
            exit;
        }

        if (!empty($id)) {
            $query = $this->Projects->find('all', [
                'contain' => ['SmAccounts'=>['conditions' => ['SmAccounts.featured' => 2]]],
                'conditions' => ['Projects.id' => $id, 'Projects.status' => 1] ]);
            $data =  $query->first();
            $this->set(compact('data','id'));
        }
    }

    /* open new popup on ajax request */
    public function openPop($id = null)
    {
        $this->autoRender = false;
        $getData = $this->request->getData();
        if (isset($getData['url']) && !empty($getData['url'])) {
            if ($id == 1) {
                echo "<script> $.magnificPopup.open({items: { src: '" . urldecode($getData['url']) . "',type: 'ajax'}, closeOnContentClick: false, closeOnBgClick: false, showCloseBtn: false, enableEscapeKey: false, }); </script>";
            } else {
                echo "<script> $.magnificPopup.open({items: { src: '" . urldecode($getData['url']) . "',type: 'ajax'}, closeMarkup: '<button class=\"mfp-close mfp-new-close\" type=\"button\" title=\"Close\">x</button>', closeOnContentClick: false, closeOnBgClick: false, showCloseBtn: true, enableEscapeKey: false}); </script>";
            }
        }
    }
}
