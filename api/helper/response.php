<?php 

class Response{
	
	public function __construct()  
	{
		
	}
    
    public static function global_message($status, $data=false)
	{
		$msg = self::global_message_code($status);
		if($status==200){
			$result = array(
				'status'=>$status,
				'message'=> $msg,
				'data' => $data
			);
		}else{
			$result = array(
				'status'=>$status,
				'message' => $msg,
			);
		}
		return json_encode($result);
	}


	public static function global_message_code($status)
	{
		$codes = array(
			200 => 'success',
			201 => 'Not created. Please try again',
			202 => 'Please enter required params.',
			203 => 'Your match title is not saved! Please try again.',
			204 => 'No record found!',
			205 => 'You match is not set! Please try again.',
			206 => 'Goal point not set! please try again.',
			207 => 'Match title not updated! Please try again.',
			208 => 'Both team could not be same! Please select different team.',
			209 => 'Team not updated! Please try again.',
			210 => 'Timer not set! Please try again.',
			211 => 'Buzzer not set! Please try again.',
			212 => 'No match found! Please try again.',
			213 => 'Goal point not set! Please try again.'
		);
		if(isset($status) && !empty($status)){
			return $codes[$status];
		}
		return array();
	}

	

	public static function notFound()
	{
		echo json_encode(array('status'=>500, 'msg'=> 'page not found !'));
	}
    
}
  
	
?>