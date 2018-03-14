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

	$link = $_SERVER['PHP_SELF'];
  $link_array = explode('/',$link);
  $controllerSlug = end($link_array);

  $requestedControllerName= $controllerSlug.'Controller';
  // if(file_exists($requestedControllerName.'.php')){
      include_once("controller/".$requestedControllerName.".php");

      $controller = new $requestedControllerName();

    	$requestmethod = (isset($_REQUEST['method']) && !empty($_REQUEST['method'])) ? $_REQUEST['method'] : '';
    	$requestService = strtolower(trim(str_replace("/","",$requestmethod)));


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
    	}else{
    		echo json_encode(array('status'=>500, 'msg'=>'Invalid  request !'));
    	}
    // }else{
    //   echo json_encode(array('status'=>500, 'msg'=>'Invalid  request !'));
    // }




?>
