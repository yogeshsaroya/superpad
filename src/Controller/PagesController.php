<?php

declare(strict_types=1);

namespace App\Controller;

use Cake\Utility\Text;
use PhpParser\Node\Stmt\TryCatch;

class PagesController extends AppController
{

    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        // methods name we can pass here which we want to allow without login
        parent::beforeFilter($event);
        /* https://book.cakephp.org/4/en/controllers/components/authentication.html#AuthComponent::allow */
        $this->viewBuilder()->setLayout('backend');
        //$this->Auth->allow();
    }
    public function initialize(): void
    {
        parent::initialize();
        $this->loadComponent('Paginator');
    }


    public function index()
    {
        //$this->redirect('/pages/properties');
    }

    public function staticPages()
    {
        $this->set('menu_act', 'static_pages');
        if ($this->request->getQuery('del')  && !empty($this->request->getQuery('del'))) {
            $blog_del = $this->Pages->findById($this->request->getQuery('del'))->firstOrFail();
            if ($this->Pages->delete($blog_del)) {
            }
            $this->redirect('/pages/static_pages');
        }

        if ($this->request->getQuery('st')  && !empty($this->request->getQuery('st'))) {
            $getData = $this->Pages->findById($this->request->getQuery('st'))->firstOrFail();
            $upData = ['id' => $getData->id, 'status' => ($getData->status == 1 ? 2:1) ];
            $saveData = $this->Pages->newEntity($upData, ['validate' => false]);
            $this->Pages->save($saveData);
            $this->redirect('/pages/static_pages');
        }

        $this->paginate = ['limit' => 100, 'order' => ['id' => 'desc']];
        $data = $this->paginate($this->Pages->find('all'));
        $this->set(compact('data'));
    }

    public function editStaticPages($id = null)
    {
        $this->set('menu_act', 'static_pages');
        $post_data = null;

        if ($this->request->is('ajax') && !empty($this->request->getData())) {
            $file_name = null;
            $postData = $this->request->getData();
            if (isset($postData['title']) && !empty($postData['title'])) {
                $sluggedTitle = Text::slug($postData['title']);
                $url = strtolower(substr($sluggedTitle, 0, 191));
            }
            $postData['slug'] = $url;
            
            if (isset($postData['id']) && !empty($postData['id'])) {
                $getBlog = $this->Pages->get($postData['id']);
                $chkBlog = $this->Pages->patchEntity($getBlog, $postData, ['validate' => true]);
            } else {
                $getBlog = $this->Pages->newEmptyEntity();
                $chkBlog = $this->Pages->patchEntity($getBlog, $postData, ['validate' => true]);
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
                if ($this->Pages->save($chkBlog)) {
                    $u = SITEURL . "pages/static_pages";
                    echo '<div class="alert alert-success" role="alert">Saved.</div>';
                    echo "<script>window.location.href ='" . $u . "'; </script>";
                } else {
                    echo '<div class="alert alert-danger" role="alert"> Not saved.</div>';
                }
            }
            exit;
        }
        
        if ($this->request->is('get')) {
            if(!empty($id)) {
                $post_data = $this->Pages->findById($id)->firstOrFail();
            }
            $this->set(compact('post_data'));
        }
    }

    public function emailTemplates(){
        $this->set('menu_act', 'email_templates');

        if ($this->request->getQuery('st')  && !empty($this->request->getQuery('st'))) {
            $getData = $this->EmailTemplates->findById($this->request->getQuery('st'))->firstOrFail();
            $upData = ['id' => $getData->id, 'status' => ($getData->status == 1 ? 2:1) ];
            $saveData = $this->EmailTemplates->newEntity($upData, ['validate' => false]);
            $this->EmailTemplates->save($saveData);
            $this->redirect('/pages/email_templates');
        }

        $this->paginate = ['limit' => 100, 'order' => ['id' => 'desc']];
        $data = $this->paginate($this->EmailTemplates->find('all'));
        $this->set(compact('data'));
    }

    public function editEmailTemplates($id = null)
    {
        $this->set('menu_act', 'email_templates');
        $blog_data = null;

        if ($this->request->is('ajax') && !empty($this->request->getData())) {
            $file_name = null;
            $postData = $this->request->getData();
            
            if (isset($postData['id']) && !empty($postData['id'])) {
                $getData = $this->EmailTemplates->findById($postData['id'])->firstOrFail();;
                $chkData = $this->EmailTemplates->patchEntity($getData, $postData, ['validate' => true]);
            } else {
                $getData = $this->EmailTemplates->newEmptyEntity();
                $chkData = $this->EmailTemplates->patchEntity($getData, $postData, ['validate' => true]);
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
                if ($this->EmailTemplates->save($chkData)) {
                    $u = SITEURL . "pages/email_templates";
                    echo '<div class="alert alert-success" role="alert"> Blog post saved.</div>';
                    echo "<script>window.location.href ='" . $u . "'; </script>";
                } else {
                    echo '<div class="alert alert-danger" role="alert"> Not saved.</div>';
                }
            }
            exit;
        }

        if (!empty($id)) {
            $data = $this->EmailTemplates->findById($id)->firstOrFail();
        }
        $this->set(compact('data'));
    }

    public function consultants()
    {
        $this->set('menu_act', 'consultants');
        if ($this->request->getQuery('del')  && !empty($this->request->getQuery('del'))) {
            $blog_del = $this->Consultants->findById($this->request->getQuery('del'))->firstOrFail();
            if ($this->Consultants->delete($blog_del)) {
            }
            $this->redirect('/pages/consultants');
        }
        $this->paginate = ['limit' => 100, 'order' => ['id' => 'desc']];
        $data = $this->paginate($this->Consultants->find('all'));
        $this->set(compact('data'));
    }

    public function manageConsultant($id = null)
    {
        $this->set('menu_act', 'consultants');
        $blog_data = null;
        if ($this->request->is('ajax') && !empty($this->request->getData())) {
            $file_name = null;
            $postData = $this->request->getData();
            $uploadPath = 'cdn/consultant/';
            if (!file_exists($uploadPath)) {
                mkdir($uploadPath, 0777, true);
            }

            if (!empty($postData['img'])) {
                if (in_array($postData['img']->getClientMediaType(), ['image/x-png', 'image/png', 'image/jpeg'])) {
                    $fileobject = $postData['img'];
                    $file_name = $fileobject->getClientFilename();
                    $destination = $uploadPath . $file_name;
                    try {
                        $fileobject->moveTo($destination);
                    } catch (Exception $e) {
                        echo '<div class="alert alert-danger" role="alert">Image not uploaded.</div>';
                        exit;
                    }
                }
            }

            if (isset($postData['id']) && !empty($postData['id'])) {
                $getBlog = $this->Consultants->get($postData['id']);
                if (!empty($file_name)) {
                    $postData['image'] = $file_name;
                }
                $chkBlog = $this->Consultants->patchEntity($getBlog, $postData, ['validate' => true]);
            } else {
                $getBlog = $this->Consultants->newEmptyEntity();
                if (!empty($file_name)) {
                    $postData['image'] = $file_name;
                }
                $chkBlog = $this->Consultants->patchEntity($getBlog, $postData, ['validate' => true]);
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
                if ($this->Consultants->save($chkBlog)) {
                    $u = SITEURL . "pages/consultants";
                    echo '<div class="alert alert-success" role="alert"> Saved.</div>';
                    echo "<script>window.location.href ='" . $u . "'; </script>";
                } else {
                    echo '<div class="alert alert-danger" role="alert"> Not saved.</div>';
                }
            }
            exit;
        }

        if (!empty($id)) {
            $blog_data = $this->Consultants->findById($id)->firstOrFail();
        }
        $this->set(compact('blog_data'));
    }



    public function settings()
    {
        $this->set('menu_act', 'settings');
        $postData = $this->request->getData();
        $tbl_data = null;
        if ($this->request->is('ajax') && !empty($this->request->getData())) {
            if (isset($postData['id']) && !empty($postData['id'])) {
                $getBlog = $this->Settings->get($postData['id']);
                $chkBlog = $this->Settings->patchEntity($getBlog, $postData, ['validate' => true]);
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

                if ($this->Settings->save($chkBlog)) {
                    $u = SITEURL . "pages/settings";
                    echo '<div class="alert alert-success" role="alert"> Saved.</div>';
                    echo "<script>window.location.href ='" . $u . "'; </script>";
                } else {
                    echo '<div class="alert alert-danger" role="alert"> Not saved.</div>';
                }
            }
            exit;
        }
        $tbl_data = $this->Settings->findById('1')->firstOrFail();
        $this->set(compact('tbl_data'));
    }

    public function profileUpdate()
    {
        $this->set('menu_act', 'profile_update');
        $postData = $this->request->getData();
        $tbl_data = null;
        if ($this->request->is('ajax') && !empty($this->request->getData())) {
            $val = ['validate' => true];
            if (!empty($postData['password1'])) {
                $postData['password'] = $postData['password1'];
            }else{
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
                    $u = SITEURL . "pages/profile_update";
                    echo '<div class="alert alert-success" role="alert"> Saved.</div>';
                    echo "<script>window.location.href ='" . $u . "'; </script>";
                } else {
                    echo '<div class="alert alert-danger" role="alert"> Not saved.</div>';
                }
            }
            exit;
        }
        $tbl_data = $this->Users->findById('1')->firstOrFail();
        $this->set(compact('tbl_data'));
    }
}
