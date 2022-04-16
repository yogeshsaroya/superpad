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
        if ($this->Auth->user('role') == 2) {
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
        $paging = $this->request->getAttribute('paging');
        $this->set(compact('data', 'paging'));
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

        $this->paginate = ['limit' => 100, 'conditions' => ['Teams.type' => 1], 'order' => ['Teams.position' => 'ASC']];
        $data = $this->paginate($this->Teams->find('all'));
        $paging = $this->request->getAttribute('paging');
        $this->set(compact('data', 'paging'));
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
                } else {
                    echo '<div class="alert alert-danger" role="alert">Please upload only png and jpg image.</div>';
                    exit;
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
        $menu_act = 'email_templates';
        $sub_menu = 'top_menu';
        $this->set(compact('menu_act', 'sub_menu'));

        if ($this->request->getQuery('st')  && !empty($this->request->getQuery('st'))) {
            $getData = $this->EmailTemplates->findById($this->request->getQuery('st'))->firstOrFail();
            $upData = ['id' => $getData->id, 'status' => ($getData->status == 1 ? 2 : 1)];
            $saveData = $this->EmailTemplates->newEntity($upData, ['validate' => false]);
            $this->EmailTemplates->save($saveData);
            $this->redirect('/pages/email_templates');
        }

        $this->paginate = ['limit' => 100, 'order' => ['id' => 'desc']];
        $data = $this->paginate($this->EmailTemplates->find('all'));
        $paging = $this->request->getAttribute('paging');
        $this->set(compact('data', 'paging'));
    }

    public function editEmailTemplates($id = null)
    {
        $menu_act = 'email_templates';
        $sub_menu = 'top_menu';
        $this->set(compact('menu_act', 'sub_menu'));
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

    public function readEmail($id = null)
    {
        $getData = null;
        if ($this->request->is('ajax')) {
            if (!empty($id)) {
                $getData = $this->EmailServers->findById($id)->first();
            }
            $this->set(compact('getData'));
        }
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
        $paging = $this->request->getAttribute('paging');
        $this->set(compact('data', 'paging'));
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
        $this->set(compact('menu_act'));
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

        $this->paginate = ['limit' => 100, 'conditions' => ['Partners.type' => 1], 'order' => ['id' => 'desc']];
        $data = $this->paginate($this->Partners->find('all'));
        $paging = $this->request->getAttribute('paging');
        $this->set(compact('data', 'paging'));
    }


    public function managePartners($id = null)
    {
        $menu_act = 'partners';
        $this->set(compact('menu_act'));
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

    public function influencers()
    {
        $menu_act = 'influencers';
        $this->set(compact('menu_act'));
        if ($this->request->getQuery('del')  && !empty($this->request->getQuery('del'))) {
            $blog_del = $this->Influencers->findById($this->request->getQuery('del'))->firstOrFail();
            if ($this->Influencers->delete($blog_del)) {
            }
            $this->redirect('/pages/influencers');
        }
        if ($this->request->getQuery('st')  && !empty($this->request->getQuery('st'))) {
            $getData = $this->Influencers->findById($this->request->getQuery('st'))->firstOrFail();
            $upData = ['id' => $getData->id, 'status' => ($getData->status == 1 ? 2 : 1)];
            $saveData = $this->Influencers->newEntity($upData, ['validate' => false]);
            $this->Influencers->save($saveData);
            $this->redirect('/pages/influencers');
        }

        $this->paginate = ['limit' => 100, 'conditions' => [], 'order' => ['id' => 'desc']];
        $data = $this->paginate($this->Influencers->find('all'));
        $paging = $this->request->getAttribute('paging');
        $this->set(compact('data', 'paging'));
    }


    public function manageInfluencers($id = null)
    {
        $menu_act = 'influencers';
        $this->set(compact('menu_act'));
        $get_data = null;
        if ($this->request->is('ajax') && !empty($this->request->getData())) {
            $file_name = $file_name_img = null;
            $postData = $this->request->getData();
            $uploadPath = 'cdn/influencers/';
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
                } else {
                    echo '<div class="alert alert-danger" role="alert">Please upload only PNG and JPG file</div>';
                    exit;
                }
            }

            if (isset($postData['id']) && !empty($postData['id'])) {
                $getData = $this->Influencers->get($postData['id']);
                if (!empty($file_name)) {
                    $postData['logo'] = $file_name;
                }
                $chkData = $this->Influencers->patchEntity($getData, $postData, ['validate' => true]);
            } else {
                $getData = $this->Influencers->newEmptyEntity();
                if (!empty($file_name)) {
                    $postData['logo'] = $file_name;
                }

                $chkData = $this->Influencers->patchEntity($getData, $postData, ['validate' => true]);
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
                if ($this->Influencers->save($chkData)) {
                    $u = SITEURL . "pages/influencers";
                    echo '<div class="alert alert-success" role="alert"> Saved.</div>';
                    echo "<script>window.location.href ='" . $u . "'; </script>";
                } else {
                    echo '<div class="alert alert-danger" role="alert"> Not saved.</div>';
                }
            }
            exit;
        }

        if (!empty($id)) {
            $get_data = $this->Influencers->findById($id)->firstOrFail();
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
        $paging = $this->request->getAttribute('paging');
        $this->set(compact('data', 'paging'));
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
            $getData = $this->Projects->findById($this->request->getQuery('featured'))->first();
            if (!empty($getData)) {
                $this->Projects->updateAll(['is_featured' => null], ['is_featured' => 1]);
                if ($getData->is_featured != 1) {
                    $upData = ['id' => $getData->id, 'is_featured' => 1];
                    $saveData = $this->Projects->newEntity($upData, ['validate' => false]);
                    $this->Projects->save($saveData);
                }
            }
            $this->redirect('/pages/projects');
        }

        $this->paginate = ['contain' => ['Blockchains'], 'limit' => 100, 'order' => ['id' => 'desc']];
        $data = $this->paginate($this->Projects->find('all'));
        $paging = $this->request->getAttribute('paging');
        $this->set(compact('data', 'paging'));
    }

    public function manageProject($id = null)
    {
        $menu_act = 'projects';
        $pro_menu = 'top_menu';
        $this->set(compact('menu_act', 'pro_menu'));
        $get_data = null;
        $get = $this->request->getQuery();

        if (isset($get['type']) && $get['type'] == 'team') {
            $url = SITEURL . "pages/manage_project/$id?type=team";
            if (isset($get['del'])  && !empty($get['del'])) {
                $blog_del = $this->Teams->findById($get['del'])->firstOrFail();
                if ($this->Teams->delete($blog_del)) {
                }
                $this->redirect($url);
            }

            if (isset($get['st']) && !empty($get['st'])) {
                $getData = $this->Teams->findById($get['st'])->firstOrFail();
                $upData = ['id' => $getData->id, 'status' => ($getData->status == 1 ? 2 : 1)];
                $saveData = $this->Teams->newEntity($upData, ['validate' => false]);
                $this->Teams->save($saveData);
                $this->redirect($url);
            }
        }
        if (isset($get['type']) && $get['type'] == 'partner') {
            $url = SITEURL . "pages/manage_project/$id?type=partner";
            if (isset($get['del'])  && !empty($get['del'])) {
                $blog_del = $this->Partners->findById($get['del'])->firstOrFail();
                if ($this->Partners->delete($blog_del)) {
                }
                $this->redirect($url);
            }

            if (isset($get['st']) && !empty($get['st'])) {
                $getData = $this->Partners->findById($get['st'])->firstOrFail();
                $upData = ['id' => $getData->id, 'status' => ($getData->status == 1 ? 2 : 1)];
                $saveData = $this->Partners->newEntity($upData, ['validate' => false]);
                $this->Partners->save($saveData);
                $this->redirect($url);
            }
        }
        if (isset($get['type']) && $get['type'] == 'media') {
            $url = SITEURL . "pages/manage_project/$id?type=media";
            if (isset($get['del'])  && !empty($get['del'])) {
                $blog_del = $this->SmAccounts->findById($get['del'])->firstOrFail();
                if ($this->SmAccounts->delete($blog_del)) {
                }
                $this->redirect($url);
            }

            if (isset($get['st']) && !empty($get['st'])) {
                $getData = $this->SmAccounts->findById($get['st'])->firstOrFail();
                $upData = ['id' => $getData->id, 'featured' => ($getData->featured == 1 ? 2 : 1)];
                $saveData = $this->SmAccounts->newEntity($upData, ['validate' => false]);
                $this->SmAccounts->save($saveData);
                $this->redirect($url);
            }
        }

        if ($this->request->is('ajax') && !empty($this->request->getData())) {
            $file_name = $file_name_img = null;
            $postData = $this->request->getData();

            if (!empty($postData['start_date']) && !empty($postData['end_date'])) {
                if (strtotime($postData['start_date']) > strtotime($postData['end_date'])) {
                    echo '<div class="alert alert-danger">Sale START DATE/TIME should be smaller to sale END DATE/TIME.</div>';
                    exit;
                } elseif (strtotime($postData['end_date']) < strtotime($postData['start_date'])) {
                    echo '<div class="alert alert-danger">END DATE/TIME should be greater than START DATE/TIME.</div>';
                    exit;
                }
            }


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
        $tab = 'home';
        if (!empty($id)) {
            $get_data = $this->Projects->findById($id)->firstOrFail();
            if ($this->request->getQuery('type')  && !empty($this->request->getQuery('type'))) {
                $tab = $this->request->getQuery('type');
                if ($tab == 'team') {
                    $this->paginate = ['limit' => 100, 'conditions' => ['Teams.type' => 2, 'Teams.project_id' => $id], 'order' => ['id' => 'desc']];
                    $data = $this->paginate($this->Teams->find('all'));
                    $paging = $this->request->getAttribute('paging');
                    $this->set(compact('data', 'paging'));
                } elseif ($tab == 'partner') {
                    $this->paginate = ['limit' => 100, 'conditions' => ['Partners.type' => 2, 'Partners.project_id' => $id], 'order' => ['id' => 'desc']];
                    $data = $this->paginate($this->Partners->find('all'));
                    $paging = $this->request->getAttribute('paging');
                    $this->set(compact('data', 'paging'));
                } elseif ($tab == 'media') {
                    $this->paginate = ['limit' => 100, 'conditions' => ['SmAccounts.project_id' => $id], 'order' => ['id' => 'desc']];
                    $data = $this->paginate($this->SmAccounts->find('all'));
                    $paging = $this->request->getAttribute('paging');
                    $this->set(compact('data', 'paging'));
                } elseif ($tab == 'applications') {
                    $this->paginate = [
                        'contain' => ['Users' => ['Countries']],
                        'limit' => 100, 'conditions' => ['Applications.project_id' => $id], 'order' => ['id' => 'desc']
                    ];
                    $data = $this->paginate($this->Applications->find('all'))->toArray();
                    $paging = $this->request->getAttribute('paging');
                    $this->set(compact('data', 'paging'));
                }
            }
        }
        $this->set(compact('get_data', 'tab'));
    }

    public function addTeam()
    {
        $post_data = null;
        if ($this->request->is('ajax')) {

            if (!empty($this->request->getData())) {
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
                    } else {
                        echo '<div class="alert alert-danger" role="alert">Please upload only PNG and JPG file</div>';
                        exit;
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
                        echo "<script>$('#save_frm').remove();</script>";
                        echo "<div class='alert alert-success'>Saved</div>";
                        echo "<script> setTimeout(function(){ location.reload(); }, 2000);</script>";
                    } else {
                        echo '<div class="alert alert-danger" role="alert"> Not saved.</div>';
                    }
                }
                exit;
            } else {

                $pro_id = $this->request->getQuery('pro_id');
                $team_id = $this->request->getQuery('team_id');
                if (!empty($team_id)) {
                    $post_data = $this->Teams->findById($team_id)->firstOrFail();
                }
                $this->set(compact('post_data', 'pro_id', 'team_id'));
            }
        }
    }

    public function addPartner()
    {
        $post_data = null;
        if ($this->request->is('ajax')) {

            if (!empty($this->request->getData())) {
                $file_name = null;
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
                    } else {
                        echo '<div class="alert alert-danger" role="alert">Please upload only PNG and JPG file</div>';
                        exit;
                    }
                }

                if (isset($postData['id']) && !empty($postData['id'])) {
                    $getBlog = $this->Partners->get($postData['id']);
                    if (!empty($file_name)) {
                        $getBlog['logo'] = $file_name;
                    }
                    $chkBlog = $this->Partners->patchEntity($getBlog, $postData, ['validate' => true]);
                } else {
                    $getBlog = $this->Partners->newEmptyEntity();
                    if (!empty($file_name)) {
                        $getBlog['logo'] = $file_name;
                    }
                    $chkBlog = $this->Partners->patchEntity($getBlog, $postData, ['validate' => true]);
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
                    if ($this->Partners->save($chkBlog)) {
                        echo "<script>$('#save_frm').remove();</script>";
                        echo "<div class='alert alert-success'>Saved</div>";
                        echo "<script> setTimeout(function(){ location.reload(); }, 2000);</script>";
                    } else {
                        echo '<div class="alert alert-danger" role="alert"> Not saved.</div>';
                    }
                }
                exit;
            } else {

                $pro_id = $this->request->getQuery('pro_id');
                $row_id = $this->request->getQuery('partner_id');
                if (!empty($row_id)) {
                    $post_data = $this->Partners->findById($row_id)->firstOrFail();
                }
                $this->set(compact('post_data', 'pro_id', 'row_id'));
            }
        }
    }

    public function addSmAccount()
    {
        $post_data = null;
        if ($this->request->is('ajax')) {

            if (!empty($this->request->getData())) {
                $file_name = null;
                $postData = $this->request->getData();

                if (isset($postData['id']) && !empty($postData['id'])) {
                    $getBlog = $this->SmAccounts->get($postData['id']);
                    $chkBlog = $this->SmAccounts->patchEntity($getBlog, $postData, ['validate' => true]);
                } else {
                    $getBlog = $this->SmAccounts->newEmptyEntity();
                    $chkBlog = $this->SmAccounts->patchEntity($getBlog, $postData, ['validate' => true]);
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
                    if ($this->SmAccounts->save($chkBlog)) {
                        echo "<script>$('#save_frm').remove();</script>";
                        echo "<div class='alert alert-success'>Saved</div>";
                        echo "<script> setTimeout(function(){ location.reload(); }, 2000);</script>";
                    } else {
                        echo '<div class="alert alert-danger" role="alert"> Not saved.</div>';
                    }
                }
                exit;
            } else {

                $pro_id = $this->request->getQuery('pro_id');
                $post_data = null;
                $this->set(compact('post_data', 'pro_id'));
            }
        }
    }

    public function tiers()
    {
        $menu_act = 'tiers';
        $pro_menu = 'top_menu';
        $this->set(compact('menu_act', 'pro_menu'));

        if ($this->request->getQuery('del')  && !empty($this->request->getQuery('del'))) {
            $blog_del = $this->Levels->findById($this->request->getQuery('del'))->firstOrFail();
            if ($this->Levels->delete($blog_del)) {
            }
            $this->redirect('/pages/tiers');
        }

        $this->paginate = ['limit' => 100, 'order' => ['position' => 'asc']];
        $data = $this->paginate($this->Levels->find('all'));
        $paging = $this->request->getAttribute('paging');
        $this->set(compact('data', 'paging'));
    }


    public function addTire($id = null)
    {
        $post_data = null;
        if ($this->request->is('ajax')) {

            if (!empty($this->request->getData())) {
                $file_name = null;
                $postData = $this->request->getData();
                if (isset($postData['id']) && !empty($postData['id'])) {
                    $getBlog = $this->Levels->get($postData['id']);
                    $chkBlog = $this->Levels->patchEntity($getBlog, $postData, ['validate' => true]);
                } else {
                    $getBlog = $this->Levels->newEmptyEntity();
                    $chkBlog = $this->Levels->patchEntity($getBlog, $postData, ['validate' => true]);
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
                    if ($this->Levels->save($chkBlog)) {
                        echo "<script>$('#save_frm').remove();</script>";
                        echo "<div class='alert alert-success'>Saved</div>";
                        echo "<script> setTimeout(function(){ location.reload(); }, 1000);</script>";
                    } else {
                        echo '<div class="alert alert-danger" role="alert"> Not saved.</div>';
                    }
                }
                exit;
            } else {

                if (!empty($id)) {
                    $post_data = $this->Levels->findById($id)->firstOrFail();
                }
                $this->set(compact('post_data'));
            }
        }
    }


    public function stakes()
    {
        $menu_act = 'stakes';
        $this->set(compact('menu_act'));

        if ($this->request->getQuery('del')  && !empty($this->request->getQuery('del'))) {
            $readData = $this->Stakes->findById($this->request->getQuery('del'))->first();
            if(!empty($readData)){
                if ($this->Stakes->delete($readData)) {
                    $this->Stakes->deleteAll(['stake_id' => $readData->id]);
                }
            }
            $this->redirect('/pages/stakes');
        }

        $this->paginate = ['contain' => ['unStakes'], 'limit' => 100, 'conditions' => [], 'order' => ['id' => 'desc']];
        $data = $this->paginate($this->Stakes->find('all'));
        $paging = $this->request->getAttribute('paging');
        $this->set(compact('data', 'paging'));
    }

    public function addStake($id = null)
    {
        $post_data = null;
        if ($this->request->is('ajax')) {
            if (!empty($this->request->getData())) {
                $postData = $this->request->getData();
                $postData['type'] = 1;

                if (isset($postData['id']) && !empty($postData['id'])) {
                    $chk = $this->Stakes->find()->where(['type' => 1, 'days' => $postData['days'], 'id <>' => $postData['id']])->first();
                    if (!empty($chk)) {
                        echo '<div class="alert alert-danger" role="alert">Stake already added for ' . $postData['days'] . ' days</div>';
                        exit;
                    }
                    $getBlog = $this->Stakes->get($postData['id']);
                    $chkBlog = $this->Stakes->patchEntity($getBlog, $postData, ['validate' => true]);
                } else {
                    $chk = $this->Stakes->find()->where(['type' => 1, 'days' => $postData['days']])->first();
                    if (!empty($chk)) {
                        echo '<div class="alert alert-danger" role="alert">Stake already added for ' . $postData['days'] . ' days</div>';
                        exit;
                    }
                    $getBlog = $this->Stakes->newEmptyEntity();
                    $chkBlog = $this->Stakes->patchEntity($getBlog, $postData, ['validate' => true]);
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
                    if ($this->Stakes->save($chkBlog)) {
                        echo "<script>$('#save_frm').remove();</script>";
                        echo "<div class='alert alert-success'>Saved</div>";
                        echo "<script> setTimeout(function(){ location.reload(); }, 1000);</script>";
                    } else {
                        echo '<div class="alert alert-danger" role="alert"> Not saved.</div>';
                    }
                }
                exit;
            } else {
                if (!empty($id)) {
                    $post_data = $this->Stakes->findById($id)->firstOrFail();
                }
                $this->set(compact('post_data'));
            }
        }
    }

    public function addUnstake($id = null)
    {
        $post_data = null;
        if ($this->request->is('ajax')) {
            if (!empty($this->request->getData())) {
                $postData = $this->request->getData();
                $postData['type'] = 2;
                

                if (isset($postData['id']) && !empty($postData['id'])) {
                    $chk = $this->Stakes->find()->where(['type' => 2, 'stake_id' => $postData['stake_id'], 'days' => $postData['days'], 'id <>' => $postData['id']])->first();
                if (!empty($chk)) {
                    echo '<div class="alert alert-danger" role="alert"> unStake already added for ' . $postData['days'] . ' days</div>';
                    exit;
                }
                    $getBlog = $this->Stakes->get($postData['id']);
                    $chkBlog = $this->Stakes->patchEntity($getBlog, $postData, ['validate' => true]);
                } else {
                    $chk = $this->Stakes->find()->where(['type' => 2, 'stake_id' => $postData['stake_id'], 'days' => $postData['days']])->first();
                if (!empty($chk)) {
                    echo '<div class="alert alert-danger" role="alert"> unStake already added for ' . $postData['days'] . ' days</div>';
                    exit;
                }
                    $getBlog = $this->Stakes->newEmptyEntity();
                    $chkBlog = $this->Stakes->patchEntity($getBlog, $postData, ['validate' => true]);
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
                    if ($this->Stakes->save($chkBlog)) {
                        echo "<script>$('#save_frm').remove();</script>";
                        echo "<div class='alert alert-success'>Saved</div>";
                        echo "<script> setTimeout(function(){ location.reload(); }, 1000);</script>";
                    } else {
                        echo '<div class="alert alert-danger" role="alert"> Not saved.</div>';
                    }
                }
                exit;
            } else {
                if (!empty($id)) {
                    $post_data = $this->Stakes->findById($id)->firstOrFail();
                }
                $this->set(compact('post_data'));
            }
        }
    }


    public function idoApplications()
    {
        $menu_act = 'ido_applications';
        $pro_menu = 'top_menu';
        $this->set(compact('menu_act', 'pro_menu'));
        $this->paginate = ['limit' => 100, 'order' => ['id' => 'desc']];
        $data = $this->paginate($this->NewProjects->find('all'));
        $paging = $this->request->getAttribute('paging');
        $this->set(compact('data', 'paging'));
    }

    public function viewIdo($id = null)
    {
        $getData = null;
        if ($this->request->is('ajax')) {
            if (!empty($id)) {
                $getData = $this->NewProjects->findById($id)->first();
            }
            $this->set(compact('getData'));
        }
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
        $paging = $this->request->getAttribute('paging');
        $this->set(compact('data', 'paging'));
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
            $readData = $this->Users->findById($this->request->getQuery('del'))->firstOrFail();
            if ($this->Users->delete($readData)) {
                $this->Applications->deleteAll(['user_id' => $readData->id]);
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
        $this->paginate = ['contain' => ['UserStakes'],'limit' => 100, 'conditions' => ['Users.role' => 2], 'order' => ['id' => 'desc']];
        $data = $this->paginate($this->Users->find('all'));
        $paging = $this->request->getAttribute('paging');
        $this->set(compact('data', 'paging'));
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

    public function manageKyc($id = null)
    {
        $menu_act = 'users';
        $this->set(compact('menu_act'));
        $get_data = null;

        if ($this->request->getQuery('st')  && !empty($this->request->getQuery('st'))) {
            $chkData = $this->Users->findById($id)->first();
            if (!empty($chkData)) {
                /* Approve KYC */
                if ($this->request->getQuery('st') == 2) {
                    $upData = ['id' => $chkData->id, 'kyc_completed' => 2];
                    $saveData = $this->Users->newEntity($upData, ['validate' => false]);
                    $this->Users->save($saveData);
                    $this->Data->AppMail($chkData->email, 9, ['NAME' => $chkData->first_name]);
                }
            }
            $this->redirect('/pages/users');
        }

        /* Reject KYC*/
        if ($this->request->is('ajax') && !empty($this->request->getData())) {
            $postData = $this->request->getData();
            if (isset($postData['id']) && !empty($postData['id'])) {
                $getData = $this->Users->get($postData['id']);
                $chkData = $this->Users->patchEntity($getData, $postData, ['validate' => false]);
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
                    $this->Data->AppMail($chkData->email, 10, ['NAME' => $chkData->first_name, 'REJECT_REASON' => $chkData->kyc_reject_reason]);
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
            $query = $this->Users->find('all', ['contain' => ['Countries'], 'conditions' => ['Users.id' => $id, 'Users.kyc_completed IN' => [1, 2, 3]]]);
            $get_data =  $query->first();

            if (empty($get_data)) {
                $this->viewBuilder()->setLayout('not_found');
            }
        }
        $this->set(compact('get_data'));
    }

    public function subscribers()
    {
        $menu_act = 'subscribers';
        $sub_menu = 'top_menu';
        $this->set(compact('menu_act', 'sub_menu'));
        if ($this->request->getQuery('del')  && !empty($this->request->getQuery('del'))) {
            $blog_del = $this->Newsletters->findById($this->request->getQuery('del'))->firstOrFail();
            if ($this->Newsletters->delete($blog_del)) {
            }
            $this->redirect('/pages/subscribers');
        }

        $this->paginate = ['limit' => 100, 'conditions' => [], 'order' => ['id' => 'desc']];
        $data = $this->paginate($this->Newsletters->find('all'));
        $paging = $this->request->getAttribute('paging');
        $this->set(compact('data', 'paging'));
    }

    public function newsletter()
    {

        $menu_act = 'newsletter';
        $sub_menu = 'top_menu';
        $this->set(compact('menu_act', 'sub_menu'));

        if ($this->request->is('ajax') && !empty($this->request->getData())) {
            $postData = $this->request->getData();
            if (!empty($postData['subject']) && !empty($postData['message'])) {
                $query = $this->Newsletters->find('list', ['keyField' => 'email', 'valueField' => 'name'])->order(['Newsletters.name' => 'ASC']);
                $data = $query->all()->toArray();
                if (!empty($data)) {
                    foreach ($data as $em => $name) {
                        $this->Data->AppMail($em, 7, ['NAME' => $name, 'SUBJECT' => $postData['subject'], 'BODY' => $postData['message']]);
                    }
                    echo "<script>$('#e_frm')[0].reset();</script>";
                    echo "<div class='alert alert-success'>Newsletter sent.</div>";
                    echo "<script> setTimeout(function(){ location.reload(); }, 2000);</script>";
                } else {
                    echo "<div class='alert alert-danger'>Subscribers not found</div>";
                }
            } else {
                echo "<div class='alert alert-danger'>Please add email subject and message.</div>";
            }
            exit;
        }
    }

    public function emails()
    {
        $menu_act = 'emails';
        $sub_menu = 'top_menu';
        $this->set(compact('menu_act', 'sub_menu'));

        $this->paginate = ['limit' => 100, 'conditions' => [], 'order' => ['id' => 'desc']];
        $data = $this->paginate($this->EmailServers->find('all'));
        $paging = $this->request->getAttribute('paging');
        $this->set(compact('data', 'paging'));
    }

    public function settings()
    {
        $this->set('menu_act', 'settings');
        $postData = $this->request->getData();
        $tbl_data = null;
        if ($this->request->is('ajax') && !empty($this->request->getData())) {
            $uploadPath = 'cdn/logo/';
            if (!file_exists($uploadPath)) {
                mkdir($uploadPath, 0777, true);
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
                $getBlog = $this->Settings->get($postData['id']);
                if (!empty($file_name)) {
                    $getBlog['logo'] = $file_name;
                }
                $chkBlog = $this->Settings->patchEntity($getBlog, $postData, ['validate' => true]);
            } else {
                echo '<div class="alert alert-danger" role="alert"> Not saved.</div>';
                exit;
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
