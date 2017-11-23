
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
	   <h4 style="margin-top:-1%;"><?php
	   if($role=='admin'){
	   echo  'Register New Administrator';
	   }else{
		echo  'Register New Station Officer';   
	   }
	   ?></h4>
	 
	
	   <div style="width:100%;height:auto;
	   background-color:#fff; height:auto; 
	   border:1px solid #E5E7E9;overflow:auto;">
	      
		  <div style="float:left; height:auto; width:48%; color:#283747;">
           <label style="margin-left:10px; margin-top:10px; float:left">First Name</label>
		   <input type="text" name="fname" class="form-control" 
		   placeholder="Enter Firstname" 
		   style="float:left; width:90%; height:40px; margin-top:0%; margin-left:10px;" required>
		  </div>
	   
	      
		  <div style="float:left; height:auto; width:48%; color:#283747;">
           <label style="margin-left:10px; margin-top:10px; float:left">Surname</label>
		   <input type="text" name="sname" class="form-control" 
		   placeholder="Enter Surname" 
		   style="float:left; width:90%; height:40px;margin-top:0%; margin-left:10px;" required>
		  </div>
	  
	  <br/>
	  
	  <div style="float:left; height:auto; width:48%; color:#283747;">
           <label style="margin-left:10px; margin-top:5px; float:left">Gender</label>
		   <select name="gender" class="form-control" style="float:left; width:90%; height:37px;margin-top:0%; margin-left:10px;"required>
								<option value="" selected>Gender</option>
								<option value="Male">Male</option>
								<option value="Female">Female</option>
							</select>
	 </div>
	 
	 <div style="float:left; height:auto; width:48%; color:#283747;">
           <label style="margin-left:10px; margin-top:10px; float:left">Birthday</label>
		   <div style="width:30%;">
								<select class="form-control col-md-2 col-sm-2" name="day" id="day" required>
								<option value="" selected="selected">Day</option>	
								<script type="text/javascript">								
									for(var d=1; d<=31; d++){
										document.write('<option value"'+d+'">'+d+'</option>');
									}
								</script>					
								</select>
			</div>
		
		<div style="width:30%; float:left; margin-left:5px;">
								<select class="form-control col-md-2 col-sm-2" name="month" id="month" required>
								<option value="" selected="selected">Month</option>
								<script type="text/javascript">
									for(var m=1; m<=12; m++){
										document.write('<option value="'+m+'">'+m+'</option>');
									}
								</script>
								</select>
		</div>
		
		<div style="width:30%; float:left; margin-left:5px;">
								<select class="form-control col-md-3 col-sm-3" name="year" required>
								<option value="" selected="selected">Year</option>
								<script type="text/javascript">
									  var myDate = new Date();
									  var year = myDate.getFullYear();
									  for(var i = year; i >1900; i--){
										  document.write('<option value="'+i+'">'+i+'</option>');
									  }
								</script>
								</select>
	   </div>
		   
	 </div><br/><br/>
	 <div style="float:left; height:auto; width:48%; color:#283747;">
           <label style="margin-left:10px; margin-top:10px; float:left">Phone Number</label>
		   <input type="text" name="phone" class="form-control" 
		   placeholder="Phone number here" 
		   style="float:left; width:90%; height:40px; margin-top:0%; margin-left:10px;" required>
		  </div>
	 <div style="float:left; height:auto; width:48%; color:#283747;">
           <label style="margin-left:10px; margin-top:10px; float:left">Email Address</label>
		   <input type="text" name="email" class="form-control" 
		   placeholder="Email Address here" 
		   style="float:left; width:90%; height:40px; margin-top:0%; margin-left:10px;" required>
    </div><br/>
	
	<div style="float:left; height:auto; width:48%; color:#283747;">
           <label style="margin-left:10px; margin-top:10px; float:left">Physical Address</label>
		   <input type="text" name="address" class="form-control" 
		   placeholder="Physical Address here" 
		   style="float:left; width:90%; height:40px; margin-top:0%; margin-left:10px;" required>
      </div>
   
     <?php
	 if($role!='admin'){
	   ?>
	   <div style="float:left; height:auto; width:48%; color:#283747;">
           <label style="margin-left:10px; margin-top:10px; float:left">Station Name</label>
		   <input type="text" name="station" class="form-control" 
		   placeholder="Station name here" 
		   style="float:left; width:90%; height:40px; margin-top:0%; margin-left:10px;" required>
      </div>
	   <?php
	   }
	 ?>
		  
	  </div>
	  
 <button type="submit" class="loginbutton" 
 name="register" id="register" style="width:15%; height:40px; margin-right:8%;
 border-radius:5px; float:right;">Register</button>
 
 
 <?php
if(isset($_POST['register'])){
	if($role!='admin'){
		$stationName=sqlSafe($_POST['station']);
		$role='officer';
	}else{
		$stationName='';
		$role='admin';
	}
$phone=sqlSafe($_POST['phone']);
if(strlen(preg_replace('/\s+/u', '', $phone)) == 0){die(ErrorMsg("Please, you must provide phone number"));}
		
		    if(!phoneNumberValidate($phone)){
			die(ErrorMsg("Please! you should provide the correct phone number"));
		}
		
if($phone[0]=="0"){
			if((strlen($phone)>10) || (strlen($phone)<10)){
				die(ErrorMsg("Please! you should provide the correct phone number"));
			}
		}else{
			if((strlen($phone)>9) || (strlen($phone)<9)){
				die(ErrorMsg("Please! you should provide the correct phone number"));
			}
		}
		
		 $Phone = ltrim($phone, '0');
         $numlength = strlen((string)$Phone);
		 $countryCode='+255';
         $phone=$countryCode.$Phone;
   

if(isset($_POST['email']) && !empty($_POST['email'])){
			$email=$_POST['email'];
			if(!emailValidate($email)){
				die(ErrorMsg("Please! you should provide the correct email"));
			}
		}
	
		 $email=$email;
		 $query="SELECT * FROM log WHERE username='$email'";
		 $result=mysql_query($query) or die(mysql_error());
		 if(mysql_num_rows($result)>0){	
		  die(ErrorMsg("This email address is already in use!"));
		 }

		
$birthdate=sqlSafe($_POST['day']).'-'.sqlSafe($_POST['month']).'-'.sqlSafe($_POST['year']);	

$surname=strtoupper(sqlSafe($_POST['sname']));
$pass=md5(md5(md5($surname)));
$date=date("Y-m-d H:i:s");
$birthdate=strtotime($birthdate);
$birthdate=date("Y-m-d H:i:s",$birthdate);

$fname=sqlSafe($_POST['fname']);
$sname=sqlSafe($_POST['sname']);
$gender=sqlSafe($_POST['gender']);
$address=sqlSafe($_POST['address']);
$username=$_SESSION['amms_user_name'];

$query=mysql_query("INSERT INTO users VALUES('$fname','$sname','$birthdate','$gender','$phone','$email','$address','$date','$username','$stationName')") or die(mysql_error());
$unsertLogs=mysql_query("INSERT INTO log VALUES('$email','$pass','$date','$role','active')") or die(mysql_error());

if($query and $unsertLogs ){
	SuccessMsg("User registered successfully");
}		
}
?>
	  
	  </div>
	 </div>
  </form>
  
</div>