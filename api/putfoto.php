<?php


		/*if(isset($_FILES['image'])){
			  $errors= array();
			  $file_name = $_FILES['image']['name'];
			  $file_size =$_FILES['image']['size'];
			  $file_tmp =$_FILES['image']['tmp_name'];
			  $file_type=$_FILES['image']['type'];
			  $file_ext=strtolower(end(explode('.',$_FILES['image']['name'])));
      
			$expensions= array("jpeg","jpg","png");
      
			if(in_array($file_ext,$expensions)=== false){
				 $errors[]="extension not allowed, please choose a JPEG or PNG file.";
			 }
		 
			if(empty($errors)==true){
				
				$randon= rand(72891,92729);
				$randon = $randon;
				$newScript= md5($randon);
				
				$nomeFile= "".$newScript.".".$file_ext;
				
				move_uploaded_file($file_tmp,$nomeFile);
				
				//$imageGuardada="../../unitel_uploads/img/utilizador/".$newScript.".".$file_ext;
				//$query = "UPDATE [utilizador] SET [foto]  = '$imageGuardada' WHERE [idutilizador] = '$_GET[iduser]'";
				//$result3=Request::UpdateBd($query);
				
				//Response::delivery_response(200,"Couver Saved with sucess",$imageGuardada);

				if(1==1){
					
					echo "$imageGuardada";
					
				}else{
					echo "error";
				}
			}else{
				echo "error";
			}
			
		}else{
				echo "error";
		}*/
		
		
		$file_ext=strtolower(end(explode('.',$_FILES['image']['name'])));
		$randon= rand(72891,92729);
		$randon = $randon;
		$newScript= md5($randon);
		
		"".$newScript.".".$file_ext;
		$filename = "upload/foto/".$newScript.".jpg";
		$filePath = $_FILES['image']['tmp_name'];
		$exif = exif_read_data($_FILES['image']['tmp_name']);
		if (!empty($exif['Orientation'])) {
		$imageResource = imagecreatefromjpeg($filePath); // provided that the image is jpeg. Use relevant function otherwise
			switch ($exif['Orientation']) {
				case 3:
				$image = imagerotate($imageResource, 180, 0);
				break;
				case 6:
				$image = imagerotate($imageResource, -90, 0);
				break;
				case 8:
				$image = imagerotate($imageResource, 90, 0);
				break;
				default:
				$image = $imageResource;
			} 
		}

		imagejpeg($image, $filename, 90);
		imagedestroy($imageResource);
		imagedestroy($image);
		
		
		echo "1";


	



?>