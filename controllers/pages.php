<?php

/*
 * @author  :  TVC97
 * @email   :  tvc208@gmail.com
 * @website :  http://mbvn.tk/
 */

class Pages extends Controller {

    function __construct() {
        parent::__construct();
    }
    
    public function index() {
        header('Location: ' . URL);
    }
    
    public function faq() {
        $this->view->title = 'Quy định';
        $this->view->load('pages/faq');
    }

    public function contact() {
        $this->view->title = 'Liên hệ';
        $this->view->load('pages/contact');
    }

    public function smilies() {
        $this->view->title = 'Danh sách Smilies';
        $this->view->load('pages/smilies');
    }

    public function bbcode() {
        $this->view->title = 'Danh sách BBCode';
        $this->view->load('pages/bbcode');
    }
    
    public function help() {
        $this->view->title = 'Trợ giúp';
        $this->view->load('pages/help');
    }

}