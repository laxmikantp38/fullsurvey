<?php
/**
 * API class
 * @author Rob
 * @version 2015-06-22
 */

class api
{
	private $db;

	/**
	 * Constructor - open DB connection
	 *
	 * @param none
	 * @return database
	 */
	function __construct()
	{
		$conf = json_decode(file_get_contents('configuration.json'), TRUE);
		$this->db = new mysqli($conf["host"], $conf["user"], $conf["password"], $conf["database"]);
	}

	/**
	 * Destructor - close DB connection
	 *
	 * @param none
	 * @return none
	 */
	function __destruct()
	{
		$this->db->close();
	}

	
	
	function getLabels($params)
	{
		$query = 'SELECT u.id AS id'
		. ', u.name AS name'
		. ', u.color AS color'
		. ' FROM `labels` AS u'
		. ($params['id'] == ''? '' : ' WHERE u.id = \'' . $this->db->real_escape_string($params['id']) . '\'')
		. ' ORDER BY u.name'
		;
		$list = array();
		$result = $this->db->query($query);
		while ($row = $result->fetch_assoc())
		{
			$list[] = $row;
		}
		return $list;
	}
	
	function insertLabels($params)
	{		
		
		$query = "INSERT INTO `labels` (`name`, `color`, `createdDate`)
        VALUES ('".$this->db->real_escape_string($params['name'])."','".$this->db->real_escape_string($params['color'])."','".date('Y-m-d H:i:s')."')";
		
		$insert = $this->db->query($query);
		if($insert)
		{
			$msg = 'Inserted successfully';
		}
		else{
			$msg = 'Internet error';
		}
		
		
		return $msg;
	}
	
	function updateLabels($params)
	{	
     	
		$query = "UPDATE  `labels` SET `name`='".$this->db->real_escape_string($params['name'])."',`color`='".$this->db->real_escape_string($params['color'])."'
         WHERE `id`=".$this->db->real_escape_string($params['id']);
		
		$update = $this->db->query($query);
		if($update)
		{
			$msg =  'Updated successfully';
		}
		else{
			$msg =  'Internet error';
		}
		
		return $msg;
	}
	
	
	function deleteLabel($params)
	{			
		$query = "DELETE FROM  `labels` WHERE `id`=".$this->db->real_escape_string($params['id']);
		
		$delete = $this->db->query($query);
		if($delete)
		{
			$msg = 'Deleted successfully';
		}
		else{
			$msg = 'Internet error';
		}
		
		return $msg;
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
	
	function insertNote($params)
	{		
		
		//$insert = mysql_insert_array("notes", $_POST, "submit");
		$query = "INSERT INTO `notes` (`title`, `description`, `archive`, `image`, `color`, `time`, `reminder`, `checklist`, `labels`, `createdDate`)
        VALUES ('".$this->db->real_escape_string($params['title'])."','".$this->db->real_escape_string($params['description'])."',
		'".$this->db->real_escape_string($params['archive'])."','".$this->db->real_escape_string($params['image'])."',
		'".$this->db->real_escape_string($params['color'])."','".$this->db->real_escape_string($params['time'])."',
		'".$this->db->real_escape_string($params['reminder'])."','".$this->db->real_escape_string($params['checklist'])."',
		'".$this->db->real_escape_string($params['labels'])."','".date('Y-m-d H:i:s')."')";
		
		$insert = $this->db->query($query);
		
		if($insert)
		{
			$msg = 'Inserted successfully';
		}
		else{
			$msg = 'Internet error';
		}
		
		
		return $msg;
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
				$row['avatar'] = 'images/profile.jpg';
			}
			$row['avatar'] = 'http://localhost/websites/osteen/newfuse/webservices/'.$row['avatar'];
			$list[] = $row;
		}
		return $list;
	}
	
	function insertContact($params)
	{		
		
		//$insert = mysql_insert_array("notes", $_POST, "submit");
		$query = "INSERT INTO `contacts` (`name`, `lastName`, `avatar`, `nickname`, `company`, `jobTitle`, `email`, `phone`, `address`, `birthday`, `notes`, `createdDate`)
        VALUES ('".$this->db->real_escape_string($params['name'])."','".$this->db->real_escape_string($params['lastName'])."',
		'".$this->db->real_escape_string($params['avatar'])."','".$this->db->real_escape_string($params['nickname'])."',
		'".$this->db->real_escape_string($params['company'])."','".$this->db->real_escape_string($params['jobTitle'])."',
		'".$this->db->real_escape_string($params['email'])."','".$this->db->real_escape_string($params['phone'])."',
		'".$this->db->real_escape_string($params['address'])."','".$this->db->real_escape_string($params['birthday'])."','".$this->db->real_escape_string($params['notes'])."','".date('Y-m-d H:i:s')."')";
		
		$insert = $this->db->query($query);
		
		if($insert)
		{
			$msg = 'Inserted successfully';
		}
		else{
			$msg = 'Internet error';
		}
		
		
		return $msg;
	}
	
	function updateContact($params)
	{	
		 /* $query = "UPDATE  `contacts` SET `name`='".$this->db->real_escape_string($params['name'])."',
		 `lastName`='".$this->db->real_escape_string($params['lastName'])."',`avatar`='".$this->db->real_escape_string($params['avatar'])."',
		 `nickname`='".$this->db->real_escape_string($params['nickname'])."',`company`='".$this->db->real_escape_string($params['company'])."',
		 `jobTitle`='".$this->db->real_escape_string($params['jobTitle'])."',`email`='".$this->db->real_escape_string($params['email'])."',
		 `phone`='".$this->db->real_escape_string($params['phone'])."',`address`='".$this->db->real_escape_string($params['address'])."',
		 `birthday`='".$this->db->real_escape_string($params['birthday'])."',`notes`='".$this->db->real_escape_string($params['notes'])."',
         WHERE `id`=".$this->db->real_escape_string($params['id']); */
		 
		 $query = "UPDATE  `contacts` SET `name`='".$this->db->real_escape_string($params['name'])."',
		`lastName`='".$this->db->real_escape_string($params['lastName'])."',`avatar`='".$this->db->real_escape_string($params['avatar'])."',
		 `nickname`='".$this->db->real_escape_string($params['nickname'])."',`company`='".$this->db->real_escape_string($params['company'])."',
		 `jobTitle`='".$this->db->real_escape_string($params['jobTitle'])."',`email`='".$this->db->real_escape_string($params['email'])."',
		 `phone`='".$this->db->real_escape_string($params['phone'])."',`address`='".$this->db->real_escape_string($params['address'])."',
		 `notes`='".$this->db->real_escape_string($params['notes'])."' 
		 WHERE `id`=".$this->db->real_escape_string($params['id']);
		 
		 
		$update = $this->db->query($query);
		
		if($update)
		{
			$msg = 'Updated successfully';
		}
		else{
			$msg = 'Internet error';
		}
		
		
		return $msg;
	}
	
	public function updateWhere($table, $rows,$id){
	      $set = [];
		  foreach($rows as $k => $v) {
			$set[] = "$k='$v'";
		  }
		  $sql = "UPDATE $table SET ". implode(', ', $set)." WHERE `id`=".$id;
		  $this->db->query($sql);
		  return true;
	}
	
	public function update($table, $rows){
	  $sql = "UPDATE $table SET ";
	  foreach($rows as $k => $v) {
		$sql .= " $k='$v',";
	  }
	  $this->db->query(trim($sql, ','));
	}
	
	
	function mysql_insert_array($table, $data, $exclude = array()) {
		$fields = $values = array();
		if( !is_array($exclude) ) $exclude = array($exclude);
		foreach( array_keys($data) as $key ) {
			if( !in_array($key, $exclude) ) {
				$fields[] = "`$key`";
				$values[] = "'" . mysql_real_escape_string($data[$key]) . "'";
			}
		}
		$fields = implode(",", $fields);
		$values = implode(",", $values);
		if( mysql_query("INSERT INTO `$table` ($fields) VALUES ($values)") ) {
			return array( "mysql_error" => false,
						  "mysql_insert_id" => mysql_insert_id(),
						  "mysql_affected_rows" => mysql_affected_rows(),
						  "mysql_info" => mysql_info()
						);
		} else {
			return array( "mysql_error" => mysql_error() );
		}
	}
}
