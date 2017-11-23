
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
	   <h4 style="margin-top:-1%;">User Information</h4>
	
	   <div style="width:100%;height:auto;
	   background-color:#fff; height:auto; 
	   border:1px solid #E5E7E9;overflow:auto;">
	    
	<?php
 $admin=mysql_query("SELECT * FROM log WHERE username='$username'") or die(mysql_error());
if(mysql_num_rows($admin)>0){  
	  ?>
	<table class="mytable" >
    <tr  class="tbth tableh" style="height:35px;">
      <th style="width:30%; padding-left:10px;">Attribute</th>
      <th >Value</th>
    </tr>
	  <?php	  
	  $counter=1;
    while($ro=mysql_fetch_array($admin)){
		$role=$ro['role'];
if($role=='admin'){
	$role1='Administrator';
}


if($role=='officer'){
	$role1='Station Officer';
}
		
        $username=$ro['username'];
		$status=$ro['status'];
		
  $userData=mysql_query("SELECT * FROM users WHERE email='$username'") or die(mysql_error());
  
    if(mysql_num_rows($userData)>0){
				  $data=mysql_fetch_array($userData);
				  $fname=$data['fname'];
				  $sname=$data['sname'];
				  $gender=$data['gender'];
				  $station=$data['Location'];
				  if($gender=='M'){
					$gender='Male';  
				  }else{
					$gender='Female';   
				  }
				  $bdate=$data['bdate'];
				  $bdate=date('D d F Y', strtotime($bdate));
				  $phone=$data['phone'];
				  $email=$data['email'];
				  $address=$data['address'];
				  $regdate=$data['dateRegistered'];
				  $regdate=date('D d F Y', strtotime($regdate));
				  $regBy=$data['RegisteredBy'];
				  $reg=mysql_query("SELECT * FROM users WHERE email='$regBy'") or die(mysql_error());
				  if(mysql_num_rows($reg)>0){
					  $registral=mysql_fetch_array($reg);
					  $registralDetails=$registral['fname'].' '.$registral['sname'];
				  }else{
					 $registralDetails='Registral Not Found'; 
				  }
			   }
	  ?>
	 <tr class="tablerow">
      <th class="tbth " style="font-weight:bold !important; padding-left:10px;">Full Name</th>
      <th class="tbth " style="font-weight:normal !important"><?php   echo $fname.' '.$sname?></th>
    </tr>
	
	<tr>
      <th class="tbth " style="font-weight:bold !important; padding-left:10px;" >Gender</th>
      <th class="tbth " style="font-weight:normal !important"><?php echo $gender?></th>
    </tr>
	
	<tr class="tablerow">
      <th class="tbth " style="font-weight:bold !important; padding-left:10px;">Birth Date</th>
      <th class="tbth " style="font-weight:normal !important"><?php echo $bdate?></th>
    </tr>
	
	<tr class="tablerow">
      <th class="tbth " style="font-weight:bold !important; padding-left:10px;">Phone Number</th>
      <th class="tbth " style="font-weight:normal !important"><?php echo $phone?></th>
    </tr>
	
	<tr class="tablerow">
      <th class="tbth " style="font-weight:bold !important; padding-left:10px;">Email Address</th>
      <th class="tbth " style="font-weight:normal !important"><?php echo $email?></th>
    </tr>
	
	<tr class="tablerow">
      <th class="tbth " style="font-weight:bold !important; padding-left:10px;">Physical Address</th>
      <th class="tbth " style="font-weight:normal !important"><?php echo $address?></th>
    </tr>
	
	<tr class="tablerow">
      <th class="tbth " style="font-weight:bold !important; padding-left:10px;">Account Registration Date</th>
      <th class="tbth " style="font-weight:normal !important"><?php echo $regdate?></th>
    </tr>
	
	<tr class="tablerow">
      <th class="tbth " style="font-weight:bold !important; padding-left:10px;">Registered By Admin</th>
      <th class="tbth " style="font-weight:normal !important"><?php echo $registralDetails?></th>
    </tr>
	
	
	<tr class="tablerow">
      <th class="tbth " style="font-weight:bold !important; padding-left:10px;">User Role</th>
      <th class="tbth " style="font-weight:normal !important"><?php echo $role1?></th>
    </tr>
	
	<?php
	if($role=='officer'){
        ?>
	<tr class="tablerow">
      <th class="tbth " style="font-weight:bold !important; padding-left:10px;">Station Name</th>
      <th class="tbth " style="font-weight:normal !important"><?php echo $station?></th>
    </tr>
		<?php
     }
	
	?>
	<tr class="tablerow">
      <th class="tbth " style="font-weight:bold !important; padding-left:10px;">Account Status</th>
      <th class="tbth " style="font-weight:normal !important"><?php echo $status?></th>
    </tr>
	
	  <?php
	  $counter++;
	}
 echo "</table>";	
  }
?>
	  </div>
	    <p style="margin-left:10px; margin-top:10px;">What would you like to do for this user?</p>
 <form method="POST" action="" style="overflow:auto;">
		   <div style="float:left; height:auto; width:48%; color:#283747;">
		   <select name="action" class="form-control" style="float:left; width:90%; height:37px;margin-top:0%; margin-left:10px;">
								<option value="" selected>Select an action</option>
								<option value="Suspend">Suspend User</option>
								<option value="Activate">Activate User</option>
								<option value="Reset">Reset Password</option>
								<?php
								
if($role=='officer'){
	?>
	<option value="upgrade">Give User Administrative Previledges</option>
	<?php
}
								
								?>
							</select>
	      </div><br/><br/>
		  <?php
		  if($role=='officer'){
			  ?>
		 <div style="height:auto; width:48%; color:#283747;">
           <label style="margin-left:10px; margin-top:10px; float:left">Update User Station</label>
		   <input type="text" name="station" class="form-control" 
		   placeholder="New Station here" 
		   style="float:left; width:90%; height:40px; margin-top:0%; margin-left:10px;">
        </div><br/>	<br/> <br/>	<br/>  
			  <?php
		  }else{
			  echo '<br/><br/>';
		  }
		  
		  ?>
		
		
		  
 <button type="submit" class="loginbutton" 
 name="update" id="update" style="width:15%; height:40px; margin-right:8%;
 border-radius:5px; float:right;">Update</button>
  </form><br/>
   <?php
   
      if(isset($_POST['update'])){
		 
		 

		 if($_POST['action']!=''){
			$action=$_POST['action']; 
			
			if($action=='Suspend'){
			$update=mysql_query("UPDATE log SET status='suspended' WHERE username='$username' ") or die(ErrorMsg(mysql_error()));
			SuccessMsg("User Suspended Successfully");
		}
		
		if($action=='Activate'){
			$update=mysql_query("UPDATE log SET status='active' WHERE username='$username' ") or die(ErrorMsg(mysql_error()));
			SuccessMsg("User Activated Successfully");
		}
		
		if($action=='Reset'){
			$surname=strtoupper($sname);
			$pass=md5(md5(md5($surname)));
			$update=mysql_query("UPDATE log SET password='$pass' WHERE username='$username' ") or die(ErrorMsg(mysql_error()));
			SuccessMsg("Default Password has been set successfully");
		}
		
		if($action=='upgrade'){
			$update=mysql_query("UPDATE log SET role='admin' WHERE username='$username' ") or die(ErrorMsg(mysql_error()));
			SuccessMsg("This user has been set to administrative previlddges!");
		}
		 }
		 
		
		if($_POST['station']!=''){
			  $station=sqlSafe($_POST['station']);
			  $updateStation="UPDATE users SET Location='$station' WHERE email='$username'";
			  $sendP=mysql_query($updateStation);
				  if(!$sendP){
					  die(ErrorMsg("Failed to update physical address!"));
					 //die(mysql_error());
				  }else{
					SuccessMsg("User Station has been Updated Successfully!");  
				  }
	  }
	  
	  }
   
   ?>
  
</div>