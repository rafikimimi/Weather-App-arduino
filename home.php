<?php
 if(!isset($SESSION)){
	  session_start();
  }
   $met='Home';
  if(isset($_GET['hom'])){
	  $met=$_GET['hom'];
  }
  include "includes/dbconnect.inc.php";
?>
<html>
<head>
<link rel="shortcut icon" href="themes/ammslogo.png" />
<link rel="stylesheet" type="text/css" href="style.css">
<link rel="stylesheet" href="bootstrap-3.3.6/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="css/bootstrap.css" />
    <link rel="stylesheet" type="text/css" href="datetimepicker-master/jquery.datetimepicker.css"/>
    <link rel="stylesheet" href="css/linksHoveringEffects.css" />
    <link rel="stylesheet" href="css/font-awesome.css" />
    <link rel="stylesheet" type="text/css" href="css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/buttons.bootstrap.min.css">
  

    <script type="text/javascript" src="js/jquery-1.11.2.js"></script>
    <script type="text/javascript" src="js/bootstrap.js"></script>
    <script type="text/javascript" src="js/jquery.dataTables.min.js"></script>
<title>AMMS|<?php echo $met?></title>
</head>
<body>
 <div class="parent">
 <?php include "includes/header.php";?>
 <center>
 <div class="wrapper">
      <div class="userpanel" style="margin-top:10px;">
	  <?php
	    include "includes/meteorologydata.php";
       if($_SESSION['amms_user_role']=='admin'){
		  include "includes/user_panel.php"; 
	   }
	  ?>
     
	  </div>
	  <?php 
	   if($met=='Today' or $met=='Home'){
	 $query=mysql_query("SELECT * FROM meteolologydata WHERE addedtime>CURDATE()") or die(mysql_error());
	 if(mysql_num_rows($query)>0){
		include "includes/collectiontoday.php"; 
	 }else{
		 ?>
		 	<table style="margin-top:2%">
			 <tr  class="tablerow">
			    <th class="tbth tableh">There is no weather information collected today</th>
			 </tr>
			</table>
		 <?php
	      }
	}else if($met=='History'){
    include "includes/datahistory.php";
	}elseif($met=='Reports'){
	include "includes/reports.php";
	 }
	 ?>
 </div>
 </center>
 </div>
 <?php include "includes/footer.php";?>
</body>
</html>

