<?php

/*
 * @author  :  TVC97
 * @email   :  tvc208@gmail.com
 * @website :  http://mbvn.tk/
 */

class Bootstrap {

    function __construct() {
        
        if(ini_get('magic_quotes_gpc') == 1) {

            foreach (array_keys($_POST) as $post) {
                $_POST[$post] = stripcslashes($_POST[$post]);
            }
            foreach (array_keys($_GET) as $post) {
                $_GET[$post] = stripcslashes($_GET[$post]);
            }
        }

        foreach (array_keys($_POST) as $post) {
            $_POST[$post] = Helper::utf2uni($_POST[$post]);
        }
        foreach (array_keys($_GET) as $post) {
            $_GET[$post] = Helper::utf2uni($_GET[$post]);
        }


        $url = trim(rtrim(isset($_GET['url']) ? $_GET['url'] : '', '/'));
        $url = filter_var($url, FILTER_SANITIZE_URL);
        $url = explode('/', $url);

        if ($url[0] == '' || $url[0] == 'index.php') {
            require ROOT . '/controllers/home.php';
            $controller = new Home();
            $controller->view->title = 'Trang chủ - ' . PNAME;
            $controller->index();
            exit;
        }

        $path = ROOT . '/controllers/' . $url[0] . '.php';
        if (file_exists($path)) {
            require $path;
        } else {
            $this->_error();
        }

        $controller = new $url[0];

        $n = count($url);
        switch ($n) {
            case 1:
                $controller->index();
                break;
            case 2:
                if (preg_match('/^[\w-]+\.\d+$/', $url[1])) {
                    $controller->vars = $url[1];
                    $controller->index();
                } elseif (preg_match('/^page-\d+$/', $url[1])) {
                    $controller->page = str_replace('page-', '', $url[1]);
                    $controller->index();
                } elseif (!method_exists($controller, $url[1])) {
                    $this->_error();
                } else {
                    $controller->{$url[1]}();
                }
                break;
            case 3:
                if (preg_match('/^[\w-]+\.\d+$/', $url[1]) && preg_match('/^page-\d+$/', $url[2])) {
                    $controller->vars = $url[1];
                    $controller->page = str_replace('page-', '', $url[2]);
                    $controller->index();
                } elseif (!method_exists($controller, $url[1])) {
                    $this->_error();
                } else {
                    $controller->{$url[1]}($url[2]);
                }
                break;
            case 4:
                if (!method_exists($controller, $url[1])) {
                    $this->_error();
                }
                $controller->{$url[1]}($url[2], $url[3]);
                break;
            case 5:
                if (!method_exists($controller, $url[1])) {
                    $this->_error();
                }
                $controller->{$url[1]}($url[2], $url[3], $url[4]);
                break;
            default:
                $this->_error();
                break;
        }
    }

    public function _error() {
        require ROOT . '/controllers/error.php';
        $controller = new Error();
        $controller->view->msg = 'Lỗi! trang bạn vừa truy cập không tồn tại.';
        $controller->index();
        die;
    }

}
