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

    public function newProject()
    {
        $tbl_data = null;
        /*$tbl_data = $this->NewProjects->findById('1')->firstOrFail(); */
        $this->set(compact('tbl_data'));

        $Setting = $this->request->getSession()->read('Setting');

        if ($this->request->is('ajax') && !empty($this->request->getData())) {
            if (empty($Setting['recaptcha_secret_key'])) {
                echo '<script>grecaptcha.reset();</script>';
                echo '<div class="alert alert-danger" role="alert">Internal server error. please try again </div>';
                exit;
            }
            $postData = $this->request->getData();
            if (isset($_SERVER['HTTP_SEC_FETCH_SITE']) && $_SERVER['HTTP_SEC_FETCH_SITE'] == 'same-origin') {
                if (isset($postData['g-recaptcha-response']) && !empty($postData['g-recaptcha-response'])) {
                    $response = $this->Data->fetch("https://www.google.com/recaptcha/api/siteverify?secret=" . $Setting['recaptcha_secret_key'] . "&response=" . $postData['g-recaptcha-response'] . "&remoteip=" . $_SERVER['REMOTE_ADDR']);
                    $arr = json_decode($response, true);
                    if (isset($arr['success']) && $arr['success'] == 1) {
                        $getEnt = $this->NewProjects->newEmptyEntity();
                        $chkEnt = $this->NewProjects->patchEntity($getEnt, $postData, ['validate' => true]);
                        if ($chkEnt->getErrors()) {
                            $st = null;
                            foreach ($chkEnt->getErrors() as $elist) {
                                foreach ($elist as $k => $v); {
                                    $st .= "<div class='alert alert-danger'>" . ucwords($v) . "</div>";
                                }
                            }
                            echo '<script>grecaptcha.reset();</script>';
                            echo $st;
                            exit;
                        } else {
                            if ($this->NewProjects->save($chkEnt)) {
                                $admin = 'support@superpad.finance';
                                $this->Data->AppMail($admin, 12, ['TITLE' => $chkEnt->name]);
                                $this->Data->AppMail($chkEnt->email, 11, ['TITLE' => $chkEnt->name]);

                                $str = '<div class="alert alert-success d-flex mb-4" role="alert"><p class="fs-14">Your application has been submitted. Our team will review it shortly and get in touch with you.</p></div>';
                                echo "<script>$('#ido_frm').html('$str');</script>";
                                exit;
                            } else {
                                echo '<script>grecaptcha.reset();</script>';
                                echo '<div class="alert alert-danger" role="alert">Internal server error. please try again </div>';
                                exit;
                            }
                        }
                    } else {
                        echo '<script>grecaptcha.reset();</script>';
                        echo "<div class='alert alert-danger'>Please verify that you are not a robot.</div>";
                    }
                } else {
                    echo '<script>grecaptcha.reset();</script>';
                    echo "<div class='alert alert-danger'>Please verify that you are not a robot.</div>";
                }
            } else {
                echo '<script>grecaptcha.reset();</script>';
                echo "<div class='alert alert-danger'>Server error [origin_error]. please try again later or contact to us</div>";
            }
            exit;
        }
    }



    public function stake()
    {

        $q = $this->request->getQuery();
        $qr = null;
        if (isset($q['days']) && isset($q['token'])) {
            $qr = ['days' => $q['days'], 'token' => $q['token']];
        }
        $query = $this->Levels->find()->order(['spad' => 'ASC']);
        $data = $query->all();
        $tire = $stake = [];
        $min = $max = $min_return = $max_return = $min_token = $max_token = 0;

        $chkStake = $this->Stakes
            ->find()
            ->where(['type' => 1])
            ->order(['days' => 'ASC'])
            ->all()->toArray();

        if (!$data->isEmpty()) {
            foreach ($data as $a) {
                if (!empty($a->spad)) {
                    $tire[$a->spad] = [
                        'spad' => $a->spad,
                        'title' => $a->title,
                        'ticket_multiplier' => $a->ticket_multiplier,
                        'cooldown' => $a->cooldown,
                        'social_task' => $a->social_task,
                        'max_ticket_allocation' => $a->max_ticket_allocation,
                        'winning_chances' => $a->winning_chances,
                        'guaranteed_allocation' => $a->guaranteed_allocation
                    ];
                }
            }
        }

        if (!empty($tire)) {
            $min_token = min(array_column($tire, 'spad'));
            $max_token = max(array_column($tire, 'spad'));
        }

        $days_list = [];
        if (!empty($chkStake)) {
            foreach ($chkStake as $b) {
                if (!empty($b['days'])) {
                    $stake[$b['days']] = $b['percentage'];
                    $days_list[$b['days']] = ($b['days'] < 365 ? $b['days'] . " Days" : ($b['days'] / 365) . " Year" . (($b['days'] / 365) > 1 ? 's' : null));
                }
            }
        }


        if (!empty($chkStake)) {
            $min = min(array_column($chkStake, 'days'));
            $max = max(array_column($chkStake, 'days'));

            $min_return = min(array_column($chkStake, 'percentage'));
            $max_return = max(array_column($chkStake, 'percentage'));
        }
        $this->set(compact('data', 'chkStake', 'min', 'max', 'min_return', 'max_return', 'stake', 'tire', 'qr', 'days_list', 'min_token', 'max_token'));
    }

    public function spad()
    {
    }

    public function team()
    {

        $query = $this->Teams->find('all', ['conditions' => ['Teams.status' => 1, 'Teams.type' => 1], 'limit' => 100, 'order' => ['Teams.position' => 'ASC']]);
        $data = $query->all();
        $this->set(compact('data'));
    }

    public function explore($id = null, $is_pop = null)
    {
        $q = $this->request->getQuery();
        $op_pop = $join_pop = null;
        if (isset($is_pop)) {
            if ($is_pop == 'apply') {
                $op_pop = 'yes';
            } elseif ($is_pop == 'join_now') {
                $join_pop = 'yes';
            }
        }

        if (!empty($id)) {
            $query = $this->Projects->find('all', [
                'contain' => [
                    'Blockchains' => ['conditions' => ['Blockchains.status' => 1]],
                    'Teams' => ['conditions' => ['Teams.status' => 1]],
                    'SmAccounts' => ['conditions' => ['SmAccounts.featured' => 2]],
                    'Partners' => ['conditions' => ['Partners.status' => 1]],
                ],
                'conditions' => ['Projects.slug' => $id, 'Projects.status' => 1]
            ]);
            $data =  $query->first();
            if (!empty($data)) {
                $data_app = null;
                if ($this->Auth->User('id') != "") {
                    $data_app = $this->Applications->find()->where(['project_id' => $data->id, 'user_id' => $this->Auth->User('id')])->first();
                }
                $this->set(compact('data', 'data_app', 'op_pop', 'data_app', 'join_pop'));
                $this->render('project_details');
            } else {
                $this->viewBuilder()->setLayout('error_404');
            }
        }
    }

    public function applyNow($id = null)
    {
        if ($this->request->is('ajax') && !empty($this->request->getData())) {
            if ($this->Auth->User('id') != "") {
                $postData = $this->request->getData();
                $query = $this->Projects->find('all', ['conditions' => ['Projects.id' => $postData['project_id'], 'Projects.status' => 1, 'Projects.product_status' => 'Whitelist Open']]);
                $proData =  $query->first();
                if (empty($proData)) {
                    echo '<div class="alert alert-danger" role="alert">Internal server error. please try again </div>';
                    exit;
                }
                $postData['user_id'] = $this->Auth->User('id');
                $total = $this->Applications->find()->where(['project_id' => $postData['project_id'], 'user_id' => $postData['user_id']])->count();
                if ($total === 0) {
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
                            $u = SITEURL . "users/application_status";
                            echo "<script>$('#save_frm').remove();</script>";
                            echo "<div class='alert alert-success'>Your application is successfully submitted </div>";
                            echo "<script> setTimeout(function(){ window.location.href ='" . $u . "'; }, 2000);</script>";
                        } else {
                            echo '<div class="alert alert-danger" role="alert">Internal server error. please try again </div>';
                            exit;
                        }
                    }
                } else {
                    echo '<div class="alert alert-danger">You have already applied to this job. Please check application status <a href="' . SITEURL . 'users/application_status">here</a> </div>';
                    exit;
                }
            } else {
                echo '<div class="alert alert-danger">Please login or register to apply.</div>';
                exit;
            }
            exit;
        }

        if (!empty($id)) {
            $query = $this->Projects->find('all', [
                'contain' => ['SmAccounts' => ['conditions' => ['SmAccounts.featured' => 2]]],
                'conditions' => ['Projects.id' => $id, 'Projects.status' => 1]
            ]);
            $data =  $query->first();
            $data_app = null;
            if ($this->Auth->User('id') != "") {
                $data_app = $this->Applications->find()->where(['project_id' => $data->id, 'user_id' => $this->Auth->User('id')])->first();
            }
            $this->set(compact('data', 'id', 'data_app'));
        }
    }

    public function joinNow($id = null)
    {

        if ($this->request->is('ajax') && !empty($this->request->getData())) {
            if ($this->Auth->User('id') != "") {
                $postData = $this->request->getData();

                $query = $this->Applications->find('all', [
                    'contain' => ['Projects', 'Users'],
                    'conditions' => ['Applications.status'=>4,'Applications.id' => $postData['id'], 'Applications.user_id' => $this->Auth->User('id')]
                ]);
                $appData =  $query->first();
                if (empty($appData)) {
                    echo '<div class="alert alert-danger" role="alert">Internal server error. please try again </div>';
                    exit;
                }
                $postData['joined'] = $appData->joined + $postData['amt'];
                $postData['remaining'] = $appData->allocation - $postData['joined'];

                $allocation_data = [];
                if (!empty($appData['allocation_data'])) {
                    $allocation_data = json_decode($appData['allocation_data'], true);
                }
                $allocation_data[strtotime(DATE)] = [
                    'date' => DATE, 'amount' => $postData['amt'], 'joined' => $appData->joined,
                    'allocation' => $appData->allocation, 'remaining' => $appData->remaining
                ];
                $postData['allocation_data'] = json_encode($allocation_data);

                $chkEnt = $this->Applications->patchEntity($appData, $postData, ['validate' => false]);
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
                        $u = SITEURL . "allocation";
                        echo "<script>$('#reg_sbtn').remove();</script>";
                        echo "<div class='alert alert-success'>Completed</div>";
                        echo "<script> setTimeout(function(){ window.location.href ='" . $u . "'; }, 2000);</script>";
                    } else {
                        echo '<div class="alert alert-danger" role="alert">Internal server error. please try again </div>';
                        exit;
                    }
                }
            } else {
                echo '<div class="alert alert-danger">Please login or register to apply.</div>';
                exit;
            }
            exit;
        }

        if (!empty($id)) {
            $max_amt = $max_tickets = 0;
            $data = $short_name = null;
            if ($this->Auth->User('id') != "") {
                $query = $this->Applications->find('all', [
                    'contain' => ['Projects' => ['Blockchains'], 'Users', 'Tickets' => ['conditions' => ['Tickets.status' => 1]]],
                    'conditions' => ['Applications.status'=>4,'Applications.project_id' => $id, 'Applications.user_id' => $this->Auth->User('id')]
                ]);
                $data =  $query->first();
                if (!empty($data)) {
                    if (!empty($data->allocation) && (float)$data->allocation > 0 && (float)$data->remaining == 0) {
                        $u = SITEURL . "allocation";
                        echo "<script>window.location.href ='" . $u . "'; </script>";
                        exit;
                    }
                    $max_tickets = count($data->tickets);
                    $ticket_allocation = $data->project->ticket_allocation;
                    $coin_price = 1; /*default will be USD 1*/
                    if (isset($data->project->blockchain->price) && $data->project->blockchain->price > 0) {
                        $coin_price = $data->project->blockchain->price;
                    }
                    $max_usd = $ticket_allocation * $max_tickets;
                    $max_amt = $max_usd / $coin_price;
                    $short_name = $data->project->blockchain->short_name;
                    if ((float)$data->allocation <= 0) {
                        $data->allocation = $max_amt;
                        $data->remaining = $max_amt;
                        $data->joined = 0;
                        $this->Applications->save($data);
                    }
                }
            }
            $this->set(compact('data', 'id', 'max_amt', 'max_tickets', 'short_name'));
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
        exit;
    }
}
