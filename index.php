<?php

//===============================================
// Debug
//===============================================
ini_set('display_errors', 'On');
error_reporting(E_ALL);

//===============================================
// mod_rewrite
//===============================================
//Please configure via .htaccess or httpd.conf

define('APP_PATH', 'app/'); //with trailing slash pls - this is where your content stays
define('WEB_FOLDER', '/jsmall/'); //with trailing slash pls
$GLOBALS['sitename'] = 'jsmall - Small PHP MVC Framework';

//===============================================
// Includes the Framework classes
//===============================================
require('hailey/haileyloader.php');

//===============================================
// Start the controller
//===============================================
$controller = new H_Controller(APP_PATH . 'controllers/', WEB_FOLDER, 'main', 'index');


?>