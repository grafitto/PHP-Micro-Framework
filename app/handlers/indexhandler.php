<?php
class IndexHandler extends requestHandler{
	public function get(){	
		Render::view("index",[],null);
		
	}
	public function post(){
		
	}

}