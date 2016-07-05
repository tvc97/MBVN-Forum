<?php

/*
 * @author  :  TVC97
 * @email   :  tvc208@gmail.com
 * @website :  http://mbvn.tk/
 */

class Search extends Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $type = isset($_GET['t']) ? $_GET['t'] : '';
        $query = isset($_GET['q']) ? Helper::cleanXSS($_GET['q']) : '';
        $page = isset($_GET['p']) ? (int) $_GET['p'] : 1;

        if ($type != '' && $query == '') {
            $type = '';
        }

        if ($type != '' && $query != '') {
            if (strlen($query) < 4) {
                $this->view->error = 'Từ tìm kiếm quá ngắn';
                $type = '';
            }
        }

        if ($type == 't') {
            $this->_search_thread($query, $page);
            exit;
        }
        if ($type == 'p') {
            $this->_search_post($query, $page);
            exit;
        }
        $this->view->title = 'Tìm kiếm';
        $this->view->load('search/index');
    }

    public function _search_thread($query, $page) {
        $this->loadModel('Search');
        $num = $this->model->num_result_thread($query);
        if ($num == 0) {
            $this->view->error = 'Không tìm thấy kết quả nào cho từ khóa ' . "'$query'";
            $this->view->load('search/index');
        } else {
            $npage = ceil($num / TPP);
            if ($page < 1) {
                $page = 1;
            }
            if ($page > $npage) {
                $page = $npage;
            }
            
            $this->view->num = $num;
            $this->view->data = $this->model->result_thread($query, ($page - 1) * TPP, TPP);
            $this->view->bar = array(URL . '/search/' => 'Tìm kiếm');
            $this->view->load('header', true);
            $this->view->load('search/thread', true);
            Helper::paging(URL . '/search/?t=t&q=' . urlencode($query) . '&p=', '', $page, $npage);
            $this->view->load('footer', true);
        }
    }

    public function _search_post($query, $page) {
        $this->loadModel('Search');
        $num = $this->model->num_result_post($query);
        if ($num == 0) {
            $this->view->error = 'Không tìm thấy kết quả nào cho từ khóa ' . "'$query'";
            $this->view->load('members/search');
        } else {
            $npage = ceil($num / PPP);
            if ($page < 1) {
                $page = 1;
            }
            if ($page > $npage) {
                $page = $npage;
            }
            
            $this->view->num = $num;
            $this->view->data = $this->model->result_post($query, ($page - 1) * PPP, PPP);
            $this->view->bar = array(URL . '/members/' => 'Thành viên');
            $this->view->load('header', true);
            $this->view->load('/search/post', true);
            Helper::paging(URL . '/search/?t=p&q=' . urlencode($query) . '&p=', '', $page, $npage);
            $this->view->load('footer', true);
        }
    }

}
