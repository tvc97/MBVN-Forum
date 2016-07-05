<?php

/*
 * @author  :  TVC97
 * @email   :  tvc208@gmail.com
 * @website :  http://mbvn.tk/
 */

class Messages extends Controller {

    function __construct() {
        parent::__construct();

        if (!$this->user->isLoged) {
            $this->_error('Bạn chưa đăng nhập.');
        }
        
        if($this->user->level == 0){
            $this->_error('Tài khoản đã bị khóa');
        }
    }

    public function index() {
        $this->view->bar = array(URL . '/upanel/' => 'Trang cá nhân');
        $this->view->title = 'Tin nhắn';
        $this->view->load('messages/index');
    }

    public function inbox($p = 1) {
        $p = (int) $p;

        $this->view->title = 'Hộp thư đến';
        $this->loadModel('Messages');

        $num = $this->model->num_receive_messages($this->user->user_id);

        if ($num == 0) {
            $this->_error('Chưa có tin nhắn nào.');
        }

        $page = ceil($num / 10);
        if ($p < 1) {
            $p = 1;
        }
        if ($p > $page) {
            $p = $page;
        }

        $start = ($p - 1) * 10;
        $this->view->data = $this->model->get_receive_messages($this->user->user_id, $start, 10);
        $this->view->bar = array(URL . '/upanel/' => 'Trang cá nhân', URL . '/messages/' => 'Tin nhắn');

        $this->view->load('messages/inbox');
    }

    public function outbox($p = 1) {
        $p = (int) $p;

        $this->view->title = 'Hộp thư đi';
        $this->loadModel('Messages');

        $num = $this->model->num_send_messages($this->user->user_id);

        if ($num == 0) {
            $this->_error('Chưa có tin nhắn nào.');
        }

        $page = ceil($num / 10);
        if ($p < 1) {
            $p = 1;
        }
        if ($p > $page) {
            $p = $page;
        }

        $start = ($p - 1) * 10;
        $this->view->data = $this->model->get_send_messages($this->user->user_id, $start, 10);
        $this->view->bar = array(URL . '/upanel/' => 'Trang cá nhân', URL . '/messages/' => 'Tin nhắn');

        $this->view->load('messages/outbox');
    }

    public function send($id = false) {
        if (!$id) {
            header('Location: ' . URL . '/members/');
            exit;
        }
        
        $this->loadModel('Messages');
        $id = (int) $id;
        
        if(!$this->model->id_exists($id)) {
            $this->_error('Thành viên không tồn tại.');
        }
        
        if($this->user->user_id == $id) {
            $this->_error('Không được tự sướng nhé :))');
        }
        
        if(isset($_POST['submit'])) {
            if(!isset($_POST['content'])) {
                $this->_error('Các trường nhập không xác định.');
            }
            
            $content = $_POST['content'];
            if(strlen($content) < 3) {
                $this->view->error = 'Nội dung quá ngắn';
            }else if($this->model->insert_message($id, $content)) {
                header('Location: ' . URL . '/messages/outbox/?sended');
                exit;
            }
        }
        
        $this->view->uid = $id;
        $this->view->load('messages/send');
    }

    public function read($id = false) {
        if (!$id) {
            $this->view->refresh = array(0, URL . '/messages/');
            $this->_error('Đã xảy ra lỗi.');
        }

        $id = (int) $id;

        $this->loadModel('Messages');
        if (!$this->model->message_exists($id, $this->user->user_id)) {
            $this->view->bar = array(URL . '/upanel/' => 'Trang cá nhân', URL . '/messages/' => 'Tin nhắn');
            $this->_error('Tin nhắn không tồn tại hoặc không có quyền đọc.');
        }

        $is_receiver = $this->model->is_receiver($id, $this->user->user_id);
        $this->view->data = $is_receiver ? $this->model->get_receive_data($id) : $this->model->get_send_data($id);
        $this->view->bar = array(URL . '/upanel/' => 'Trang cá nhân', URL . '/messages/' => 'Tin nhắn', URL . '/messages/' . ($is_receiver ? 'inbox/' : 'outbox/') => $is_receiver ? 'Hộp thư đến' : 'Hộp thư đi');

        if ($is_receiver) {
            $this->model->mark_readed($id);
            if ($this->user->numMessage > 0)
                $this->user->numMessage--;
        }

        $this->view->is_receiver = $is_receiver;
        $this->view->load('messages/read');
    }
    
}
