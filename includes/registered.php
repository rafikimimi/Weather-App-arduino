
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
	   echo  'Registered Administrators';
	   }
	   if($role=='officer'){
		echo  'Registered Station Officers';   
	   }
	   if($role=='All'){
		  echo  'All Registered Users'; 
	   }
	   ?></h4>
	
	   <div style="width:100%;height:auto;
	   background-color:#fff; height:auto; 
	   border:1px solid #E5E7E9;overflow:auto;">
	    
	  <?php
	  $userInfo=mysql_query("SELECT * FROM users") or die(mysql_error());
	    if(mysql_num_rows($userInfo)>0){
		 
		 if($role=='admin'){
			 include "registered_admins.php";
		 }
		 if($role=='officer'){
			 include "registered_officers.php";
		 }
		if($role=='All'){
			 include "registered_all.php";
		 }
		
		}else{
			echo 'There is no any registered user';
		}
	  
	  ?>
		
	   
	      
	 
	  
	  </div>
	 </div>
  </form>
  
</div>