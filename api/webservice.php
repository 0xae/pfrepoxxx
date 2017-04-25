<?php
	require_once "Response.php";
	require_once "Request.php";
	//require_once "src/QrCode.php";
	include_once('phpqrcode/qrlib.php'); 
	

	header('Content-Type: text/plain; charset=ISO-8859-1');
	header("Access-Control-Allow-Origin: *");

	if ($_SERVER['REQUEST_METHOD'] === 'POST') {

		//$_GET['function']();
		if(isset($_GET['function']) && !empty($_GET['function'])){
			
			if(function_exists($_GET['function'])){
				$_GET['function']();	
			}
			else{
				Response::delivery_response(400,"request function invalid",NULL);
			}
		}
		else{
			Response::delivery_response(400,"request invalid",NULL);
		}
	}

	if ($_SERVER['REQUEST_METHOD'] === 'GET') {
		if(isset($_GET['function']) && !empty($_GET['function'])){

			if(function_exists($_GET['function'])){
				$_GET['function']();	
			}
			else{

				Response::delivery_response(400,"request  function invalid",NULL);
			}
		}
		else{
			Response::delivery_response(400,"request invalid",NULL);
		}
	}
?>