<?php
include_once("config/database.php");



class ContactModel {
  
  public function __construct()  
	{
      $db = new db();
      $this->db = $db->index();
  }

	function getContacts($params)
  {
      $query = 'SELECT u.id AS id'
		. ', u.name AS name'
		. ', u.lastName AS lastName'
		. ', u.avatar AS avatar'
		. ', u.nickname AS nickname'
		. ', u.company AS company'
		. ', u.jobTitle AS jobTitle'
		. ', u.email AS email'
		. ', u.phone AS phone'
		. ', u.address AS address'
		. ', u.birthday AS birthday'
		. ', u.notes AS notes'
		. ' FROM `contacts` AS u'
		. ($params['id'] == ''? '' : ' WHERE u.id = \'' . $this->db->real_escape_string($params['id']) . '\'')
		. ' ORDER BY u.name'
		;
		$list = array();
		$result = $this->db->query($query);
		while ($row = $result->fetch_assoc())
		{
			if(!isset($row['avatar']) || empty($row['avatar'])){
				$row['avatar'] = BASE_URL.'/'.IMAGE_PATH.'/'.'profile.jpg';
			}
			$row['avatar'] = BASE_URL.'/'.IMAGE_PATH.'/'.CONTACT_IMAGE_PATH.$row['avatar'];
			$list[] = $row;
		}
		return $list;
  }
  
  function insertContact($params){
    
		$query = "INSERT INTO `contacts` (`name`, `lastName`, `avatar`, `nickname`, `company`, `jobTitle`, `email`, `phone`, `address`, `birthday`, `notes`, `createdDate`)
        VALUES ('".$this->db->real_escape_string($params['name'])."','".$this->db->real_escape_string($params['lastName'])."',
		'".$this->db->real_escape_string($params['avatar'])."','".$this->db->real_escape_string($params['nickname'])."',
		'".$this->db->real_escape_string($params['company'])."','".$this->db->real_escape_string($params['jobTitle'])."',
		'".$this->db->real_escape_string($params['email'])."','".$this->db->real_escape_string($params['phone'])."',
		'".$this->db->real_escape_string($params['address'])."','".$this->db->real_escape_string($params['birthday'])."','".$this->db->real_escape_string($params['notes'])."','".date('Y-m-d H:i:s')."')";
		
		$insert = $this->db->query($query);
    return $insert;
  }
  
  function updateContact($params){
    $paramsArr = array();
    forEach($params as $key=>$data){
      if(isset($data) && !empty($data) && $key != 'id'){
        $value = $this->db->real_escape_string($data);
        $paramsArr[] = "$key = '$value'";  
      }      
    }
    $paramsSqlArray = implode(', ', $paramsArr);    
    $query = sprintf("UPDATE %s SET %s WHERE id='%s'", '`contacts`', $paramsSqlArray, $params['id']);
		$update = $this->db->query($query);
    return $update;
  }
  
}

?>
