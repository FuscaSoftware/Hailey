<?php

/*
 * The MIT License
 *
 * Copyright 2015 s.kalski.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */

/**
 * 
 *
 * @author s.kalski
 */
function get_config($value) {
    $jsonFile = file_get_contents('./config/config.json');
    $jsonConfig = json_decode($jsonFile, true);
    return $jsonConfig['config'][$value];
}

//===============================================
// Class Autoload function
// 
// autoload all classes if hailey is used as MVC system.
// If you don't wish to use autoload, set class_autoload in config.json
// to false. So only the nessecary classes to provide hailey classes and functions as
// framework will be loaded
//===============================================
function __autoload($classname) {
    $jsonFile = file_get_contents('./config/config.json');
    $jsonConfig = json_decode($jsonFile, true);
    if ($jsonConfig['config']['class_autoload'] == 'true') {
        $a = $classname;
        if ($a >= 'A' && $a <= 'Z' && !preg_match('/HAILEY/',$a))
            require_once(APP_PATH . 'models/' . $classname . '.php');
        elseif ($a >= 'A' && $a <= 'Z' && preg_match('/HAILEY/',$a))
            require_once('classes/' . $classname . '.php');
        else
            require_once('helper/' . $classname . '.php');
    } else {
        foreach (glob("classes/*.php") as $filename) {
            include $filename;
        }
    }
}

//===============================================================
// Model/ORM
//===============================================================
class H_Model extends HAILEY_Model {
    
}

//===============================================================
// Controller
//===============================================================
class H_Controller extends HAILEY_Controller {
    
}

//===============================================================
// View
//===============================================================
class H_View extends HAILEY_View {
    
}

//===============================================================
// DBManager
//===============================================================
class H_DBM extends HAILEY_DBManager {
    
}

//===============================================================
// configuration
//===============================================================
class H_Config extends HAILEY_Config {
    
}

//===============================================================
// validation
//===============================================================
class H_Validate extends HAILEY_Validator {
    
}

//===============================================================
// network
//===============================================================
class H_Net extends HAILEY_Network {
    
}

//===============================================================
// strings
//===============================================================
class H_Str extends HAILEY_Strings {
    
}

//===============================================================
// Filehandling
//===============================================================
class H_File extends HAILEY_Files {
    
}



//===============================================
// Uncaught Exception Handling
//===============================================
set_exception_handler('uncaught_exception_handler');

function uncaught_exception_handler($e) {
    ob_end_clean(); //dump out remaining buffered text
    $vars['message'] = $e;
    die(View::do_fetch(APP_PATH . 'errors/exception_uncaught.php', $vars));
}

function custom_error($msg = '') {
    $vars['msg'] = $msg;
    die(View::do_fetch(APP_PATH . 'errors/custom_error.php', $vars));
}

//===============================================
// Database Handler
//===============================================
function getdbh() {
    $config = new H_Config();
    $dbhost = $config->getConfig('dbhost');
    $dbuser = $config->getConfig('dbuser');
    $dbpass = $config->getConfig('dbpass');
    $dbname = $config->getConfig('dbname');
    try {
        $dbConnection = new PDO('mysql:host=' . $dbhost . ';dbname=' . $dbname, $dbuser, $dbpass);
    } catch (PDOException $e) {
        die('Connection failed: ' . $e->getMessage());
    }
    return $dbConnection;
}
