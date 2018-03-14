<?php
include_once("config/database.php");



class TodosModel {
  
  public function __construct()  
	{
      $db = new db();
      $this->db = $db->index();
  }

	function getTodos($params)
  {
      $query = 'SELECT u.id AS id'
		. ', u.title AS title'
		. ', u.notes AS notes'
		. ', u.startDate AS startDate'
		. ', u.dueDate AS dueDate'
		. ', u.completed AS completed'
		. ', u.starred AS starred'
		. ', u.important AS important'
		. ', u.deleted AS deleted'
		. ', u.tags AS tags'
		. ' FROM `todos` AS u'
		. ($params['id'] == ''? '' : ' WHERE u.id = \'' . $this->db->real_escape_string($params['id']) . '\'')
		. ' WHERE deleted=false ORDER BY u.title'
		;
		$list = array();
		$result = $this->db->query($query);
		while ($row = $result->fetch_assoc())
		{
			//$list[] = $row;
			if($row['tags']) {
				$ckl = json_decode($row['tags']);
				//$ckl = explode(',',$row['tags']);
			}
			else{
				$ckl = array();
			}
			
			/* if($row['labels']) {
				$lbl = explode(',',$row['labels']);
			}
			else{
				$lbl = array();
			} */
			
			$cm = $row['completed'] === 'true'? true: false;
			$str = $row['starred'] === 'true'? true: false;
			$im = $row['important'] === 'true'? true: false;
			$dl = $row['deleted'] === 'true'? true: false;
			
			$list[] = array('id'=>$row['id'],'title'=>$row['title'],'notes'=>strip_tags($row['notes']),
			'startDate'=>$row['startDate'],'dueDate'=>$row['dueDate'],'completed'=>$cm,'starred'=>$str,
			'important'=>$im,'deleted'=>$dl,'tags'=>$ckl);
			
			
		}
		return $list;
  }
  
  function insertTodos($params){
    
    $query = "INSERT INTO `todos` (`title`, `notes`, `startDate`, `dueDate`, `completed`, `starred`, `important`, `deleted`, `tags`, `created_date`)
        VALUES ('".$this->db->real_escape_string($params['title'])."','".$this->db->real_escape_string($params['notes'])."',
		'".$this->db->real_escape_string($params['startDate'])."','".$this->db->real_escape_string($params['dueDate'])."',
		'".$this->db->real_escape_string($params['completed'])."','".$this->db->real_escape_string($params['starred'])."',
		'".$this->db->real_escape_string($params['important'])."','".$this->db->real_escape_string($params['deleted'])."',
		'".$this->db->real_escape_string($params['tags'])."','".date('Y-m-d H:i:s')."')";
		
		$insert = $this->db->query($query);
    return $insert;    
  }
  
  function updateTodos($params){
    $paramsArr = array();
    forEach($params as $key=>$data){
      if(isset($data) && !empty($data) && $key != 'id'){
        $value = $this->db->real_escape_string($data);
        $paramsArr[] = "$key = '$value'";  
      }      
    }
    $paramsSqlArray = implode(', ', $paramsArr);    
    $query = sprintf("UPDATE %s SET %s WHERE id='%s'", '`todos`', $paramsSqlArray, $params['id']);
		$update = $this->db->query($query);
    return $update;
  }
  
  
    function deleteTodos($params){
      //$query = "DELETE FROM  `todos` WHERE `id`=".$this->db->real_escape_string($params['id']);
	  $query = "UPDATE `todos` SET `deleted`='true'  WHERE `id`=".$this->db->real_escape_string($params['id']);
      $delete = $this->db->query($query);
      return $delete;    
  }
  
  function toggleComplted($params){
      //$query = "DELETE FROM  `todos` WHERE `id`=".$this->db->real_escape_string($params['id']);
	  $query = "UPDATE `todos` SET `completed`='".$this->db->real_escape_string($params['completed'])."'  WHERE `id`=".$this->db->real_escape_string($params['id']);
      $delete = $this->db->query($query);
      return $delete;    
  }
  
  
  function toggleImportant($params){
      //$query = "DELETE FROM  `todos` WHERE `id`=".$this->db->real_escape_string($params['id']);
	  $query = "UPDATE `todos` SET `important`='".$this->db->real_escape_string($params['important'])."'  WHERE `id`=".$this->db->real_escape_string($params['id']);
      $delete = $this->db->query($query);
      return $delete;    
  }
  
  function toggleStarred($params){
      //$query = "DELETE FROM  `todos` WHERE `id`=".$this->db->real_escape_string($params['id']);
	  $query = "UPDATE `todos` SET `starred`='".$this->db->real_escape_string($params['starred'])."'  WHERE `id`=".$this->db->real_escape_string($params['id']);
      $delete = $this->db->query($query);
      return $delete;    
  }
  
}

?>
