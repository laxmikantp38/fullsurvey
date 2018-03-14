<?php 

class Common{
	
	public function __construct()  
	{
		
	}
    
  function fileUpload($path, $base64)
	{
		$image_parts = explode(";base64,", $base64);		
		$image_type_aux = explode("image/", $image_parts[0]);
		$image_type = $image_type_aux[1];
		$image_base64 = base64_decode($image_parts[1]);
    $fileName = uniqid() . '.png';
		$filePath = $path . $fileName;
		file_put_contents($filePath, $image_base64);
		return $fileName;
	}	
    
}
  
	
?>