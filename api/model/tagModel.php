<?php
include_once("config/database.php");



class TagModel {
  
  public function __construct()  
	{
      $db = new db();
      $this->db = $db->index();
  }
  
  
  function getTags($params)
  {
      $query = 'SELECT u.tags AS tags'
		. ' FROM `todos` AS u'
		. ($params['id'] == ''? '' : ' WHERE u.id = \'' . $this->db->real_escape_string($params['id']) . '\'')
		. ' WHERE deleted=false ORDER BY u.id desc'
		;
		$list = array();
		$result = $this->db->query($query);
		//$data =  new stdClass();
		$data =  array();
		$ckl = array();
		while ($row = $result->fetch_assoc())
		{
			//$list[] = $row;
			if($row['tags']) {
				$ckl[] = json_decode($row['tags']);
				
				
				//$ckl = explode(',',$row['tags']);
			}
			else{
				$ckl = array();
				$data[] = array();
			}
			
			/* if($row['labels']) {
				$lbl = explode(',',$row['labels']);
			}
			else{
				$lbl = array();
			} */
			
			
			//$list[] =  json_decode($row['tags']);
			
			
		}
		
		foreach($ckl as $k=>$t)
		{
			//$list[] = $t;
			/* if($t[$k]){
			echo'<pre>';
			print_r($t[$k]);
			} */
			
			foreach($t as $tag)
			{
				$list[] = array('name'=>$tag->name,'label'=>$tag->label,'color'=>$tag->color);
				/* $list[]['name'] = $tag->name;
				$list[]['label'] = $tag->label;
				$list[]['color'] = $tag->color; */
			}
			
		}
		
		//$list[] = $ckl;
		$list = array_map("unserialize", array_unique(array_map("serialize", $list)));
		return $list;
  }

	/* function getTags($params)
  {
      $query = 'SELECT u.id AS id'
		. ', u.name AS name'
		. ', u.label AS label'
		. ', u.color AS color'
		. ' FROM `tags` AS u'
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
  } */
  
  function insertTags($params){
    
      $query = "INSERT INTO `tags` (`name`, `label`, `color`, `createDate`)
        VALUES ('".$this->db->real_escape_string($params['name'])."','".$this->db->real_escape_string($params['label'])."','".$this->db->real_escape_string($params['color'])."','".date('Y-m-d H:i:s')."')";
		
      $insert = $this->db->query($query);
      return $insert;    
  }
  
  function updateTags($params){
    
    $paramsArr = array();
    forEach($params as $key=>$data){
      if(isset($data) && !empty($data) && $key != 'id'){
        $value = $this->db->real_escape_string($data);
        $paramsArr[] = "$key = '$value'";  
      }      
    }
    $paramsSqlArray = implode(', ', $paramsArr);    
    $query = sprintf("UPDATE %s SET %s WHERE id='%s'", '`tags`', $paramsSqlArray, $params['id']);
		$update = $this->db->query($query);
    return $update;
    
  }
  
  function deleteTags($params){
      $query = "DELETE FROM  `tags` WHERE `id`=".$this->db->real_escape_string($params['id']);
      $delete = $this->db->query($query);
      return $delete;    
  }
        
}

?>
