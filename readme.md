##Hailey Framework Beta
====================

read more:
http://lambda-code.github.io/Hailey/

This is a very tiny mvc framework within all needings
to design large website up to complex searchengines and
social networks with ease.

### What is it?

####Simple
HAILEY is an very small library and framework for web-projects. It does no matter how big or how small your project
will be.
####Downgrade compatibility
Fell free to make new functions or classes, but in this master it's not alowed to delete old functions
or change there returns and goal. So we make sure, that everyone can update his project with the new core file without
fear to get a real hard night.
####Minimalist
Only the real needed essentials are here. Non-MVC related functionality are not provided yet.
####Robust
Core code is very small and can be audited and secured quickly, also by beginners. It's a good place to start from here.
SQL injection would be unable by protection with PDO.
####Unobtrusive
No restrictions on use of other libraries like PEAR or another ORM like Doctrine.
All PHP globals are accessible.
####Flexible
PDO abstraction allows choice of databases.
Core MVC classes can be extended or overriden easily using object oriented inheritance.
Choice of using procedural or object-oriented code or both! This was a real hard decision and i'm sure,
that many hardcore coders want me dead by now :)
####Fast
No feature, code or framework bloat at all.
Even faster when used with a PHP Accelerator like APC.
####Friendly URL
It uses Human/Robot friendly URLs.
Also upgrade friendly, simply overwrite of the old core file with the new one!

### Little help guide

####The Model ORM CLASS
HAILEY provides a "Model" ORM class to let you map your database tables as PHP objects. It requires PHP5.
Data objects extend the Model class and have five functions: Create, Retrieve, Update, Delete and Exists.

Let's start with a little "users" table, with the following fields: 
uid (autoincremented primary key)
username
password 
fullname 
created_date

Now let's build a Model. By the Way - this is not a tutorial for save Logins. Don't use it, for real Projects.
```php
	<?php
	class User extends H_Model {
	function User() {
	//call parent with primary key name "uid", table name "users"
	//and function that returns the pdo handler named "getdbh"
	parent::__construct('uid','users','getdbh');
	//list of table fields below, need not contain all fields in table.
	$this->rs['uid'] = '';
	$this->rs['username'] = '';
	$this->rs['password'] = '';
	$this->rs['fullname'] = '';
	$this->rs['created_dt'] = '';
	}
}
?>
```

If you are an real lazy coder.
HAILEY can create the object for you. The only thing you need is the name of the table.
For the Model to work, a global function that returns the PDO needs to be defined.
In this case we got an table called User:
```php
<?php
                    $dbm = new H_DBM();
                    $dbm->createModel('User');
                    $user = new User();
                    $user_array = $user->retrieve_many();
?>
```

I think this is an really lazy-mode.

Here a few snippets to se how the Model works

```php
//Create
$user = new User();
$user->set('username','user');
$user->set('password','password');
$user->create();
$uid=$user->get('uid');

//Update
$user->set('password','newpassword');
$user->update();

//Retrieve, Delete, Exists
$user = new User();
$user->retrieve($uid);
if ($user->exists())
	$user->delete();

//Retrieve based on other criteria than the PK
$user = new User();
$user->retrieve_one("username=?",'yetanotherusr');
$user->retrieve_one("username=? AND password=? AND status='enabled'",array('erickoh','123456'));

//Return an array of Model objects
$user = new User();
$user_array = $user->retrieve_many("username LIKE ?",'eric%');
foreach ($user_array as $user)
	$user->delete();

//Return selected fields as array
$user = new User();
$result_array = $user->select("username,email","username LIKE ?",'eric%');
print_r($result_array);
```

#### Controller Class

In HAILEY, the Controller looks at the HTTP Request and then route the program control to the appropriate function.
It allows the use of Search Engine Friendly URLs on your web application.
> For the Controller to work, mod_rewrite is required and has to be configured via the webserver config file or via an .htaccess file.

How it works:
Parse the HTTP Request URL
Includes a php file based on (1)
Calls a php function included from (2)

Some examples:

http://mydomain.com/example-controller/action/param1/param2
With the above URL, it includes a file example-controller/action.php and calls the function _action(param1,param2)

http://mydomain.com/example-controller2/action2
With the above URL, it includes a file example-controller2/action2.php and calls the function _action2()

http://mydomain.com/example-controller2/action2/
With the above URL, it includes a file example-controller2/action2.php and calls the function _action2('')

http://mydomain.com/example-controller/action/param1/?a=1&b=2
With the above URL, it includes a file example-controller/action.php and calls the function _action(param1,'?a=1&b=2')
The querystring works and the global variable $_GET = array('a'=>1, 'b'=>2). 
Your function does not have to define the second parameter.

This is how the Controller is called:
```php
$controller = new H_Controller('../app/controllers/','/','main','index'); 
$controller->parse_http_request()->route_request();
```


#### View Class

The templates are plain PHP files, and so normal PHP code can be used and the PHP global variables are accessible together with any extra variables you have passed in as a parameter in the form of an associative array.


Let's say you have a template file named 
welcome.tpl.php with the following contents:
```php
<html>
  <head>
    <title><?php echo $pagename;?></title>
  </head>
  <body>
    <h1>Welcome <?php echo $username;?>,</h1>
    <p>The time is now <?php echo date("Y-m-d H:i:s");?></p>
  </body>
</html>
```

This is how you use call template file using a simple function call:
```php
<?php
	$vars = array("pagename"="Welcome!","username"="yetanotherusr");
	echo View::do_fetch("/path/to/welcome.tpl.php",$vars);
?>
```

Same result as above, but using object-oriented code:
```php
<?php
	$vars = array("pagename"="Welcome!","username"="yetanotherusr");
	$view = new H_View("/path/to/welcome.tpl.php",$vars);
	echo $view->fetch();
?>
```

Annnnd another way, a little bit easier for beginners
```php
<?php
	$view = new H_View("/path/to/welcome.tpl.php");
	$view->set("pagename","Welcome!");
	$view->set("username","Eric");
	echo $view->fetch();
?>
```


####Other ORM
The ORM class is not related to the View-Controller, 
so you can replace it with another ORM Classes even CouchDB, MongoDB or even POSTgreSQL.

