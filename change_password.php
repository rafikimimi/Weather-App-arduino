<?php
 if(!isset($SESSION)){
	  session_start();
  }
?>
<html>
<head>
<link rel="shortcut icon" href="themes/ammslogo.png" />
<link rel="stylesheet" type="text/css" href="style.css">
<link rel="stylesheet" href="bootstrap-3.3.6/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/linksHoveringEffects.css" />
    <link rel="stylesheet" href="css/font-awesome.css" />
    <link rel="stylesheet" type="text/css" href="css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/buttons.bootstrap.min.css">
  

    <script type="text/javascript" src="js/jquery-1.11.2.js"></script>
    <script type="text/javascript" src="js/bootstrap.js"></script>
    <script type="text/javascript" src="js/jquery.dataTables.min.js"></script>
<title>AMMS|Password</title>
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
	  <?php include "includes/changepass.php";?>
 </div>
 </center>
 </div>
</body>
</html>

<?php include "includes/footer.php";?>