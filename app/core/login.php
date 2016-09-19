<?php
class Login{
	private static $user;
	
	public static function isLoggedIn(){
		return Session::has('user');
	}
	public static function user(){
		if(!self::$user){
			if(Login::isLoggedIn()){
				$class = ucfirst(Session::get('rank'));
				self::$user = $class::find(Session::get('id'));
				return self::$user;
			}else{
				return false;
			}
		}else{
			return self::$user;
		}
	}
	public static function authenticate($username,$password,$table){
		$class = ucfirst($table);
		$sql = "SELECT * FROM {$table} WHERE user_name='{$username}' OR national_id='{$username}' OR phone_number='{$username}' OR email='{$username}'";
		
		DatabaseObject::connect();
		
		$res = DatabaseObject::query($sql);
		
		$row = [];
		//debug($sql);
		if(DatabaseObject::rows($res) > 0){
			while($data = DatabaseObject::assoc($res)){
				$row[] = $data;
			}
			$row = $row[0];
			
			if(password_verify($password,$row['password'])){
				
				Session::set('national_id', $row['national_id']);
				Session::set('id',$row['id']);
				Session::set('rank', $table);
				self::$user = $class::find(Session::get('id'));
				
				return self::$user;
			}else{
				return false;
			}
		}else{
			return false;
		}
	}
	/*
	 * Logs out the user
	 */
	public static function logout(){
		self::$user = NULL;
		Session::clear();
		session_destroy();
	}
}