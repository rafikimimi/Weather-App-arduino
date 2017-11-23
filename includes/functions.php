<?php
error_reporting(E_ALL ^ E_DEPRECATED); 
	date_default_timezone_set("Africa/Nairobi");
	function ErrorMsg($msg){
		echo '<div class="alert alert-danger alert-dismissable" style="width:70%; margin-top:35%;"> 
			   <button type="button" class="close" data-dismiss="alert"  
			      aria-hidden="true"> 
			      &times; 
			   </button>'. $msg. '</div>';
	}

	function SuccessMsg($msg){
		echo '<div class="alert alert-success alert-dismissable" style="width:70%;> 
			   <button type="button" class="close" data-dismiss="alert"  
			      aria-hidden="true"> 
			      &times; 
			   </button>'. $msg. '</div>';
	}

	function emailValidate($email){
		if(preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/i", $email)){
			// echo 'Please enter a valid email address';
			return true;
		}
	}

	function phoneNumberValidate($mobile){
		if(is_numeric($mobile)){		
			// echo 'Please enter the valid Mobile number';	
			return true;		
		}
	}

	function sqlSafe($val){
		return trim(htmlentities(mysql_real_escape_string($val)));
	}

?>