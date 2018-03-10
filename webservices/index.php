<?php
 header("Access-Control-Allow-Origin: *");
/**
 * Simple example of web service
 * @author R. Bartolome
 * @version v1.0
 * @return JSON messages with the format:
 * {
 * 	"code": mandatory, string '0' for correct, '1' for error
 * 	"message": empty or string message
 * 	"data": empty or JSON data
 * }
 *
 * This file can be tested from the browser:
 * http://localhost/webservice-php-json/service_test.php
 *
 * Based on
 * http://www.raywenderlich.com/2941/how-to-write-a-simple-phpmysql-web-service-for-an-ios-app
 */

	error_reporting(E_ALL);
	ini_set('display_errors', TRUE);
	ini_set('display_startup_errors', TRUE);

// the API file
require_once 'api.php';

// creates a new instance of the api class
$api = new api();

// the upload file calls
require_once 'fileUpload.php';

// creates a new instance of the upload file class
$fileUpload = new fileUpload();

// message to return
$message = array();

switch($_GET["action"])
{
	
    case 'getlabels':
		$params = array();
		$params['id'] = isset($_GET["id"]) ? $_GET["id"] : '';
		if (is_array($data = $api->getLabels($params))) {
			//$message["code"] = "0";
			$message["data"] = $data;
		} else {
			//$message["code"] = "1";
			$message["message"] = "Error on get method";
		}
	break;
	case 'insertlabel':
		//$lbl=json_decode(file_get_contents('php://input'));  //get lbl from 
		//return $lbl->name.''.$lbl->color; 
		
	     //$insdata = json_decode(file_get_contents("php://input"));
		$params = array();
		//$params['name'] = isset($insdata->name) ? $insdata->name : '';
		//$params['color'] = isset($insdata->color) ? $insdata->color : '';
		$params['name'] = isset($_POST['name']) ? $_POST['name'] : '';
		$params['color'] = isset($_POST['color']) ? $_POST['color'] : '';
		$data = $api->insertLabels($params);
			//$message["code"] = "0";
		$message["data"] = $data; 
	break;
	case 'updatelabel':
		$params = array();
		$params['id'] = isset($_POST["id"]) ? $_POST["id"] : '';
		$params['name'] = isset($_POST['name']) ? $_POST['name'] : '';
		$params['color'] = isset($_POST['color']) ? $_POST['color'] : '';
		$data = $api->updateLabels($params);
			//$message["code"] = "0";
		$message["data"] = $data; 
	break;
	case 'deletelabel':
		$params = array();
		$params['id'] = isset($_POST["id"]) ? $_POST["id"] : '';
		$data = $api->deleteLabel($params);
			//$message["code"] = "0";
		$message["data"] = $data; 
	break;
	case 'getnotes':
		$params = array();
		$params['id'] = isset($_GET["id"]) ? $_GET["id"] : '';
		if (is_array($data = $api->getNotes($params))) {
			//$message["code"] = "0";
			$message["data"] = $data;
		} else {
			//$message["code"] = "1";
			$message["message"] = "Error on get method";
		}
	break;
	case 'insertnotes':				
	     //$insdata = json_decode(file_get_contents("php://input"));
		$params = array();
		$params['title'] = isset($_POST['title']) ? $_POST['title'] : '';
		$params['description'] = isset($_POST['description']) ? $_POST['description'] : '';
		$params['archive'] = isset($_POST['archive']) ? $_POST['archive'] : '';
		$params['image'] = isset($_POST['image']) ? $_POST['image'] : '';
		$params['color'] = isset($_POST['color']) ? $_POST['color'] : '';
		$params['time'] = isset($_POST['time']) ? $_POST['time'] : '';
		$params['reminder'] = isset($_POST['reminder']) ? $_POST['reminder'] : '';
		/* $cklist = '';
		if(isset($_POST['checklist']))
		{
			foreach($_POST['checklist'] as $checklist)
			{
				$cklist.= implode(',',$checklist);
			}
		} */
		//$params['checklist'] = $cklist;
		$params['checklist'] = isset($_POST['checklist']) ? json_encode($_POST['checklist']) : '';
		$params['labels'] = isset($_POST['labels']) ? implode(',',$_POST['labels']) : '';
		$data = $api->insertNote($params);
			//$message["code"] = "0";
		$message["data"] = $data; 
	break;
	case 'getcontacts':
		$params = array();
		$params['id'] = isset($_GET["id"]) ? $_GET["id"] : '';
		if (is_array($data = $api->getContacts($params))) {
			//$message["code"] = "0";
			$message["data"] = $data;
		} else {
			//$message["code"] = "1";
			$message["message"] = "Error on get method";
		}
	break;
	case 'insertcontact':				
	     //$insdata = json_decode(file_get_contents("php://input"));
		$params = array();
		$params['name'] = isset($_POST['name']) ? $_POST['name'] : '';
		$params['lastName'] = isset($_POST['lastName']) ? $_POST['lastName'] : '';
		$params['avatar'] = 'images/profile.jpg';
		$params['nickname'] = isset($_POST['nickname']) ? $_POST['nickname'] : '';
		$params['company'] = isset($_POST['company']) ? $_POST['company'] : '';
		$params['jobTitle'] = isset($_POST['jobTitle']) ? $_POST['jobTitle'] : '';
		$params['email'] = isset($_POST['email']) ? $_POST['email'] : '';
		$params['phone'] = isset($_POST['phone']) ? $_POST['phone'] : '';
		$params['address'] = isset($_POST['address']) ? $_POST['address'] : '';
		$params['birthday'] = isset($_POST['birthday']) ? $_POST['birthday'] : '';
		$params['notes'] = isset($_POST['notes']) ? $_POST['notes'] : '';
		
		if(isset($_POST['avatar']) && !empty(isset($_POST['avatar'])) && strpos($_POST['avatar'], 'base64')){
				$fileUploadRes	= $fileUpload->upload($_POST['avatar']);
				$params['avatar'] = $fileUploadRes;
		}
		
		$data = $api->insertContact($params);
			//$message["code"] = "0";
		$message["data"] = $data; 
	break;
	case 'updatecontact':				
	     //$insdata = json_decode(file_get_contents("php://input"));
						
			
		
		
						
		$params = array();
		$params['id'] = isset($_POST["id"]) ? $_POST["id"] : '';
		$params['name'] = isset($_POST['name']) ? $_POST['name'] : '';
		$params['lastName'] = isset($_POST['lastName']) ? $_POST['lastName'] : '';
		$params['nickname'] = isset($_POST['nickname']) ? $_POST['nickname'] : '';
		$params['company'] = isset($_POST['company']) ? $_POST['company'] : '';
		$params['jobTitle'] = isset($_POST['jobTitle']) ? $_POST['jobTitle'] : '';
		$params['email'] = isset($_POST['email']) ? $_POST['email'] : '';
		$params['phone'] = isset($_POST['phone']) ? $_POST['phone'] : '';
		$params['address'] = isset($_POST['address']) ? $_POST['address'] : '';
		$params['notes'] = isset($_POST['notes']) ? $_POST['notes'] : '';
		/* 
		$params['avatar'] = isset($_POST['avatar']) ? $_POST['avatar'] : '';
		
		
		$params['birthday'] = isset($_POST['birthday']) ? $_POST['birthday'] : '';
		 */

		if(isset($_POST['avatar']) && !empty(isset($_POST['avatar'])) && strpos($_POST['avatar'], 'base64')){
				$fileUploadRes	= $fileUpload->upload($_POST['avatar']);
				$params['avatar'] = $fileUploadRes;
		}
		$data = $api->updateContact($params);
			//$message["code"] = "0";
		$message["data"] = $data; 
	break;
	default:
		//$message["code"] = "1";
		$message["message"] = "Unknown method " . $_POST["action"];
		break;
}

//the JSON message
header('Content-type: application/json; charset=utf-8');
//echo json_encode($message, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
echo json_encode($message);
exit;
?>
