<?php 
foreach(glob('../app/core/*.php') as $name){
	if(is_file($name))
		require_once $name;
}
require_once '../app/dirs.php';
require_once '../routes.php';
require_once '../app/init.php';
require_once '../app/core/utilities.php';

foreach(glob('../app/models/*.php') as $name){
	require_once $name;
}

//print_r();// exit;
$url = substr($_SERVER['REQUEST_URI'], 1);
$url = explode("?", $url)[0];
$app = new Application($url,$ROUTES);
$app->start();