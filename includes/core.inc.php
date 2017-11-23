<?php
	if(!isset($_SESSION)) 
    { 
        session_start(); 
    }
error_reporting(E_ALL ^ E_DEPRECATED); 
	ob_start();
	function loggedIn()
	{
		if(isset($_SESSION['amms_user_id']) && !empty($_SESSION['amms_user_id']))
		{
			return true;
		}
		else
		{
			return false;
		}
	}	
	loggedIn();
?>