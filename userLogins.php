<?php
  if(!isset($SESSION)){
	  session_start();
  }
  include "includes/core.inc.php";
  function sqlSafe($val){
		return trim(htmlentities(mysql_real_escape_string($val)));
	}
?>
<div id="form_sample" style="width:400px;height:40px"></div>
<?php
if(isset($_POST['login'])){
	$_SESSION['Error']='';
	require_once "includes/dbconnect.inc.php";
		$username=sqlSafe($_POST['username']);
		$password=sqlSafe($_POST['pass']);
		$password=md5(md5(md5($password)));

		$query=mysql_query("SELECT * FROM log WHERE username='$username' AND password='$password' AND status='active'") or die(mysql_error());
		  if(mysql_num_rows($query)>0){
			 
			 while($row=mysql_fetch_array($query)){
             $role=$row['role'];	
             $username=$row['username'];		 
     
			 $userInfo=mysql_query("SELECT * FROM users WHERE email='$username'") or die(mysql_error());
			   if(mysql_num_rows($userInfo)>0){
				  $rows=mysql_fetch_array($userInfo);
				  $fname=$rows['fname'];
				  $sname=$rows['sname'];
				  $bdate=$rows['bdate'];
				  $location=$rows['Location'];
				  $gender=$rows['gender'];
				  $phone=$rows['phone'];
				  $email=$rows['email'];
				  $address=$rows['address'];
				    if($role=='admin'){
					 $station='NA';	
					}else{
					  $station=$rows['Location'];	
					}  
			   }else{
				   echo 'user not found!';
			   }  
			 }

	$_SESSION['amms_user_role']=$role;
	$_SESSION['amms_user_name']= $username;
	$_SESSION['amms_user_fname']=$fname;
	$_SESSION['amms_user_sname']=$sname;
	$_SESSION['location']=$location;
	$_SESSION['birthday']=$bdate;
	$_SESSION['gender']=$gender;
	$_SESSION['phone']= $phone;
	$_SESSION['email']= $email;
	$_SESSION['address']= $address;
	$_SESSION['station']= $station;
      echo  $_SESSION['amms_user_role'];
	  
    header("Location:home.php");	
		  }else{
			$_SESSION['Error']="Invalid Username or Password[Possibly your account might have been suspended]";
			header('Location:index.php');
			
		  }	
}


?>