<?php
include_once("model/contactModel.php");
session_start();

class ContactController {
	public $model;
	
	public function __construct()  
	{  
	    $this->model = new ContactModel();
	    header('Access-Control-Allow-Origin: *'); 
	    header('Access-Control-Allow-Headers: *');
	    $postdata = file_get_contents("php://input");
	    $_POST = (array)json_decode($postdata);
	}
  
  public function get(){
    $params = array();
		$params['id'] = isset($_GET["id"]) ? $_GET["id"] : '';
		$contacts = $this->model->getContacts($params);
		if(isset($contacts) && !empty($contacts))
		{
      $response['data'] = $contacts;
      $response['status'] = 200;
      return $response;
		}else{
			$response['status'] = 200;
      return $response;
		}			
  }
  
  public function post(){
    
    if(isset($_POST['name']) && !empty($_POST['name'])){        
        if(isset($_POST['avatar']) && !empty(isset($_POST['avatar'])) && strpos($_POST['avatar'], 'base64')){
            $fileUploadPath = IMAGE_PATH.'/'.CONTACT_IMAGE_PATH;
            $fileUploadRes	= $fileUpload->upload($fileUploadPath, $_POST['avatar']);
            if(isset($fileUploadRes) && !empty($fileUploadRes)){
              $_POST['avatar'] = $fileUploadRes;  
            }else{
              $_POST['avatar'] = 'profile.jpg';
            }            
        }
        
        $inserted = $this->model->insertContact($_POST);
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
    
    if(isset($_POST['id']) && !empty($_POST['id'])){
        
        if(isset($_POST['avatar']) && !empty(isset($_POST['avatar'])) && strpos($_POST['avatar'], 'base64')){
            $fileUploadPath = IMAGE_PATH.'/'.CONTACT_IMAGE_PATH;
            $fileUploadRes	= $fileUpload->upload($fileUploadPath, $_POST['avatar']);
            if(isset($fileUploadRes) && !empty($fileUploadRes)){
              $_POST['avatar'] = $fileUploadRes;  
            }else{
              $_POST['avatar'] = 'profile.jpg';
            }
        }

        $updated = $this->model->updateContact($_POST);
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
  

	
	
}

?>