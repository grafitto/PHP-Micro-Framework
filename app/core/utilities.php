<?php
function debug($item){
	print_r($item);
	exit;
}

function redirect($path,$session = NULL){
	if(!is_null($session))
		Raise::put($session);
	header("Location:" . $path);
	exit(0);
	
}

function load($fragment,$data = NULL){
	include  DIRECTORY_SEPARATOR . "app" . DIRECTORY_SEPARATOR . "views" . DIRECTORY_SEPARATOR . $fragment . ".php";
		//include BASEURL . $fragment . ".php";
}
function loadStatic($file){
	//$url = $_SERVER['SERVER_NAME'] . DIRECTORY_SEPARATOR . $file;
	$url = "/vendor/" . $file;
	return $url;
}
function loadUserImage($name){
	$name = str_replace("/", DIRECTORY_SEPARATOR, $name);
	return "..".DIRECTORY_SEPARATOR."app".DIRECTORY_SEPARATOR."data".DIRECTORY_SEPARATOR. $name;
}
function getRandomString($chars = null, $length = 5){
	
	if(is_null($chars))
		$chars = '0123456789abcdefghijkmnopqrstuvwxyzABCDEFGHJKLMNOPQRSTUVWXYZ';
	
	return substr(str_shuffle($chars), 0, $length);
}