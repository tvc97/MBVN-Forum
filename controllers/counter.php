<?php

/*
 * @author  :  TVC97
 * @email   :  tvc208@gmail.com
 * @website :  http://mbvn.tk/
 */

class Counter extends Controller {

    function __construct() {
        parent::__construct();
    }

    public function index() {
        $this->loadModel('Main');
        $this->view->onl = $this->model->users_online();
        $this->view->data = $this->counter;
        $this->view->title = 'Trực tuyến & Truy Cập';
        $this->view->load('counter/index');
    }

    public function img() {
        header('Content-Type: image/png');
        
        $fh = imagefontheight(1) + 4;
        $fw = imagefontwidth(1);
        $h = $fh * 3 + 2;

        $img = imagecreate(80, $h);
        $blue = imagecolorallocate($img, 0, 97, 255);
        imagefilledrectangle($img, 0, 0, 80, $h, $blue);
        $white = imagecolorallocate($img, 255, 255, 255);
        imagefilledrectangle($img, 1, 1, 78, $h - 2, $white);

        imageline($img, 0, 1 + $fh, 80, 1 + $fh, $blue);
        imageline($img, 0, 1 + $fh * 2, 80, 1 + $fh * 2, $blue);

        imagestring($img, 1, 2, 2, 'online', $blue);
        imagestring($img, 1, 2, $fh + 3, 'today', $blue);
        imagestring($img, 1, 2, $fh * 2 + 3, 'total', $blue);

        $online = $this->counter['online'];
        $today = $this->counter['today'];
        $total = $this->counter['total'];

        imagestring($img, 1, 79 - $fw * strlen($online), 2, $online, $blue);
        imagestring($img, 1, 79 - $fw * strlen($today), $fh + 3, $today, $blue);
        imagestring($img, 1, 79 - $fw * strlen($total), $fh * 2 + 3, $total, $blue);

        imagepng($img);
    }

}
