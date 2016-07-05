<?php

/*
 * @author  :  TVC97
 * @email   :  tvc208@gmail.com
 * @website :  http://mbvn.tk/
 */

class Chat extends Controller {

    function __construct() {
        parent::__construct();
        define('INSIDE_CHAT', 1);
    }

    public function index() {
        $page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
        $this->loadModel('Chat');
        $num = $this->model->num_chats();
        $npage = ceil($num / PPP);

        if ($page < 1)
            $page = 1;
        if ($page > $npage)
            $page = $npage;

        $this->view->title = 'Trò chuyện';
        $this->view->data = $this->model->get_chats(($page - 1) * PPP, PPP);
        $this->view->load('header', true);
        $this->view->load('chat/index', true);
        Helper::paging(URL . '/chat/?page=', '/', $page, $npage);
        $this->view->load('footer', true);
    }

    public function post_i() {
        if (!$this->user->isLoged) {
            $this->_error('Bạn chưa đăng nhập.');
        }

        if (!isset($_POST['content'])) {
            $this->_error('Missing variable.');
        }

        $content = $_POST['content'];

        if (strlen($content) < 1) {
            $this->_error('Vui lòng nhập nội dung.');
        }

        $this->loadModel('Chat');
        if ($this->model->insert_chat($content)) {
            header('Location: ' . URL);
        } else {
            $this->_error('Đã xảy ra lỗi.');
        }
    }

    public function ajax_post() {
        if (!$this->user->isLoged) {
            exit('false');
        }

        if (!isset($_POST['content'])) {
            exit('false');
        }

        $content = $_POST['content'];

        if (strlen($content) < 1) {
            $this->_error('Vui lòng nhập nội dung.');
        }

        $this->loadModel('Chat');
        if ($this->model->insert_chat($content)) {
            $this->view->chat = $this->model->get_chats(0, 7);
            $this->view->load('chat/ajax_load', true);
        } else {
            exit('false');
        }
    }

    public function ajax_load($id = -1) {
        $this->loadModel('Chat');
        $last = $this->model->get_lastest_id();
        if($last != $id) {
            echo format_chat_id($last);
            $this->view->chat = $this->model->get_chats(0, 7);
            $this->view->load('chat/ajax_load', true);
        } else {
            exit('0');
        }
    }

    public function post_c() {
        if (!$this->user->isLoged) {
            $this->_error('Bạn chưa đăng nhập.');
        }

        if (!isset($_POST['content'])) {
            $this->_error('Missing variable.');
        }

        $content = $_POST['content'];

        if (strlen($content) < 1) {
            $this->_error('Vui lòng nhập nội dung.');
        }

        $this->loadModel('Chat');
        if ($this->model->insert_chat($content)) {
            header('Location: ' . URL . '/chat/');
        } else {
            $this->_error('Đã xảy ra lỗi.');
        }
    }

    public function clean_i() {
        if (!$this->user->isLoged) {
            $this->_error('Bạn chưa đăng nhập.');
        }

        if ($this->user->level < 10) {
            $this->_error('Bạn không có quyền truy cập trang này.');
        }
        
        if(!isset($_GET['confirm'])) {
            $this->view->title = 'Dọn dẹp phòng chat';
            $this->view->confirm_url = URL . '/chat/clean_i/?confirm';
            $this->view->return_url = URL;
            $this->view->load('confirm_box/clean_chat');
            exit;
        }

        $this->loadModel('Chat');

        if ($this->model->clean_chat()) {
            header('Location: ' . URL);
        } else {
            $this->_error('Đã xảy ra lỗi');
        }
    }

    public function clean_c() {
        if (!$this->user->isLoged) {
            $this->_error('Bạn chưa đăng nhập.');
        }

        if ($this->user->level < 10) {
            $this->_error('Bạn không có quyền truy cập trang này.');
        }

        if(!isset($_GET['confirm'])) {
            $this->view->title = 'Dọn dẹp phòng chat';
            $this->view->confirm_url = URL . '/chat/clean_c/?confirm';
            $this->view->return_url = URL . '/chat';
            $this->view->load('confirm_box/clean_chat');
            exit;
        }

        $this->loadModel('Chat');

        if ($this->model->clean_chat()) {
            header('Location: ' . URL . '/chat/');
        } else {
            $this->_error('Đã xảy ra lỗi');
        }
    }

}
