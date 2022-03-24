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
            $get_data = $this->Pages
                ->find()
                ->where(['slug' => $id, 'status' => 1])
                ->first();
        }
        $this->set(compact('get_data'));
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

    public function contactUs()
    {
    }

    public function explore($id = null)
    {
        if( !empty($id) ){
            $query = $this->Projects->find('all', [
                'contain' => ['Blockchains'],
                'conditions' => ['Projects.slug' => $id, 'Projects.status' => 1]]);
            $data =  $query->first();
            if(!empty($data)){
                $this->set(compact('data'));
                $this->render('project_details');
            }else{
                $this->viewBuilder()->setLayout('error_404');
            }
            
        }
    }
    public function projectDetails()
    {
    }

    public function ajFrm()
    {
        $this->autoRender = false;
        if ($this->request->is('ajax')) {
            //ec($this->request->getData());
            // Only process POST reqeusts.
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                // Get the form fields and remove whitespace.
                $name = strip_tags(trim($_POST["name"]));
                $name = str_replace(array("\r", "\n"), array(" ", " "), $name);
                $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
                $message = trim($_POST["message"]);

                // Check that data was sent to the mailer.
                if (empty($name) or empty($message) or !filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    // Set a 400 (bad request) response code and exit.
                    // http_response_code(400);
                    echo "Please complete the form and try again.";
                    exit;
                }

                // Set the recipient email address.
                // FIXME: Update this to your desired email address.
                $recipient = "kevinal.min@gmail.com";
                $recipient = "saroya.com@gmail.com";

                $email_headers = "From: Info <test@redmoontech.com>";
                // Set the email subject.
                $subject = "New contact from $name";

                // Build the email content.
                $email_content = "Name: $name\n";
                $email_content .= "Email: $email\n\n";
                $email_content .= "Subject: $subject\n\n";
                $email_content .= "Message:\n$message\n";

                // Build the email headers.


                // Send the email.
                if (mail($recipient, $subject, $email_content, $email_headers)) {
                    // Set a 200 (okay) response code.
                    //http_response_code(200);
                    echo "Thank You! Your message has been sent.";
                } else {
                    // Set a 500 (internal server error) response code.
                    //http_response_code(500);
                    echo "Oops! Something went wrong and we couldn't send your message.";
                }
            } else {
                // Not a POST request, set a 403 (forbidden) response code.
                //http_response_code(403);
                echo "There was a problem with your submission, please try again.";
            }
        }
        exit;
    }
}
