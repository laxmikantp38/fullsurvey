<?php
include_once("config/database.php");



class NotesModel {
  
  public function __construct()  
	{
      $db = new db();
      $this->db = $db->index();
  }

	function getNotes($params)
  {
      $query = 'SELECT u.id AS id'
		. ', u.title AS title'
		. ', u.description AS description'
		. ', u.archive AS archive'
		. ', u.image AS image'
		. ', u.color AS color'
		. ', u.time AS time'
		. ', u.reminder AS reminder'
		. ', u.checklist AS checklist'
		. ', u.labels AS labels'
		. ' FROM `notes` AS u'
		. ($params['id'] == ''? '' : ' WHERE u.id = \'' . $this->db->real_escape_string($params['id']) . '\'')
		. ' ORDER BY u.title'
		;
		$list = array();
		$result = $this->db->query($query);
		while ($row = $result->fetch_assoc())
		{
			//$list[] = $row;
			if($row['checklist']) {
				$ckl = json_decode($row['checklist']);
			}
			else{
				$ckl = array();
			}
			
			if($row['labels']) {
				$lbl = explode(',',$row['labels']);
			}
			else{
				$lbl = array();
			}
			
			
			$list[] = array('id'=>$row['id'],'title'=>$row['title'],'description'=>$row['description'],
			'archive'=>$row['archive'],'image'=>$row['image'],'color'=>$row['color'],'time'=>$row['time'],
			'reminder'=>$row['reminder'],'checklist'=>$ckl,'labels'=>$lbl);
			
			
		}
		return $list;
  }
  
  function insertNotes($params){
    
    $query = "INSERT INTO `notes` (`title`, `description`, `archive`, `image`, `color`, `time`, `reminder`, `checklist`, `labels`, `createdDate`)
        VALUES ('".$this->db->real_escape_string($params['title'])."','".$this->db->real_escape_string($params['description'])."',
		'".$this->db->real_escape_string($params['archive'])."','".$this->db->real_escape_string($params['image'])."',
		'".$this->db->real_escape_string($params['color'])."','".$this->db->real_escape_string($params['time'])."',
		'".$this->db->real_escape_string($params['reminder'])."','".$this->db->real_escape_string($params['checklist'])."',
		'".$this->db->real_escape_string($params['labels'])."','".date('Y-m-d H:i:s')."')";
		
		$insert = $this->db->query($query);
    return $insert;    
  }
  
  
    function deleteNotes($params){
      $query = "DELETE FROM  `notes` WHERE `id`=".$this->db->real_escape_string($params['id']);
      $delete = $this->db->query($query);
      return $delete;    
  }
  

   function updateNotes($params){
    
    $paramsArr = array();
    forEach($params as $key=>$data){
      if(isset($data) && !empty($data) && $key != 'id'){
        $value = $this->db->real_escape_string($data);
        $paramsArr[] = "$key = '$value'";  
      }      
    }
    $paramsSqlArray = implode(', ', $paramsArr);    
    $query = sprintf("UPDATE %s SET %s WHERE id='%s'", '`notes`', $paramsSqlArray, $params['id']);
		$update = $this->db->query($query);
    return $update;
    
  }
}

?>
