<?php

/*
 * @author  :  TVC97
 * @email   :  tvc208@gmail.com
 * @website :  http://mbvn.tk/
 */

class Logout extends Controller {

    function __construct() {
        parent::__construct();
    }
    
    function index() {
        if(!$this->user->isLoged){
            $this->view->msg = 'Lỗi! bạn chưa đăng nhập.';
            $this->view->load('error/index');
            exit;
        }
        
        $this->loadModel('Logout');
        $this->model->update_logout($this->user->user_id);
        
        setcookie('hash', '', -1, '/');
        $this->view->refresh = array(0, URL);
        $this->view->load('logout/index');
    }

}