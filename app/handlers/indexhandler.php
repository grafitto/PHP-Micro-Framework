<?php
class IndexHandler extends LoggedInHandler{
	public function get(){	
		Render::view("index",[],null);
	}
	public function post(){
		
	}

}