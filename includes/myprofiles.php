
<div class="colltodaypannel">
<div style="width:100%;height:40px; background-color: #005ea6;float:left; text-align:left;">
 <?php 
  ob_start();
 $username=$_SESSION['amms_user_name'];
$role =$_SESSION['amms_user_role'];
 include "dbconnect.inc.php";
  $userInfo=mysql_query("SELECT * FROM users WHERE email='$username'") or die(mysql_error());
			   if(mysql_num_rows($userInfo)>0){
				  $rows=mysql_fetch_array($userInfo);
				  $fname=$rows['fname'];
				  $sname=$rows['sname'];
				  $bdate=$rows['bdate'];
				  $location=$rows['Location'];
				  $gender=$rows['gender'];
				  if($gender=='M'){
					$gender='Male';  
				  }else{
					$gender='Female';  
				  }
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
	   <h4 style="margin-top:-1%;">My Profile</h4>
	 
	
	   <div style="width:100%;height:auto;
	   background-color:#fff; height:auto; 
	   border:1px solid #E5E7E9;overflow:auto;">
	      
		  <div style="float:left; height:auto; width:48%; color:#283747;">
           <label style="margin-left:10px; margin-top:10px; float:left">First Name</label>
		   <input type="text" name="fname" class="form-control" 
		   placeholder="<?php echo $fname?>" 
		   style="float:left; width:90%; height:40px; margin-top:0%; margin-left:10px;" disabled >
		  </div>
	   
	      
		  <div style="float:left; height:auto; width:48%; color:#283747;">
           <label style="margin-left:10px; margin-top:10px; float:left">Surname</label>
		   <input type="text" name="sname" class="form-control" 
		   placeholder="<?php echo  $sname?>" 
		   style="float:left; width:90%; height:40px;margin-top:0%; margin-left:10px;" disabled >
		  </div>
	  
	  <br/>
	  
	  <div style="float:left; height:auto; width:48%; color:#283747;">
           <label style="margin-left:10px; margin-top:5px; float:left">Gender</label>
		   <select name="gender" class="form-control" style="float:left; width:90%; height:37px;margin-top:0%; margin-left:10px;" disabled  required>
								<option value="" selected><?php echo $gender?></option>
								<option value="Male">Male</option>
								<option value="Female">Female</option>
							</select>
	 </div>
	 
	 <div style="float:left; height:auto; width:48%; color:#283747;">
           <label style="margin-left:10px; margin-top:5px; float:left">Birthday</label>
		   <input type="text" name="sname" class="form-control" 
		   placeholder="<?php echo $bdate?>" 
		   style="float:left; width:90%; height:40px;margin-top:0%; margin-left:10px;" disabled   >
	</div><br/><br/>
		  
	 <div style="float:left; height:auto; width:48%; color:#283747;">
           <label style="margin-left:10px; margin-top:10px; float:left">Phone Number</label>
		   <input type="text" name="phone" class="form-control" 
		   placeholder="<?php echo $phone?>" 
		   style="float:left; width:90%; height:40px; margin-top:0%; margin-left:10px;" >
		  </div>
	 <div style="float:left; height:auto; width:48%; color:#283747;">
           <label style="margin-left:10px; margin-top:10px; float:left">Email Address</label>
		   <input type="text" name="email" class="form-control" 
		   placeholder="<?php echo $email?>" 
		   style="float:left; width:90%; height:40px; margin-top:0%; margin-left:10px;" disabled >
    </div><br/>
	
	<div style="float:left; height:auto; width:48%; color:#283747;">
           <label style="margin-left:10px; margin-top:10px; float:left">Physical Address</label>
		   <input type="text" name="address" class="form-control" 
		   placeholder="<?php echo $address?>" 
		   style="float:left; width:90%; height:40px; margin-top:0%; margin-left:10px;" >
      </div>
   
     <?php
	 if($role!='admin'){
	   ?>
	   <div style="float:left; height:auto; width:48%; color:#283747;">
           <label style="margin-left:10px; margin-top:10px; float:left">Station Name</label>
		   <input type="text" name="station" class="form-control" 
		   placeholder="<?php echo $location?>" 
		   style="float:left; width:90%; height:40px; margin-top:0%; margin-left:10px;" >
      </div>
	   <?php
	   }
	 ?>
		  
	  </div>
	  
 <button type="submit" class="loginbutton" 
 name="update" id="update" style="width:15%; height:40px; margin-right:8%;
 border-radius:5px; float:right;">Update</button>
 
 
 <?php
if(isset($_POST['update'])){
				
				if($_POST['phone']!=''){
			     $phone=sqlSafe($_POST['phone']);
				  if(!phoneNumberValidate($phone)){
		         die(ErrorMsg("Invalid phone number!"));
	             }else if($phone[0]!=0 or strlen($phone)<10 or strlen($phone)>10 ){
		            die(ErrorMsg("Invalid phone number!"));
	           }else{
			       $phone = ltrim($phone, '0');
		           $phone='+255'.$phone;
				 $updatePhone="UPDATE users SET  phone='$phone' WHERE email='$username'";
				 $sendP=mysql_query($updatePhone);
				  if(!$sendP){
					  die(ErrorMsg("Failed to update phone number!"));
					 //die(mysql_error());
				  }
			   }
			  }	

				if($_POST['address']!=''){
			     $address=sqlSafe($_POST['address']);
				 $updateaddress="UPDATE users SET  address='$address' WHERE email='$username'";
				 $sendP=mysql_query($updateaddress);
				  if(!$sendP){
					  die(ErrorMsg("Failed to update physical address!"));
					 //die(mysql_error());
				  }
			  }	
 header('Location:profiles.php');			  
}	
?>
	  
	  </div>
	 </div>
  </form>
  
</div>