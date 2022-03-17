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
        $this->Auth->allow(['login','register','backend','backendRestPassword','logout','check','gAuth','forgetPassword','connectWallet']);

        // Form helper https://codethepixel.com/tutorial/cakephp/cakephp-4-common-helpers
        /* https://codethepixel.com/tutorial/cakephp/cakephp-4-find-sort-count */

        $this->SiteSetting = $this->request->getSession()->read('Setting');
    }


    public function index()
    {
        $po_data = [
            ['id' => null, 'email' => rand() . 'abc@gmail.com', 'password' => '123456', 'first_name' => rand()],
            ['id' => null, 'email' => rand() . 'abc@gmail.com', 'password' => '123456', 'first_name' => rand()],
            ['id' => null, 'email' => rand() . 'abc@gmail.com', 'password' => '123456', 'first_name' => rand()]
        ];

        $entities = $this->Blogs->newEntities($po_data, ['validate' => true]);

        try {
            $result = $this->Blogs->saveMany($entities);
            ec($result);
        } catch (Exception $e) {
            ec($e);
        }

        exit;
        if (password_verify('123456', '$2y$10$8awoEg3aaKcXAnTmfpKdeufuyBLvBcyz79nngQRlGr5OCf2TJXNzi')) {
            echo 'Password is valid!';
        } else {
            echo 'Invalid password.';
        }

        die;
        /*
        $query = $this->Users->find('all', [
            'conditions' => [],
            'contain' => [],
            'limit' => 10
        ]);
        $row = $query->all()->toArray();
        ec($row);die;
        
        ec( $this->Auth->user() );
        */
        $user_data = ['id' => null, 'email' => rand() . 'abc@gmail.com', 'password' => '123456', 'first_name' => 'Yogesh'];
        /*
        $hasher = new DefaultPasswordHasher();
        $pass = $hasher->hash('123456');
        ec($pass);
        
        if (password_verify('123456', '$2y$10$3TgUhsVOsGDtEXjmP6FqneV7bBRQSQAd//K0WhP7FC1QJ8FWIlaFa')) {
            echo 'Password is valid!';
        } else {
            echo 'Invalid password.';
        }
        
        $postpassword = $hasher->check('123456',$pass);
        dd($postpassword);die;
        */

        // Trial 1
        $user1 = $this->Users->newEntity($user_data, ['validate' => true]);
        if ($user1->getErrors()) {
            ec($user1->getErrors());
        } else {
            if ($this->Users->save($user1)) {
                echo "saved";
            } else {
                echo "error";
            }
        }
        die;
        // Trial 2
        /*
        $user2 = $this->Users->newEmptyEntity();
        $entity = $this->Users->patchEntity($user2, $user_data);
        $this->Users->save($user2);
        */
    }
    public function connectWallet()
    {
    }

    public function dashboard()
    {
         ec($this->Auth->user());
    }
    /**
     * Admin password reset page
     */
    public function register()
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
            $s = "<script>s();</script>";
            $postData = $this->request->getData();
            $getEnt = $this->Users->newEmptyEntity();
            $setData = $this->Users->patchEntity($getEnt,$postData,['validate' => true]);
            if ($setData->getErrors()) {
                $st = null;
                foreach( $setData->getErrors() as $elist ){
                    foreach($elist as $k=>$v);{ $st.="<div class='alert alert-danger'>".ucwords($v)."</div>"; }
                }
                echo $st; exit;
            }else{
                if($this->Users->save($setData)){
                    $this->Auth->setUser($setData);
                    $u = SITEURL."dashboard";
                    echo '<div class="alert alert-success" role="alert"> Blog post saved.</div>';
                    echo "<script>window.location.href ='".$u."'; </script>";
                }else{
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
        /*
        $users = $this->Users->find();
        $user = $users->first()->toArray();
        $this->Auth->setUser($user);
        $this->redirect('/users');
        */
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
                    ->first()->toArray();

                if (!empty($verify)) {
                    if (password_verify($pwd, $verify['password'])) {
                        $this->Auth->setUser($verify);

                        $up_arr = ['id' => $verify['id'], 'last_activity' => DATE];
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
    
    public function forgetPassword(){
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
            }else {
                $password = rand(123456,987654);

                $verify = $this->Users->find('all')
                    ->where(['Users.status' => 1, 'Users.role' => 2, 'Users.email' => trim(strtolower($post_data['email']))])
                    ->first();
                    if (!empty($verify)) {
                        $this->Data->AppMail($verify->email,4, ['NAME'=>$verify->first_name,'PWD'=>$password]);
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
                        return $this->redirect(SITEURL . "dashboard");
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
                                return $this->redirect(SITEURL . "dashboard");
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
        $err_msg = 'Authentication error. Please try again later.';
        $q = $this->request->getQuery();

        if (isset($q['facebook']) && $q['facebook'] == 'true' && isset($q['code']) && !empty($q['code'])) {
            $fbappid = $this->SiteSetting['fb_app_id'];
            $fbappsecret = $this->SiteSetting['fb_app_secret'];
            $fbcode = $q['code'];
            $getToken = $this->_getFbToken($fbappid, $fbappsecret, SITEURL . 'check?facebook=true', $fbcode);
            
            if (isset($getToken['access_token']) && !empty($getToken['access_token'])) {
                $fb_user = $this->_parseFbInfo($getToken['access_token']);
                /* Check if user exists */
                $verify = $this->Users->find('all')
                    ->where(['Users.status' => 1, 'Users.role' => 2, 'Users.fb_id' => $fb_user->id])
                    ->first();
                if (!empty($verify)) {
                    $this->Auth->setUser($verify);
                    $up_arr = ['id' => $verify->id, 'last_activity' => DATE];
                    $user1 = $this->Users->newEntity($up_arr, ['validate' => false]);
                    $this->Users->save($user1);
                    return $this->redirect(SITEURL . "dashboard");
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
                            return $this->redirect(SITEURL . "dashboard");
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
}
