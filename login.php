
<!DOCTYPE html>
<html>
<head>
<link rel="shortcut icon" href="themes/ammslogo.png" />
<link rel="stylesheet" type="text/css" href="style.css">
<title>AMMS|Login</title>
</head>
<body style="background-color: #f2f3f4 min-width:1000px" >
<center>
<div class="logform">
<form class="loginform" action="userLogins.php" method="POST">
  <div class="ammstext">
   <label>AMMS<label>
  </div>

  <div class="container">
    <input class="userpass" type="text" placeholder="Enter Username" name="username"  id="username" required>
    <input class="userpass" type="password" placeholder="Enter Password" name="pass" id="pass" required><br/>
	
	   <?php
		 if(isset($_SESSION['Error'])){
			?>
            <p style="color:red"><?php echo $_SESSION['Error'];?></p>
         <?php			
		 }
		 ?>
		 </form>
    <button type="submit" class="loginbutton" name="login" id="login">Login</button>
    </div>
</form>
</div>
</center>
</body>
</html>