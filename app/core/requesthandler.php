<?php
class requestHandler
{
	
	public $requestUrl;
	
	public function __construct(){
		if(isset($_SERVER['HTTP_REFERER'])){
			$this->requestUrl = $_SERVER['HTTP_REFERER'];
		}else{
			$this->requestUrl = '/';
		}
	}
	/**
	 * gets the GET value of $name, returns the value if it exists or null if the key doesnt exist 
	 * @param string $name
	 * @return string $_GET[$name]
	 */
	public function getVar($name,$default = null)
	{
		return $_GET[$name]?$_GET[$name]:$default;
	}
	/**
	 * gets the POST value of $name, returns the value if it exists or null if the key doesnt exist
	 * @param string $name
	 * @return string $_POST[$name]
	 */
	public function postVar($name,$default = null)
	{
		return isset($_POST[$name])?$_POST[$name]:$default;
	}
	public function getAll($default = null){
		return !empty($_GET)?$_GET:$default;
	}
	public function postAll($default = null){
		return !empty($_POST)?$_POST:$default;
	}
	public function onCreate(){
		
	}
}