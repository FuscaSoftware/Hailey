<?php
//===============================================
// Debug
//===============================================
ini_set('display_errors','On');
error_reporting(E_ALL);

//===============================================
// mod_rewrite
//===============================================
//Please configure via .htaccess or httpd.conf

define('APP_PATH','app/'); //with trailing slash pls - this is where your content stays
define('WEB_FOLDER','/yourDIR/'); //with trailing slash pls

define('WEB_DOMAIN','http://localhost'); //with http:// and NO trailing slash pls
define('VIEW_PATH','app/views/'); //with trailing slash pls

//===============================================
// Includes the Framework classes
//===============================================
require('jsmall/jsmall.php');

//===============================================
// Session
//===============================================
session_start();
//===============================================
// Uncaught Exception Handling
//===============================================s
set_exception_handler('uncaught_exception_handler');

function uncaught_exception_handler($e) {
	ob_end_clean(); //dump out remaining buffered text
	$vars['message']=$e;
	die(View::do_fetch(APP_PATH.'errors/exception_uncaught.php',$vars));
}

function custom_error($msg='') {
	$vars['msg']=$msg;
	die(View::do_fetch(APP_PATH.'errors/custom_error.php',$vars));
}



//===============================================
// Autoloading for Business Classes
//===============================================
// Assumes Model Classes start with capital letters and Helpers start with lower case letters

function __autoload($classname) {
	$a=$classname[0];
	if ($a >= 'A' && $a <='Z')
		require_once(APP_PATH.'models/'.$classname.'.php');
	else
		require_once(APP_PATH.'helpers/'.$classname.'.php');  
	}


//===============================================
// Start the controller
//===============================================
$controller = new Controller(APP_PATH.'controllers/',WEB_FOLDER,'main','index');
