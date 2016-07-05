<?php

/*
 * @author  :  TVC97
 * @email   :  tvc208@gmail.com
 * @website :  http://mbvn.tk/
 */

class Register extends Controller {

    function __construct() {
        parent::__construct();

        if ($this->user->isLoged) {
            $this->view->msg = 'Lỗi! Bạn đã đăng nhập.';
            $this->view->load('error/index');
            exit;
        }
    }

    public function index() {
        $this->view->title = 'Đăng kí';
        $this->view->load('register/index');
    }

    public function doReg() {

        if (!isset($_POST['login']) || !isset($_POST['password']) || !isset($_POST['rpassword']) || !isset($_POST['email']) || !isset($_POST['gender']) || !isset($_POST['verify']) || !isset($_SESSION['verify'])) {
            $this->__error('Lỗi! Vui lòng nhập đầy đủ thông tin.');
        }


        $name = $_POST['login'];
        $password = $_POST['password'];
        $rpassword = $_POST['rpassword'];
        $email = strtolower($_POST['email']);
        $gender = $_POST['gender'];
        $dob = implode('/', array($_POST['date'], $_POST['month'], $_POST['year']));
        $verify = $_POST['verify'];
        $sess = $_SESSION['verify'];

        $this->loadModel('Register'); 
        if (!Helper::valid_user($name)) {
            $this->__error('Lỗi! Tên đăng nhập phải hơn 3 kí tự và chỉ chứa kí tự a-z, A-Z, 0-9, -, _ .');
        } elseif (strlen($password) < 1) {
            $this->__error('Lỗi! Mật khẩu không được để trống.');
        } elseif ($password != $rpassword) {
            $this->__error('Lỗi! Nhập lại mật khẩu không chính xác');
        } elseif (!Helper::valid_email($email)) {
            $this->__error('Lỗi! Email không hợp lệ.');
        } elseif (!Helper::valid_dob($dob)) {
            $this->__error('Lỗi! Bạn là siêu nhân =))');
        } elseif ($sess != md5(md5($verify))) {
            $this->__error('Lỗi! Mã bảo mật không chính xác');
        }elseif ($this->model->user_exists(strtolower($name))) {
            $this->__error('Lỗi! Tên đăng nhập đã có người sử dụng.');
        } elseif ($this->model->email_exists($email)) {
            $this->__error('Lỗi! Email đã có người sử dụng.');
        } else if($dob == '1/1/1980'){
            $this->__error('Vui lòng nhập ngày sinh.');
        } else {
            $insert = $this->model->insert_user(array(
                'username' => strtolower($name),
                'dname' => $name,
                'password' => Hash::generate('md5', $password, PWD_KEY),
                'email' => $email,
                'gender' => ($gender == 'male' ? 1 : 2),
                'dob' => $dob,
                'reg' => time(),
                'login_hash' => Hash::generate('sha512', strtolower($name) . ';' . $password, PWD_KEY)
            ));

            if ($insert) {
                $this->view->load('register/success');
                $id = $this->model->getID(strtolower($name));
                $this->model->insert_message($id, "Hey, $name.\nChào mừng bạn đến với diễn đàn Mobile Việt Nam\n Trước khi tham gia bàn luận trên diễn đàn hãy dành chút thời gian đọc qua [url=/pages/faq/]Quy định[/url] và [url=/threads/quy-dinh-khi-dang-chu-de.3/]Quy định khi đăng chủ đề[/url] nhé!\nCám ơn bạn.");
                copy(ROOT . '/public/img/avatar/default.png', ROOT . '/public/img/avatar/' . $id . '.png');
            } else {
                $this->view->load('register/error');
            }
        }
    }
    
    private function __error($str) {
        $this->view->msg = $str;
        $this->view->load('register/index');
        exit;
    }

    public function faq() {
        $this->view->title = 'Điều khoàn đăng kí';
        $this->view->load('register/faq');
    }

}
