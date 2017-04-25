<?php

		if(isset($_FILES['image']) && $_GET['iduser']){
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
				
				$nomeFile= "unitel_uploads/img/utilizador/".$newScript.".".$file_ext;
				
				move_uploaded_file($file_tmp,$newScript.".jpg");
				setDeviceRotation($newScript.".jpg");
				
				$imageGuardada="../../unitel_uploads/img/utilizador/".$newScript.".".$file_ext;
				$query = "UPDATE [utilizador] SET [foto]  = '$imageGuardada' WHERE [idutilizador] = '$_GET[iduser]'";

				echo "SUcesso";
			//	$result3=Request::UpdateBd($query);
				
				//Response::delivery_response(200,"Couver Saved with sucess",$imageGuardada);

				//if($result3){
					
					//Response::delivery_response(200,"Couver Saved with sucess",$imageGuardada);
					
				//}else{
					//Response::delivery_response(200,"Face not Saved","null");
				//}
			}else{
				//Response::delivery_response(200,"Face not Saved",$error);
			}
			
		}else{
				//esponse::delivery_response(400,getHttpStatusMessage(400),"Miss Parameter");
		}




		function setDeviceRotation($filePath)
			{
					$exif = exif_read_data($filePath);
					 
					//if there is orientation change
					$exif_orient = isset($exif['Orientation']) ? $exif['Orientation'] : 0;
					$rotateImage = 0;
					 
					//convert exif rotation to angles
					if (6 == $exif_orient)
					{
						$rotateImage = 90;
						$imageOrientation = 1;
					}
					elseif (3 == $exif_orient)
					{
						$rotateImage = 180;
						$imageOrientation = 1;
					}
					elseif (8 == $exif_orient)
					{
						$rotateImage = 270;
						$imageOrientation = 1;
					}
					//if the image is rotated
					if ($rotateImage)
					{
						$rotateImage = -$rotateImage;
						$info   = getimagesize($filePath);
						$fileType = $info[2];

						switch ($fileType)
						{
							case '2': //image/jpeg
								$source = imagecreatefromjpeg($filePath);
								$rotate = imagerotate($source, $rotateImage, 0);
								imagejpeg($rotate,$filePath);
							break;
							case '3': //image/png
								$source = imagecreatefrompng($filePath);
								$rotate = imagerotate($source, $rotateImage, 0);
								imagepng($rotate,$filePath);
							break;
							case '1':
								$source = imagecreatefromgif($filePath);
								$rotate = imagerotate($source, $rotateImage, 0);
								imagegif($rotate,$filePath);
							break;
							default:
							break;
						}
					}
					// The image orientation is fixed, pass it back for further processing
					return "file";
			}


?>


	