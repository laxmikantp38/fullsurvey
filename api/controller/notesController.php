<?php
include_once("model/notesModel.php");
session_start();

class NotesController {
	public $model;
	
	public function __construct()  
	{  
	    $this->model = new NotesModel();
	    header('Access-Control-Allow-Origin: *'); 
	    header('Access-Control-Allow-Headers: *');
	    $postdata = file_get_contents("php://input");
	    $_POST = (array)json_decode($postdata);
	}
  
  public function get(){
    $params = array();
		$params['id'] = isset($_GET["id"]) ? $_GET["id"] : '';
		$notes = $this->model->getNotes($params);
		if(isset($notes) && !empty($notes))
		{
      $response['data'] = $notes;
      $response['status'] = 200;
      return $response;
		}else{
			$response['status'] = 200;
      return $response;
		}			
  }
  
  public function post(){
    if(isset($_POST['title']) && !empty($_POST['name'])
       && isset($_POST['description']) && !empty($_POST['description'])
       && isset($_POST['archive']) && !empty($_POST['archive'])
       //&& isset($_POST['image']) && !empty($_POST['image'])
       && isset($_POST['time']) && !empty($_POST['time'])
       && isset($_POST['reminder']) && !empty($_POST['reminder'])
       ){
        
        $inserted = $this->model->insertNotes($_POST);
        if($inserted)
        {
          $response['data'] = $inserted;
          $response['status'] = 200;
          return $response;
        }else{
          $response['status'] = 201;
          return $response;
        }
    }else{
      $response['status'] = 202;
      return $response;
    }
  }
  

	
	
}

?>