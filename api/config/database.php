<?php

class db {
  
  public function index(){

      $connection = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
      
      if ($connection->connect_error) {
          die("Databse connection failed: " . $connection->connect_error);
      } 
      return $connection;
  }
  
}
	
?>
