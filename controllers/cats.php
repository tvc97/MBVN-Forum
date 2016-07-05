<?php

/*
 * @author  :  TVC97
 * @email   :  tvc208@gmail.com
 * @website :  http://mbvn.tk/
 */

class Cats extends Controller {

    function __construct() {
        parent::__construct();
    }

    public function index() {
        if (!isset($this->vars)) {
            $this->showRoot();
        } else {
            $this->showCats();
        }
    }

    public function showRoot() {
        $this->loadModel('Main');
        $this->view->title = 'Chuyên mục';
        $this->view->data = $this->model->get_cats();
        $this->view->load('main/root_cat');
    }

    public function showCats() {
        $this->loadModel('Main');
        $cat = explode('.', $this->vars);
        $name = $cat[0];
        $id = (int) $cat[1];
        if ($this->model->cat_exists($id)) {
            $cdat = $this->model->cat_info($id);
            if ($name != Helper::toURL(Helper::to_ascii($cdat['cat_name']))) {
                header('Location: ' . URL . '/cats/' . Helper::mkURL($cdat['cat_name'], $id) . '/');
                exit;
            }

            if ($this->model->is_root_cat($id)) {
                $this->view->title = $cdat['cat_name'];
                $this->view->name = $cdat['cat_name'];
                $this->view->data = $this->model->get_cats_by_root($id);
                $this->view->load('main/cat');
            } else {
                $root = $this->model->root_info($id);
                $this->view->title = $cdat['cat_name'];
                $this->view->bar = array(URL . '/cats/' . Helper::mkURL($root['cat_name'], $root['cat_id']) . '/' => $root['cat_name']);
                $this->view->name = $cdat['cat_name'];
                $this->view->cat_id = $cdat['cat_id'];
                $num = $this->model->num_threads_by_cat($id);
                if ($num == 0) {
                    if ($this->user->isLoged) {
                        $this->view->addition = '<a class="button" href="' . URL . '/upanel/thread_post/' . $cdat['cat_id'] . '">Đăng chủ đề mới</a>';
                    }
                    $this->_error('Chưa có chủ đề nào trong chuyện mục này!');
                }
                $pages = ceil($num / TPP);
                $page = isset($this->page) ? $this->page : 1;
                if ($page < 1)
                    $page = 1;
                if ($page > $pages)
                    $page = $pages;
                $this->view->data = $this->model->get_threads_by_catN($id, ($page - 1) * TPP, TPP);
                $this->view->load('header', true);
                $this->view->load('main/threads_by_cat', true);
                Helper::paging(URL . '/cats/' . Helper::mkURL($cdat['cat_name'], $cdat['cat_id']) . '/page-', '/', $page, $pages);
                $this->view->load('footer', true);
            }
        } else {
            $this->_error('Chuyên mục không tồn tại.');
        }
    }

}
