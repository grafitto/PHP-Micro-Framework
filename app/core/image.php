<?php
class Image{
	private $tmp_file;
	private $path;
	private $newPath;
	private $name;
	private $size;
	private $type;
	private $error;
	private $user;
	
	public function __construct($file,$user){
		$this->user = $user;
		$this->path = "../app/data/".$this->user->user_name;
		$this->tmp_file = $file['tmp_name'];
		$this->name = $file['name'];
		$this->size = $file['size'];
		$this->type = $file['type'];
	}
	public function move(){
		if(!file_exists($this->path)){
			mkdir($this->path,0777,true);
		}
		$this->newPath = $this->path . DIRECTORY_SEPARATOR . $this->name;
		if(!file_exists($this->newPath)){
			if(move_uploaded_file($this->tmp_file,$this->newPath)){
				return true;
			}else{
				return false;
			}
		}
	}
	public function getName(){
		return $this->user->user_name . "/" . $this->name;
	}
	public function validate(){
		if($this->type !== "image/jpg" || $this->type !== "image/jpg" || $this->type !== "image/png" || $this->type !== "image/gif"){
			return true;
		}
	}
	public static function remove($name,$user){
		$dir = "../app/data/". $name;
		if(file_exists($dir)){
			return unlink($dir);
		}else{
			return true;
		}
	}
}