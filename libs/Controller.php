<?php

/*
 * @author  :  TVC97
 * @email   :  tvc208@gmail.com
 * @website :  http://mbvn.tk/
 */

class Controller {

    public $user;

    function __construct() {
        $this->view = new View();
        $this->user = new User();
        $this->view->user = &$this->user;
        Helper::$user = &$this->user;

        /*
        $this->view->load('newyear', true);
        exit;
        */

        /*
         * Counter and Online
         */
        $this->loadModel('Counter');
        if (!preg_match('#/counter/img.*#', Helper::get_location())) {
            $this->model->update_online_counter();
            $this->model->insert_online(Helper::get_ip(), Helper::get_ua(), Helper::get_location(), $this->user->isLoged ? $this->user->user_id : 0, time());
        }
        $this->counter = $this->model->get_data();
        
        $ctrller = trim($_SERVER['REQUEST_URI'], '/');

        /*
         * Deny banned user
         */
        if ($this->user->isLoged)
            if ($this->user->level == 0 && $ctrller != 'logout') {
                $this->_error('Tài khoản đã bị khóa');
            }
    }

    public function loadModel($name) {
        require ROOT . '/models/' . $name . '.php';
        $name = $name . '_Model';
        $this->model = new $name;
        $this->model->user = &$this->user;
    }

    public function getDefaultModel() {
        $this->model = new Model();
        $this->model->user = &$this->user;
    }

    public function _error($str) {
        $this->view->msg = $str;
        $this->view->load('error/index');
        exit;
    }

}
