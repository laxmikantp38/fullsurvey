<?php
include_once("model/tagModel.php");
session_start();

class TagController {
	public $model;
	
	public function __construct()  
	{  
	    $this->model = new TagModel();
	    header('Access-Control-Allow-Origin: *'); 
	    header('Access-Control-Allow-Headers: *');
	}
  
  public function get(){
    $params = array();
		$params['id'] = isset($_GET["id"]) ? $_GET["id"] : '';
		$labels = $this->model->getTags($params);
		if(isset($labels) && !empty($labels))
		{
      $response['data'] = $labels;
      $response['status'] = 200;
      return $response;
		}else{
			$response['status'] = 200;
      return $response;
		}			
  }
  
  public function post(){
    if(isset($_POST['name']) && !empty($_POST['name'])){
        
        $inserted = $this->model->insertTags($_POST);
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
  
  public function update(){
    if(isset($_POST['id']) && !empty($_POST['id'])
      && (isset($_POST['color']) && !empty($_POST['color']) ||  isset($_POST['name']) && !empty($_POST['name']))){

        $updated = $this->model->updateTags($_POST);
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
  
  public function delete(){
    if(isset($_POST['id']) && !empty($_POST['id'])){
        $deleted = $this->model->deleteTags($_POST);
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



	
	
}

?>