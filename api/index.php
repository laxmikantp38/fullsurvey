<?php 
ob_start();

//error_reporting(E_ALL^E_WARNING^E_NOTICE);
//ini_set("display_errors", 1);
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);

  
header('Access-Control-Allow-Origin: *'); 
header('Access-Control-Allow-Headers: *');

require_once('config/config.php');
require_once('helper/response.php');

$response = new Response();

define('BASEURL', 'http://localhost:3001');

	$link = $_SERVER['PHP_SELF'];
  $link_array = explode('/',$link);
  $controllerSlug = end($link_array);
  
  $requestedControllerName= $controllerSlug.'Controller';
  
  include_once("controller/".$requestedControllerName.".php");
  
  
  $controller = new $requestedControllerName();
  
	$requestmethod = (isset($_REQUEST['requestmethod']) && !empty($_REQUEST['requestmethod'])) ? $_REQUEST['requestmethod'] : '';
	$requestService = strtolower(trim(str_replace("/","",$requestmethod)));
 //$postdata = file_get_contents("php://input");
 //   $request = json_decode($postdata);
	
	if(isset($requestService) && !empty($requestService))
	{
		if(method_exists($controller, $requestService))
		{
			$controllerResponse = $controller->$requestService();
      $data = array();
      $status = '';
      if(isset($controllerResponse['data'])){
        $data = $controllerResponse['data'];
      }
      if(isset($controllerResponse['status'])){
        $status = $controllerResponse['status'];
      }
      echo $response::global_message($status, $data);
      exit;
		}else{
			echo $response::notFound();
      exit;
		}
	}
	else
	{
		echo json_encode(array('status'=>500, 'msg'=>'Invalid  request !'));
	}
  
  
  
	
?>