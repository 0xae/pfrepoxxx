<?php

	/*function bd_connect(){
		$HOST	= "mysql:dbname=app_passafree1;host=appbakarycom.ipagemysql.com";
		$USER	= "passafree2";
		$PASS	= "#!password!1";
		$dbcon = new PDO($HOST, $USER, $PASS);
		return 	$dbcon;
	}*/

	function bd_connect(){
		$HOST	= "mysql:dbname=passafree_ultimate;host=localhost";
		$USER	= "root";
		$PASS	= "";
		$dbcon = new PDO($HOST, $USER, $PASS);
		return 	$dbcon;
	}
	

?>