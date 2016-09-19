<?php

/**
 * a dynamic object for holding arbitrary data
 * @author Habbes
 *
 */
class DataObject
{
	protected $data;
	
	public function __construct($data = array())
	{
		$this->data = array();
		if($data)
			$this->loadData($data);
	}
	
	
	/**
	 * loads the data in the specified assocative array
	 * to the data in this object
	 * @param array $data
	 */
	public function loadData($data)
	{
		foreach($data as $key => $val){
			$this->set($key, $val);
		}
	}
	
	/**
	 * retrieve a property
	 * @param string $name data to retrive
	 * @param unknown $default the value returned when the specified property does not exist
	 * @return mixed
	 */
	public function get($name, $default = null)
	{
		if(array_key_exists($name, $this->data))
			return $this->data[$name];
		return $default;
	}
	
	/**
	 * add data to the object
	 * @param string $name
	 * @param mixed $value
	 */
	public function set($name, $value)
	{
		$this->data[$name] = $value;
	}
	
	public function __get($name)
	{
		return $this->get($name);
	}
	
	public function __set($name, $value)
	{
		return $this->set($name, $value);
	}
	
	public function __unset($name){
		unset($this->data[$name]);
	}
	
	/**
	 * checks whether this object has the specified attribute
	 * @param string $name
	 * @return boolean
	 */
	public function has($name)
	{
		return array_key_exists($name, $this->data);
	}
	
	/**
	 * returns all the data in this object in a dictionary array
	 * @return array
	 */
	public function toArray()
	{
		$a = array();
		foreach($this->data as $key => $value){
			$a[$key] = $value;
		}
		
		return $a;
	}
	
	/**
	 * returns the  number of data elements in this object
	 * @return number
	 */
	public function dataCount()
	{
		return count($this->data);
	}
}