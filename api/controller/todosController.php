<?php
include_once("model/todosModel.php");
session_start();

class TodosController {
	public $model;
	
	public function __construct()  
	{  
	    $this->model = new TodosModel();
	    header('Access-Control-Allow-Origin: *'); 
	    header('Access-Control-Allow-Headers: *');
	}
  
  public function get(){
    $params = array();
		$params['id'] = isset($_GET["id"]) ? $_GET["id"] : '';
		$todos = $this->model->getTodos($params);
		if(isset($todos) && !empty($todos))
		{
      $response['data'] = $todos;
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
		$params['notes'] = isset($_POST['notes']) ? strip_tags($_POST['notes']) : '';
		$params['startDate'] = isset($_POST['startDate']) ? $_POST['startDate'] : '';
		$params['dueDate'] = isset($_POST['dueDate']) ? $_POST['dueDate'] : '';
		$params['completed'] = isset($_POST['completed']) ? $_POST['completed'] : '';
		$params['starred'] = isset($_POST['starred']) ? $_POST['starred'] : '';
		$params['important'] = isset($_POST['important']) ? $_POST['important'] : '';
		$params['deleted'] = isset($_POST['deleted']) ? $_POST['deleted'] : ''; 
		//$params['tags'] = isset($_POST['tags']) ? implode(',',$_POST['tags']) : '';
        $params['tags'] = isset($_POST['tags']) ? json_encode($_POST['tags']) : '';
		
        $inserted = $this->model->insertTodos($params);
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
  
  public function update(){
    
    if(isset($_POST['id']) && !empty($_POST['id'])){
		$params['id'] = isset($_POST['id']) ? $_POST['id'] : '';
		$params['title'] = isset($_POST['title']) ? $_POST['title'] : '';
		$params['notes'] = isset($_POST['notes']) ? strip_tags($_POST['notes']) : '';
		$params['startDate'] = isset($_POST['startDate']) ? $_POST['startDate'] : '';
		$params['dueDate'] = isset($_POST['dueDate']) ? $_POST['dueDate'] : '';
		$params['completed'] = isset($_POST['completed']) ? $_POST['completed'] : '';
		$params['starred'] = isset($_POST['starred']) ? $_POST['starred'] : '';
		$params['important'] = isset($_POST['important']) ? $_POST['important'] : '';
		$params['deleted'] = isset($_POST['deleted']) ? $_POST['deleted'] : ''; 
		//$params['tags'] = isset($_POST['tags']) ? implode(',',$_POST['tags']) : '';
        $params['tags'] = isset($_POST['tags']) ? json_encode($_POST['tags']) : '';
		
         $updated = $this->model->updateTodos($params);
        //$updated = $this->model->updateTodos($_POST);
        if($updated)
        {
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
  
  
  function delete(){
    if(isset($_POST['id']) && !empty($_POST['id'])){
        $deleted = $this->model->deleteTodos($_POST);
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
  
  function completed(){
    if(isset($_POST['id']) && !empty($_POST['id'])){
        $completed = $this->model->toggleComplted($_POST);
        if($completed){
          $response['data'] = $completed;
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
  
  
  function important(){
    if(isset($_POST['id']) && !empty($_POST['id'])){
        $completed = $this->model->toggleImportant($_POST);
        if($completed){
          $response['data'] = $completed;
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
  
  
  function starred(){
    if(isset($_POST['id']) && !empty($_POST['id'])){
        $completed = $this->model->toggleStarred($_POST);
        if($completed){
          $response['data'] = $completed;
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