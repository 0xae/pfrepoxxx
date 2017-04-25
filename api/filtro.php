<?php

include_once("webservice.php");




function getFiltroEvento(){
		
		$data = date("Y-m-d");
		
		if(isset($_GET['tipo']) && !empty($_GET['tipo']) && isset($_GET['user']) && !empty($_GET['user']) && isset($_GET['pesq']) && !empty($_GET['pesq'])){
			
			$getEvento="";
			
			//*echo  $_GET['tipo']."<br />";
			
			if($_GET['tipo']=='todos'){
				
				if($_GET['pesq']!='null'){
					
					$getEvento = "SELECT `evento`.`tipoevento_idtipoevento`,`idevento`,`produtor_idprodutor`,`evento`.`nome`,`data`,`hora`,`local`,`tipoevento`.`nome` as tipoevento,`evento`.`descricao`,`cartaz`,`ilha`,`filtro`,`marca`.`idmarca`, `marca`.`nome` as nomeMarca, `marca`.`logo` as logoMarca,
							`marca`.`sede` as sedeMarca, `marca`.`email` as emailMarca, `marca`.`telefone` as TelefoneMarca , `marca`.`slogan` as sloganMarca FROM `evento`,`produtor`,`marca`, tipoevento WHERE 
							`evento`.`estado`=1 and `tipoevento`.`idtipoevento`=`evento`.`tipoevento_idtipoevento` and `produtor`.`idprodutor`=`evento`.`produtor_idprodutor` and `marca`.`idmarca`=`produtor`.`marca_idmarca`
							and (`evento`.`nome` LIKE '%".$_GET['pesq']."%' or evento.ilha LIKE '%".$_GET['pesq']."%' or evento.local LIKE '%".$_GET['pesq']."%' or tipoevento.nome LIKE '%".$_GET['pesq']."%') ORDER by `data`,`hora` ASC limit 15";
					
				}else{
						$getEvento = "SELECT evento.*, `tipoevento`.`nome` as tipoevento, `marca`.`idmarca`, `marca`.`nome` as nomeMarca, 
					`marca`.`logo`as logoMarca, `marca`.`sede` as sedeMarca,`marca`.`email` as emailMarca, `marca`.`telefone` as TelefoneMarca,
					`marca`.`slogan` as sloganMarca FROM evento, tipoevento, produtor,marca where `evento`.`estado`=1 and 
					`tipoevento`.`idtipoevento`=`evento`.`tipoevento_idtipoevento` AND `produtor`.`idprodutor`=`evento`.`produtor_idprodutor`
					and `produtor`.`marca_idmarca`=`marca`.`idmarca` order by `evento`.`data`,`evento`.`hora` limit 15";
				}
				
				
				
			}else{
				
				if($_GET['tipo']!='null' && $_GET['pesq']!='null'){
				
				 $getEvento = "SELECT `evento`.`tipoevento_idtipoevento`,`idevento`,`produtor_idprodutor`,`evento`.`nome`,`data`,`hora`,`local`,`tipoevento`.`nome` as tipoevento,`evento`.`descricao`,`cartaz`,`ilha`,`filtro`,`marca`.`idmarca`, `marca`.`nome` as nomeMarca, `marca`.`logo` as logoMarca,
				 `marca`.`sede` as sedeMarca, `marca`.`email` as emailMarca, `marca`.`telefone` as TelefoneMarca , `marca`.`slogan` as sloganMarca FROM `evento`,`produtor`,`marca`, tipoevento WHERE 
				 `evento`.`estado`=1 and `tipoevento`.`idtipoevento`=`evento`.`tipoevento_idtipoevento` and
				 `tipoevento_idtipoevento`='$_GET[tipo]' and `produtor`.`idprodutor`=`evento`.`produtor_idprodutor` and `marca`.`idmarca`=`produtor`.`marca_idmarca`
				 and (`evento`.`nome` LIKE '%".$_GET['pesq']."%' or evento.ilha LIKE '%".$_GET['pesq']."%' or evento.local LIKE '%".$_GET['pesq']."%' or tipoevento.nome LIKE '%".$_GET['pesq']."%') ORDER by `data`,`hora` ASC limit 15";
				 
				}else{
					if($_GET['tipo']!='null'){
						
						$getEvento = "SELECT `evento`.`tipoevento_idtipoevento`,`idevento`,`produtor_idprodutor`,
							`evento`.`nome`,`data`,`hora`,`local`,`evento`.`descricao`,`cartaz`,`ilha`,`filtro`,`marca`.`idmarca`, `marca`.`nome` as nomeMarca, `marca`.`logo` as logoMarca, `marca`.`sede` as sedeMarca, 
							`marca`.`email` as emailMarca, `marca`.`telefone` as TelefoneMarca , `tipoevento`.`nome` as tipoevento,`marca`.`slogan` as sloganMarca FROM `evento`,`produtor`,`marca`,`tipoevento` WHERE  `evento`.`estado`=1 and
							`produtor`.`idprodutor`=`evento`.`produtor_idprodutor` and `marca`.`idmarca`=`produtor`.`marca_idmarca` and `tipoevento_idtipoevento`='$_GET[tipo]' and 
							`tipoevento`.`idtipoevento`=`evento`.`tipoevento_idtipoevento` ORDER by `data`,`hora` ASC limit 15";
							
							
						
					}else{
						
						if($_GET['pesq']!='null'){
							
							
							$getEvento = "SELECT `evento`.`tipoevento_idtipoevento`,`idevento`,`produtor_idprodutor`,`evento`.`nome`,`data`,`hora`,`local`,`tipoevento`.`nome` as tipoevento,`evento`.`descricao`,`cartaz`,`ilha`,`filtro`,`marca`.`idmarca`, `marca`.`nome` as nomeMarca, `marca`.`logo` as logoMarca,
							`marca`.`sede` as sedeMarca, `marca`.`email` as emailMarca, `marca`.`telefone` as TelefoneMarca , `marca`.`slogan` as sloganMarca FROM `evento`,`produtor`,`marca`, tipoevento WHERE 
							`evento`.`estado`=1 and `tipoevento`.`idtipoevento`=`evento`.`tipoevento_idtipoevento` and `produtor`.`idprodutor`=`evento`.`produtor_idprodutor` and `marca`.`idmarca`=`produtor`.`marca_idmarca`
							and (`evento`.`nome` LIKE '%".$_GET['pesq']."%' or evento.ilha LIKE '%".$_GET['pesq']."%' or evento.local LIKE '%".$_GET['pesq']."%' or tipoevento.nome LIKE '%".$_GET['pesq']."%') ORDER by `data`,`hora` ASC limit 15";
							
						}else{
							Response::delivery_response(404,"Invaid Request","false");
							exit();
						}
						
					}
					
				}
				
			}
			
		
			
			$tipoEvento = Request::dataBaseInfo($getEvento);
		
		
			if($tipoEvento){
				
					$arrayevento= array();
					
					foreach($tipoEvento as $evento){
						
						$getGosto= "SELECT * FROM gosto where `gosto`.`evento_idevento`=$evento[idevento] and `gosto`.`utilizador_idutilizador`='$_GET[user]' Limit 1";
						$isLike = Request::dataBaseInfo($getGosto);
						
						if($isLike){
							$evento['isLike']="true";
						}else{
							$evento['isLike']="false";
						}
						
						
						$sqlMarca = "SELECT * FROM `follow_marca` WHERE `marca_idmarca`='$evento[idmarca]' and `utilizador_idutilizador`='$_GET[user]'";
		
						$listMarca = Request::dataBaseInfo($sqlMarca);
		
						if($listMarca){
							$evento['isFollowing']="true";
						}else{
							$evento['isFollowing']="false";	
						}
						
						$arrayevento[]=$evento;
						
					}
					
					Response::delivery_response(200,"List Guia Found",$arrayevento);
			}else{
				Response::delivery_response(200,"List Event not Fount","null");
			}
			
			
			
		}else{
			Response::delivery_response(404,"Invaid Request","false");
		}
	
		
	}
	
	

function getMoreFiltroEvento(){
		
		$data = date("Y-m-d");
		

		if(isset($_GET['tipo']) && !empty($_GET['tipo']) && isset($_GET['user']) && !empty($_GET['user']) && isset($_GET['pesq']) && !empty($_GET['pesq'])){
			
			$getEvento="";
			
			
			
			if($_GET['tipo']=='todos'){
				
				if($_GET['pesq']!='null'){
					
						$getEvento = "SELECT `evento`.`tipoevento_idtipoevento`,`idevento`,`produtor_idprodutor`,`evento`.`nome`,`data`,`hora`,`local`,`tipoevento`.`nome` as tipoevento,`evento`.`descricao`,`cartaz`,`ilha`,`filtro`,`marca`.`idmarca`, `marca`.`nome` as nomeMarca, `marca`.`logo` as logoMarca,
						`marca`.`sede` as sedeMarca, `marca`.`email` as emailMarca, `marca`.`telefone` as TelefoneMarca , `marca`.`slogan` as sloganMarca FROM `evento`,`produtor`,`marca`, tipoevento WHERE 
						`evento`.`estado`=1 and `tipoevento`.`idtipoevento`=`evento`.`tipoevento_idtipoevento` and `produtor`.`idprodutor`=`evento`.`produtor_idprodutor` and `marca`.`idmarca`=`produtor`.`marca_idmarca`
						and (`evento`.`nome` LIKE '%".$_GET['pesq']."%' or evento.ilha LIKE '%".$_GET['pesq']."%' or evento.local LIKE '%".$_GET['pesq']."%' or tipoevento.nome LIKE '%".$_GET['pesq']."%') ORDER by `data`,`hora` ASC limit $_GET[quantidade],15";
							
					
				}else{
					
					/*$getEvento = "SELECT evento.*, `tipoevento`.`nome` as tipoevento, `marca`.`idmarca`, `marca`.`nome` as nomeMarca, 
					`marca`.`logo`as logoMarca, `marca`.`sede` as sedeMarca,`marca`.`email` as emailMarca, `marca`.`telefone` as TelefoneMarca,
					`marca`.`slogan` as sloganMarca FROM evento, tipoevento, produtor,marca where `evento`.`estado`=1 and 
					`tipoevento`.`idtipoevento`=`evento`.`tipoevento_idtipoevento` AND `produtor`.`idprodutor`=`evento`.`produtor_idprodutor`
					and `produtor`.`marca_idmarca`=`marca`.`idmarca` order by `evento`.`data`,`evento`.`hora` limit $_GET[quantidade],15";*/

					$dados= listAllEvents($_GET['user'], $_GET['quantidade']);
					Response::delivery_response(200,"List Guia Found",$dados);
					exit();
				}
				
				
			}else{
				
				if($_GET['tipo']!='null' && $_GET['pesq']!='null'){
				
				 $getEvento = "SELECT `evento`.`tipoevento_idtipoevento`,`idevento`,`produtor_idprodutor`,`evento`.`nome`,`data`,`hora`,`local`,`tipoevento`.`nome` as tipoevento,`evento`.`descricao`,`cartaz`,`ilha`,`filtro`,`marca`.`idmarca`, `marca`.`nome` as nomeMarca, `marca`.`logo` as logoMarca,
				 `marca`.`sede` as sedeMarca, `marca`.`email` as emailMarca, `marca`.`telefone` as TelefoneMarca , `marca`.`slogan` as sloganMarca FROM `evento`,`produtor`,`marca`, tipoevento WHERE 
				 `evento`.`estado`=1 and `tipoevento`.`idtipoevento`=`evento`.`tipoevento_idtipoevento` and
				 `tipoevento_idtipoevento`='$_GET[tipo]' and `produtor`.`idprodutor`=`evento`.`produtor_idprodutor` and `marca`.`idmarca`=`produtor`.`marca_idmarca`
				 and (`evento`.`nome` LIKE '%".$_GET['pesq']."%' or evento.ilha LIKE '%".$_GET['pesq']."%' or evento.local LIKE '%".$_GET['pesq']."%' or tipoevento.nome LIKE '%".$_GET['pesq']."%') ORDER by `data`,`hora` ASC limit $_GET[quantidade],15";
				 
				}else{
					if($_GET['tipo']!='null'){
						
						$getEvento = "SELECT `evento`.`tipoevento_idtipoevento`,`idevento`,`produtor_idprodutor`,
							`evento`.`nome`,`data`,`hora`,`local`,`evento`.`descricao`,`cartaz`,`ilha`,`filtro`,`marca`.`idmarca`, `marca`.`nome` as nomeMarca, `marca`.`logo` as logoMarca, `marca`.`sede` as sedeMarca, 
							`marca`.`email` as emailMarca, `marca`.`telefone` as TelefoneMarca , `tipoevento`.`nome` as tipoevento,`marca`.`slogan` as sloganMarca FROM `evento`,`produtor`,`marca`,`tipoevento` WHERE  `evento`.`estado`=1 and
							`produtor`.`idprodutor`=`evento`.`produtor_idprodutor` and `marca`.`idmarca`=`produtor`.`marca_idmarca` and `tipoevento_idtipoevento`='$_GET[tipo]' and 
							`tipoevento`.`idtipoevento`=`evento`.`tipoevento_idtipoevento` ORDER by `data`,`hora` ASC limit $_GET[quantidade],15";
							
							//
						
					}else{
						
						if($_GET['pesq']!='null'){
							
							
							$getEvento = "SELECT `evento`.`tipoevento_idtipoevento`,`idevento`,`produtor_idprodutor`,`evento`.`nome`,`data`,`hora`,`local`,`tipoevento`.`nome` as tipoevento,`evento`.`descricao`,`cartaz`,`ilha`,`filtro`,`marca`.`idmarca`, `marca`.`nome` as nomeMarca, `marca`.`logo` as logoMarca,
							`marca`.`sede` as sedeMarca, `marca`.`email` as emailMarca, `marca`.`telefone` as TelefoneMarca , `marca`.`slogan` as sloganMarca FROM `evento`,`produtor`,`marca`, tipoevento WHERE 
							`evento`.`estado`=1 and `tipoevento`.`idtipoevento`=`evento`.`tipoevento_idtipoevento` and `produtor`.`idprodutor`=`evento`.`produtor_idprodutor` and `marca`.`idmarca`=`produtor`.`marca_idmarca`
							and (`evento`.`nome` LIKE '%".$_GET['pesq']."%' or evento.ilha LIKE '%".$_GET['pesq']."%' or evento.local LIKE '%".$_GET['pesq']."%' or tipoevento.nome LIKE '%".$_GET['pesq']."%') ORDER by `data`,`hora` ASC limit $_GET[quantidade],15";
							
						}else{
							Response::delivery_response(404,"Invaid Request","false");
							exit();
						}
						
					}
					
				}
				
			}
			
			$tipoEvento = Request::dataBaseInfo($getEvento);
		
		
			if($tipoEvento){
				
					$arrayevento= array();
					
					foreach($tipoEvento as $evento){
						
						$getGosto= "SELECT * FROM gosto where `gosto`.`evento_idevento`=$evento[idevento] and `gosto`.`utilizador_idutilizador`='$_GET[user]' Limit 1";
						$isLike = Request::dataBaseInfo($getGosto);
						
						if($isLike){
							$evento['isLike']="true";
						}else{
							$evento['isLike']="false";
						}


						$sqlMarca = "SELECT * FROM `follow_marca` WHERE `marca_idmarca`='$evento[idmarca]' and `utilizador_idutilizador`='$_GET[user]'";
		
						$listMarca = Request::dataBaseInfo($sqlMarca);
		
						if($listMarca){
							$evento['isFollowing']="true";
						}else{
							$evento['isFollowing']="false";	
						}
						
						$arrayevento[]=$evento;
						
					}
					
					Response::delivery_response(200,"List Guia Found",$arrayevento);
			}else{
				Response::delivery_response(200,"List Event not Fount","null");
			}
			
			
			
		}else{
			Response::delivery_response(404,"Invaid Request","false");
		}
	
		
	}


	function listAllEvents($iduser, $limit){

    		$getList = "SELECT evento.*, `tipoevento`.`nome` as tipoevento, `marca`.`idmarca`, `marca`.`nome` as nomeMarca,
			`marca`.`logo`as logoMarca, `marca`.`sede` as sedeMarca,`marca`.`email` as emailMarca, `marca`.`telefone` as TelefoneMarca,
			`marca`.`slogan` as sloganMarca, (SELECT SUM(`stock`)  FROM `bilhete` WHERE `evento_idevento` = `evento`.`idevento` GROUP by `evento_idevento`) as quantidadeBilhete FROM evento, tipoevento, produtor,marca where `evento`.`estado`=1 and
			`tipoevento`.`idtipoevento`=`evento`.`tipoevento_idtipoevento` AND `produtor`.`idprodutor`=`evento`.`produtor_idprodutor`
			and `produtor`.`marca_idmarca`=`marca`.`idmarca` and `evento`.`publicado`=1 and `evento`.`data`>=CURDATE()  order by `evento`.`data` ASC limit $limit,15";


			$arrayRequest = Request::dataBaseInfo($getList);

			$lastData="";

			if($arrayRequest){

				$arrayevento= array();
				foreach($arrayRequest as $evento){

					
					if($lastData!=$evento['data']) {
						
						$object = (object) ['isTitle' => true, "titulo"=>$evento['data']];
						//$arrayevento[]=array();
						$arrayevento[]=$object;
						
						$lastData=$evento['data'];
					}



					$getGosto= "SELECT * FROM gosto where `gosto`.`evento_idevento`=$evento[idevento] and `gosto`.`utilizador_idutilizador`='$iduser' Limit 1";
					$isLike = Request::dataBaseInfo($getGosto);

					if($isLike){
						$evento['isLike']="true";
					}else{
						$evento['isLike']="false";
					}

					$sqlMarca = "SELECT * FROM `follow_marca` WHERE `marca_idmarca`='$evento[idmarca]' and `utilizador_idutilizador`='$iduser'";

	    			$listMarca = Request::dataBaseInfo($sqlMarca);

					if($listMarca){
						$evento['isFollowing']="true";
					}else{
						$evento['isFollowing']="false";
					}
					$evento['isTitle']=false;
					$arrayevento[]=$evento;
				}

				return $arrayevento;
			}else{
				return array();
			}

    }



?>