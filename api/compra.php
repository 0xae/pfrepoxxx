<?php

	include_once("webservice.php");
	include_once('phpqrcode/qrlib.php');


    //*************************************************************************
	//***************** Efectuar Comprar Bilhete ******************************
	//*************************************************************************
	
	
 	function efectuarComprar(){
		
		
		$resultadoError="Bilhetes do tipo ";
		$isDesponivel=true;
		
		
		if(isset($_POST['listReserva']) && !empty($_POST['listReserva']) ){
			
			$listCompra = explode(",",$_POST['listReserva']);
			
			foreach($listCompra as $itenConprar){
			
				$getBilheteRestant = "SELECT (`bilhete`.`stock`-`bilhete`.`comprado`) as stock, `bilhete`.`nome_bilhete` as nome From bilhete where `bilhete`.`idbilhete`='$itenConprar' LIMIT 1";
				$bilheteRestantInfo = Request::dataBaseInfo($getBilheteRestant);

				if($bilheteRestantInfo){
				
					foreach($bilheteRestantInfo as $bilhete){
						
						if($bilhete['stock']<1){
							$resultadoError=$resultadoError." ".$bilhete['nome'].",";
							$isDesponivel = false;
						}
					}			
				}else{
					echo "errr";
				}
			
			}
			
		}else{
			Response::delivery_response(404,"Operacao Invalida","false");
			exit();
		}
		
		
		if($isDesponivel==true){
			
			
			$listReservasFeitas = array();
			
			foreach($listCompra as $itenConprar){
				
				//**********************************
				//******* generate free Pass *******
				//**********************************
				
				$randon= rand(72891,92729);
				$randon = $randon;
				$codeContents = $_POST['iduser'].'/'.$randon; 
				$codeContents = md5($codeContents);
				
				
				$newScript= md5($randon);
				$fileName = "uploads/qrcodes/".$newScript.'_file_d'.'.png'; 
			    $filePath = "../uploads/qrcodes/".$newScript.'_file_d'.'.png'; 
				
				QRcode::png($codeContents,$filePath,QR_ECLEVEL_L, 10); 
				
				//**********************************
				//******* Fim generate free Pass ***
				//**********************************
				
				$dataCompra = date("Y-m-d");
				$query = "INSERT INTO compra_bilhete (utilizador_idutilizador,bilhete_idbilhete,tipo,estado,id_donobilhete,qr_code,codigo_QR,dataCompra) VALUES (:ut,:tp,:tipo,:es,:iddonu,:qcod,:codqr,:dt)";
			    $data = array(':ut'=>$_POST['iduser'],':tp'=>$itenConprar,':tipo'=>"1", ':es'=>"1", ':iddonu'=>$_POST['iduser'], ':qcod'=>$fileName, ':codqr'=> $codeContents, ':dt'=>$dataCompra);
				
				$result=Request::saveIntoDB($query,$data);
				
				if($result){
					
					$query2 = "UPDATE bilhete SET `comprado`=`comprado`+1 where `bilhete`.`idbilhete`='$itenConprar'";
					$result3=Request::UpdateBd($query2);	
					
					
					$listReservasFeitas []=$result;
				}else{
					
					foreach($listReservasFeitas as $reservaTodelete){

						$query = "DELETE FROM compra_bilhete WHERE idcompra_bilhete='$reservaTodelete'";
						Request::deleteIntoDB($query);	
						
					}
					
					Response::delivery_response(200,"Reserva Feita Sem Sucesso","null");
					exit();
					
				}
			
			}


		
			foreach($listReservasFeitas as $idcompra){
				    
					saveHistorico($_POST['iduser'], "cp", $idcompra);  // registra a compra	
			}
			
	
			Response::delivery_response(200,"Reserva Feita Com Sucesso",$listReservasFeitas);
			
			
			
		}else{
			$resultadoError = $resultadoError." não estão desponivel para a venda";
			Response::delivery_response(200,"Bilhete nao Desponivel",$resultadoError);
		}
		
		
		
    }
	
	
	
	function saveHistorico($idUser, $codTabela, $idCont){
		
		
		$data = date("Y-m-d");
		$hora = date("H:i:s");
		
		$query = "INSERT INTO `historico` (`utilizador_idutilizador`, `tabela`, `idconteudo`, `data`, `hora`, `estado`) VALUES (:uId,:tb,:idCon,:dt,:hr,:es)";
		$data = array(':uId'=>$idUser,':tb'=>$codTabela ,':idCon'=>$idCont,':dt'=>$data,':hr'=>$hora,':es'=>"1");
			
		$resultInsert= Request::saveIntoDB($query,$data);


		
	}
	
	function validarBilhete(){
		
				$getBilhete = "SELECT * FROM `compra_bilhete`,`bilhete` WHERE `codigo_QR` = '$_POST[codigo]' and `bilhete`.`idbilhete`=`compra_bilhete`.`bilhete_idbilhete`";
				$bilheteRestantInfo = Request::dataBaseInfo($getBilhete);
				
				if($bilheteRestantInfo){
					
					$id=$bilheteRestantInfo[0]['idcompra_bilhete'];
					$isUsed = "SELECT * FROM `user_has_bilhete` WHERE `idcompra_bilhete` = '$id'";
					$isUsed = Request::dataBaseInfo($isUsed);
					
					if($isUsed){
						Response::delivery_response(200,"ERROR","Bilhete Usado");
					}else{
						$hora = date("H:i:s");
						$query = "INSERT INTO `user_has_bilhete` (`evento_idevento`, `idcompra_bilhete`, `hora`) VALUES (:evId,:comId,:tim)";
						$data = array(':evId'=>$bilheteRestantInfo[0]['evento_idevento'],':comId'=>$bilheteRestantInfo[0]['idcompra_bilhete'] ,':tim'=>$hora);
						$resultInsert= Request::saveIntoDB($query,$data);
						
						Response::delivery_response(200,"OK","Sucesso");
					}
				
								
				}else{
					Response::delivery_response(200,"ERROR","Bilhete Inexistente");
				}
		//
	}




?>