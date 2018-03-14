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
    $params = array();
		$params['title'] = isset($_POST['title']) ? $_POST['title'] : '';
		$params['description'] = isset($_POST['description']) ? $_POST['description'] : '';
		$params['archive'] = isset($_POST['archive']) ? $_POST['archive'] : '';
		$params['image'] = isset($_POST['image']) ? $_POST['image'] : '';
		$params['color'] = isset($_POST['color']) ? $_POST['color'] : '';
		$params['time'] = isset($_POST['time']) ? $_POST['time'] : '';
		$params['reminder'] = isset($_POST['reminder']) ? $_POST['reminder'] : '';
    $params['checklist'] = isset($_POST['checklist']) ? json_encode($_POST['checklist']) : '';
		$params['labels'] = isset($_POST['labels']) ? implode(',',$_POST['labels']) : '';
        $inserted = $this->model->insertNotes($params);
        if($inserted)
        {
          $response['data'] = $inserted;
          $response['status'] = 200;
          return $response;
        }else{
          $response['status'] = 201;
          return $response;
        }
    
  }
  
  
  function delete(){
    if(isset($_POST['id']) && !empty($_POST['id'])){
        $deleted = $this->model->deleteNotes($_POST);
        if($deleted){
          $response['data'] = $deleted;
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
  

   public function update(){
    $params = array();
    $params['title'] = isset($_POST['title']) ? $_POST['title'] : '';
    $params['description'] = isset($_POST['description']) ? $_POST['description'] : '';
    $params['archive'] = isset($_POST['archive']) ? $_POST['archive'] : '';
    $params['image'] = isset($_POST['image']) ? $_POST['image'] : '';
    $params['color'] = isset($_POST['color']) ? $_POST['color'] : '';
    $params['time'] = isset($_POST['time']) ? $_POST['time'] : '';
    $params['reminder'] = isset($_POST['reminder']) ? $_POST['reminder'] : '';
    $params['checklist'] = isset($_POST['checklist']) ? json_encode($_POST['checklist']) : '';
    $params['labels'] = isset($_POST['labels']) ? implode(',',$_POST['labels']) : '';
    if(isset($_POST['id']) && !empty($_POST['id'])){
      $params['id'] = $_POST['id'];
        $updated = $this->model->updateNotes($params);
        if($updated){
          $response['data'] = $updated;
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