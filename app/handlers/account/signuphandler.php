<?php
class signupHandler extends requestHandler{
	
	public function get(){
		Render::view("account.signup");
	}
	
	public function post(){
		$landlord = new Landlord();
		$landlord->name = $this->postVar("fullname");
		$landlord->national_id = $this->postVar("nationalid");
		$landlord->phone_number = $this->postVar("phonenumber");
		$landlord->enrolled_at = strftime("%Y-%m-%d %H:%M:%S",time());
		$landlord->user_name = $this->postVar("username");
		$landlord->email = $this->postVar('email');
		$landlord->password = password_hash($this->postVar("password"),PASSWORD_BCRYPT);
		if($landlord->save()){
			if(Login::authenticate($this->postVar("username"), $this->postVar("password"), "landlord")){
				redirect('/home',['success' => 'Account created successfully']);
			}else{
				redirect('/account/login',['success' => 'Account created successfully. Log in to start']);
			}
		}else{
			debug("Failed");
		}
	}
}