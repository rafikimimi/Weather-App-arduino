<?php
 if(!isset($_SESSION)) 
    { 
        session_start(); 
    }
error_reporting(E_ALL ^ E_DEPRECATED);
	include "includes/core.inc.php";
	if(!loggedIn())
	{
		header("location: ../");
	}
?>

