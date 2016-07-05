<?php

/*
 * @author TVC97
 * @site http://mbvn.tk
 */

header('Content-Type: image/png');

ini_set('display_errors', 0);
require '../../../config/config.php';

$db = null;
$time = time();

if(!file_exists(ROOT . '/counter.db')) {
    $db = new PDO('sqlite:' . ROOT . '/counter.db');
    $db->exec('CREATE TABLE counter (`time` INTEGER, `today` INTEGER, `total` INTEGER)');
    $db->exec('CREATE TABLE online (`time` INTEGER, `ip` TEXT, `is_member` INT)');
    $db->exec('INSERT INTO counter VALUES (' . $time . ', 0, 0)');
} else {
    $db = new PDO('sqlite:' . ROOT . '/counter.db');
}

/////////////////////////////////////////////////////////////////////////////////////////////////////////////

$counter = $db->query('SELECT * FROM counter')->fetch(PDO::FETCH_ASSOC);
$onl = $db->query('SELECT (SELECT COUNT(DISTINCT ip) FROM online) AS num_onl, (SELECT COUNT(DISTINCT ip) FROM online WHERE is_member = 1) AS num_mem_onl')->fetch(PDO::FETCH_ASSOC);

$fh = imagefontheight(1) + 4;
$fw = imagefontwidth(1);
$h = $fh * 3 + 2;

$img = imagecreate(80, $h);
$blue = imagecolorallocate($img, 32, 78, 176);
imagefilledrectangle($img, 0, 0, 80, $h, $blue);
$white = imagecolorallocate($img, 255, 255, 255);
imagefilledrectangle($img, 1, 1, 78, $h-2, $white);

imageline($img, 0, 1 + $fh, 80, 1 + $fh, $blue);
imageline($img, 0, 1 + $fh * 2, 80, 1 + $fh *2, $blue);

imagestring($img, 1, 2, 2, 'online', $blue);
imagestring($img, 1, 2, $fh + 3, 'today', $blue);
imagestring($img, 1, 2, $fh * 2 + 3, 'total', $blue);

$online = $onl['num_onl'];
$today = $counter['today'];
$total = $counter['total'];

imagestring($img, 1, 79 - $fw * strlen($online), 2, $online, $blue);
imagestring($img, 1, 79 - $fw * strlen($today), $fh + 3, $today, $blue);
imagestring($img, 1, 79 - $fw * strlen($total), $fh * 2 + 3, $total, $blue);

imagepng($img);