<?php

/*
 * @author  :  TVC97
 * @email   :  tvc208@gmail.com
 * @website :  http://mbvn.tk/
 */

class View {

    function __construct() {
        
    }

    /**
     * 
     * @param String $file model name to load
     * @param Boolean $incFaH include header and footer or not
     */
    public function load($file, $incFaH = false) {

        if (!$incFaH) {
            require ROOT . '/views/header.php';
            require ROOT . '/views/' . $file . '.php';
            require ROOT . '/views/footer.php';
        } else {
            require ROOT . '/views/' . $file . '.php';
        }
    }

}
