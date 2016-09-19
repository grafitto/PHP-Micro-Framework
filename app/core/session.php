<?php
class Session {
	public static function start()
	{
		if(session_status() !== PHP_SESSION_ACTIVE)
			session_start();
		
	}
	public static function contains($key){
		return isset($_SESSION['user'][$key]);
	}
	public static function get($key,$default = false){
		return isset($_SESSION['user'][$key])?$_SESSION['user'][$key]:$default;
	}
	public static function set($key,$value){
		$_SESSION['user'][$key] = $value;
	}
	public static function has($key){
		return isset($_SESSION[$key]);
	}
	public static function clear(){
		unset($_SESSION['user']);
	}
}

class Raise{
	public static function contains($key){
		isset($_SESSION['data'][$key]);
	}
	public static function put($value){
		$_SESSION['data'] = $value;
	}
	public static function get($key,$default = false){
		$temp = isset($_SESSION['data'][$key])?$_SESSION['data'][$key]:$default;
		self::clear();
		return $temp;
	}
	public static function available(){
		return isset($_SESSION['data']);
	}
	private static function clear(){
		unset($_SESSION['data']);
	}
}