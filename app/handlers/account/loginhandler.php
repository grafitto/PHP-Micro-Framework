<?php
class loginHandler extends requestHandler{
	
	/*
	 * Used to render login view
	 */
	public function get(){
		Render::view("account.login");
	}
	/*
	 * Used to get login data
	 */
	public function post(){
		$username = $this->postVar("username");
		$password = $this->postVar("password");
		$table = USER_TABLE;
		
		if(Login::authenticate($username, $password, $table)){
			redirect('/home');
		}else{
			redirect('/account/login',['error' => 'Incorrect Username/Password.']);
		}
	}
	public function logout(){
		Login::logout();
		redirect('/');
	}
	public function onCreate(){
		
	}
}