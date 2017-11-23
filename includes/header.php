<?php
include "functions.php";
if($_SESSION['amms_user_role']==''){
	header('location:index.php');
  }
?>

<style type="text/css"> 
  a:hover{
	  text-decoration:none;
  }
</style>
<div class="topcontainer">
   <center>
   <div class="innerheader">
     <a href="home.php">
	 <div class="logoimage">
	  <img src="themes\ammslogo.PNG" alt="AMMS" style="border-radius:50%;width:100%;height:100%;">
	 </div>
	 </a>
	 <a href="home.php">
	 <div class="logotexts">
	 <img src="themes\amms.PNG" alt="AMMS" style="border-radius:30%;width:100%;height:100%;">
	 </div>
	 <a>
	 <div class="userdiv" >	
      <li class="dropdown">
                          <a style="text-decoration:none;" href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                          <span class="glyphicon glyphicon-user userprof"></span>&nbsp 
                            <?php              
                               echo $_SESSION['amms_user_fname'].' '.$_SESSION['amms_user_sname'];
                                  ?>
                          <span class="caret"></span></a>
                          <ul class="dropdown-menu" role="menu">
                                  <li><a href="profiles.php"><span class="glyphicon glyphicon-info-sign"></span>&nbsp My Profile</a></li>                         
                            <li class="divider"></li>
                            <li><a href="change_password.php"><span class="glyphicon glyphicon-edit"></span>&nbsp Change Password</a></li>
                            <li class="divider"></li>
                            <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span>&nbsp Logout</a></li>
                          </ul>
                        </li>
                      </ul>
    </div>
	 
	 </div>
   </div>
   </center>
</div>