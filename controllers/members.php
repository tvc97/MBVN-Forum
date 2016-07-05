<?php

/*
 * @author  :  TVC97
 * @email   :  tvc208@gmail.com
 * @website :  http://mbvn.tk/
 */

class Members extends Controller {

    function __construct() {
        parent::__construct();
    }

    function index() {
        if (!isset($this->vars)) {
            $this->_listUser();
        } else {
            $this->_profile();
        }
    }

    function _profile() {
        $user = explode('.', $this->vars);
        $this->loadModel('Members');
        if ($this->model->id_exists((int) $user[1])) {
            $udat = $this->model->infoID((int) $user[1]);
            if ($udat['user_name'] != $user[0]) {
                header('Location: ' . URL . '/members/' . $udat['user_name'] . '.' . $udat['user_id'] . '/');
                exit;
            }

            $this->view->title = 'Hồ sơ ' . $udat['dname'];
            $this->view->bar = array(URL . '/members/' => 'Thành viên');

            $this->view->data = $udat;
            $this->view->load('members/profile');
        } else {
            $this->_error('Thành viên không tồn tại.');
        }
    }

    function _listUser() {
        $page = isset($this->page) ? (int) $this->page : 1;
        $this->loadModel('Members');
        $num = $this->model->num_users();
        $npage = ceil($num / TPP);

        if ($page < 1)
            $page = 1;

        if ($page > $npage)
            $page = $npage;

        $this->view->data = $this->model->listUser(($page - 1) * TPP, TPP);
        $this->view->title = 'Danh sách thành viên';

        $this->view->load('header', true);
        $this->view->load('members/list', true);
        Helper::paging(URL . '/members/page-', '/', $page, $npage);
        $this->view->load('footer', true);
    }

    function threads($id = -1) {
        $id = (int) $id;

        if ($id == -1) {
            header('Location: ' . URL . '/members/');
            exit;
        }

        $this->loadModel('Main');

        if (!$this->model->id_exists($id)) {
            $this->_error('Thành viên không tồn tại.');
            exit;
        }

        $page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
        $num = $this->model->num_threads_by_user($id);

        if ($num == 0) {
            $this->_error('Chưa có chủ đề nào của thành viên này.');
            exit;
        }

        $npage = ceil($num / TPP);

        if ($page < 1)
            $page = 1;

        if ($page > $npage)
            $page = $npage;

        $this->view->data = $this->model->get_threads_by_user($id, ($page - 1) * TPP, TPP);
        $this->view->u = $this->model->user_info($id);
        $this->view->title = 'Chủ đề của ' . $this->view->u['dname'];

        $this->view->load('header', true);
        $this->view->load('members/threads', true);
        Helper::paging(URL . '/members/threads/' . $id . '/?page=', '', $page, $npage);
        $this->view->load('footer', true);
    }

    public function search() {
        $page  = isset($_GET['p']) ? (int) $_GET['p'] : 1;
        $query = isset($_GET['q']) ? $_GET['q'] : '';
        
        if(strlen($query) < 4) {
            $this->view->error = 'Từ tìm kiếm quá ngắn.';
            $this->view->load('members/search');
            exit;
        }

        $this->loadModel('Search');
        $num = $this->model->num_result_user($query);
        if ($num == 0) {
            $this->view->error = 'Không tìm thấy kết quả nào cho từ khóa ' . "'$query'";
            $this->view->load('members/search');
        } else {
            $npage = ceil($num / TPP);
            if ($page < 1) {
                $page = 1;
            }
            if ($page > $npage) {
                $page = $npage;
            }

            $this->view->num = $num;
            $this->view->data = $this->model->result_user($query, ($page - 1) * TPP, TPP);
            $this->view->bar = array(URL . '/search/' => 'Tìm kiếm');
            $this->view->load('header', true);
            $this->view->load('members/search_result', true);
            Helper::paging(URL . '/members/search/?q=' . urlencode($query) . '&p=', '', $page, $npage);
            $this->view->load('footer', true);
        }
    }

}
