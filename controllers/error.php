<?php

/*
 * @author  :  TVC97
 * @email   :  tvc208@gmail.com
 * @website :  http://mbvn.tk/
 */

class Error extends Controller {

    function __construct() {
        
        parent::__construct();
        
    }
    
    function index(){
        if(isset($_GET['403']))
            $this->view->msg = 'Bạn không có quyền truy cập vào trang này';
        $this->view->load('error/index');
    }

}