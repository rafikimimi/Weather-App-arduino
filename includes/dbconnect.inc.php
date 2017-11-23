<?php  

	error_reporting(E_ALL ^ E_DEPRECATED);

	$host="localhost";
	$user="root";
	$password='';
	$db="ammsdb";

	if(mysql_connect($host, $user, $password)){
		if(mysql_select_db($db)){
			// echo 'selected';
		}else{
			echo mysql_error();
		}
	}else{
		echo mysql_error();
	}
?>