<?php

/*
 * @author  :  TVC97
 * @email   :  tvc208@gmail.com
 * @website :  http://mbvn.tk/
 */

class Login extends Controller {

    function __construct() {
        parent::__construct();

        if ($this->user->isLoged) {
            $this->view->msg = 'Lỗi! Bạn đã đăng nhập.';
            $this->view->load('error/index');
            exit;
        }
    }

    function index() {
        $this->view->title = 'Đăng nhập';
        $this->view->load('login/index');
    }

    public function doLog() {
        if (!isset($_POST['login']) || !isset($_POST['password']) || !isset($_POST['submit'])) {
            $this->view->msg = 'Vui lòng nhập đầy đủ thông tin đăng nhập.';
        } else {
            $username = strtolower($_POST['login']);
            $password = $_POST['password'];

            if (strlen($username) == 0 || strlen($password) == 0) {
                $this->view->msg = 'Vui lòng nhập đầy đủ thông tin đăng nhập.';
            } else {
                $this->loadModel('Login');

                if ($this->model->check_login($username, Hash::generate('md5', $password, PWD_KEY), Hash::generate('sha512', $username . ';' . $password, PWD_KEY))) {
                    setcookie('hash', Hash::generate('sha512', $username . ';' . $password, PWD_KEY), time() + 3600 * 24 * 365, '/');
                    $this->view->refresh = array(0, URL);
                    $this->view->load('login/success');
                    exit;
                } else {
                    $this->view->msg = 'Lỗi! Tên đăng nhập hoặc mật khẩu không chính xác.';
                }
            }
        }
        $this->view->load('login/index');
    }

}
