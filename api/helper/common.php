<?php 

class Common{
	
	public function __construct()  
	{
		
	}
    
  function upload($path, $base64)
	{
		$image_parts = explode(";base64,", $base64);		
		$image_type_aux = explode("image/", $image_parts[0]);
		$image_type = $image_type_aux[1];
		$image_base64 = base64_decode($image_parts[1]);
		$file = $path . uniqid() . '.png';
		file_put_contents($file, $image_base64);
		return $file;
	}	
    
}
  
	
?>