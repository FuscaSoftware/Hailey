<?php
function _index($msg='Hello World!') {
	$name = 'This is JSMALL MVC framework';
	$view = new View(APP_PATH.'views/layout.php');
	$view->set('msg',$msg);
	$view->set('name',$name);
	$view->dump();
}