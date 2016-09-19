<?php
require_once("../env.php");

class DatabaseObject{
    private static $database;
    
    public static function connect(){
        self::$database = new mysqli(HOST,ROOT,PASS,DATABASE);
        //self::$database_select = mysqli_select_db(self::$database,DATABASE);
    }
    /*
    @return self::$database
     
     */
    public function getDatabase(){
        return self::$database;
    }
    public static function query($sql){
       return mysqli_query(self::$database,$sql);
    }
    public static function close(){
        mysqli_close(self::$database);
        //echo "Database closed<br />";
    }
    public static function insertId(){
        return mysqli_insert_id(self::$database);
    }
    public static function assoc($result){
        return mysqli_fetch_assoc($result);
    }
    public static function rows($result){
        return mysqli_num_rows($result);
    }
    public static function prepare($string){
            if(!get_magic_quotes_gpc()){$string = addslashes($string);}
                else return false;
            return $string;
    }
    public static function error(){
    	return mysqli_error(self::$database);
    }
    private static function type($item){
    	$type = "";
    	switch(gettype($item)){
    		case "string":
    			return "s";
    		case "integer":
    			return "i";
    		case "double":
    			return "d";
    	}
    	return false;
   }
}
?>