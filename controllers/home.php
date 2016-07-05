<?php

/*
 * @author  :  TVC97
 * @email   :  tvc208@gmail.com
 * @website :  http://mbvn.tk/
 */

class Home extends Controller {

    function __construct() {
        parent::__construct();
    }

    public function index() {

        $this->view->display_desc = 1;
        $this->view->load('header', true);
        $this->view->load('home/index', true);
        
        $this->loadModel('Main');
        if ($this->model->num_threads() != 0) {
            $mode = isset($_GET['m']) ? ($_GET['m'] == 'old' ? 'old' : ($_GET['m'] == 'view' ? 'view' : 'new')) : 'new';
            $this->view->mode = $mode;
            if($mode == 'new')
                $this->view->data = $this->model->get_new_threads(0, 10);
            if($mode == 'old')
                $this->view->data = $this->model->get_old_threads(0, 10);
            if($mode == 'view')
                $this->view->data = $this->model->get_view_threads(0, 10);
            $this->view->load('home/thread', true);
        }

        $this->view->chat = $this->model->get_chats();
        $this->view->load('home/widget/chat', true);
        $this->view->data = $this->model->get_cats();
        $this->view->load('main/root_cat', true);
        $this->view->load('home/widget/tool', true);

        $this->view->online = $this->model->users_online();
        $this->view->counter = $this->counter;
        $this->view->load('home/widget/online', true);
        $this->view->load('home/widget/link', true);

        $this->view->load('footer', true);
    }

}
