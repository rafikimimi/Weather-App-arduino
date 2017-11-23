
<div class="colltodaypannel">
<div style="width:100%;height:40px; background-color: #005ea6;float:left; text-align:left;">
 <?php 
 if($_SESSION['amms_user_role']=='admin'){
	 ?>
	<p style="color:#fff; margin-left:10px; margin-top:10px; font-size:18px;"><?php echo 'System Administrator';?><p>
	 <?php

 }else{
	 
	  ?>
	<p style="color:#fff; margin-left:10px; margin-top:10px; font-size:18px;"><?php echo 'Station Officer'.' - '.$_SESSION['location'];?><p>
	 <?php
 } 
 ?>
</div>
<div class="my-container" style="margin-top:7%; ">
  <form method="post" action="" style="width:100%; float:left; overflow:auto; text-align:left;">
	 <div class="well" style="overflow:auto;">
	   <h4 style="margin-top:-1%;">Change Password</h4>
	 
	
	   <div style="width:100%;height:auto;
	   background-color:#fff; height:auto; 
	   border:1px solid #E5E7E9;overflow:auto;">
	      
		  <div style="height:auto; width:100%; color:#283747;">
           <label style="margin-left:10px; margin-top:10px;">Current Password</label>
		   <input type="password" name="cuPass" class="form-control" 
		   placeholder="Enter Current Password here" 
		   style="float:left; width:90%; height:40px; margin-top:0%; margin-left:10px;" required>
		  </div><br/>
	   
	      
		 
	 <div style=" height:auto; width:100%; color:#283747;">
           <label style="margin-left:10px; margin-top:10px;">New Password</label>
		   <input type="password" name="NewPass" class="form-control" 
		   placeholder="Enter New Password here" 
		   style="float:left; width:90%; height:40px; margin-top:0%; margin-left:10px;" required>
	</div><br/>
	
		 
	 <div style=" height:auto; width:100%; color:#283747;">
           <label style="margin-left:10px; margin-top:10px;">Confirm New Password</label>
		   <input type="password" name="repass" class="form-control" 
		   placeholder="Retype New Password here" 
		   style="float:left; width:90%; height:40px; margin-top:0%; margin-left:10px;" required>
	</div><br/>

	  </div>
	  
	  <?php
if(isset($_REQUEST['changepassword'])){
        include "dbconnect.inc.php";
        $username=$_SESSION['amms_user_name'];
		$currentPassword=sqlSafe($_POST['cuPass']);
		$password=sqlSafe($_POST['NewPass']);
		$repassword=sqlSafe($_POST['repass']);
		
		$currentPass=md5(md5(md5($currentPassword)));
		$pass=md5(md5(md5($password)));

		if(strlen(preg_replace('/\s+/u', '', $currentPassword)) == 0){
			die(ErrorMsg("Please, you must provide Password"));}
		if(strlen(preg_replace('/\s+/u', '', $password)) == 0){
			die(ErrorMsg("Please, you must provide Password"));}
		if(strlen(preg_replace('/\s+/u', '', $repassword)) == 0){
			die(ErrorMsg("Please, you must provide Password"));}
		
		$check=mysql_query("SELECT * FROM log WHERE username='$username' AND password='$currentPass'") or 
		die(ErrorMsg(mysql_error()));
		if(mysql_num_rows($check) > 0){
			if($password != $repassword){
				die(ErrorMsg("Password does not matching"));
			}else{
				$change="UPDATE log SET password='$pass' WHERE username='$username' ";
				if(mysql_query($change)){
				SuccessMsg("Password Changed successfully");
				}else{
					die(ErrorMsg(mysql_error()));
				}
			}
		}else{
			ErrorMsg("Incorrect Current Password");
		}		
		mysql_close();
	}
	
	?>
	  <button type="submit" class="loginbutton" 
 name="changepassword" id="changepassword" style="width:15%; height:40px; margin-right:8%;
 border-radius:5px; float:right;">Change</button>
	 </div>
  </form>
  
</div>