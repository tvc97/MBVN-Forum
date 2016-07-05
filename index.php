<?php

/*
 * Author  :  TVC97
 * Email   :  tvc208@gmail.com
 * Website :  http://mbvn.tk/
 */

//exit('Forum bao tri, cac ban quay lai sau!');

//define('RO', 1);

error_reporting(0);
ini_set('dislay_errors', 0);

ob_start();
session_start();

$start_load = microtime(true);


require 'libs/Functions.php';
require 'libs/Controller.php';
require 'libs/Model.php';
require 'libs/View.php';

require 'libs/Database.php';

require 'libs/User.php';
require 'libs/Hash.php';
require 'libs/Helper.php';
require 'libs/Smilies.php';

require 'libs/Bootstrap.php';
require 'libs/AntiDDos.php';

require 'config/config.php';

//$firewall = new AntiDDos();

$app = new Bootstrap();