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
        if( $this->Auth->user('role') == 2 ){
            $this->redirect('/');
        }
        //$this->Auth->allow();
    }
    public function initialize(): void
    {
        parent::initialize();
        $this->loadComponent('Paginator');
    }


    public function index()
    {
        $this->redirect('/pages/users');
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
            $upData = ['id' => $getData->id, 'status' => ($getData->status == 1 ? 2 : 1)];
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
            /*
            if (isset($postData['title']) && !empty($postData['title'])) {
                $sluggedTitle = Text::slug($postData['title']);
                $url = strtolower(substr($sluggedTitle, 0, 191));
            }
            $postData['slug'] = $url;
            */

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
            if (!empty($id)) {
                $post_data = $this->Pages->findById($id)->firstOrFail();
            }
            $this->set(compact('post_data'));
        }
    }

    public function team()
    {
        $this->set('menu_act', 'team');
        if ($this->request->getQuery('del')  && !empty($this->request->getQuery('del'))) {
            $blog_del = $this->Teams->findById($this->request->getQuery('del'))->firstOrFail();
            if ($this->Teams->delete($blog_del)) {
            }
            $this->redirect('/pages/team');
        }

        if ($this->request->getQuery('st')  && !empty($this->request->getQuery('st'))) {
            $getData = $this->Teams->findById($this->request->getQuery('st'))->firstOrFail();
            $upData = ['id' => $getData->id, 'status' => ($getData->status == 1 ? 2 : 1)];
            $saveData = $this->Teams->newEntity($upData, ['validate' => false]);
            $this->Teams->save($saveData);
            $this->redirect('/pages/team');
        }

        $this->paginate = ['limit' => 100, 'order' => ['id' => 'desc']];
        $data = $this->paginate($this->Teams->find('all'));
        $this->set(compact('data'));
    }

    public function editTeam($id = null)
    {
        $this->set('menu_act', 'team');
        $post_data = null;

        if ($this->request->is('ajax') && !empty($this->request->getData())) {
            $file_name = null;
            $postData = $this->request->getData();
            $uploadPath = 'cdn/team/';
            if (!file_exists($uploadPath)) {
                mkdir($uploadPath, 0777, true);
            }
            /* For logo */

            if (!empty($postData['hero_img'])) {
                if (in_array($postData['hero_img']->getClientMediaType(), ['image/x-png', 'image/png', 'image/jpeg', 'image/svg+xml'])) {
                    $fileobject = $postData['hero_img'];
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
                $getBlog = $this->Teams->get($postData['id']);
                if (!empty($file_name)) {
                    $getBlog['img'] = $file_name;
                }
                $chkBlog = $this->Teams->patchEntity($getBlog, $postData, ['validate' => true]);
            } else {
                $getBlog = $this->Teams->newEmptyEntity();
                if (!empty($file_name)) {
                    $getBlog['img'] = $file_name;
                }
                $chkBlog = $this->Teams->patchEntity($getBlog, $postData, ['validate' => true]);
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
                if ($this->Teams->save($chkBlog)) {
                    $u = SITEURL . "pages/team";
                    echo '<div class="alert alert-success" role="alert">Saved.</div>';
                    echo "<script>window.location.href ='" . $u . "'; </script>";
                } else {
                    echo '<div class="alert alert-danger" role="alert"> Not saved.</div>';
                }
            }
            exit;
        }

        if ($this->request->is('get')) {
            if (!empty($id)) {
                $post_data = $this->Teams->findById($id)->firstOrFail();
            }
            $this->set(compact('post_data'));
        }
    }

    public function emailTemplates()
    {
        $this->set('menu_act', 'email_templates');

        if ($this->request->getQuery('st')  && !empty($this->request->getQuery('st'))) {
            $getData = $this->EmailTemplates->findById($this->request->getQuery('st'))->firstOrFail();
            $upData = ['id' => $getData->id, 'status' => ($getData->status == 1 ? 2 : 1)];
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

    public function blockchain()
    {
        $menu_act = 'blockchain';
        $pro_menu = 'top_menu';
        $this->set(compact('menu_act', 'pro_menu'));
        if ($this->request->getQuery('del')  && !empty($this->request->getQuery('del'))) {
            $blog_del = $this->Blockchains->findById($this->request->getQuery('del'))->firstOrFail();
            if ($this->Blockchains->delete($blog_del)) {
            }
            $this->redirect('/pages/blockchain');
        }
        if ($this->request->getQuery('st')  && !empty($this->request->getQuery('st'))) {
            $getData = $this->Blockchains->findById($this->request->getQuery('st'))->firstOrFail();
            $upData = ['id' => $getData->id, 'status' => ($getData->status == 1 ? 2 : 1)];
            $saveData = $this->Blockchains->newEntity($upData, ['validate' => false]);
            $this->Blockchains->save($saveData);
            $this->redirect('/pages/blockchain');
        }

        $this->paginate = ['limit' => 100, 'order' => ['id' => 'desc']];
        $data = $this->paginate($this->Blockchains->find('all'));
        $this->set(compact('data'));
    }

    public function manageBlockchain($id = null)
    {
        $menu_act = 'blockchain';
        $pro_menu = 'top_menu';
        $this->set(compact('menu_act', 'pro_menu'));
        $get_data = null;
        if ($this->request->is('ajax') && !empty($this->request->getData())) {
            $file_name = $file_name_img = null;
            $postData = $this->request->getData();
            $uploadPath = 'cdn/blockchains/';
            $uploadImg = 'cdn/blockchains_img/';
            if (!file_exists($uploadPath)) {
                mkdir($uploadPath, 0777, true);
            }
            if (!file_exists($uploadImg)) {
                mkdir($uploadImg, 0777, true);
            }
            /*For hero image*/
            if (!empty($postData['hero_img'])) {
                if (in_array($postData['hero_img']->getClientMediaType(), ['image/x-png', 'image/png', 'image/jpeg', 'image/svg+xml'])) {
                    $fileobject1 = $postData['hero_img'];
                    $file_name_img = $fileobject1->getClientFilename();
                    $destination1 = $uploadImg . $file_name_img;
                    try {
                        $fileobject1->moveTo($destination1);
                    } catch (Exception $e) {
                        echo '<div class="alert alert-danger" role="alert">Image not uploaded.</div>';
                        exit;
                    }
                }
            }

            /* For logo */
            if (!empty($postData['logo_img'])) {
                if (in_array($postData['logo_img']->getClientMediaType(), ['image/x-png', 'image/png', 'image/jpeg', 'image/svg+xml'])) {
                    $fileobject = $postData['logo_img'];
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
                $getData = $this->Blockchains->get($postData['id']);
                if (!empty($file_name)) {
                    $postData['logo'] = $file_name;
                }
                if (!empty($file_name_img)) {
                    $postData['img'] = $file_name_img;
                }
                $chkData = $this->Blockchains->patchEntity($getData, $postData, ['validate' => true]);
            } else {
                $getData = $this->Blockchains->newEmptyEntity();
                if (!empty($file_name)) {
                    $postData['logo'] = $file_name;
                }
                if (!empty($file_name_img)) {
                    $postData['img'] = $file_name_img;
                }
                $chkData = $this->Blockchains->patchEntity($getData, $postData, ['validate' => true]);
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
                if ($this->Blockchains->save($chkData)) {
                    $u = SITEURL . "pages/blockchain";
                    echo '<div class="alert alert-success" role="alert"> Saved.</div>';
                    echo "<script>window.location.href ='" . $u . "'; </script>";
                } else {
                    echo '<div class="alert alert-danger" role="alert"> Not saved.</div>';
                }
            }
            exit;
        }

        if (!empty($id)) {
            $get_data = $this->Blockchains->findById($id)->firstOrFail();
        }
        $this->set(compact('get_data'));
    }

    public function partners()
    {
        $menu_act = 'partners';
        $pro_menu = 'top_menu';
        $this->set(compact('menu_act', 'pro_menu'));
        if ($this->request->getQuery('del')  && !empty($this->request->getQuery('del'))) {
            $blog_del = $this->Partners->findById($this->request->getQuery('del'))->firstOrFail();
            if ($this->Partners->delete($blog_del)) {
            }
            $this->redirect('/pages/partners');
        }
        if ($this->request->getQuery('st')  && !empty($this->request->getQuery('st'))) {
            $getData = $this->Partners->findById($this->request->getQuery('st'))->firstOrFail();
            $upData = ['id' => $getData->id, 'status' => ($getData->status == 1 ? 2 : 1)];
            $saveData = $this->Partners->newEntity($upData, ['validate' => false]);
            $this->Partners->save($saveData);
            $this->redirect('/pages/partners');
        }

        $this->paginate = ['limit' => 100, 'order' => ['id' => 'desc']];
        $data = $this->paginate($this->Partners->find('all'));
        $this->set(compact('data'));
    }

    public function managePartners($id = null)
    {
        $menu_act = 'partners';
        $pro_menu = 'top_menu';
        $this->set(compact('menu_act', 'pro_menu'));
        $get_data = null;
        if ($this->request->is('ajax') && !empty($this->request->getData())) {
            $file_name = $file_name_img = null;
            $postData = $this->request->getData();
            $uploadPath = 'cdn/partners/';
            if (!file_exists($uploadPath)) {
                mkdir($uploadPath, 0777, true);
            }
            /* For logo */

            if (!empty($postData['hero_img'])) {
                if (in_array($postData['hero_img']->getClientMediaType(), ['image/x-png', 'image/png', 'image/jpeg', 'image/svg+xml'])) {
                    $fileobject = $postData['hero_img'];
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
                $getData = $this->Partners->get($postData['id']);
                if (!empty($file_name)) {
                    $postData['logo'] = $file_name;
                }
                $chkData = $this->Partners->patchEntity($getData, $postData, ['validate' => true]);
            } else {
                $getData = $this->Partners->newEmptyEntity();
                if (!empty($file_name)) {
                    $postData['logo'] = $file_name;
                }

                $chkData = $this->Partners->patchEntity($getData, $postData, ['validate' => true]);
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
                if ($this->Partners->save($chkData)) {
                    $u = SITEURL . "pages/partners";
                    echo '<div class="alert alert-success" role="alert"> Saved.</div>';
                    echo "<script>window.location.href ='" . $u . "'; </script>";
                } else {
                    echo '<div class="alert alert-danger" role="alert"> Not saved.</div>';
                }
            }
            exit;
        }

        if (!empty($id)) {
            $get_data = $this->Partners->findById($id)->firstOrFail();
        }
        $this->set(compact('get_data'));
    }

    public function roadmap()
    {
        $menu_act = 'roadmap';
        $pro_menu = 'top_menu';
        $this->set(compact('menu_act', 'pro_menu'));
        if ($this->request->getQuery('del')  && !empty($this->request->getQuery('del'))) {
            $blog_del = $this->Roadmaps->findById($this->request->getQuery('del'))->firstOrFail();
            if ($this->Roadmaps->delete($blog_del)) {
            }
            $this->redirect('/pages/roadmap');
        }
        if ($this->request->getQuery('st')  && !empty($this->request->getQuery('st'))) {
            $getData = $this->Roadmaps->findById($this->request->getQuery('st'))->firstOrFail();
            $upData = ['id' => $getData->id, 'status' => ($getData->status == 1 ? 2 : 1)];
            $saveData = $this->Roadmaps->newEntity($upData, ['validate' => false]);
            $this->Roadmaps->save($saveData);
            $this->redirect('/pages/roadmap');
        }

        $this->paginate = ['limit' => 100, 'order' => ['id' => 'desc']];
        $data = $this->paginate($this->Roadmaps->find('all'));
        $this->set(compact('data'));
    }

    public function manageRoadmap($id = null)
    {
        $menu_act = 'roadmap';
        $pro_menu = 'top_menu';
        $this->set(compact('menu_act', 'pro_menu'));
        $get_data = null;
        if ($this->request->is('ajax') && !empty($this->request->getData())) {
            $file_name = $file_name_img = null;
            $postData = $this->request->getData();

            if (isset($postData['id']) && !empty($postData['id'])) {
                $getData = $this->Roadmaps->get($postData['id']);
                if (!empty($file_name)) {
                    $postData['logo'] = $file_name;
                }
                $chkData = $this->Roadmaps->patchEntity($getData, $postData, ['validate' => true]);
            } else {
                $getData = $this->Roadmaps->newEmptyEntity();
                if (!empty($file_name)) {
                    $postData['logo'] = $file_name;
                }

                $chkData = $this->Roadmaps->patchEntity($getData, $postData, ['validate' => true]);
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
                if ($this->Roadmaps->save($chkData)) {
                    $u = SITEURL . "pages/roadmap";
                    echo '<div class="alert alert-success" role="alert"> Saved.</div>';
                    echo "<script>window.location.href ='" . $u . "'; </script>";
                } else {
                    echo '<div class="alert alert-danger" role="alert"> Not saved.</div>';
                }
            }
            exit;
        }

        if (!empty($id)) {
            $get_data = $this->Roadmaps->findById($id)->firstOrFail();
        }
        $this->set(compact('get_data'));
    }


    public function projects()
    {
        $menu_act = 'projects';
        $pro_menu = 'top_menu';
        $this->set(compact('menu_act', 'pro_menu'));
        if ($this->request->getQuery('del')  && !empty($this->request->getQuery('del'))) {
            $blog_del = $this->Projects->findById($this->request->getQuery('del'))->firstOrFail();
            if ($this->Projects->delete($blog_del)) {
            }
            $this->redirect('/pages/projects');
        }
        if ($this->request->getQuery('st')  && !empty($this->request->getQuery('st'))) {
            $getData = $this->Projects->findById($this->request->getQuery('st'))->firstOrFail();
            $upData = ['id' => $getData->id, 'status' => ($getData->status == 1 ? 2 : 1)];
            $saveData = $this->Projects->newEntity($upData, ['validate' => false]);
            $this->Projects->save($saveData);
            $this->redirect('/pages/projects');
        }
        if ($this->request->getQuery('featured')  && !empty($this->request->getQuery('featured'))) {
            $getData = $this->Projects->findById($this->request->getQuery('featured'))->firstOrFail();

            $this->Projects->updateAll(['is_featured' => null], ['is_featured' => 1]);

            $upData = ['id' => $getData->id, 'is_featured' => 1];
            $saveData = $this->Projects->newEntity($upData, ['validate' => false]);
            $this->Projects->save($saveData);
            $this->redirect('/pages/projects');
        }


        $this->paginate = ['contain' => ['Blockchains'], 'limit' => 100, 'order' => ['id' => 'desc']];
        $data = $this->paginate($this->Projects->find('all'));
        $this->set(compact('data'));
    }

    public function manageProject($id = null)
    {
        $menu_act = 'projects';
        $pro_menu = 'top_menu';
        $this->set(compact('menu_act', 'pro_menu'));
        $get_data = null;
        if ($this->request->is('ajax') && !empty($this->request->getData())) {
            $file_name = $file_name_img = null;
            $postData = $this->request->getData();
            $uploadPath = 'cdn/project_logo/';
            $uploadImg = 'cdn/project_img/';
            $uploadBanner = 'cdn/project_banner/';
            if (!file_exists($uploadPath)) {
                mkdir($uploadPath, 0777, true);
            }
            if (!file_exists($uploadImg)) {
                mkdir($uploadImg, 0777, true);
            }
            if (!file_exists($uploadBanner)) {
                mkdir($uploadBanner, 0777, true);
            }

            /*For hero image*/
            if (!empty($postData['banner_img'])) {
                if (in_array($postData['banner_img']->getClientMediaType(), ['image/x-png', 'image/png', 'image/jpeg', 'image/svg+xml'])) {
                    $fileobject2 = $postData['banner_img'];
                    $file_banner_img = $fileobject2->getClientFilename();
                    $destination2 = $uploadBanner . $file_banner_img;
                    try {
                        $fileobject2->moveTo($destination2);
                    } catch (Exception $e) {
                        echo '<div class="alert alert-danger" role="alert">Image not uploaded.</div>';
                        exit;
                    }
                }
            }

            /*For hero image*/
            if (!empty($postData['hero_img'])) {
                if (in_array($postData['hero_img']->getClientMediaType(), ['image/x-png', 'image/png', 'image/jpeg', 'image/svg+xml'])) {
                    $fileobject1 = $postData['hero_img'];
                    $file_name_img = $fileobject1->getClientFilename();
                    $destination1 = $uploadImg . $file_name_img;
                    try {
                        $fileobject1->moveTo($destination1);
                    } catch (Exception $e) {
                        echo '<div class="alert alert-danger" role="alert">Image not uploaded.</div>';
                        exit;
                    }
                }
            }

            /* For logo */
            if (!empty($postData['logo_img'])) {
                if (in_array($postData['logo_img']->getClientMediaType(), ['image/x-png', 'image/png', 'image/jpeg', 'image/svg+xml'])) {
                    $fileobject = $postData['logo_img'];
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
                $getData = $this->Projects->get($postData['id']);
                if (!empty($file_name)) {
                    $postData['logo'] = $file_name;
                }
                if (!empty($file_name_img)) {
                    $postData['hero_image'] = $file_name_img;
                }
                if (!empty($file_banner_img)) {
                    $postData['banner'] = $file_banner_img;
                }

                $chkData = $this->Projects->patchEntity($getData, $postData, ['validate' => true]);
            } else {
                $getData = $this->Projects->newEmptyEntity();
                if (!empty($file_name)) {
                    $postData['logo'] = $file_name;
                }
                if (!empty($file_name_img)) {
                    $postData['hero_image'] = $file_name_img;
                }
                if (!empty($file_banner_img)) {
                    $postData['banner'] = $file_banner_img;
                }
                $chkData = $this->Projects->patchEntity($getData, $postData, ['validate' => true]);
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
                if ($this->Projects->save($chkData)) {
                    $u = SITEURL . "pages/projects";
                    echo '<div class="alert alert-success" role="alert"> Saved.</div>';
                    echo "<script>window.location.href ='" . $u . "'; </script>";
                } else {
                    echo '<div class="alert alert-danger" role="alert"> Not saved.</div>';
                }
            }
            exit;
        }

        if (!empty($id)) {
            $get_data = $this->Projects->findById($id)->firstOrFail();
        }
        $this->set(compact('get_data'));
    }


    public function features()
    {
        $menu_act = 'features';
        $pro_menu = 'top_menu';
        $this->set(compact('menu_act', 'pro_menu'));
        if ($this->request->getQuery('del')  && !empty($this->request->getQuery('del'))) {
            $blog_del = $this->Features->findById($this->request->getQuery('del'))->firstOrFail();
            if ($this->Features->delete($blog_del)) {
            }
            $this->redirect('/pages/features');
        }
        if ($this->request->getQuery('st')  && !empty($this->request->getQuery('st'))) {
            $getData = $this->Features->findById($this->request->getQuery('st'))->firstOrFail();
            $upData = ['id' => $getData->id, 'status' => ($getData->status == 1 ? 2 : 1)];
            $saveData = $this->Features->newEntity($upData, ['validate' => false]);
            $this->Features->save($saveData);
            $this->redirect('/pages/features');
        }

        $this->paginate = ['limit' => 100, 'order' => ['id' => 'desc']];
        $data = $this->paginate($this->Features->find('all'));
        $this->set(compact('data'));
    }

    public function manageFeature($id = null)
    {
        $menu_act = 'features';
        $pro_menu = 'top_menu';
        $this->set(compact('menu_act', 'pro_menu'));
        $get_data = null;
        if ($this->request->is('ajax') && !empty($this->request->getData())) {
            $file_name = $file_name_img = null;
            $postData = $this->request->getData();
            $uploadPath = 'cdn/features/';
            if (!file_exists($uploadPath)) {
                mkdir($uploadPath, 0777, true);
            }
            /* For logo */

            if (!empty($postData['hero_img'])) {
                if (in_array($postData['hero_img']->getClientMediaType(), ['image/x-png', 'image/png', 'image/jpeg', 'image/svg+xml'])) {
                    $fileobject = $postData['hero_img'];
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
                $getData = $this->Features->get($postData['id']);
                if (!empty($file_name)) {
                    $postData['icon'] = $file_name;
                }
                $chkData = $this->Features->patchEntity($getData, $postData, ['validate' => true]);
            } else {
                $getData = $this->Features->newEmptyEntity();
                if (!empty($file_name)) {
                    $postData['icon'] = $file_name;
                }

                $chkData = $this->Features->patchEntity($getData, $postData, ['validate' => true]);
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
                if ($this->Features->save($chkData)) {
                    $u = SITEURL . "pages/features";
                    echo '<div class="alert alert-success" role="alert"> Saved.</div>';
                    echo "<script>window.location.href ='" . $u . "'; </script>";
                } else {
                    echo '<div class="alert alert-danger" role="alert"> Not saved.</div>';
                }
            }
            exit;
        }

        if (!empty($id)) {
            $get_data = $this->Features->findById($id)->firstOrFail();
        }
        $this->set(compact('get_data'));
    }

    public function users()
    {
        $menu_act = 'users';
        $this->set(compact('menu_act'));
        if ($this->request->getQuery('del')  && !empty($this->request->getQuery('del'))) {
            $blog_del = $this->Users->findById($this->request->getQuery('del'))->firstOrFail();
            if ($this->Users->delete($blog_del)) {
            }
            $this->redirect('/pages/users');
        }
        if ($this->request->getQuery('st')  && !empty($this->request->getQuery('st'))) {
            $getData = $this->Users->findById($this->request->getQuery('st'))->firstOrFail();
            $upData = ['id' => $getData->id, 'status' => ($getData->status == 1 ? 2 : 1)];
            $saveData = $this->Users->newEntity($upData, ['validate' => false]);
            $this->Users->save($saveData);
            $this->redirect('/pages/users');
        }

        $this->paginate = ['limit' => 100, 'conditions' => ['Users.role' => 2], 'order' => ['id' => 'desc']];
        $data = $this->paginate($this->Users->find('all'));
        $this->set(compact('data'));
    }

    public function manageUser($id = null)
    {
        $menu_act = 'users';
        $this->set(compact('menu_act'));
        $get_data = null;
        if ($this->request->is('ajax') && !empty($this->request->getData())) {
            $postData = $this->request->getData();
            $val = ['validate' => true];
            if (!empty($postData['password1'])) {
                $postData['password'] = $postData['password1'];
            } else {
                $val = ['validate' => 'OnlyCheck'];
            }

            if (isset($postData['id']) && !empty($postData['id'])) {
                $getData = $this->Users->get($postData['id']);
                $chkData = $this->Users->patchEntity($getData, $postData, $val);
            } else {
                $getData = $this->Users->newEmptyEntity();
                $chkData = $this->Users->patchEntity($getData, $postData, $val);
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
                if ($this->Users->save($chkData)) {
                    $u = SITEURL . "pages/users";
                    echo '<div class="alert alert-success" role="alert"> Saved.</div>';
                    echo "<script>window.location.href ='" . $u . "'; </script>";
                } else {
                    echo '<div class="alert alert-danger" role="alert"> Not saved.</div>';
                }
            }
            exit;
        }

        if (!empty($id)) {
            $get_data = $this->Users->findById($id)->firstOrFail();
        }
        $this->set(compact('get_data'));
    }

    public function newsletter()
    {

        if ($this->request->is('ajax') && !empty($this->request->getData())) {
            $postData = $this->request->getData();
            if(!empty($postData['subject']) && !empty($postData['message'])){
                $query = $this->Newsletters->find('list', ['keyField' => 'email', 'valueField' => 'name'])->order(['Newsletters.name' => 'ASC']);
                $data = $query->all()->toArray();
                if(!empty($data)){
                    foreach($data as $em=>$name){
                        $this->Data->AppMail($em,7, ['NAME'=>$name,'SUBJECT'=>$postData['subject'],'BODY'=>$postData['message']]);
                    }
                    echo "<script>$('#e_frm')[0].reset();</script>";
                    echo "<div class='alert alert-success'>Newsletter sent.</div>";
                }else{ echo "<div class='alert alert-danger'>Subscribers not found</div>"; }
            }else{ echo "<div class='alert alert-danger'>Please add email subject and message.</div>"; }
            exit;
        }
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
