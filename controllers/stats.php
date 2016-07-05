<?php

/*
 * @author  :  TVC97
 * @email   :  tvc208@gmail.com
 * @website :  http://mbvn.tk/
 */

class Stats extends Controller {

    function __construct() {
        parent::__construct();
    }
    
    public function index() {
        $this->loadModel('Stats');
        $this->view->data['forum'] = $this->model->forum_stats();
        $this->view->data['newestUser'] = $this->model->get_newest_user();
        
        $this->view->title = 'Thống kê diễn đàn';
        $this->view->load('stats/index');
    }

}