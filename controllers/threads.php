<?php

/*
 * @author  :  TVC97
 * @email   :  tvc208@gmail.com
 * @website :  http://mbvn.tk/
 */

class Threads extends Controller {

    function __construct() {
        parent::__construct();
    }

    public function index() {
        if (!isset($this->vars)) {
            header('Location: ' . URL);
            exit;
        }

        $page = isset($this->page) ? (int) $this->page : 1;

        $this->loadModel('Main');
        $var = explode('.', $this->vars);
        $name = $var[0];
        $id = $var[1];

        if (!$this->model->thread_exists($id)) {
            $this->_error('Chủ đề không tồn tại hoặc đã bị xóa.');
        }

        $tdat = $this->model->thread_info($id);
        $root = $this->model->root_info($tdat['cat_id']);

        if ($name != Helper::toURL(Helper::to_ascii($tdat['thread_name']))) {
            header('Location: ' . URL . '/threads/' . Helper::mkURL($tdat['thread_name'], $id) . '/');
            exit;
        }

        $num = $this->model->num_posts_by_thread($id);
        $npage = ceil($num / PPP);
        if ($page < 1)
            $page = 1;
        if ($page > $npage)
            $page = $npage;

        $this->view->data = $this->model->get_posts_by_thread($id, ($page - 1) * PPP, PPP);
        $liked = array();
        foreach ($this->view->data as $a) {
            if ($a['liked'] != 0) {
                $liked[$a['post_id']] = $this->model->liked($a['post_id']);
            }
        }
        $this->view->liked = $liked;
        $this->view->thread = $tdat;
        $this->view->title = $tdat['thread_name'] . ($page != 1 ? ' - Trang ' . $page : '');
        $this->view->bar = array(
            URL . '/cats/' . Helper::mkURL($root['cat_name'], $root['cat_id']) . '/' => $root['cat_name'],
            URL . '/cats/' . Helper::mkURL($tdat['cat_name'], $tdat['cat_id']) . '/' => $tdat['cat_name']
        );

        if (isset($_GET['del']))
            $this->view->msg = 'Đã xóa bài viết.';

        if (isset($_GET['liked']))
            $this->view->msg = 'Đã thích bài viết.';

        if (isset($_GET['unliked']))
            $this->view->msg = 'Đã bỏ bài viết.';

        if (isset($_GET['quote'])) {
            $quote = (int) $_GET['quote'];
            if ($this->model->post_exists($quote)) {
                $pinf = $this->model->post_info($quote);
                $uinf = $this->model->user_info($pinf['user_id']);
                $this->view->quote = array($uinf['user_name'], $pinf['content']);
            }
        }

        $this->model->update_views($id);
        $this->view->upost = $this->model->user_info($tdat['user_id']);

        $this->view->load('header', true);
        $this->view->load('main/show_thread', true);
        Helper::paging(URL . '/threads/' . Helper::mkURL($tdat['thread_name'], $id) . '/page-', '/', $page, $npage);
        if ($this->user->isLoged)
            $this->view->load('main/post_form', true);

        $this->view->data = $this->model->viewing_thread(Helper::mkURL('/' . $tdat['thread_name'] . '/', $id));
        $this->view->load('main/thread/viewing', true);
        $this->view->data = $this->model->same_cat_threads($tdat['parent'], $tdat['thread_id']);
        $this->view->load('main/thread/same_cat', true);

        $this->view->load('footer', true);
    }

}
