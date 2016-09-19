<?php
require_once "requesthandler.php";

class loggedInHandler extends requestHandler{
	protected $user;

	public function onCreate(){
		if(!Login::isLoggedIn()){
			redirect('/account/login');
		}else{
			$this->user = Login::user();
		}
	}
}