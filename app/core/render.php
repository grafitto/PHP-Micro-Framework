<?php
class Render{
	private static $path = '/app/views/';

	/*
	 * This is what is used to render content to a view
	 * @return nothing
	 */
	public static function view($view,$data = NULL,$user = NULL,$hasArrays = false){
		$temp = [];
		if(!is_null($data)){
			if($hasArrays && is_array($data)){
				foreach($data as $d){
					$temp[] = new DataObject($d->toArray());
				}
				$data = $temp;
			}else{
				$data = new DataObject($data);
			}
		}
		$url = str_replace(".", "/", $view) . "view.php";
		include self::$path . $url;
	}
}