<?php

function _index() {

    $name = 'HAILEY FRAMEWORK';
    $view = new H_View(APP_PATH . 'views/layout.php');

    $view->set('name', $name);

    /*
     * $dbm = new H_DBM();
     * $dbm->createModel('Users');
     * $user = new Users();
     * $user_array = $user->retrieve_many();
     * *
     */

    $view->dump();
}
