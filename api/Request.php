<?php
	require_once "dbconfig/config.ini.php";
	

	class Request
	{
		function dataBaseInfo($query){
			$dbcon = bd_connect();

			$stmt = $dbcon->prepare($query);
			$array = array();
			$dbcon->query("SET CHARACTER SET utf8");
			$stmt->execute();
			$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
			foreach ($result as $_QResponse){
				$array[] = $_QResponse;
			}
			return $array;
		}


		function saveIntoDB($sql,$preparedArray){
			$result = NULL;
			$dbcon = bd_connect();
			$q = $dbcon->prepare($sql);
			$sucess= $q->execute($preparedArray);
			if($sucess != 0){
				$result = $dbcon->lastInsertId();
			}

			return $result;
		}
		
		
		function deleteIntoDB($sql){
			$result = false;
			$dbcon = bd_connect();
			$q = $dbcon->prepare($sql);
			$sucess= $q->execute();
			
			if($sucess){
				$result = true;
			}

			return $result;
		}
		
		function UpdateBd($sql){
			
			$result = NULL;
			$dbcon = bd_connect();
			$q = $dbcon->prepare($sql);
			$sucess= $q->execute();
			
			if($sucess != 0){
				return true;
			}

			return false;
		}
		
		


		function searchIten($array){

			$dbcon = bd_connect();
			$arrayReturn = array();

			foreach ($array as $value){

				$stmt = $dbcon->prepare("SELECT description FROM `detail_topic` WHERE topic_idtopic=$value[idtopic] and status=1");

				
				$dbcon->query("SET CHARACTER SET utf8");
				$stmt->execute();
				$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
				
				$arrayIten = array();
			
				foreach ($result as $_QResponse){
					$arrayIten[] = $_QResponse;
				}

				$value['iten'] = $arrayIten;

				$arrayReturn[] = $value;
          	}

          	return $arrayReturn;
		}


		// function dataBaseSearchGroup($id_topic){
		// 	$dbcon = bd_connect();

		// 	$stmt = $dbcon->prepare("SELECT * FROM `subtopic` WHERE `topic_idtopic`='$id_topic' and status=1");
			
		// 	$array = array();
		// 	$dbcon->query("SET CHARACTER SET utf8");
		// 	$stmt->execute();
		// 	$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
			
		// 	foreach ($result as $_QResponse){

		// 		$stmt = $dbcon->prepare("SELECT * FROM `description` WHERE `subtopic_idsubtopic`=$_QResponse[idsubtopic] and `status`=1"); 
		// 		$array2 = array();
		// 		$dbcon->query("SET CHARACTER SET utf8");
		// 		$stmt->execute();
		// 		$result2 = $stmt->fetchAll(PDO::FETCH_ASSOC);

		// 		foreach ($result2 as $_QResponse2){
		// 			//$array[] = $_QResponse+$_QResponse2;


		// 			$stmt = $dbcon->prepare("SELECT * FROM `detail` WHERE `description_iddescription`=$_QResponse2[iddescription] and `status`=1"); 

		// 			$array3 = array();
		// 			$dbcon->query("SET CHARACTER SET utf8");
		// 			$stmt->execute();
		// 			$result3 = $stmt->fetchAll(PDO::FETCH_ASSOC);

		// 			foreach ($result3 as $_QResponse3){
		// 					$stmt = $dbcon->prepare("SELECT * FROM `pontos` WHERE `detail_iddetail`=$_QResponse3[iddetail] and `status`=1"); 

		// 						$array4 = array();
		// 						$dbcon->query("SET CHARACTER SET utf8");
		// 						$stmt->execute();
		// 						$result4 = $stmt->fetchAll(PDO::FETCH_ASSOC);

		// 						foreach ($result4 as $_QResponse4) {
		// 							 $array4[]=$_QResponse4;
		// 						}

		// 						$_QResponse3['subItem'] = $array4;
		// 						$array3[]=$_QResponse3;
		// 			}

		// 			$_QResponse2['iten'] = $array3;
		// 			$array2 []= $_QResponse2;
		// 		} 

		// 		$_QResponse['description'] =$array2;

		// 		// $array [] = array('subItem' => $_QResponse, "description" => $array2 );
		// 		$array [] = $_QResponse;
				
		// 	}
		// 	return $array;
		// }

		function dataBaseSearchGroup($id_subtopic){
			$dbcon = bd_connect();
		
				$stmt = $dbcon->prepare("SELECT * FROM `description` WHERE `subtopic_idsubtopic`=$id_subtopic and `status`=1"); 
				$array2 = array();
				$dbcon->query("SET CHARACTER SET utf8");
				$stmt->execute();
				$result2 = $stmt->fetchAll(PDO::FETCH_ASSOC);

				foreach ($result2 as $_QResponse2){
					//$array[] = $_QResponse+$_QResponse2;


					$stmt = $dbcon->prepare("SELECT * FROM `detail` WHERE `description_iddescription`=$_QResponse2[iddescription] and `status`=1"); 

					$array3 = array();
					$dbcon->query("SET CHARACTER SET utf8");
					$stmt->execute();
					$result3 = $stmt->fetchAll(PDO::FETCH_ASSOC);

					foreach ($result3 as $_QResponse3){
							$stmt = $dbcon->prepare("SELECT * FROM `pontos` WHERE `detail_iddetail`=$_QResponse3[iddetail] and `status`=1"); 

								$array4 = array();
								$dbcon->query("SET CHARACTER SET utf8");
								$stmt->execute();
								$result4 = $stmt->fetchAll(PDO::FETCH_ASSOC);

								foreach ($result4 as $_QResponse4) {
									 $array4[]=$_QResponse4;
								}

								$_QResponse3['subItem'] = $array4;
								$array3[]=$_QResponse3;
					}

					$_QResponse2['iten'] = $array3;
					$array []= $_QResponse2;
				} 
				
			
			return $array;
		}


		function dataBaseSearchGroup2($id_subtopic){
			$dbcon = bd_connect();
		
				$stmt = $dbcon->prepare("SELECT * FROM `description` WHERE `subtopic_idsubtopic`=$id_subtopic and `status`=1"); 
				$array2 = array();
				$dbcon->query("SET CHARACTER SET utf8");
				$stmt->execute();
				$result2 = $stmt->fetchAll(PDO::FETCH_ASSOC);

				foreach ($result2 as $_QResponse2){
					//$array[] = $_QResponse+$_QResponse2;


					$stmt = $dbcon->prepare("SELECT * FROM `detail` WHERE `description_iddescription`=$_QResponse2[iddescription] and `status`=1"); 

					$array3 = array();
					$dbcon->query("SET CHARACTER SET utf8");
					$stmt->execute();
					$result3 = $stmt->fetchAll(PDO::FETCH_ASSOC);

					foreach ($result3 as $_QResponse3){
							$stmt = $dbcon->prepare("SELECT * FROM `pontos` WHERE `detail_iddetail`=$_QResponse3[iddetail] and `status`=1"); 

								$array4 = array();
								$dbcon->query("SET CHARACTER SET utf8");
								$stmt->execute();
								$result4 = $stmt->fetchAll(PDO::FETCH_ASSOC);

								foreach ($result4 as $_QResponse4) {
									 $array4[]=$_QResponse4;
								}

								$_QResponse3['subItem'] = $array4;
								$array3[]=$_QResponse3;
					}

					$_QResponse2['iten'] = $array3;
					$array []= $_QResponse2;
				} 
				
			
			return $array;
		}


		function dataBaseSearchGroupReadMore($id_categoria){
			

			$dbcon = bd_connect();

			
			$stmt = $dbcon->prepare("SELECT * FROM `topic` WHERE `category_idcategory`='$id_categoria' and status=1");
			$array = array();
			$dbcon->query("SET CHARACTER SET utf8");
			$stmt->execute();
			$resultCategoria = $stmt->fetchAll(PDO::FETCH_ASSOC);

			$resultR = array();

			
			foreach ($resultCategoria as $topic) {
					$sqld  = "SELECT `detail_topic`.`description` FROM `detail_topic` WHERE `detail_topic`.`topic_idtopic`= $topic[idtopic]";

					$stmt2 = $dbcon->prepare($sqld);
					$array2 = array();
					$dbcon->query("SET CHARACTER SET utf8");
					$stmt2->execute();
					$resultDes = $stmt2->fetchAll(PDO::FETCH_ASSOC);

					foreach ($resultDes as $topicDes) {
						$array2[] =$topicDes;
					}

					$topic ['iten'] = $array2;
					$resultR[] = $topic;


			}

			$resultCategoria = $resultR;



			foreach ($resultCategoria as $topic) {
				$array1 = array();
				$stmt = $dbcon->prepare("SELECT * FROM `subtopic` WHERE `topic_idtopic`='$topic[idtopic]' and status=1");
				$dbcon->query("SET CHARACTER SET utf8");
				$stmt->execute();
				$result1 = $stmt->fetchAll(PDO::FETCH_ASSOC);
				
				foreach ($result1 as $_QResponse){
					
					$stmt = $dbcon->prepare("SELECT * FROM `description` WHERE `subtopic_idsubtopic`=$_QResponse[idsubtopic] and `status`=1"); 
					$array2 = array();
					$dbcon->query("SET CHARACTER SET utf8");
					$stmt->execute();
					$result2 = $stmt->fetchAll(PDO::FETCH_ASSOC);

					foreach ($result2 as $_QResponse2){
						$stmt = $dbcon->prepare("SELECT * FROM `detail` WHERE `description_iddescription`=$_QResponse2[iddescription] and `status`=1"); 

						$array3 = array();
						$dbcon->query("SET CHARACTER SET utf8");
						$stmt->execute();
						$result3 = $stmt->fetchAll(PDO::FETCH_ASSOC);

						foreach ($result3 as $_QResponse3){
								
								$stmt = $dbcon->prepare("SELECT * FROM `pontos` WHERE `detail_iddetail`=$_QResponse3[iddetail] and `status`=1"); 

								$array4 = array();
								$dbcon->query("SET CHARACTER SET utf8");
								$stmt->execute();
								$result4 = $stmt->fetchAll(PDO::FETCH_ASSOC);

								foreach ($result4 as $_QResponse4) {
									 $array4[]=$_QResponse4;
								}

								$_QResponse3['subItem'] = $array4;
								$array3[]=$_QResponse3;
						}

						$_QResponse2['iten'] = $array3;
						$array2 [] = $_QResponse2;
					}

					$_QResponse['description']=$array2;
					$array1[]=$_QResponse;
				}

				$topic['subtopic']=$array1;
				$array[]=$topic;

			}

			return $array;
		//}
	}


	}


	
?>