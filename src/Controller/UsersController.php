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

/**
 * Static content controller
 *
 * This controller will render views from templates/Pages/
 *
 * @link https://book.cakephp.org/4/en/controllers/pages-controller.html
 */
class UsersController extends AppController
{

    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        // methods name we can pass here which we want to allow without login
        parent::beforeFilter($event);

        /* https://book.cakephp.org/4/en/controllers/components/authentication.html#AuthComponent::allow */
        $this->Auth->allow(['login', 'check', 'backend', 'backendRestPassword', 'logout', 'checkMetamask']);

        // Form helper https://codethepixel.com/tutorial/cakephp/cakephp-4-common-helpers
        /* https://codethepixel.com/tutorial/cakephp/cakephp-4-find-sort-count */

        $this->SiteSetting = $this->request->getSession()->read('Setting');
    }


    public function index()
    {
    }


    public function checkMetamask()
    {
        $this->autoRender = false;
        $session = $this->getRequest()->getSession();
        $getData = $this->request->getData();
        if (!empty($getData)) {
            if ($getData['request'] == 'login') {
                echo "Welcome to SuperPAD";
            } elseif ($getData['request'] == 'auth') {
                if (isset($getData['signature'])) {
                    $verify = $this->Users->find('all')->where(['Users.status' => 1, 'Users.role' => 2, 'Users.metamask_wallet_id' => $getData['address']])->first();
                    if (!empty($verify)) {
                        $this->Auth->setUser($verify);
                        echo (json_encode(["Success"]));
                    } else {
                        $postData['id'] = null;
                        $postData['metamask_wallet_id'] = $getData['address'];
                        $postData['status'] = 1;
                        $postData['role'] = 2;
                        $getEnt = $this->Users->newEmptyEntity();
                        $setData = $this->Users->patchEntity($getEnt, $postData, ['validate' => false]);
                        if ($this->Users->save($setData)) {
                            $this->Auth->setUser($setData);
                            echo (json_encode(["Success"]));
                        } else {
                            echo (json_encode(["Fail"]));
                        }
                    }
                } else {
                    echo (json_encode(["Cancel"]));
                }
            }
        }
        exit;
    }



    /**
     * REF : https://book.cakephp.org/4/en/controllers/components/authentication.html#manually-logging-users-in
     */
    public function login()
    {
        if ($this->Auth->User('id') != "") {
            if ($this->request->is('ajax')) {
                $u = SITEURL;
                echo "<script>window.location.href ='" . $u . "'; </script>";
                exit;
            } else {
                $this->redirect('/');
            }
        }
    }

    /**
     * Admin login page
     */
    public function backend()
    {
        $this->viewBuilder()->setLayout('backend_login');
        /*
        pr($this->request->getParam('controller'));
        pr($this->request->getParam('action'));
        die;
        */
        //pr($this->request);die;

        //$user_data = $this->Users->find('all', ['conditions' => ['Users.id' => 1]])->first();
        $user_data = null;
        $this->set(compact('user_data'));

        if ($this->Auth->User('id') != "") {
            if ($this->request->is('ajax')) {
                $u = SITEURL . "pages";
                echo "<script>window.location.href ='" . $u . "'; </script>";
                exit;
            } else {
                $this->redirect('/pages');
            }
        }

        if ($this->request->is('ajax') && !empty($this->request->getData())) {
            $post_data = $this->request->getData();
            $s = "<script>s();</script>";
            if (empty($post_data['email'])) {
                echo $s;
                echo '<div class="alert alert-danger">Please enter email id.</div>';
            } elseif (empty($post_data['password'])) {
                echo $s;
                echo '<div class="alert alert-danger">Please enter password.</div>';
            } else {
                $pwd = trim($post_data['password']);

                $verify = $this->Users->find('all')
                    ->where(['Users.status' => 1, 'Users.role' => 1, 'Users.email' => trim(strtolower($post_data['email']))])
                    ->first();

                if (!empty($verify)) {
                    if (password_verify($pwd, $verify->password)) {
                        $this->Auth->setUser($verify);

                        $up_arr = ['id' => $verify->id, 'last_activity' => DATE];
                        $user1 = $this->Users->newEntity($up_arr, ['validate' => false]);
                        if ($this->Users->save($user1)) {
                        }

                        $q_url = SITEURL . "pages";
                        echo '<script>window.location.href = "' . $q_url . '"</script>';
                        exit;
                    } else {
                        echo $s;
                        echo '<div class="alert alert-danger">Password is invalid</div>';
                    }
                } else {
                    echo $s;
                    echo '<div class="alert alert-danger">User id or password is incorrect</div>';
                }
            }
            exit;
        }
    }

    /**
     * Admin password reset page
     */
    public function backendRestPassword()
    {
        $this->viewBuilder()->setLayout('backend_login');
    }

    public function logout()
    {
        $this->Auth->logout();
        $this->redirect('/');
    }


    public function applicationStatus()
    {
        $query = $this->Applications->find('all', [
            'contain' => ['Projects'],
            'conditions' => ['Applications.user_id' => $this->Auth->User('id')]
        ]);
        $data =  $query->all();
        $this->set(compact('data'));
    }



    public function dashboard()
    {
        return $this->redirect('/users/kyc');
        exit;
       
    }

    public function wallet()
    {
        $user_data = $this->Users->findById($this->Auth->user('id'))->first();
        if (!empty($user_data)) {
            $this->set(compact('user_data'));
        } else {
            $this->viewBuilder()->setLayout('error_404');
        }
    }

    public function kyc()
    {
        if ($this->request->is('ajax') && !empty($this->request->getData())) {
            $postData = $this->request->getData();
            $val = ['validate' => 'OnlyKyc'];

            $uploadPath = 'cdn/kyc/';
            if (!file_exists($uploadPath)) {
                mkdir($uploadPath, 0777, true);
            }
            /*For profile iamge */
            if (!empty($postData['kyc_user_pic1'])) {
                if (in_array($postData['kyc_user_pic1']->getClientMediaType(), ['image/x-png', 'image/png', 'image/jpeg'])) {
                    $fileobject1 = $postData['kyc_user_pic1'];
                    $ext = pathinfo($fileobject1->getClientFilename(), PATHINFO_EXTENSION);
                    $kyc_user_pic =  $postData['id'] . "-profile-pic." . $ext;
                    $destination1 = $uploadPath . $kyc_user_pic;
                    try {
                        $fileobject1->moveTo($destination1);
                    } catch (Exception $e) {
                        
                        echo '<div class="alert alert-danger" role="alert">Image not uploaded.</div>';
                        exit;
                    }
                } else {
                    echo '<div class="alert alert-danger" role="alert">Image not uploaded.</div>';
                    exit;
                }
            }

            /*For doc front img */
            if (!empty($postData['kyc_doc_file1'])) {
                if (in_array($postData['kyc_doc_file1']->getClientMediaType(), ['image/x-png', 'image/png', 'image/jpeg'])) {
                    $fileobject2 = $postData['kyc_doc_file1'];
                    $ext1 = pathinfo($fileobject2->getClientFilename(), PATHINFO_EXTENSION);
                    $kyc_doc_file =  $postData['id'] . "-doc-front." . $ext1;
                    $destination2 = $uploadPath . $kyc_doc_file;
                    try {
                        $fileobject2->moveTo($destination2);
                    } catch (Exception $e) {
                        echo '<div class="alert alert-danger" role="alert">Image not uploaded.</div>';
                        exit;
                    }
                } else {
                    echo '<div class="alert alert-danger" role="alert">Image not uploaded.</div>';
                    exit;
                }
            }

            /*For doc last img*/
            if (!empty($postData['kyc_doc_file_back1'])) {
                if (in_array($postData['kyc_doc_file_back1']->getClientMediaType(), ['image/x-png', 'image/png', 'image/jpeg'])) {
                    $fileobject3 = $postData['kyc_doc_file_back1'];
                    $ext3 = pathinfo($fileobject3->getClientFilename(), PATHINFO_EXTENSION);
                    $kyc_doc_file_back =  $postData['id'] . "-doc-back." . $ext3;
                    $destination3 = $uploadPath . $kyc_doc_file_back;
                    try {
                        $fileobject3->moveTo($destination3);
                    } catch (Exception $e) {
                        echo '<div class="alert alert-danger" role="alert">Image not uploaded.</div>';
                        exit;
                    }
                } else {
                    echo '<div class="alert alert-danger" role="alert">Image not uploaded.</div>';
                    exit;
                }
            }

            if (isset($postData['id']) && !empty($postData['id'])) {
                $getBlog = $this->Users->get($postData['id']);

                if (!empty($kyc_user_pic)) {
                    $postData['kyc_user_pic'] = $kyc_user_pic;
                }
                if (!empty($kyc_doc_file)) {
                    $postData['kyc_doc_file'] = $kyc_doc_file;
                }
                if (!empty($kyc_doc_file_back)) {
                    $postData['kyc_doc_file_back'] = $kyc_doc_file_back;
                }
                $postData['kyc_completed'] = 1;
                $postData['kyc_submitted'] = DATE;
                $postData['kyc_full_name'] = $postData['first_name']." ".$postData['last_name'];

                $chkBlog = $this->Users->patchEntity($getBlog, $postData, $val);
            }
            if ($chkBlog->getErrors()) {
                $st = null;
                foreach ($chkBlog->getErrors() as $elist) {
                    foreach ($elist as $k => $v); {
                        $st .= "<div class='alert alert-danger'>" . ucwords($v) . "</div>";
                    }
                }
                echo $st;
                exit;
            } else {
                if ($this->Users->save($chkBlog)) {
                    $admin = 'support@superpad.finance';
                    $this->Data->AppMail($admin, 8, ['NAME' => $chkBlog->first_name, 'LINK' => SITEURL . "pages/manage_kyc/" . $chkBlog->id]);
                    $u = SITEURL . "users/kyc";
                    echo '<div class="alert alert-success" role="alert"> Saved.</div>';
                    echo "<script>window.location.href ='" . $u . "'; </script>";
                } else {
                    echo '<div class="alert alert-danger" role="alert"> Not saved.</div>';
                }
            }
            exit;
        }


        $user_data = $this->Users->findById($this->Auth->user('id'))->first();
        if (!empty($user_data)) {
            $this->set(compact('user_data'));
        } else {
            $this->viewBuilder()->setLayout('error_404');
        }
    }


    public function doStake()
    {
        $this->autoRender = false;
        if ($this->request->is('ajax') && !empty($this->request->getData())) {
            $post_data = $this->request->getData();
            $post_data['user_id'] = $this->Auth->User('id');
            $all_levels = $this->Levels->find()->order(['spad' => 'ASC'])->all()->toArray();

            $get_satak = $this->Stakes->find()
                ->contain(['allStakes' => ['fields' => ['id', 'stake_id', 'type', 'days', 'percentage']]])
                ->select(['id', 'stake_id', 'type', 'days', 'percentage'])
                ->where(['Stakes.type' => 1, 'Stakes.days' => $post_data['days']])
                ->first()->toArray();

            if (!empty($get_satak)) {
                if (!empty($all_levels)) {
                    foreach ($all_levels as $a) {
                        if (!empty($a->spad)) {
                            $tire[$a->spad] = [
                                'spad' => $a->spad, 'title' => $a->title, 'ticket_multiplier' => $a->ticket_multiplier,
                                'cooldown' => $a->cooldown, 'social_task' => $a->social_task, 'max_ticket_allocation' => $a->max_ticket_allocation,
                                'winning_chances' => $a->winning_chances, 'guaranteed_allocation' => $a->guaranteed_allocation
                            ];
                        }
                    }
                }

                $min_tier = min(array_keys($tire));

                $closest_tier = null;
                if ($post_data['bal'] > $post_data['bal']) {
                    if (!empty($tire)) {
                        foreach ($tire as $a => $b) {
                            if ($post_data['bal'] >= $a) {
                                $closest_tier = $b;
                            }
                        }
                        if ($closest_tier === null) {
                            $closest_tier = end($tire);
                        }
                    }
                }
                $get_satak['tier'] = $closest_tier;
                $post_data['stake_info'] = json_encode($get_satak);
                $post_data['stake_date'] = DATE;
                $post_data['staked_token'] =  $post_data['bal'];
                $post_data['balance'] =  $post_data['bal'];
                $post_data['reward_token'] = $post_data['unstaked_token'] = $post_data['penalty'] = 0;

                $saveData = $this->UserStakes->newEntity($post_data, ['validate' => false]);
                if ($this->UserStakes->save($saveData)) {
                    $q_url = SITEURL . "users/staking";
                    echo '<script>window.location.href = "' . $q_url . '"</script>';
                    exit;
                }
            }
        }
        exit;
    }

    public function unStake($id = null)
    {

        if ($this->request->is('ajax') && !empty($this->request->getData())) {
            if ($this->Auth->User('id') != "") {
                $postData = $this->request->getData();
                $val = ['validate' => false];

                if (isset($postData['id']) && !empty($postData['id'])) {
                    $getData = $this->UserStakes->get($postData['id']);

                    $postData['unstaked_token'] = $getData['unstaked_token'] + $postData['final_token'];
                    $postData['penalty'] = $getData['penalty'] + $postData['penalty'];
                    $postData['balance'] = $getData['balance'] - $postData['unstake'];
                    $postData['unstake_date'] = DATE;
                    $unstake_info = [];
                    if (!empty($getData['unstake_info'])) {
                        $unstake_info = json_decode($getData['unstake_info'], true);
                    }
                    $unstake_info[strtotime(DATE)] = [
                        'date' => DATE, 'token' => $postData['unstake'], 'penalty' => $postData['penalty'], 'penalty_percentage' => $postData['penalty_percentage'],
                        'total_token' => $postData['final_token'], 'days' => $postData['hold'], 'bf_token' => $getData['balance'], 'af_token' => $postData['balance']
                    ];
                    $postData['unstake_info'] = json_encode($unstake_info);
                    $chkData = $this->UserStakes->patchEntity($getData, $postData, $val);
                } else {
                    echo '<div class="alert alert-danger" role="alert">An error occurred, please try again later.</div>';
                    exit;
                }
                if ($chkData->getErrors()) {
                    $st = null;
                    foreach ($chkData->getErrors() as $elist) {
                        foreach ($elist as $k => $v); {
                            $st .= "<div class='alert alert-danger'>" . ucwords($v) . "</div>";
                        }
                    }
                    echo $st;
                    exit;
                } else {

                    if ($this->UserStakes->save($chkData)) {
                        $u = SITEURL . "users/staking";
                        echo '<div class="alert alert-success" role="alert">unStaked.</div>';
                        echo "<script>window.location.href ='" . $u . "'; </script>";
                    } else {
                        echo '<div class="alert alert-danger" role="alert"> Not saved.</div>';
                    }
                }
            }
            exit;
        }

        if (!empty($id)) {
            $getStake = $this->UserStakes->find()->where(['id' => $id, 'user_id' => $this->Auth->User('id')])->first();
            $this->set(compact('getStake'));
        }
    }

    public function staking()
    {
        $query = $this->UserStakes->find('all', [
            'conditions' => ['UserStakes.user_id' => $this->Auth->User('id')],
            'order' => ['UserStakes.stake_date' => 'ASC']
        ]);
        $data =  $query->all();

        $this->set(compact('data'));
    }

    public function tier()
    {
        $bal = $this->UserStakes->find()->select(['sum' => 'SUM(UserStakes.balance)'])->where(['UserStakes.user_id' => $this->Auth->User('id')])->toArray();
        $tot_stake = 0;
        if (isset($bal[0]->sum)) {
            $tot_stake = $bal[0]->sum;
        }
        $query = $this->Levels->find()->order(['spad' => 'ASC']);
        $data = $query->all();
        $tire = null;
        if (!empty($data)) {
            foreach ($data as $a) {
                if (!empty($a->spad)) {
                    $tire[$a->spad] = $a;
                }
            }
        }

        $my_tier = null;
        if ($tot_stake > 0) {
            if (!empty($tire)) {
                foreach ($tire as $a => $b) {
                    if ($tot_stake >= $a) {
                        $my_tier = $b;
                    }
                }
                if ($my_tier === null) {
                    $my_tier = end($tire);
                }
            }
        }
        $this->set(compact('data', 'tot_stake', 'my_tier'));
    }

    public function allocation()
    {
        $average = 0;
        $query = $this->Applications->find('all', [
            'contain' => ['Projects' => ['Blockchains'], 'Tickets' => ['conditions' => ['Tickets.status' => 1]]],
            'conditions' => ['Applications.status' => 4, 'Applications.user_id' => $this->Auth->User('id')]
        ]);
        $data =  $query->all();
        $this->set(compact('data'));
    }

    public function doClaim($id = null)
    {
        $contract = $this->fetchTable('Contracts')->find('all')->where(['type' => 'main'])->first();
        if (empty($contract)) {
            $this->viewBuilder()->setLayout('error_404');
        }
        $query = $this->Applications->find('all', [
            'contain' => ['Users', 'Claims', 'Projects' => ['TokenDistributions' => ['sort' => ['TokenDistributions.claim_date' => 'ASC']]]],
            'conditions' => [
                'Applications.id' => $id, 'Applications.status' => 4, 'Applications.total_token > ' => 0,
                'Applications.user_id' => $this->Auth->User('id')
            ]
        ]);
        $data =  $query->first();
        if (!empty($data)) {
            $this->set(compact('data', 'contract'));
        } else {
            $this->viewBuilder()->setLayout('error_404');
        }
    }

    public function checkClaim()
    {
        $this->autoRender = false;
        if ($this->request->is('ajax') && !empty($this->request->getData())) {
            $postData = $this->request->getData();
            if ($this->Auth->User('id') != "") {
                $chk_user = $this->Users->find('all')->where(['id' => $this->Auth->User('id')])->first();
                if (!empty($chk_user)) {
                    if ($chk_user->kyc_completed == 2) {
                        $arr = $this->fetchTable('Claims')->find('all')->contain(['Applications'])
                            ->where(['Claims.id' => $postData['id'], 'Claims.uuid IS NOT' => null, 'Claims.token_address IS NOT' => null])
                            ->first();
                        if (!empty($arr)) {
                            if (in_array($arr->transaction_status, [1, 4])) {
                                if (strtotime(DATE) > strtotime($arr->claim_from->format("Y-m-d H:i:s"))) {
                                    if (($arr->application->available_token + $arr->application->claimed_token) ==  $arr->application->total_token) {
                                        echo "<script>token_claim(" . $arr->id . ",'" . $arr->uuid . "','" . $arr->token_address . "','" . $arr->wallet_address . "');</script>";
                                    } else {
                                        echo "<div class='alert alert-danger'>Sorry, something went wrong. Please contact support.</div>";
                                        exit;
                                    }
                                } else {
                                    echo "<div class='alert alert-danger'>You can claim tokens " . $arr->claim_from->format("Y-m-d h:i A") . " after </div>";
                                    exit;
                                }
                            } elseif ($arr->transaction_status == 2) {
                                echo "<div class='alert alert-danger'>This transaction is pending. Please check Transaction Hash for details.</div>";
                                exit;
                            } elseif ($arr->transaction_status == 3) {
                                echo "<div class='alert alert-success'>Tokens already claimed. Please check Transaction Hash for more details.</div>";
                                exit;
                            }
                        }
                    }else{
                        echo "<div class='alert alert-danger'><p class='fs-14'>Please complete your KYC to join this sale. <br><a href='".SITEURL."users/kyc'>Click Here</a> to complete KYC.</p></div>";
                        exit;
                    }
                }
            }
        }
        exit;
    }

    public function updateClaim()
    {

        $this->autoRender = false;
        if ($this->request->is('ajax') && !empty($this->request->getData())) {
            if ($this->Auth->User('id') != "") {
                $postData = $this->request->getData();
                $query = $this->fetchTable('Claims')->find('all', ['conditions' => ['Claims.id' => $postData['id']]]);
                $query->contain(['Applications']);
                $data =  $query->first();
                if (!empty($data)) {
                    if (isset($postData['transaction_id'])) {
                        $data->transaction_id = $postData['transaction_id'];
                    }

                    if (!empty($postData['tran_data'])) {
                        $data->transaction_data = json_encode($postData['tran_data']);
                    } else {
                        $data->transaction_data = null;
                    }

                    $data->transaction_status = $postData['status'];
                    if ($postData['status'] == 3) {
                        /* If Claimed */
                        $data->claimed_date = DATE;
                        $total_claimed_token =  $data->application->claimed_token + $data->total_token;
                        $available_token = $data->application->available_token - $data->total_token;
                        $data->application->claimed_token = $total_claimed_token;
                        $data->application->available_token = $available_token;
                    } else {
                        $data->claimed_date = null;
                    }

                    $this->fetchTable('Claims')->save($data);
                    $this->Applications->save($data->application);
                    if ((int)$postData['status'] == 2) {
                        /* If Pending */
                        echo "<script>$('#btn_" . $postData['id'] . "').remove(); $('#on_" . $postData['id'] . "').html(''); $('#st_" . $postData['id'] . "').html('<span class=\'badge bg-warning\'>Pending</span>'); $('#hash_" . $postData['id'] . "').html('<a href=\'" . env('bscscanHash') . "tx/" . $postData['transaction_id'] . "\' target=\'_blank\'>View</a>'); </script>";
                    } elseif ((int)$postData['status'] == 3) {
                        /* If Claimed */
                        echo "<script>$('#btn_" . $postData['id'] . "').remove(); $('#on_" . $postData['id'] . "').html('" . DATE . "'); $('#st_" . $postData['id'] . "').html('<span class=\'badge bg-success\'>Completed</span>');  $('#hash_" . $postData['id'] . "').html('<a href=\'" . env('bscscanHash') . "tx/" . $postData['transaction_id'] . "\' target=\'_blank\'>View</a>'); </script>";
                    } elseif ((int)$postData['status'] == 4) {
                        /* If Failed */
                        echo "<script>$('#btn_" . $postData['id'] . "').remove(); $('#on_" . $postData['id'] . "').html(''); $('#st_" . $postData['id'] . "').html('<span class=\'badge bg-danger\'>Failed</span>');  $('#hash_" . $postData['id'] . "').html(''); </script>";
                    }
                }
            }
        }
        exit;
    }
}
