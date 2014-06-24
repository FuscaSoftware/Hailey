<?php
function _index($msg='Hello World!') {
	$name = 'This is JSMALL MVC framework';

	$config = new Config();
	$sitename = $config->get_config('sitename');

	$view = new View(APP_PATH.'views/layout.php');
	$view->set('msg',$msg);
	$view->set('name',$name);
	$view->set('sitename',$sitename);
	$view->dump();
}