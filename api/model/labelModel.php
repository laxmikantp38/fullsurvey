<?php
include_once("config/database.php");



class LabelModel {
  
  public function __construct()  
	{
      $db = new db();
      $this->db = $db->index();
  }

	function getLabels($params)
  {
      $query = 'SELECT u.id AS id'
		. ', u.name AS name'
		. ', u.color AS color'
		. ' FROM `labels` AS u'
		. ($params['id'] == ''? '' : ' WHERE u.id = \'' . $params['id'] . '\'')
		. ' ORDER BY u.name'
		;
      $sql = $this->db->query($query);
      $data = array();
      if($sql->num_rows > 0){
          while($result = $sql->fetch_assoc()){
              $data[] = $result;
          }
      }
      return $data;
  }
  
  function insertLabels($params){
    
      $query = "INSERT INTO `labels` (`name`, `color`, `createdDate`)
        VALUES ('".$this->db->real_escape_string($params['name'])."','".$this->db->real_escape_string($params['color'])."','".date('Y-m-d H:i:s')."')";
		
      $insert = $this->db->query($query);
      return $insert;    
  }
  
  function updateLabels($params){
    
    $paramsArr = array();
    forEach($params as $key=>$data){
      if(isset($data) && !empty($data) && $key != 'id'){
        $value = $this->db->real_escape_string($data);
        $paramsArr[] = "$key = '$value'";  
      }      
    }
    $paramsSqlArray = implode(', ', $paramsArr);    
    $query = sprintf("UPDATE %s SET %s WHERE id='%s'", '`labels`', $paramsSqlArray, $params['id']);
		$update = $this->db->query($query);
    return $update;
    
  }
  
  function deleteLabels($params){
      $query = "DELETE FROM  `labels` WHERE `id`=".$this->db->real_escape_string($params['id']);
      $delete = $this->db->query($query);
      return $delete;    
  }
        
}

?>
