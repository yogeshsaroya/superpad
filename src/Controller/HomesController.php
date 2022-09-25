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

use Cake\Collection\Collection;


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

            exit;
        }
    }
    public function airdrop()
    {

        $Setting = $this->request->getSession()->read('Setting');

        if (
            //$this->request->is('ajax') && 
            !empty($this->request->getData())
        ) {
            if (empty($Setting['recaptcha_secret_key'])) {
                echo '<script>grecaptcha.reset();</script>';
                echo '<div class="alert alert-danger" role="alert">Internal server error. please try again </div>';
                exit;
            }
            $postData = $this->request->getData();
            if (isset($_SERVER['HTTP_REFERER']) && in_array($_SERVER['HTTP_REFERER'], [SITEURL . 'airdrop', SITEURL . 'airdrop/'])) {
                if (isset($postData['g-recaptcha-response']) && !empty($postData['g-recaptcha-response'])) {
                    $response = $this->Data->fetch("https://www.google.com/recaptcha/api/siteverify?secret=" . $Setting['recaptcha_secret_key'] . "&response=" . $postData['g-recaptcha-response'] . "&remoteip=" . $_SERVER['REMOTE_ADDR']);
                    $arr = json_decode($response, true);
                    if (isset($arr['success']) && $arr['success'] == 1) {
                        $v = (int)$postData['a1'] + (int)$postData['a2'];
                        if ((int)$postData['ans'] ==  $v) {
                            $postData['post_info'] = json_encode($_SERVER);
                            $getEnt = $this->Airdrops->newEmptyEntity();
                            $chkEnt = $this->Airdrops->patchEntity($getEnt, $postData, ['validate' => true]);
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
                                if ($this->Airdrops->save($chkEnt)) {
                                    $admin = 'support@superpad.finance';

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
                            echo '<div class="alert alert-danger" role="alert">Your answer is wrong for math questions.</div>';
                            exit;
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
                echo '<div class="alert alert-danger" role="alert">Internal server error. please try again! </div>';
                exit;
            }


            exit;
        }
        $tbl_data = null;
        $query = $this->SmAccounts->find('all', ['conditions' => ['SmAccounts.project_id' => 3]]);
        $sm_accounts =  $query->all();
        $this->set(compact('sm_accounts'));
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
                    'TokenDistributions',
                    'Blockchains' => ['conditions' => ['Blockchains.status' => 1]],
                    'Teams' => ['conditions' => ['Teams.status' => 1]],
                    'SmAccounts' => ['conditions' => ['SmAccounts.featured' => 2]],
                    'Partners' => ['conditions' => ['Partners.status' => 1]],
                ],
                'conditions' => ['Projects.slug' => $id, 'Projects.status' => 1]
            ]);
            $data =  $query->first();

            if (!empty($data)) {
                /* Change status from comming soon to whitelist Open*/
                if ($data->product_status == 'Coming Soon' && !empty($data->whitelist_starts) && strtotime($data->whitelist_starts->format('Y-m-d H:i:s')) <= strtotime(DATE)) {
                    $data->product_status = 'Whitelist Open';
                    $this->Projects->save($data);
                }
                /* Change status from whitelist open to whitelist Closed*/ elseif ($data->product_status == 'Whitelist Open' && !empty($data->whitelist_ends) && strtotime($data->whitelist_ends->format('Y-m-d H:i:s')) <= strtotime(DATE)) {
                    $data->product_status = 'Whitelist Closed';
                    $this->Projects->save($data);
                }
                /* Change status from whitelist Closed to whitelist end*/ elseif ($data->product_status == 'Whitelist Closed' && !empty($data->sale_starts) && strtotime($data->sale_starts->format('Y-m-d H:i:s')) <= strtotime(DATE)) {
                    $data->product_status = 'Live Now';
                    $this->Projects->save($data);
                }
                /* Change status from whitelist Closed to whitelist end*/ elseif ($data->product_status == 'Live Now' && !empty($data->sale_ends) && strtotime($data->sale_ends->format('Y-m-d H:i:s')) <= strtotime(DATE)) {
                    $data->product_status = 'Sold Out';
                    $this->Projects->save($data);
                }

                $data_app = null;
                if ($this->Auth->User('id') != "") {
                    $data_app = $this->Applications->find()->where(['project_id' => $data->id, 'user_id' => $this->Auth->User('id')])->first();
                }

                if ($join_pop == 'yes') {
                    $max_amt = $max_tickets = 0;
                    $is_pending = $join_data = $short_name = null;
                    if ($this->Auth->User('id') != "") {
                        $query1 = $this->Applications->find('all', [
                            'contain' => ['Payments', 'Projects', 'Users', 'Tickets' => ['conditions' => ['Tickets.status' => 1]]],
                            'conditions' => ['Applications.status' => 4, 'Applications.project_id' => $data->id, 'Applications.user_id' => $this->Auth->User('id')]
                        ]);
                        $join_data =  $query1->first();

                        if (!empty($join_data->payments)) {
                            $collection = new Collection($join_data->payments);
                            if (!$collection->isEmpty()) {
                                $chk_pending = $collection->match(['transaction_status' => 2]);
                                $is_pending = $chk_pending->toList();
                            }
                        }
                        if (!empty($join_data) && isset($join_data->user->metamask_wallet_id)) {
                            if (!empty($join_data->allocation) && (float)$join_data->allocation > 0 && (float)$join_data->remaining == 0) {
                                $u = SITEURL . "allocation";
                                echo "<script>window.location.href ='" . $u . "'; </script>";
                                exit;
                            }
                            $max_allocation = $ticket_allocation = $join_data->project->ticket_allocation;
                            if ((float)$join_data->project->max_allocation > 0) {
                                $max_allocation = $join_data->project->max_allocation;
                            }
                            $coin_price = 1; /*default will be USD 1*/
                            if (isset($join_data->project->coin_price) && $join_data->project->coin_price > 0) {
                                $coin_price = $join_data->project->coin_price;
                            }
                            $short_name = 'USD';
                            if (!empty($join_data->project->coin_name)) {
                                $short_name = $join_data->project->coin_name;
                            }

                            if ($join_data->project->token_required == 2) {
                                $max_amt = round($max_allocation / $coin_price, 3);
                            } elseif ($join_data->project->token_required == 1) {
                                $max_tickets = count($join_data->tickets);
                                $max_usd = $ticket_allocation * $max_tickets;
                                $max_amt = round($max_usd / $coin_price, 3);
                            }
                            if ((float)$join_data->allocation <= 0) {
                                $join_data->allocation = $max_amt;
                                $join_data->remaining = $max_amt;
                                $join_data->joined = 0;
                                $this->Applications->save($join_data);
                            }
                        }
                    }
                    $contract = $this->fetchTable('Contracts')->find('all')->where(['type' => 'main'])->first();
                    if (empty($contract)) { $this->viewBuilder()->setLayout('error_404'); } 
                    $this->set(compact('join_data', 'id', 'max_amt', 'max_tickets', 'short_name', 'is_pending','contract'));
                }
                $this->set(compact('data', 'data_app', 'op_pop', 'data_app', 'join_pop'));


                $this->render('project_details');
            } else {
                $this->viewBuilder()->setLayout('error_404');
            }
        }
    }

    public function updateJoinNow()
    {
        $this->autoRender = false;
        if ($this->request->is('ajax') && !empty($this->request->getData())) {
            if ($this->Auth->User('id') != "") {
                $postData = $this->request->getData();
                $query = $this->Applications->find('all', ['contain' => ['Projects', 'Users'], 'conditions' => ['Applications.status' => 4, 'Applications.id' => $postData['id'], 'Applications.user_id' => $this->Auth->User('id')]]);
                $appData =  $query->first();
                if (empty($appData)) {
                    echo '<div class="alert alert-danger" role="alert">Internal server error. please try again </div>';
                    exit;
                }
                $coin_price = 1; /*default will be USD 1*/
                if (isset($appData->project->coin_price) && $appData->project->coin_price > 0) {
                    $coin_price = $appData->project->coin_price;
                }
                $arr = [];
                $arr['joined'] = ((float)$appData->joined + (float)$postData['amount']);
                $arr['joined_usd'] = round($appData->joined_usd + ((float)$postData['amount'] * $coin_price));
                $arr['remaining'] = ((float)$appData->allocation - $arr['joined']);

                if ($postData['status'] == 2) {
                    /* payment is Pending  */
                    $payment = $this->fetchTable('Payments')->newEmptyEntity();
                    $payment_arr = [
                        'application_id' => $appData->id,
                        'project_id' => $appData->project_id,
                        'user_id' => $appData->user_id,
                        'wallet_address' => $postData['wallet_address'],
                        'chain_id' => $postData['chain_id'],
                        'currency' => $postData['currency'],
                        'amount' => $postData['amount'],
                        'transaction_id' => $postData['transaction_id'],
                        'transaction_data' => null,
                        'transaction_status' => 2
                    ];
                    $payment = $this->fetchTable('Payments')->patchEntity($payment, $payment_arr);
                } elseif ($postData['status'] == 3) {
                    $payment = $this->fetchTable('Payments')->find('all', ['conditions' => ['Payments.transaction_id' => $postData['transaction_id']]])->first();
                    $payment->transaction_status = 3;
                    $payment->transaction_data = json_encode($postData['transaction_data']);

                    /* payment is completed */
                    $appData->joined = $arr['joined'];
                    $appData->joined_usd = $arr['joined_usd'];
                    $appData->remaining = $arr['remaining'];
                } elseif ($postData['status'] == 4) {
                    /* payment is failed */
                    $payment = $this->fetchTable('Payments')->find('all', ['conditions' => ['Payments.transaction_id' => $postData['transaction_id']]])->first();
                    $payment->transaction_status = 4;
                    $payment->transaction_data = json_encode($postData['transaction_data']);
                }

                if ($this->fetchTable('Payments')->save($payment)) {
                    $this->Applications->save($appData);
                    echo "<script>$('#paybusd').remove();</script>";
                    if ((int)$postData['status'] == 2) {
                        /* If Pending */
                        echo "<div class='alert alert-success'>Transaction has been initiated. Please wait....</div>";
                    } elseif ((int)$postData['status'] == 3) {
                        /* If Claimed */
                        $u = SITEURL . "allocation";
                        echo "<script>$('#paybusd').remove();</script>";
                        echo "<div class='alert alert-success'>Transaction has been Completed.</div>";
                        echo "<script> setTimeout(function(){ window.location.href ='" . $u . "'; }, 2000);</script>";
                    } elseif ((int)$postData['status'] == 4) {
                        /* If Failed */
                        echo "<div class='alert alert-success'>Transaction has been failed.</div>";
                    }
                } else {
                    echo "<div class='alert alert-success'>Transaction has been failed.</div>";
                }
            } else {
                echo '<div class="alert alert-danger">Please login or register to apply.</div>';
                exit;
            }
            exit;
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
