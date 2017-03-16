<?php
class Model extends DatabaseObject{
	
	public function __construct(){
		self::connect();
	}
	/*deletes
	 * 
	 */
	public function clear(){
		$class = get_called_class();
		$table = strtolower($class);
		
		$sql = "DELETE FROM {$table} WHERE id={$this->id}";
		self::connect();
		$result = self::query($sql);
		self::close();
		
		return $result;
	}
	/*
	 * This saves an object to the database
	 * $return bool
	 */
	public function save(){
		if(!isset($this->in_trash) || is_null($this->in_trash))
			$this->in_trash = 0;
		if(isset($this->id) && !is_null($this->id)){
			return $this->update();
		}else{
			return $this->persist();
		}
	}
	private function persist(){
		$class = get_called_class();
		$table = strtolower($class);
		$attribs = get_class_vars(get_called_class());
		
		foreach($attribs as $key => $value){
			$attribs[$key] = $this->$key;
		}
		unset($attribs['id']);
		$h = array_keys(get_class_vars($class));
		unset($h[0]);
		$handles = (string)implode(",",$h);
		$values = [];
		foreach($attribs as $key => $value){
			if(is_string($attribs[$key])){
				$attribs[$key] = "'".$value."'";
			}else if(is_null($attribs[$key])){
				$attribs[$key] = 'NULL';
			}
		}
		$values = implode(",",array_values($attribs));
		$sql = "INSERT INTO {$table} ({$handles}) VALUES ({$values})";
		//debug($sql);
		self::connect();
		self::query($sql);
		$this->id = self::insertId();
		if($this->id)
			return true;
		return false;
	}
	/**
	 * Used to update a user
	 */
	private function update(){
		$class = get_called_class();
		$table = strtolower($class);
		$attribs = get_class_vars(get_called_class());
		
		foreach($attribs as $key => $value){
			$attribs[$key] = $this->$key;
		}
		unset($attribs['id']);
		
		$values = "";
		$tempArrayValues = [];
		foreach($attribs as $key => $value){
			if($key == "phone_number"){
				settype($value,"string");
			}
			if(is_string($value)){
				$value = "'" . $value . "'";
			}else if(is_numeric($value)){
				$value = $value;
			}else if(is_null($value)){
				$value = 'NULL';
			}
			$values .= $key . " = " . $value . ",";
		}
		$values = rtrim($values,",");
		
		$sql = "UPDATE {$table} SET {$values} WHERE id={$this->id}";
		
		self::connect();
		$res = self::query($sql);
		if($res)
			return true;
		return false;
	}
	/**
	 * Magic method used to access a variable by name 
	 * @param string $name
	 * @return NULL
	 */
	public function __get($name){
			return $this->$name;
	}
	/*
	 * Magic Method used to set a an attribute $name to $value
	 * @param string $name,$alue
	 * @return NULL
	 */
	public function __set($name,$value){
			$this->$name = $value;
	}
	/**
	 * Used to fetch a record from the database
	 * @param int $id
	 */
	public static function find($id,$table = NULL){
		$class = get_called_class();
		if(is_null($table)){
			$table = strtolower($class);
		}
		//Open connection
		self::connect();
		
		//create a query and fetch records
		$sql = "SELECT * FROM {$table} WHERE id={$id}";
		$records = self::query($sql);
		
		$data = [];
			if($records && self::rows($records)){
				while($record = self::assoc($records)){
					$data[] = $record;
				}
				self::close();
				$data = $data[0];
				foreach($data as $key => $value){
					if($key === "phone_number"){
						settype($value,"string");
					}
					if(is_double($value)){
						settype($data[$key], "double");
					}else if(is_numeric($value)){
						settype($data[$key], "integer");
					}
				}
				return self::createModel($data,$class);
				//return $model;
			}
		return false;
	}
	/*
	 * This is used to get all the model instances from the database
	 * $param optional string $table
	 * $return array Model
	 */
	private static function fetch($table = NULL,$trash = false){
		$class = get_called_class();
		if(is_null($table)){
			$table = strtolower($class);
		}
		//create query
			if($trash){
				$sql = "SELECT * FROM {$table}"; //this includes trash
			}else{
				$sql = "SELECT * FROM {$table} WHERE in_trash = 0 OR in_trash IS NULL"; //this doesnt include trash
			}
		//Open connection
	
		self::connect();
		
		$records = self::query($sql);
		
		$data = [];
		if(self::rows($records) > 0){
			while($record = self::assoc($records)){
				$data[] = $record;
			}
		
			//Close connection
			self::close();
		//cast types
			foreach($data as $key => $value){
				if(is_double($value)){
					settype($data[$key], "double");
				}else if(is_numeric($value)){
					settype($data[$key], "integer");
				}
			}
			
			$models = [];
			foreach($data as $single){
				$models[] = self::createModel($single, $class);
			}
			
			return $models;
		}
		return false;
	}
	/**
	 * Returns all records excluding the trash can
	 * @return array records
	 */
	public static function all(){
		return self::fetch(NULL,false);
	}
	/**
	 * This marks a record as deleted
	 * returns bool
	 */
	public function delete(){
		//first chek if the record exists in the system
		if(!isset($this->id) || is_null($this->id)){
			return false;
		}
		$table = strtolower(get_class($this));
		$time = strftime("%Y-%m-%d %H:%M:%S",time());
		$sql = "UPDATE {$table} SET in_trash = 1, left_at = '{$time}' WHERE id={$this->id}";
		echo ($sql);
		self::connect();
		$res = self::query($sql) or die(self::error());
		//debug($res);
		if($res)
			return true;
		return false;
	}
	/*
	 * Changes the model to array
	 * @return array
	 */
	public function toArray(){
		$array = get_class_vars(get_called_class());
		
		foreach($array as $key => $value){
			$array[$key] = $this->$key;
		}
		return $array;
	}
	/*
	 * A relationship where the model belongs to this
	 * Populates a class with the data from the database
	 * $returns model
	 */
	public function hasOne($property){
		if(isset($this->id)){
			$table = strtolower($property);
			return $property::find($this->id);
		}else{
			return false;
		}
	}
	public function belongsTo($property){
		$localid = strtolower($property) . "_id";
		return $property::find($this->$localid);
	}
	/*
	 * A relationship where many models belong to this
	 * Populates a class with the data from the database
	 * $returns array model
	 */
	public function hasMany($property){
		$attribute = strtolower(get_class($this)) . "_id";
		if(isset($this->id)){
			$table = strtolower($property);
			$res =  $property::get($attribute,$this->id);
			if($res)
				return $res;
			return [];
		}
	}
	/**
	 * This sends a message to a number using africastalking API
	 * returns results
	 */
	public function sendSMS($message, $recipient){
		$gateway = new AfricasTalkingGateway(SMS_API_NAME, SMS_API_KEY);
		$results = $gateway->sendMessage($recipient, $message);
		return $results;
	}
	private static function createModel($data,$class){
		$model = new $class;
		
		foreach($data as $key => $value){
			$model->$key = $value;
		}
		return $model;
	}
	public function toJSON(){
		return json_encode($this->toArray());
	}
}
