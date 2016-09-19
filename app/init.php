<?php 

function __autoload($class){
    $class = strtolower($class);
    $path = __DIR__ . DIRECTORY_SEPARATOR . "core" . DIRECTORY_SEPARATOR . "{$class}.php";
    if(file_exists($path)){
    	echo "Found";
        require_once($path);
    }else{
        die("The file {$class}.php couldn't be found in ($path}");
    }
}