<?php


	include_once("webservice.php");
	include_once('phpqrcode/qrlib.php');
	//require_once 'src/QrCode.php';
	//use Endroid\QrCode\QrCode;


    /**
    *@descripitons ddf:
    * Funcao responsavel para retorna Lista de Categoria
    */

    function getListEvents(){

		if(isset($_GET['user']) && !empty($_GET['user'])){

				$eventoToRetun= array();


				$eventoToRetun['destaque']=detaque($_GET['user']);
				$eventoToRetun['weekly']=getEventoFromThisWeek($_GET['user']);
				$eventoToRetun['para_Si']=getEventoProdutorFollowing($_GET['user']);
				$eventoToRetun['list_Events']=listAllEvents($_GET['user'],0);
				$eventoToRetun['list_Events_Dates']=listAllEventsDate();

				Response::delivery_response(200,"List Evento",$eventoToRetun);
		
		} else {
			Response::delivery_response(404,"Requesicao Nao Permitida","null");
		}
    }


    function listAllEventsDate(){
    	$sql = "SELECT `data`, COUNT(`idevento`) as quantidadeEvento FROM `evento` Where `evento`.`data`>=CURDATE() and `evento`.`estado`=1 and `evento`.`publicado`=1 GROUP by `data`";
   		$arrayRequest = Request::dataBaseInfo($sql);


   		return $arrayRequest;
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


    function detaque($iduser){

    		$getList = "SELECT evento.*, `tipoevento`.`nome` as tipoevento, `marca`.`idmarca`, `marca`.`nome` as nomeMarca,
			`marca`.`logo`as logoMarca, `marca`.`sede` as sedeMarca,`marca`.`email` as emailMarca, `marca`.`telefone` as TelefoneMarca,
			`marca`.`slogan` as sloganMarca, (SELECT SUM(`stock`)  FROM `bilhete` WHERE `evento_idevento` = `evento`.`idevento` GROUP by `evento_idevento`) as quantidadeBilhete FROM evento, tipoevento, produtor,marca where `evento`.`estado`=1 and
			`tipoevento`.`idtipoevento`=`evento`.`tipoevento_idtipoevento` AND `produtor`.`idprodutor`=`evento`.`produtor_idprodutor`
			and `produtor`.`marca_idmarca`=`marca`.`idmarca` and `evento`.`publicado`=1 and `evento`.`data`>=CURDATE() and `evento`.`isDestaque`=1 order by `evento`.`data` ASC limit 8";


			$arrayRequest = Request::dataBaseInfo($getList);

			if($arrayRequest){

				$arrayevento= array();
				foreach($arrayRequest as $evento){

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

					$arrayevento[]=$evento;
				}

				return $arrayevento;
			}else{
				return array();
			}

    }


    function getEventoFromThisWeek($idUser) {


    		$day = date('w');

			$week_start = date('Y-m-d', strtotime('-'.($day-1).' days'));
			$week_end = date('Y-m-d', strtotime('+'.(7-$day).' days'));

			//echo "$week_start $week_end     ";



			$getList = "SELECT evento.*, `tipoevento`.`nome` as tipoevento, `marca`.`idmarca`, `marca`.`nome` as nomeMarca,
			`marca`.`logo`as logoMarca, `marca`.`sede` as sedeMarca,`marca`.`email` as emailMarca, `marca`.`telefone` as TelefoneMarca,
			`marca`.`slogan` as sloganMarca, (SELECT SUM(`stock`)  FROM `bilhete` WHERE `evento_idevento` = `evento`.`idevento` GROUP by `evento_idevento`) as quantidadeBilhete FROM evento, tipoevento, produtor,marca where `evento`.`estado`=1 and
			`tipoevento`.`idtipoevento`=`evento`.`tipoevento_idtipoevento` AND `produtor`.`idprodutor`=`evento`.`produtor_idprodutor`
			and `produtor`.`marca_idmarca`=`marca`.`idmarca` and `evento`.`publicado`=1 and `evento`.`data`>='$week_start' and `evento`.`data`<='$week_end' order by `evento`.`data` ASC";



			$arrayRequest = Request::dataBaseInfo($getList);

			if($arrayRequest){

				$arrayevento= array();
				foreach($arrayRequest as $evento){

					$getGosto= "SELECT * FROM gosto where `gosto`.`evento_idevento`=$evento[idevento] and `gosto`.`utilizador_idutilizador`='$idUser' Limit 1";
					$isLike = Request::dataBaseInfo($getGosto);

					if($isLike){
						$evento['isLike']="true";
					}else{
						$evento['isLike']="false";
					}

					$sqlMarca = "SELECT * FROM `follow_marca` WHERE `marca_idmarca`='$evento[idmarca]' and `utilizador_idutilizador`='$idUser'";

	    			$listMarca = Request::dataBaseInfo($sqlMarca);

					if($listMarca){
						$evento['isFollowing']="true";
					}else{
						$evento['isFollowing']="false";
					}

					$arrayevento[]=$evento;
				}

				return $arrayevento;
			}else{
				return array();
			}


    }


    function getEventoProdutorFollowing($iduser){



    	$getList = "SELECT evento.*, `tipoevento`.`nome` as tipoevento, `marca`.`idmarca`, `marca`.`nome` as nomeMarca,
			`marca`.`logo`as logoMarca, `marca`.`sede` as sedeMarca,`marca`.`email` as emailMarca, `marca`.`telefone` as TelefoneMarca,
			`marca`.`slogan` as sloganMarca, (SELECT SUM(`stock`)  FROM `bilhete` WHERE `evento_idevento` = `evento`.`idevento` GROUP by `evento_idevento`) as quantidadeBilhete FROM evento, tipoevento, produtor,marca,follow_marca where `marca`.`idmarca`=`follow_marca`.`marca_idmarca` and `follow_marca`.`utilizador_idutilizador`='$iduser' and    `evento`.`estado`=1 and
			`tipoevento`.`idtipoevento`=`evento`.`tipoevento_idtipoevento` AND `produtor`.`idprodutor`=`evento`.`produtor_idprodutor`
			and `produtor`.`marca_idmarca`=`marca`.`idmarca` and `evento`.`publicado`=1 and `evento`.`data`>=CURDATE() order by `evento`.`data` ASC limit 15";


			$arrayRequest = Request::dataBaseInfo($getList);

			if($arrayRequest){

				$arrayevento= array();
				foreach($arrayRequest as $evento){

					$getGosto= "SELECT * FROM gosto where `gosto`.`evento_idevento`=$evento[idevento] and `gosto`.`utilizador_idutilizador`='$iduser' Limit 1";
					$isLike = Request::dataBaseInfo($getGosto);

					if($isLike){
						$evento['isLike']="true";
					}else{
						$evento['isLike']="false";
					}

				
					$evento['isFollowing']="true";
					$arrayevento[]=$evento;
				}

				return $arrayevento;
			}else{
				return array();
			}



    }


	function getMoreEvents(){

		if(isset($_GET['user']) && !empty($_GET['user']) && isset($_GET['quantidade']) && !empty($_GET['quantidade'])){


			$dados= listAllEvents($_GET['user'], $_GET['quantidade']);
			
			if($dados){
				Response::delivery_response(200,"List  Found",$dados);
			}else{
				Response::delivery_response(200,"Nenhum conteúdo","null");
			}

			/*$getList = "SELECT evento.*, `tipoevento`.`nome` as tipoevento, `marca`.`idmarca`, `marca`.`nome` as nomeMarca, `marca`.`logo`as logoMarca, `marca`.`sede` as sedeMarca,
			`marca`.`email` as emailMarca, `marca`.`telefone` as TelefoneMarca,`marca`.`slogan` as sloganMarca FROM evento, tipoevento, produtor,marca where `evento`.`estado`=1 and
			`tipoevento`.`idtipoevento`=`evento`.`tipoevento_idtipoevento` AND `produtor`.`idprodutor`=`evento`.`produtor_idprodutor` and `produtor`.`marca_idmarca`=`marca`.`idmarca`
			and `evento`.`publicado`=1
			order by `evento`.`data` DESC limit $_GET[quantidade],15";
			$arrayRequest = Request::dataBaseInfo($getList);

			if($arrayRequest){

				$arrayevento= array();
				foreach($arrayRequest as $evento){

					$getGosto= "SELECT * FROM gosto where `gosto`.`evento_idevento`='$evento[idevento]' and `gosto`.`utilizador_idutilizador`='$_GET[user]' Limit 1";
					$isLike = Request::dataBaseInfo($getGosto);

					if($isLike){
						$evento['isLike']="true";
					}else{
						$evento['isLike']="false";
					}

					$arrayevento[]=$evento;

				}

				Response::delivery_response(200,"List Guia Found",$arrayevento);
			}else{
				Response::delivery_response(200,"Nenhum conteúdo","null");
			}*/

		}else{
			Response::delivery_response(404,"Requesicao Nao Permitida","null");
		}
    }



	function UserGostaEvento(){


		if(isset($_POST['user']) && !empty($_POST['user']) && isset($_POST['event']) && !empty($_POST['event'])){


			$query = "INSERT INTO gosto (utilizador_idutilizador,evento_idevento) VALUES (:uId,:eId)";
			$data = array(':uId'=>$_POST['user'],':eId'=>$_POST['event']);

			$codeResult = Request::saveIntoDB($query,$data);

			if($codeResult){
				saveHistorico($_POST['user'], "gt", $_POST['event']);
				Response::delivery_response(200,"sucess","null");
			}else{
				Response::delivery_response(200,"error","null");
			}

		}else{
			Response::delivery_response(404,"Requesicao Nao Permitida","null");
		}

	}


	function UserNaoGostaEvento(){


		if(isset($_POST['user']) && !empty($_POST['user']) && isset($_POST['event']) && !empty($_POST['event'])){

			$query = "DELETE FROM gosto WHERE utilizador_idutilizador='$_POST[user]' and evento_idevento='$_POST[event]'";

			if(Request::deleteIntoDB($query)==true){
				saveHistorico($_POST['user'], "n_gt", $_POST['event']);
				Response::delivery_response(200,"sucess","null");
			}else{
				Response::delivery_response(200,"error","null");
			}
		}
		else{
				Response::delivery_response(404,"Requesicao Nao Permitida","null");
		}


	}


	function getCommentByEvent(){  // http://192.168.1.110/passa_free/api/evento/getallcomment/1


		if(isset($_GET['idevent']) && !empty($_GET['idevent'])){


			$getComment= "SELECT idcomentario,evento_idevento,comentario,data,idutilizador, nome as nomeUtilizador,apelido,foto,hora FROM `comentario`,`utilizador` where evento_idevento='$_GET[idevent]' and `comentario`.`utilizador_idutilizador`=`utilizador`.`idutilizador`  order by idcomentario ASC";
			$listComment = Request::dataBaseInfo($getComment);

			if($listComment){

				Response::delivery_response(200,"List Comment",$listComment);
			}else{

				Response::delivery_response(200,"List Not found","null");
			}

		}else{
				Response::delivery_response(404,"Requesicao Nao Permitida","null");
		}

	}



	function saveComment(){

		if(isset($_POST['idevent']) && !empty($_POST['idevent']) && isset($_POST['iduser']) && !empty($_POST['iduser']) && isset($_POST['comment']) && !empty($_POST['comment'])){

			$query = "INSERT INTO comentario (evento_idevento,utilizador_idutilizador,comentario,data, hora) VALUES (:eId,:uId,:com,:dt, :hr)";
			$data = array(':eId'=>$_POST['idevent'],':uId'=>$_POST['iduser'],':com'=>$_POST['comment'], ':dt'=>date("Y-m-d"), ':hr'=>date('H:m:s'));
			$resultInsert= Request::saveIntoDB($query,$data);

			if($resultInsert){
				saveHistorico($_POST['iduser'], "cm", $resultInsert);
				Response::delivery_response(200,"sucess","null");
			}else{
				Response::delivery_response(200,"error","null");
			}


		}else{
			Response::delivery_response(404,"Requesicao Nao Permitida","null");
		}

	}


	function verificacaoDeUser(){

		$getUser= "SELECT * FROM `utilizador` where email='$_POST[email]' Limit 1";
		$userInfo = Request::dataBaseInfo($getUser);

		if($userInfo){
			Response::delivery_response(200,"user existente","null");
		}else{
			Response::delivery_response(200,"user inexistente","null");
		}

	}



	function recoverPassWord(){


		$getUser= "SELECT * FROM `utilizador` where email='$_POST[email]' Limit 1";
		$userInfo = Request::dataBaseInfo($getUser);

		if($userInfo){

			//create new passwod
			$randon= rand(72891,92729);
			$email_password = $randon;

			// encrypty the password
			$newPassword = md5($email_password);

			// update into you data Base

			if(Request::UpdateBd("UPDATE `utilizador` SET `password` = '$newPassword' WHERE `utilizador`.`email` = '$_POST[email]'")){

				$subject="Login Information";
				$messagem= "Password been changed to email $_POST[email] to new password $email_password";
				$from="From: exemple@exemple.com";

				mail("ronilson.cardoso@bonako.com",$subject,$messagem,$from);
				//echo "email sent";
				Response::delivery_response(200,"email sente","null");

			}else{
				//echo "email not sent";
				Response::delivery_response(200,"email not sent","null");

			}

		}else{
			Response::delivery_response(200,"email inexistente","null");
		}

	}


	function cadastrarUsuario(){


		if(isset($_POST['nome']) && !empty($_POST['nome']) && isset($_POST['apelido']) && !empty($_POST['apelido']) && isset($_POST['dataNasc']) && !empty($_POST['dataNasc'])
			&& isset($_POST['email']) && !empty($_POST['email']) && isset($_POST['password']) && !empty($_POST['password']) && isset($_POST['foto']) && !empty($_POST['foto'])){


			if(verificarUserCadastroExistent($_POST['email'])==true){

				Response::delivery_response(200,"error","Cadastro Existente");

			}else{

				$query = "INSERT INTO utilizador (nome,apelido,data_nascimento,email,password, foto) VALUES (:nm,:ap,:dt,:e, :pass, :ft)";
				$data = array(':nm'=>$_POST['nome'],':ap'=>$_POST['apelido'],':dt'=>$_POST['dataNasc'], ':e'=>$_POST['email'], ":pass"=>md5($_POST['password']), ":ft"=>$_POST['foto']);

				$result=Request::saveIntoDB($query,$data);

				if($result){
					Response::delivery_response(200,"sucess",$result);
				}else{
					Response::delivery_response(200,"error","null");
				}

			}

		}else{
			Response::delivery_response(404,"Requesicao Nao Permitida","null");
		}

	}


	function cadastrarUsuarioAndroid(){


		if(isset($_POST['nome']) && !empty($_POST['nome']) && isset($_POST['apelido']) && !empty($_POST['apelido']) && isset($_POST['dataNasc']) && !empty($_POST['dataNasc'])
			&& isset($_POST['email']) && !empty($_POST['email']) && isset($_POST['password']) && !empty($_POST['password']) && isset($_POST['foto']) && !empty($_POST['foto'])){


			if(verificarUserCadastroExistent($_POST['email'])==true){

				Response::delivery_response(200,"error","Cadastro Existente");

			}else{


				$Imagem= UploadFile();

				if($Imagem!="error"){

					$query = "INSERT INTO utilizador (nome,apelido,data_nascimento,email,password, foto) VALUES (:nm,:ap,:dt,:e, :pass, :ft)";
					$data = array(':nm'=>$_POST['nome'],':ap'=>$_POST['apelido'],':dt'=>$_POST['dataNasc'], ':e'=>$_POST['email'], ":pass"=>md5($_POST['password']), ":ft"=>$Imagem);

					$result=Request::saveIntoDB($query,$data);

					if($result){
						Response::delivery_response(200,"sucess",array("id"=>$result,"foto"=>$Imagem, "nome"=>$_POST['nome'], "apelido"=>$_POST['apelido'], "email"=>$_POST['email']));
					}else{
						Response::delivery_response(200,"error","null");
					}

				}else{
					Response::delivery_response(200,"Imagem Invalida","null");
				}
			}

		}else{
			Response::delivery_response(404,"Requesicao Nao Permitida","null");
		}

	}

	function verificarUserCadastroExistent($email){

		$getUser= "SELECT * FROM `utilizador` where email='$email' Limit 1";
		$userInfo = Request::dataBaseInfo($getUser);

		if($userInfo){
			return true;
		}else{
			return false;
		}
	}

	/*function cadastrarUsuario(){


		if(isset($_POST['nome']) && !empty($_POST['nome']) && isset($_POST['apelido']) && !empty($_POST['apelido']) && isset($_POST['dataNasc']) && !empty($_POST['dataNasc'])
			&& isset($_POST['email']) && !empty($_POST['email']) && isset($_POST['password']) && !empty($_POST['password']) && isset($_POST['idcadastro']) && !empty($_POST['idcadastro'])){

			$password= md5($_POST['password']);

			$query = "UPDATE utilizador SET nome='$_POST[nome]', apelido='$_POST[apelido]', data_nascimento='$_POST[dataNasc]', email='$_POST[email]', password='$password'  where `utilizador`.`idutilizador`='$_POST[idcadastro]'";
			$result=Request::UpdateBd($query);

			if($result){

				Response::delivery_response(202,"Cadastro Com sucesso","true");
			}else{
				Response::delivery_response(202,"Cadastro Sem sucesso","false");
			}


		}else{
			Response::delivery_response(404,"Requesicao Nao Permitida","null");
		}

	}*/

	function efectuarLogin(){


		if(isset($_POST['email']) && !empty($_POST['email']) && isset($_POST['password']) && !empty($_POST['password'])){


			$password =md5($_POST['password']);

			$getUser= "SELECT idutilizador,nome,apelido,data_nascimento,foto,email,password,sexo FROM `utilizador` where email='$_POST[email]' and password='$password'";
		    $userInfo = Request::dataBaseInfo($getUser);

			if($userInfo){
				Response::delivery_response(200,"sucess",$userInfo);
			}else{
				Response::delivery_response(200,"error","null");
			}


		}else{
			Response::delivery_response(404,"Requesicao Nao Permitida","null");
		}
	}


	function generateQRCode(){

		$codeContents = 'This Goes From File';
		$codeContents = md5($codeContents);
		$fileName = '006_file_'.md5($codeContents).'.png';

		QRcode::png($codeContents,"008_file.png",QR_ECLEVEL_L, 10);

	}


	function getBilheteFromEvent(){

		//

		if(isset($_GET['idevento']) && !empty($_GET['idevento'])){

			$getBilhete= "SELECT `bilhete`.`idbilhete`,`bilhete`.`evento_idevento`,`bilhete`.`flag` ,`bilhete`.`preco`, (`bilhete`.`stock`-`bilhete`.`comprado`) as stock, `bilhete`.`imagem`, `nome_bilhete` as nome, `descricao_bilhete` as descricao FROM `bilhete` WHERE `bilhete`.`evento_idevento`='$_GET[idevento]' and `bilhete`.`estado`=1 and `bilhete`.`publicado`=1";
			$bilheteInfo = Request::dataBaseInfo($getBilhete);


			if($bilheteInfo){
				Response::delivery_response(200,"List of Bilhete",$bilheteInfo);
			}else{
				Response::delivery_response(200,"Bilhete not Found","null");
			}

		}else{
			Response::delivery_response(404,"Requesicao Nao Permitida","null");
		}
	}



	//*************************************************************************
	//***************** Efectuar Reserva Bilhete ******************************
	//*************************************************************************


	function addBilheteToStandBy(){

		$resultadoError="Bilhetes ";
		$isDesponivel=true;


		$listCompra= array(array("idbilhete"=>"1"),array("idbilhete"=>"2"),array("idbilhete"=>"1"));


		$listCompra = explode(",",$_POST['listCompra']);


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


		if($isDesponivel==true){

			$listReservasFeitas = array();

			foreach($listCompra as $itenConprar){

				$query = "INSERT INTO compra_bilhete (utilizador_idutilizador,bilhete_idbilhete,tipo,estado,id_donobilhete) VALUES (:ut,:tp,:tipo,:es, :iddonu)";
			    $data = array(':ut'=>$_POST['iduser'],':tp'=>$itenConprar,':tipo'=>1, ':es'=>1, ':iddonu'=>$_POST['iduser']);

				$result=Request::saveIntoDB($query,$data);

				if($result){
					$listReservasFeitas []=$result;
				}else{

					foreach($listReservasFeitas as $reservaTodelete){

						$query = "DELETE FROM compra_bilhete WHERE idcompra_bilhete='$reservaTodelete'";
						Request::deleteIntoDB($query);

					}

					Response::delivery_response(200,"Reserva Feita Sem Sucesso","null");

				}

			}

			Response::delivery_response(200,"Reserva Feita Com Sucesso",$listReservasFeitas);

		}else{
			$resultadoError = $resultadoError." nao estao desponivel para a venda";
			Response::delivery_response(200,"Bilhete nao Desponivel",$resultadoError);
		}



	}

	//*************************************************************************
	//***************** Efectuar Comprar Bilhete ******************************
	//*************************************************************************


 	function efectuarComprar(){

		$listCompra= array(array("idreserva"=>"5"),array("idreserva"=>"6"),array("idreserva"=>"7"));


		if(isset($_POST['listReserva']) && !empty($_POST['listReserva']) ){

			$listCompra = explode(",",$_POST['listReserva']);


			$isBuyed=false;

			foreach($listCompra as $list){


				$query = "UPDATE compra_bilhete SET tipo=1 where `compra_bilhete`.`idcompra_bilhete`='$list'";
				$result=Request::UpdateBd($query);

				saveHistorico($_POST['id_user'], "cp", $list);  // registra a compra

				if($result){


				   $getBilhete = "SELECT * FROM `compra_bilhete` WHERE `idcompra_bilhete`='$list' LIMIT 1";
				   $bilheteInfo = Request::dataBaseInfo($getBilhete);

				   if($bilheteInfo){

						$codeContents = '1/'.$list;
						$codeContents = md5($codeContents);


						$randon= rand(72891,92729);
						$randon = $randon;

						// encrypty the password

						$newScript= md5($randon);
						$fileName = "uploads/qrcodes/".$newScript.'_file_d'.'.png';
						$filePath = "../uploads/qrcodes/".$newScript.'_file_d'.'.png';

						QRcode::png($codeContents,$filePath,QR_ECLEVEL_L, 10);

						$data = date("Y-m-d");

						$query = "UPDATE compra_bilhete SET `qr_code`='$fileName',`compra_bilhete`.`codigo_QR`='$newScript',`compra_bilhete`.`dataCompra`='$data' where `compra_bilhete`.`idcompra_bilhete`='$list'";
						$result2=Request::UpdateBd($query);

						if($result2){

							foreach($bilheteInfo as $rowBilhete){

								$query = "UPDATE bilhete SET `comprado`=`comprado`+1 where `bilhete`.`idbilhete`='$rowBilhete[bilhete_idbilhete]'";
								$result3=Request::UpdateBd($query);
							}

							$isBuyed=true;
						}
				   }

				}else{


				}

			}


			if($isBuyed==true){

				Response::delivery_response(200,"Compra Efectuada com sucesso","true");
			}else{
				Response::delivery_response(200,"Compra Efectuada sem sucesso","false");
			}
		}else{
			Response::delivery_response(404,"Operacao Invalida","false");
		}



    }


	function getTipoEvento(){


		$getTipo = "SELECT * FROM `tipoevento` WHERE `tipoevento`.`estado`=1";
	    $tipoEvento = Request::dataBaseInfo($getTipo);


		if($tipoEvento){
			Response::delivery_response(200,"List Tipo Evento",$tipoEvento);
		}else{
			Response::delivery_response(200,"List Evento not Fount","null");
		}


	}


	function getyourPockect(){


		$getTipo = "SELECT idevento,tipoevento_idtipoevento,produtor_idprodutor,data,hora,local,descricao,descricao_bilhete,cartaz,ilha,filtro,`evento`.`nome`, count(idcompra_bilhete) as quantidade FROM `evento`,
		`compra_bilhete`, `utilizador`, `bilhete` WHERE `evento`.`idevento`=`bilhete`.`evento_idevento` and
		`compra_bilhete`.`id_donobilhete`='$_GET[user]' and
		`utilizador`.`idutilizador`=`compra_bilhete`.`id_donobilhete` and `compra_bilhete`.`tipo`=1 and `compra_bilhete`.`bilhete_idbilhete`=`bilhete`.`idbilhete` GROUP by `evento`.`idevento`";
	    $tipoEvento = Request::dataBaseInfo($getTipo);


		if($tipoEvento){
			Response::delivery_response(200,"List Pockect",$tipoEvento);
		}else{
			Response::delivery_response(200,"List Pockect not Fount","null");
		}


	}


	function getFiltroEvento(){


		$data = date("Y-m-d");


		$getEvento = "SELECT `idevento`,`produtor_idprodutor`,`nome`,`data`,`hora`,`local`,`descricao`,`cartaz`,`ilha`,`filtro` FROM `evento` WHERE
		`data`>'$data' and `estado`=1 and `tipoevento_idtipoevento`='$_GET[tipo]' and `evento`.`publicado`=1 ORDER by `data` DESC,`hora` DESC";
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

					$arrayevento[]=$evento;

				}

				Response::delivery_response(200,"List Guia Found",$arrayevento);
		}else{
			Response::delivery_response(200,"List Event not Fount","null");
		}


	}


	function getFiltroUser(){


		$getUser = "SELECT `idutilizador`,`nome`,`apelido`,`data_nascimento`,`foto`,`email`,`sexo` FROM `utilizador` WHERE `nome` LIKE '%".$_GET['dados']."%' or `apelido` LIKE '%".$_GET['dados']."%'
		or `email` LIKE '%".$_GET['dados']."%' or CONCAT (`nome`,' ',`apelido`) LIKE '%".$_GET['dados']."%'  GROUP by `email` order by `nome`,`apelido` ASC";
	    $listUser = Request::dataBaseInfo($getUser);


		if($listUser){
			Response::delivery_response(200,"List User Found",$listUser);
		}else{
			Response::delivery_response(200,"List User not Fount","null");
		}


	}



	function searchEvent(){

		$data = date("Y-m-d");


		$getEvento = "SELECT evento.*, `tipoevento`.`nome` as tipoevento, `marca`.`idmarca`, `marca`.`nome` as nomeMarca, `marca`.`logo`as logoMarca,
		`marca`.`sede` as sedeMarca,`marca`.`email` as emailMarca, `marca`.`telefone` as TelefoneMarca,`marca`.`slogan` as sloganMarca FROM evento, tipoevento,
		produtor,marca where `evento`.`estado`=1 and `evento`.`publicado`=1 and `tipoevento`.`idtipoevento`=`evento`.`tipoevento_idtipoevento` AND `produtor`.`idprodutor`=`evento`.`produtor_idprodutor` and
		`produtor`.`marca_idmarca`=`marca`.`idmarca` and (`evento`.`nome` LIKE '%".$_GET['dados']."%' or `evento`.`local` LIKE '%".$_GET['dados']."%' or `evento`.ilha LIKE '%".$_GET['dados']."%' or `marca`.`nome` LIKE '%".$_GET['dados']."%')
		and `evento`.data>='$data' ";
	    $tipoEvento = Request::dataBaseInfo($getEvento);


		if($tipoEvento){
			Response::delivery_response(200,"List Event Found",$tipoEvento);
		}else{
			Response::delivery_response(200,"List Event not Fount","null");
		}



	}







	//



	//


	function getListBilheteFromPocket(){

		$getTipo = "SELECT `compra_bilhete`.*, `utilizador`.`nome`,`utilizador`.`apelido`,`utilizador`.`foto`,`bilhete`.`nome_bilhete` as tipoBilhete,descricao_bilhete FROM `compra_bilhete`,`utilizador`,`bilhete` WHERE `tipo`=1 AND
		`compra_bilhete`.`id_donobilhete`='$_GET[user]' AND `utilizador`.`idutilizador`=`compra_bilhete`.`id_donobilhete`AND `bilhete`.`idbilhete`=`compra_bilhete`.`bilhete_idbilhete` and
		`bilhete`.`evento_idevento`='$_GET[idevento]'";

		//SELECT `compra_bilhete`.*, `utilizador`.`nome`,`utilizador`.`apelido`,`utilizador`.`foto`,`bilhete`.`nome_bilhete` as tipoBilhete FROM `compra_bilhete`,`utilizador`,`bilhete` WHERE `tipo`=1 AND `compra_bilhete`.`id_donobilhete`=1 and `compra_bilhete`.`estado`=1 AND `utilizador`.`idutilizador`=`compra_bilhete`.`id_donobilhete`AND`bilhete`.`evento_idevento`=5 GROUP by `idcompra_bilhete`
	    $tipoEvento = Request::dataBaseInfo($getTipo);


		if($tipoEvento){
			$valorReturn =array();
			foreach($tipoEvento as $row){
				$codido= (crc32 ('key'.$row['idcompra_bilhete']));
				$row ['genatecode']= $codido;
				$valorReturn[]=$row;
			}

			Response::delivery_response(200,"List Pockect",$valorReturn);
		}else{
			Response::delivery_response(200,"List Pockect not Fount","null");
		}

	}

	/*function saveCouver(){

		if(isset($_FILES['image'])){
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

				$nomeFile= "backend/web/uploads/utilizador_app/".$newScript.".".$file_ext;

				move_uploaded_file($file_tmp,"../".$nomeFile);

				$imageGuardada="uploads/utilizador_app/".$newScript.".".$file_ext;
				$query = "UPDATE `passafree`.`utilizador` SET `foto` = '$imageGuardada' WHERE `utilizador`.`idutilizador` = '$_GET[user]'";
				$result3=Request::UpdateBd($query);

				if($result3){

					Response::delivery_response(200,"Couver Saved with sucess",$imageGuardada);

				}else{
					Response::delivery_response(200,"Couver not Saved","null");
				}
			}else{
				Response::delivery_response(200,"Couver not Saved",$error);
			}

		}
	}*/


	function saveCouver(){

		if(isset($_FILES['image'])){
			  $errors= array();
			  $file_name = $_FILES['image']['name'];
			  $file_size =$_FILES['image']['size'];
			  $file_tmp =$_FILES['image']['tmp_name'];
			  $file_type=$_FILES['image']['type'];
			  $file_ext=strtolower(end(explode('.',$_FILES['image']['name'])));

			$expensions= array("jpeg","jpg","png","JPEG","JPG","PNG");

			if(in_array($file_ext,$expensions)=== false){
				 $errors[]="extension not allowed, please choose a JPEG or PNG file.";
			 }

			if(empty($errors)==true){

				$randon= rand(72891,92729);
				$randon = $randon;
				$newScript= md5($randon);

				$nomeFile= "uploads/utilizador_app/".$newScript.".".$file_ext;

				move_uploaded_file($file_tmp,"../".$nomeFile);
				$imageGuardada="uploads/utilizador_app/".$newScript.".".$file_ext;

				if(!empty($imageGuardada)){
					Response::delivery_response(200,"Couver Saved with sucess",$imageGuardada);
				}else{
					Response::delivery_response(200,"Couver not Saved","null");
				}

			}else{
				Response::delivery_response(200,"Couver not Saved",$errors);
			}

		}
	}


	function sendTicket(){


		if(isset($_POST['oldDonu']) && !empty($_POST['oldDonu']) && isset($_POST['newDonu']) && !empty($_POST['newDonu']) && isset($_POST['idCompra']) && !empty($_POST['idCompra']) ) {

				$query = "UPDATE `compra_bilhete` SET `compra_bilhete`.`id_donobilhete` = '$_POST[newDonu]' , pin='',face='' WHERE `compra_bilhete`.`idcompra_bilhete` = '$_POST[idCompra]'";
				$result3=Request::UpdateBd($query);

				if($result3){
					saveNotification($_POST['oldDonu'], $_POST['newDonu'], "enB", $_POST['idCompra']);

					Response::delivery_response(200,"Bilhete Enviado Com sucesso","true");
				}else{
					Response::delivery_response(200,"Bilhete Enviado Sem sucesso","false");
				}

		}else{

			Response::delivery_response(404,"Requesicao Invalida","");
		}

	}




	function setTicketPin(){


		if(isset($_POST['newPIN']) && !empty($_POST['newPIN']) && isset($_POST['idCompra']) && !empty($_POST['idCompra'])){

			$query = "UPDATE `compra_bilhete` SET `compra_bilhete`.`pin` = '$_POST[newPIN]' WHERE `compra_bilhete`.`idcompra_bilhete` = '$_POST[idCompra]'";
			$result3=Request::UpdateBd($query);

			if($result3){
				Response::delivery_response(200,"Operacao realizador com sucesso","true");
			}else{
				Response::delivery_response(200,"Operacao realizador sem sucesso","false");
			}

		}else{
			Response::delivery_response(404,"Requesicao Invalida","");
		}

	}




	function addFace(){

		if(isset($_FILES['image'])){
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

				$nomeFile= "uploads/ticket_face/".$newScript.".".$file_ext;

				move_uploaded_file($file_tmp,"../".$nomeFile);

				$imageGuardada="uploads/ticket_face/".$newScript.".".$file_ext;
				$query = "UPDATE `compra_bilhete` SET `compra_bilhete`.`face` = '$imageGuardada' WHERE `compra_bilhete`.`idcompra_bilhete` = '$_GET[id_compra]'";
				$result3=Request::UpdateBd($query);

				if($result3){

					Response::delivery_response(200,"Couver Saved with sucess",$imageGuardada);

				}else{
					Response::delivery_response(200,"Face not Saved","null");
				}
			}else{
				Response::delivery_response(200,"Face not Saved",$error);
			}

		}else{
			if(isset($_POST['face'])){
				$imageGuardada= UploadFace("uploads/ticket_face/");

				if($imageGuardada!="error"){
					$query = "UPDATE `compra_bilhete` SET `compra_bilhete`.`face` = '$imageGuardada' WHERE `compra_bilhete`.`idcompra_bilhete` = '$_GET[id_compra]'";
					$result3=Request::UpdateBd($query);
					if($result3){
						Response::delivery_response(200,"Couver Saved with sucess",$imageGuardada);
					}else{
						Response::delivery_response(200,"Face not Saved","null");
					}
				}else{
					Response::delivery_response(200,"Face not Saved","null");
				}
			}else{
				Response::delivery_response(200,"Requesicao Invalida","null");
			}
		}
	}


	function sugerirEvento(){

		if(isset($_POST['iduser']) && !empty($_POST['iduser']) && isset($_POST['idevento']) && !empty($_POST['idevento']) && isset($_POST['idconvidado']) && !empty($_POST['idconvidado'])){


			$data = date("Y-m-d");
			$hora = date("H:i:s");

			$query = "INSERT INTO sugerir_evento (utilizador_idutilizador,utilizador_idconvidado,evento_idevento,data,hora) VALUES (:uId,:idConv,:idEv,:dt,:hr)";
			$data = array(':uId'=>$_POST['iduser'],':idConv'=>$_POST['idconvidado'] ,':idEv'=>$_POST['idevento'] ,':dt'=>$data,':hr'=>$hora);

			$result= Request::saveIntoDB($query,$data);

			if($result){
				saveNotification($_POST['iduser'], $_POST['idconvidado'], "sg", $result);
				Response::delivery_response(200,"sucess",$result);
			}else{
				Response::delivery_response(200,"error","null");
			}


		}else{
			Response::delivery_response(404,"Requesicao Nao Permitida","null");
		}

	}


	function followMarca(){

		if(isset($_POST['iduser']) && !empty($_POST['iduser']) && isset($_POST['idmarca']) && !empty($_POST['idmarca'])){


			$data = date("Y-m-d");
			$hora = date("H:i:s");

			$query = "INSERT INTO follow_marca (utilizador_idutilizador,marca_idmarca,data,hora) VALUES (:uId,:idMarca,:dt,:hr)";
			$data = array(':uId'=>$_POST['iduser'],':idMarca'=>$_POST['idmarca'] ,':dt'=>$data,':hr'=>$hora);

			$result= Request::saveIntoDB($query,$data);

			if($result){
				saveHistorico($_POST['iduser'], "fm", $_POST['idmarca']);
				Response::delivery_response(200,"sucess",$result);
			}else{
				Response::delivery_response(200,"error","null");
			}


		}else{
			Response::delivery_response(404,"Requesicao Nao Permitida","null");
		}

	}


	function unfollowMarca(){


		if(isset($_POST['iduser']) && !empty($_POST['iduser']) && isset($_POST['idmarca']) && !empty($_POST['idmarca'])){

			$query = "DELETE FROM follow_marca WHERE utilizador_idutilizador='$_POST[iduser]' and marca_idmarca='$_POST[idmarca]'";

			if(Request::deleteIntoDB($query)==true){
				saveHistorico($_POST['iduser'], "un_fm", $_POST['idmarca']);
				Response::delivery_response(200,"sucess","true");
			}else{
				Response::delivery_response(200,"error","false");
			}
		}
		else{
			Response::delivery_response(404,"Requesicao Nao Permitida","null");
		}




	}


	function getListMarca(){

		$sqlMarca = "SELECT `idfollow_marca`,`marca_idmarca`, `marca`.`nome`, `marca`.`logo`, `marca`.`sede`, `marca`.`email`, `marca`.`telefone`, `marca`.`slogan` FROM `follow_marca`,`marca` WHERE
		`marca`.`idmarca`=`follow_marca`.`marca_idmarca` and `marca`.`estado`=1 AND `follow_marca`.`utilizador_idutilizador`=$_GET[iduser]";

	    $listMarca = Request::dataBaseInfo($sqlMarca);

		if($listMarca){
			Response::delivery_response(200,"Data Found", $listMarca);
		}else{
			Response::delivery_response(200,"Data nNot Found",array());
		}

	}

	function checkUserFollowMarca(){

		$sqlMarca = "SELECT * FROM `follow_marca` WHERE `marca_idmarca`='$_GET[idmarca]' and `utilizador_idutilizador`='$_GET[iduser]'";

	    $listMarca = Request::dataBaseInfo($sqlMarca);

		if($listMarca){
			Response::delivery_response(200,"Following", "1");
		}else{
			Response::delivery_response(200,"Not Following","0");
		}

	}

	//*************************************************************************
	//*************** SAve User Historico *************************************
	//*************************************************************************


	function saveHistorico($idUser, $codTabela, $idCont){


		$data = date("Y-m-d");
		$hora = date("H:i:s");

		$query = "INSERT INTO `historico` (`utilizador_idutilizador`, `tabela`, `idconteudo`, `data`, `hora`, `estado`) VALUES (:uId,:tb,:idCon,:dt,:hr,:es)";
		$data = array(':uId'=>$idUser,':tb'=>$codTabela ,':idCon'=>$idCont,':dt'=>$data,':hr'=>$hora,':es'=>"1");

		$resultInsert= Request::saveIntoDB($query,$data);

	}

	function saveNotification($idUserEnviar, $idUserReceber, $codTabela, $idCont){


		$data = date("Y-m-d");
		$hora = date("H:i:s");

		$query = "INSERT INTO `notificacao` (`utilizador_idutilizador`, `tabela`, `idconteudo`, `data`, `hora`, `status`, `receive_idutilizador`) VALUES (:uId,:tb,:idCon,:dt,:hr,:es,:rec)";
		$data = array(':uId'=>$idUserEnviar,':tb'=>$codTabela ,':idCon'=>$idCont,':dt'=>$data,':hr'=>$hora,':es'=>"1", ':rec'=> $idUserReceber);
		$resultInsert= Request::saveIntoDB($query,$data);

		if($resultInsert){
			saveHistorico($idUserEnviar, $codTabela, $idCont);
		}
	}


	function getNotification(){


		$sqlNoficacao = "SELECT * FROM `notificacao` WHERE  `receive_idutilizador`='$_GET[iduser]'  ORDER BY `notificacao`.`idnotificacao` DESC";

	    $listNotificacao = Request::dataBaseInfo($sqlNoficacao);

		if($listNotificacao){

			$resultArray= array();

			foreach($listNotificacao as $row){


				if($row['tabela']=='sg'){

					$user="";
					$menssagem="";

					if($row['receive_idutilizador']==$_GET['iduser']){
						$user=$row['utilizador_idutilizador'];
						$menssagem=" sugeriu-te o ";
					}else{
						continue;
					}

					$selectUser = "SELECT CONCAT(`utilizador`.`nome`, ' ', `utilizador`.`apelido`) as user FROM `utilizador` where `utilizador`.`idutilizador`='$user' limit 1";

					$result=Request::dataBaseInfo($selectUser);

					foreach($result as $row2){
						$menssagem =$row2['user'].$menssagem;
					}

					$selectSug = "SELECT * FROM `sugerir_evento` WHERE `sugerir_evento`.`idsugerir_evento`='$row[idconteudo]' limit 1";
					$result=Request::dataBaseInfo($selectSug);


					foreach($result as $row2){

						$selectUser = "SELECT `evento`.`nome` FROM `evento` WHERE evento.idevento='$row2[idsugerir_evento]' limit 1";

						$result3=Request::dataBaseInfo($selectUser);

						foreach($result3 as $row4){
							$menssagem = $menssagem."".$row4['nome'];
						}
						$row['idconteudo']=$row2['evento_idevento'];

					}



					$row['mensagem']= $menssagem;

					$resultArray[]=$row;
				} else {

					if($row['tabela']=='enB'){

						$user="";
						$menssagem="";

						if($row['receive_idutilizador']==$_GET['iduser']){
							$user=$row['utilizador_idutilizador'];
							$menssagem=" enviou-te um bilhete ";

						}else{
							continue;
						}


						$selectUser = "SELECT CONCAT(`utilizador`.`nome`, ' ', `utilizador`.`apelido`) as user FROM `utilizador` where `utilizador`.`idutilizador`='$user' limit 1";
						$result=Request::dataBaseInfo($selectUser);

						foreach($result as $row2){
							$menssagem = $row2['user']."".$menssagem."";
						}

						$selectUser = "SELECT `evento`.`nome`,`bilhete`.`nome_bilhete`, `tipoevento`.`nome` as nomeTipo FROM `evento`,`bilhete`,compra_bilhete,tipoevento WHERE `compra_bilhete`.`idcompra_bilhete`='$row[idconteudo]' and
						`bilhete`.`idbilhete`=`compra_bilhete`.`bilhete_idbilhete` and `bilhete`.`evento_idevento`=`evento`.`idevento` and `tipoevento`.`idtipoevento`=`evento`.`tipoevento_idtipoevento` Limit 1";

						$result=Request::dataBaseInfo($selectUser);

						foreach($result as $row2){
							$menssagem = $menssagem."\"".$row2['nome_bilhete']."\" para ".$row2['nomeTipo']." ".$row2['nome'];
						}

						$row['mensagem']= $menssagem;
						$resultArray[]=$row;
					}
				}
			}
			Response::delivery_response(200,"Data Found", $resultArray);
		}else{
			Response::delivery_response(200,"Data Not Found",array());
		}

	}


	function updateNotificationHistoricoStatus(){


		//echo $_GET['tabela'];


		if(isset($_POST['id']) && !empty($_POST['id']) && isset($_GET['tabela']) && !empty($_GET['tabela'])){

			$sql="";

			if($_GET['tabela']=="notification"){
				$sql="UPDATE `notificacao` SET `notificacao`.`status` = '2' WHERE `notificacao`.`idnotificacao` = '$_POST[id]'";
			}else{
				$sql="UPDATE `historico` SET `estado` = '2' WHERE `historico`.`idhistorico` = '$_POST[id]'";
			}



			$result= Request::UpdateBd($sql);

			if($result){
				Response::delivery_response(200,"Sucesso","true");
			}else{
				Response::delivery_response(200,"Insucesso","false");
			}


		}else{
			Response::delivery_response(404,"Requesicao Invalida",array());
		}




	}




	function getHistorico() {


		$sql="SELECT * FROM `historico` where `historico`.`utilizador_idutilizador`='$_GET[iduser]'";
		$listHistorico = Request::dataBaseInfo($sql);

		if($listHistorico){

			$resultArray= array();

			foreach($listHistorico as $row){



				if($row['tabela']=='enB'){

					$user="";
					$menssagem="Envias-te um Bilhete ";

					$row['mensagem']= $menssagem;
					$resultArray[]=$row;
				}else{
					if($row['tabela']=="cp"){
						$menssagem="Efetuaste uma compra de um bilhete";
						$row['mensagem']= $menssagem;
						$resultArray[]=$row;
					}

				}
			}

			Response::delivery_response(200,"Data Found", $resultArray);


		}else{
			Response::delivery_response(200,"Data Not Found",array());
		}

	}




	function saveUserLoginSocialNetWork(){


		if(isset($_POST['nome']) && isset($_POST['apelido']) && isset($_POST['dtnas']) && isset($_POST['foto']) && isset($_POST['email']) && isset($_POST['resId']) && isset($_POST['tc']) && !empty($_POST['tc'])){


			$data = date("Y-m-d");
			$hora = date("H:i:s");

			/*$query = "INSERT INTO utilizador (nome,apelido,data_nascimento,foto,email,registration_id,tipoCadastro,last_login,timelogin) VALUES
			(:n,:ap,:dt,:ft,:em,:res,:tc,:lastL,:tl) ON DUPLICATE KEY UPDATE nome='$_POST[nome]', apelido='$_POST[apelido]',
			data_nascimento='$_POST[dtnas]', foto='$_POST[foto]', email='$_POST[email]', registration_id='125436', tipoCadastro='$_POST[tc]', last_login='$data', timelogin='$hora'";


			$data = array(':n'=>$_POST['nome'],':ap'=>$_POST['apelido'],':dt'=>$_POST['dtnas'],':ft'=>$_POST['foto'],':em'=>$_POST['email'],':res'=>$_POST['resId'],':tc'=>$_POST['tc'],':lastL'=>$data, ':tl'=>$hora);

			$codeResult = Request::saveIntoDB($query,$data);

			if($codeResult){
				//saveHistorico($_POST['user'], "gt", $_POST['event']);
				Response::delivery_response(200,"Sucesso",$codeResult);
			}else{
				Response::delivery_response(200,"error","null");
			}*/

			$sql="SELECT * FROM `utilizador` where `utilizador`.`registration_id`='$_POST[resId]' and `utilizador`.`tipoCadastro`='$_POST[tc]' Limit 1";
			$isRegister = Request::dataBaseInfo($sql);

			if($isRegister){

				 $id="";

				foreach($isRegister as $row){
					$id= $row['idutilizador'];
					break;
				}

				$sql="UPDATE `utilizador` SET nome='$_POST[nome]', apelido='$_POST[apelido]', data_nascimento='$_POST[dtnas]',foto='$_POST[foto]',email='$_POST[email]'
					,registration_id='$_POST[resId]',tipoCadastro='$_POST[tc]',last_login='$data',timelogin='$hora' where idutilizador='$id'";

				$result= Request::UpdateBd($sql);

				if($result){
					Response::delivery_response(200,"Sucesso",$id);
				}else{
					Response::delivery_response(200,"Error","null");
				}


			}else{

				$query = "INSERT INTO utilizador (nome,apelido,data_nascimento,foto,email,registration_id,tipoCadastro,last_login,timelogin) VALUES (:n,:ap,:dt,:ft,:em,:res,:tc,:lastL,:tl)";
				$data = array(':n'=>$_POST['nome'],':ap'=>$_POST['apelido'],':dt'=>$_POST['dtnas'],':ft'=>$_POST['foto'],':em'=>$_POST['email'],':res'=>$_POST['resId'],':tc'=>$_POST['tc'],':lastL'=>$data, ':tl'=>$hora);

				$codeResult = Request::saveIntoDB($query,$data);
				if($codeResult){
					Response::delivery_response(200,"Sucesso",$codeResult);
				}else{
					Response::delivery_response(200,"Error","null");
				}
			}


		}else{
			Response::delivery_response(404,"Requesicao Nao Permitida","null");
		}

	}




	function UploadFile(){

		if(isset($_POST['foto']) && isset($_POST['foto'])){

			$randon= rand(72891,92729);
			$randon = $randon;
			$newScript= md5($randon);

			$nomeFile= "uploads/utilizador_app/".$newScript.".png";

			$decodeImage = base64_decode($_POST['foto']);
			$data = file_put_contents("../".$nomeFile, $decodeImage);

			//move_uploaded_file($file_tmp,"../".$nomeFile);
			$imageGuardada="uploads/utilizador_app/".$newScript.".png";

			if(file_exists("../".$nomeFile)){
				if(!empty($imageGuardada)){
					return $imageGuardada;
				}else{
					return "error";
				}
			}else{
				return "error";
			}
		}else{
			return "error";
		}

	}

	function UploadFace($urlImage){

		if(isset($_POST['face']) && isset($_POST['face'])){

			$randon= rand(72891,92729);
			$randon = $randon;
			$newScript= md5($randon);

			$nomeFile= $urlImage.$newScript.".png";

			$decodeImage = base64_decode($_POST['face']);
			$data = file_put_contents("../".$nomeFile, $decodeImage);

			//move_uploaded_file($file_tmp,"../".$nomeFile);
			$imageGuardada="uploads/ticket_face/".$newScript.".png";

			if(file_exists("../".$nomeFile)){
				if(!empty($imageGuardada)){
					return $imageGuardada;
				}else{
					return "error";
				}
			}else{
				return "error";
			}
		}else{
			return "error";
		}

	}



	function getEventById(){

		if(isset($_GET['user']) && !empty($_GET['user'])  && isset($_GET['idevent']) && !empty($_GET['idevent'])){

			$getList = "SELECT evento.*, `tipoevento`.`nome` as tipoevento, `marca`.`idmarca`, `marca`.`nome` as nomeMarca,
			`marca`.`logo`as logoMarca, `marca`.`sede` as sedeMarca,`marca`.`email` as emailMarca, `marca`.`telefone` as TelefoneMarca,
			`marca`.`slogan` as sloganMarca, (SELECT SUM(`stock`)  FROM `bilhete` WHERE `evento_idevento` = `evento`.`idevento` GROUP by `evento_idevento`) as quantidadeBilhete FROM evento, tipoevento, produtor,marca where `evento`.`estado`=1 and
			`tipoevento`.`idtipoevento`=`evento`.`tipoevento_idtipoevento` AND `produtor`.`idprodutor`=`evento`.`produtor_idprodutor`
			and `produtor`.`marca_idmarca`=`marca`.`idmarca` and `evento`.`idevento`='$_GET[idevent]' and `evento`.`publicado`=1 order by `evento`.`data` limit 1";


			$arrayRequest = Request::dataBaseInfo($getList);

			if($arrayRequest){

				$arrayevento= array();
				foreach($arrayRequest as $evento){

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
				Response::delivery_response(200,"Nenhum conteúdo","null");
			}

		}else{
			Response::delivery_response(404,"Requesicao Nao Permitida","null");
		}
    }


    function updateUserPerfil(){


    	if(isset($_POST['nome']) && !empty($_POST['nome'])  && isset($_POST['apelido']) && !empty($_POST['apelido']) && isset($_POST['email']) && !empty($_POST['email']) && isset($_POST['password']) && !empty($_POST['password'])){
    			//if(Request::UpdateBd("UPDATE `passafree`.`utilizador` SET `password` = '$newPassword' WHERE `utilizador`.`email` = '$_POST[email]'")){


				//		Response::delivery_response(200,"email sente","null");

				//}else{
				//	Response::delivery_response(200,"email not sent","null");

				//}
    		$image ="null";
    		if(isset($_POST['foto']) && !empty($_POST['foto'])){
    				$image=UploadFile();
    		}

    		$sqlUpdate="";
    		$userPass = md5($_POST['password']);
    		if($image!="error" && $image!="null"){
    			$sqlUpdate = "UPDATE `utilizador` SET `nome` = '$_POST[nome]', `apelido`='$_POST[apelido]', `foto`='$image', `password`='$userPass', `email`='$_POST[email]' WHERE `utilizador`.`idutilizador` = '$_POST[iduser]'";
    		}else{
				$sqlUpdate = "UPDATE `utilizador` SET `nome` = '$_POST[nome]', `apelido`='$_POST[apelido]', `password`='$userPass',`email`='$_POST[email]' WHERE `utilizador`.`idutilizador` = '$_POST[iduser]'";
    		}

    		$result=Request::UpdateBd($sqlUpdate);

    		if ($result) {
    			# code...
    			Response::delivery_response(200,"Conteúdo Alterado","$image");
    		}else{
    			Response::delivery_response(200,"Conteúdo Nao Alterado","false");
    		}

    	}else{
    		Response::delivery_response(200,"Requesicao Invalida","null");
    	}

    }
















	function testQR(){

		$name="qrcodes/data/qrcodes.png";


		QRcode::png('some othertext 1234',$name,QR_ECLEVEL_L, 10);



		// === Adding image to qrcode
		$QR = imagecreatefrompng($name);
		$logo = "qrcodes/data/tt.png";

		if($logo !== FALSE){
			$logopng = imagecreatefrompng($logo);
			$QR_width = imagesx($QR);
			$QR_height = imagesy($QR);
			$logo_width = imagesx($logopng)/8;
			$logo_height = imagesy($logopng)/8;

			list($newwidth, $newheight) = getimagesize($logo);
			$out = imagecreatetruecolor($QR_width, $QR_width);
			imagecopyresampled($out, $QR, 0, 0, 0, 0, $QR_width, $QR_height, $QR_width, $QR_height);
			imagecopyresampled($out, $logopng, $QR_width/2.2, $QR_height/2.2, 0, 0, $QR_width/8, $QR_height/8, $newwidth, $newheight);

		}
		imagepng($out,"qrcodes/data/de.png");
		imagedestroy($out);
	}

?>
