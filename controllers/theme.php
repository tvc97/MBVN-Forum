<?php

/*
 * @author  :  TVC97
 * @email   :  tvc208@gmail.com
 * @website :  http://mbvn.tk/
 */

class Theme extends Controller {

    function __construct() {
        parent::__construct();
        
        if(!$this->user->isLoged) {
            $this->_error('Bạn chưa đăng nhập.');
        }
    }
    
    public function index() {
        header('Location: ' . URL);
    }
    
    public function change() {
        if(!isset($_POST['theme'])) {
            $this->_error('Missing variable');
        }
        $theme = preg_replace('/[^\w\d]/', '', $_POST['theme']);
        if(!file_exists(ROOT . '/public/css/' . $theme . '/theme.inf')) {
            $this->_error('Giao diện không tồn tại');
        }
        $this->loadModel('Theme');
        if($this->model->update_theme($theme)) {
            header('Location: ' . URL);
        } else {
            $this->_error('Đã xảy ra lỗi');
        }
    }

}