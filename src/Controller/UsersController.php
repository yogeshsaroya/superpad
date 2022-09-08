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

use Google_Client;
use Google_Service_Oauth2;

use Cake\Core\Configure;
use Cake\Http\Exception\ForbiddenException;
use Cake\Http\Exception\NotFoundException;
use Cake\Http\Response;
use Cake\View\Exception\MissingTemplateException;
use Cake\Auth\DefaultPasswordHasher;


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
        $this->Auth->allow([
            'login', 'register', 'backend', 'backendRestPassword', 'logout', 'check', 'gAuth',
            'forgetPassword', 'check_metamask'
        ]);

        // Form helper https://codethepixel.com/tutorial/cakephp/cakephp-4-common-helpers
        /* https://codethepixel.com/tutorial/cakephp/cakephp-4-find-sort-count */

        $this->SiteSetting = $this->request->getSession()->read('Setting');
        
    }


    public function index()
    {
    }

    /**
     * Admin password reset page
     */
    public function register()
    {
        $session = $this->getRequest()->getSession();
        $q = $this->request->getQuery();

        $user_data = null;
        $this->set(compact('user_data'));
        if ($this->Auth->User('id') != "") {
            if ($this->request->is('ajax')) {
                $u = SITEURL . "dashboard";
                echo "<script>window.location.href ='" . $u . "'; </script>";
                exit;
            } else {
                $this->redirect('/dashboard');
            }
        }

        if ($this->request->is('ajax') && !empty($this->request->getData())) {
            $s = "<script>s();</script>";
            $postData = $this->request->getData();
            $getEnt = $this->Users->newEmptyEntity();
            $setData = $this->Users->patchEntity($getEnt, $postData, ['validate' => true]);
            if ($setData->getErrors()) {
                $st = null;
                foreach ($setData->getErrors() as $elist) {
                    foreach ($elist as $k => $v); {
                        $st .= "<div class='alert alert-danger'>" . ucwords($v) . "</div>";
                    }
                }
                echo $st;
                exit;
            } else {
                if ($this->Users->save($setData)) {
                    $this->Auth->setUser($setData);

                    $q_url = SITEURL . "dashboard";
                    if (!empty($session->read('redirect'))) {
                        $q_url = SITEURL . $session->read('redirect');
                        $session->delete('redirect');
                    }
                    echo '<div class="alert alert-success" role="alert"> Blog post saved.</div>';
                    echo "<script>window.location.href ='" . $q_url . "'; </script>";
                } else {
                    echo '<div class="alert alert-danger" role="alert"> Not saved.</div>';
                }
            }
            exit;
        }
    }

    /**
     * REF : https://book.cakephp.org/4/en/controllers/components/authentication.html#manually-logging-users-in
     */
    public function login()
    {
        $session = $this->getRequest()->getSession();
        $q = $this->request->getQuery();
        if (isset($q['redirect']) && !empty($q['redirect'])) {
            $qr = $q['redirect'];
            unset($q['redirect']);
            if (!empty($q)) {
                $qr .= "?" . http_build_query($q);
            }
            $session->write('redirect', $qr);
        }

        $user_data = null;
        $this->set(compact('user_data'));
        if ($this->Auth->User('id') != "") {
            if ($this->request->is('ajax')) {
                $u = SITEURL . "dashboard";
                echo "<script>window.location.href ='" . $u . "'; </script>";
                exit;
            } else {
                $this->redirect('/dashboard');
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
                try {
                    $verify = $this->Users->find('all')
                        ->where(['Users.status' => 1, 'Users.role' => 2, 'Users.email' => trim(strtolower($post_data['email']))])
                        ->first();
                    if (!empty($verify)) {
                        if (password_verify($pwd, $verify->password)) {
                            $this->Auth->setUser($verify);
                            $up_arr = ['id' => $verify->id, 'last_activity' => DATE];
                            $user1 = $this->Users->newEntity($up_arr, ['validate' => false]);
                            if ($this->Users->save($user1)) {
                            }

                            $q_url = SITEURL . "dashboard";
                            if (!empty($session->read('redirect'))) {
                                $q_url = SITEURL . $session->read('redirect');
                                $session->delete('redirect');
                            }
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
                } catch (\Throwable $th) {
                    echo $s;
                    echo '<div class="alert alert-danger">User is invalid</div>';
                }
            }
            exit;
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

    public function forgetPassword()
    {
        $user_data = null;
        $this->set(compact('user_data'));
        if ($this->Auth->User('id') != "") {
            if ($this->request->is('ajax')) {
                $u = SITEURL . "dashboard";
                echo "<script>window.location.href ='" . $u . "'; </script>";
                exit;
            } else {
                $this->redirect('/dashboard');
            }
        }

        if ($this->request->is('ajax') && !empty($this->request->getData())) {
            $post_data = $this->request->getData();
            if (empty($post_data['email'])) {
                echo '<div class="alert alert-danger">Please enter email id.</div>';
            } else {
                $password = rand(123456, 987654);

                $verify = $this->Users->find('all')
                    ->where(['Users.status' => 1, 'Users.role' => 2, 'Users.email' => trim(strtolower($post_data['email']))])
                    ->first();
                if (!empty($verify)) {
                    $this->Data->AppMail($verify->email, 4, ['NAME' => $verify->first_name, 'PWD' => $password]);
                    $up_arr = ['id' => $verify->id, 'password' => $password];
                    $user1 = $this->Users->newEntity($up_arr, ['validate' => false]);
                    $this->Users->save($user1);
                    echo '<script>$("#e_frm")[0].reset();</script>';
                    echo '<div class="alert alert-success">Change password request has been send to registered email address.</div>';
                    exit;
                } else {
                    echo '<div class="alert alert-danger">This email address is not registered </div>';
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

    /* Login via Google */
    public function gAuth()
    {
        $session = $this->getRequest()->getSession();
        $q = $this->request->getQuery();

        $this->autoRender = false;
        $err_msg = 'Authentication error. Please try again later.';
        //echo ROOT . '/vendor' . DS  . 'google' . DS . 'vendor' . DS . 'autoload.php';die;
        require_once(ROOT . '/vendor' . DS  . 'google' . DS . 'vendor' . DS . 'autoload.php');

        $clientID = $this->SiteSetting['google_client_id'];
        $clientSecret = $this->SiteSetting['google_client_secret'];
        $redirectUri = SITEURL . "users/g_auth";
        // create Client Request to access Google API

        $client = new Google_Client();
        $client->setClientId($clientID);
        $client->setClientSecret($clientSecret);
        $client->setRedirectUri($redirectUri);
        $client->addScope("email");
        $client->addScope("profile");
        if (isset($_GET['code'])) {
            $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
            if (isset($token['access_token'])) {
                $client->setAccessToken($token['access_token']);
                // get profile info
                $google_oauth = new Google_Service_Oauth2($client);
                $google_account_info = $google_oauth->userinfo->get();

                if (isset($google_account_info->id) && isset($google_account_info->email)) {
                    $email =  $google_account_info->email;
                    $f_name =  $google_account_info->givenName;
                    $l_name =  $google_account_info->familyName;
                    $gid =  $google_account_info->id;

                    /* Check if user exists */

                    $verify = $this->Users->find('all')
                        ->where(['Users.status' => 1, 'Users.role' => 2, 'Users.google_id' => $gid])
                        ->first();
                    if (!empty($verify)) {
                        $this->Auth->setUser($verify);
                        $up_arr = ['id' => $verify->id, 'last_activity' => DATE];
                        $user1 = $this->Users->newEntity($up_arr, ['validate' => false]);
                        $this->Users->save($user1);

                        $q_url = SITEURL . "dashboard";
                        if (!empty($session->read('redirect'))) {
                            $q_url = SITEURL . $session->read('redirect');
                            $session->delete('redirect');
                        }

                        return $this->redirect($q_url);
                        exit;
                    } else {
                        $verify_em = $this->Users->find('all')->where(['Users.status' => 1, 'Users.role' => 2, 'Users.email' => $email])->first();
                        if (!empty($verify_em)) {
                            $err_msg = 'An account already registered using email ' . $email . '. Please login using email address.';
                            $this->set('err_msg', $err_msg);
                            $this->render('auth_error');
                        } else {
                            $up_arr = ['id' => null, 'google_id' => $gid, 'email' => $email, 'first_name' => $f_name, 'last_name' => $l_name, 'password' => rand(), 'status' => 1, 'role' => 2, 'last_activity' => DATE];
                            $user1 = $this->Users->newEntity($up_arr, ['validate' => false]);
                            if ($this->Users->save($user1)) {
                                $this->Auth->setUser($user1);
                                $up_arr = ['id' => $user1->id, 'last_activity' => DATE];
                                $udata = $this->Users->newEntity($up_arr, ['validate' => false]);
                                $this->Users->save($udata);
                                $q_url = SITEURL . "dashboard";
                                if (!empty($session->read('redirect'))) {
                                    $q_url = SITEURL . $session->read('redirect');
                                    $session->delete('redirect');
                                }

                                return $this->redirect($q_url);
                                exit;
                            } else {
                                $err_msg = 'An error occurred. Please try again later';
                                $this->set('err_msg', $err_msg);
                                $this->render('auth_error');
                            }
                        }
                    }
                } else {
                    $this->set('err_msg', $err_msg);
                    $this->render('auth_error');
                }
            } else {
                $this->set('err_msg', $err_msg);
                $this->render('auth_error');
            }
        } else {
            $url = $client->createAuthUrl();
            return $this->redirect($url);
        }
    }

    /* login via FB */
    public function check()
    {
        $this->autoRender = false;
        $session = $this->getRequest()->getSession();
        $q = $this->request->getQuery();

        $err_msg = 'Authentication error. Please try again later.';


        if (isset($q['facebook']) && $q['facebook'] == 'true' && isset($q['code']) && !empty($q['code'])) {
            $fbappid = $this->SiteSetting['fb_app_id'];
            $fbappsecret = $this->SiteSetting['fb_app_secret'];
            $fbcode = $q['code'];
            $getToken = $this->_getFbToken($fbappid, $fbappsecret, SITEURL . 'check?facebook=true', $fbcode);
            ec($getToken);
            die;

            if (isset($getToken['access_token']) && !empty($getToken['access_token'])) {
                $fb_user = $this->_parseFbInfo($getToken['access_token']);
                ec($fb_user);
                die;
                /* Check if user exists */
                $verify = $this->Users->find('all')
                    ->where(['Users.status' => 1, 'Users.role' => 2, 'Users.fb_id' => $fb_user->id])
                    ->first();
                if (!empty($verify)) {
                    $this->Auth->setUser($verify);
                    $up_arr = ['id' => $verify->id, 'last_activity' => DATE];
                    $user1 = $this->Users->newEntity($up_arr, ['validate' => false]);
                    $this->Users->save($user1);
                    $q_url = SITEURL . "dashboard";
                    if (!empty($session->read('redirect'))) {
                        $q_url = SITEURL . $session->read('redirect');
                        $session->delete('redirect');
                    }
                    return $this->redirect($q_url);
                    exit;
                } else {
                    $verify_em = $this->Users->find('all')->where(['Users.status' => 1, 'Users.role' => 2, 'Users.email' => $fb_user->email])->first();
                    if (!empty($verify_em)) {
                        $err_msg = 'An account already registered using email ' . $fb_user->email . '. Please login using email address.';
                        $this->set('err_msg', $err_msg);
                        $this->render('auth_error');
                    } else {
                        $up_arr = ['id' => null, 'fb_id' => $fb_user->id, 'email' => $fb_user->email, 'first_name' => $fb_user->first_name, 'last_name' => $fb_user->last_name, 'password' => rand(), 'status' => 1, 'role' => 2, 'last_activity' => DATE];
                        $user1 = $this->Users->newEntity($up_arr, ['validate' => false]);
                        if ($this->Users->save($user1)) {
                            $this->Auth->setUser($user1);
                            $up_arr = ['id' => $user1->id, 'last_activity' => DATE];
                            $udata = $this->Users->newEntity($up_arr, ['validate' => false]);
                            $this->Users->save($udata);
                            $q_url = SITEURL . "dashboard";
                            if (!empty($session->read('redirect'))) {
                                $q_url = SITEURL . $session->read('redirect');
                                $session->delete('redirect');
                            }
                            return $this->redirect($q_url);
                            exit;
                        } else {
                            $err_msg = 'An error occurred. Please try again later';
                            $this->set('err_msg', $err_msg);
                            $this->render('auth_error');
                        }
                    }
                }
            } else {
                $this->set('err_msg', $err_msg);
                $this->render('auth_error');
            }
        } else {
            $this->set('err_msg', $err_msg);
            $this->render('auth_error');
        }
    }

    public function _getFbToken($app_id, $app_secret, $redirect_url, $code)
    {
        // Build the token URL
        $url = 'https://graph.facebook.com/oauth/access_token?client_id=' . $app_id . '&redirect_uri=' . urlencode($redirect_url) . '&client_secret=' . $app_secret . '&code=' . $code;
        // Get the file
        $response = $this->Data->fetch($url);
        $arr = json_decode($response, true);
        return $arr;
    }

    public function _parseFbInfo($access_token)
    {
        $url = "https://graph.facebook.com/me?fields=id,email,first_name,last_name,verified&access_token=" . $access_token;
        $user = json_decode($this->Data->fetch($url));
        if ($user != null && isset($user->email)) {
            return $user;
        }
        return null;
    }

    public function checkMetamask()
    {
        $this->autoRender = false;
        $getData = $this->request->getData();
        if (!empty($getData)) {

            if ($getData['request'] == 'login') {
                //ec("Login : ");ec($getData);
                echo "Welcome to SuperPAD";
            } elseif ($getData['request'] == 'auth') {
                if (isset($getData['signature'])) {
                    if ($this->Auth->User('id') != "") {
                        $verify = $this->Users->find('all')
                            ->where(['Users.status' => 1, 'Users.role' => 2, 'Users.id' => $this->Auth->User('id')])
                            ->first();
                        if (!empty($verify)) {
                            $up_arr = ['id' => $verify->id, 'metamask_wallet_id' => $getData['address']];
                            $user1 = $this->Users->newEntity($up_arr, ['validate' => 'WalletAddress']);
                            if ($user1->getErrors()) {
                                echo (json_encode(['Error', 'This wallet address is already in use with other account.']));
                                exit;
                            } else {
                                $this->Users->save($user1);
                                echo (json_encode(["Success"]));
                            }
                        } else {
                            echo (json_encode(["Fail"]));
                        }
                    } else {
                        echo (json_encode(["Fail"]));
                    }
                } else {
                    echo (json_encode(["Cancel"]));
                }
            }
        }
        exit;
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

    public function connectWallet()
    {
        $user_data = $this->Users->findById($this->Auth->user('id'))->first();
        if (!empty($user_data->metamask_wallet_id)) {
            $this->redirect('/users/wallet');
        }
    }

    public function dashboard()
    {
        if ($this->request->is('ajax') && !empty($this->request->getData())) {
            $postData = $this->request->getData();
            $val = ['validate' => true];
            if (!empty($postData['password1'])) {
                $postData['password'] = $postData['password1'];
            } else {
                $val = ['validate' => 'OnlyCheck'];
            }
            if (isset($postData['id']) && !empty($postData['id'])) {
                $getBlog = $this->Users->get($postData['id']);
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
                    $u = SITEURL . "dashboard";
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
            //ec($postData);die;
            $val = ['validate' => true];
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
        //$a = $this->fetchTable('Claims')->find('all')->all();
        
    }

    public function doClaim($id = null)
    {
        $query = $this->Applications->find('all', [
            'contain' => ['Projects' => ['TokenDistributions' => ['sort' => ['TokenDistributions.claim_date' => 'ASC']]]],
            'conditions' => ['Applications.id' => $id, 'Applications.status' => 4, 'Applications.total_token > '=>0,
            'Applications.user_id' => $this->Auth->User('id')]
        ]);
        $data =  $query->first();
        if(!empty($data)){
            $arr = [];
            if (empty($data->info) && isset($data->project->token_distributions) && !empty($data->project->token_distributions)) {
                foreach ($data->project->token_distributions as $list) {
                    if(!empty($list->claim_date)){
                        $arr[strtotime($list->claim_date->format("Y-m-d H:i:s"))] = [
                            'percentage' => $list->percentage, 'total_token' => $data->total_token * $list->percentage / 100,
                            'claim_before' => $list->claim_date->format("Y-m-d H:i:s"), 'claim_on' => null
                        ];
                    }
                }
                $data->info = json_encode($arr);
                $this->Applications->save($data);
            }
        }
        $this->set(compact('data'));
    }

    public function updateClaim()
    {   
        
        $this->autoRender = false;
        if ($this->request->is('ajax') && !empty($this->request->getData())) {
            if ($this->Auth->User('id') != "") {
                $postData = $this->request->getData();
                
                $query = $this->Applications->find('all', ['conditions' => ['Applications.id' => $postData['app_id'], 'Applications.status' => 4]]);
                $data =  $query->first();
                $claimed_token = 0;
                if (!empty($data->info)) {
                    $arr = json_decode($data->info, true);
                    if (isset($arr[$postData['id']]) && !empty($arr[$postData['id']])) {
                        $arr[$postData['id']]['claim_on'] = DATE;
                        $arr[$postData['id']]['claimed_token'] = $postData['amt'];
                        $arr[$postData['id']]['transaction_id'] = $postData['transaction_id'];
                        $arr[$postData['id']]['transaction_data'] = $postData['tran_data'];
                        $claimed_token = $arr[$postData['id']]['total_token'];
                    }
                    
                    $data->claimed_token = $data->claimed_token + $claimed_token;
                    $data->available_token = $data->available_token - $claimed_token;
                    $data->info = json_encode($arr);
                    $this->Applications->save($data);
                    echo "<script>$('#btn_" . $postData['id'] . "').remove(); $('#on_" . $postData['id'] . "').html('" . DATE . "'); </script>";
                }
            }
        }
        exit;
    }
}
