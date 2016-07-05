<?php

/*
 * Author  :  TVC97
 * Email   :  tvc208@gmail.com
 * Website :  http://mbvn.tk/
 */

// Website URL
define('URL', 'http://mbvn.dev');
// App root
define('ROOT', $_SERVER['DOCUMENT_ROOT']);
// Page name
define('PNAME', 'Mobile Việt Nam');
// Server name
define('SNAME', 'MBVN.TK');

// Database info
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASSWORD', 'root');
define('DB_NAME', 'mbvn');

// Password key security, dont change this after install
define('PWD_KEY', '!@#Mobile1Forum^&*');

// Custom color for user
define('COLOR_ADM', '#ff0000');
define('COLOR_MOD', '#0000ff');
define('COLOR_MEM', '#373839');
define('COLOR_BAN', '#aaaaaa');

// Custom display
define('PPP', 10); // Num posts per page
define('TPP', 10); // Num threads per page

// Set timezone
date_default_timezone_set('Asia/Ho_Chi_Minh');