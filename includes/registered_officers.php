<?php
 $admins=mysql_query("SELECT * FROM log WHERE role='officer'") or die(mysql_error());
if(mysql_num_rows($admins)>0){  
	  ?>
	<table class="mytable"  >
    <tr class="tablerow">
      <th class="tbth tableh">SN</th>
      <th class="tbth tableh">First Name</th>
      <th class="tbth tableh">Surname</th>
	  <th class="tbth tableh">Email</th>
	  <th class="tbth tableh">Role</th>
	  <th class="tbth tableh">Action</th>
    </tr>
	  <?php	  
	  $counter=1;
    while($ro=mysql_fetch_array($admins)){
		$role=$ro['role'];
		
if($role=='officer'){
	$role='Station Officer';
}		
        $username=$ro['username'];
		$status=$ro['status'];
		
  $userData=mysql_query("SELECT * FROM users WHERE email='$username'") or die(mysql_error());
  
    if(mysql_num_rows($userData)>0){
				  $data=mysql_fetch_array($userData);
				  $fname=$data['fname'];
				  $sname=$data['sname'];
				  $phone=$data['phone'];
				  $email=$data['email'];
				  $date=$data['dateRegistered'];
				  $station=$data['Location'];
			   }
	  ?>
	 <tr class="tablerow" >
      <th class="tbth " style="font-weight:normal !important"><?php  echo $counter?></th>
      <th class="tbth " style="font-weight:normal !important"><?php   echo $fname?></th>
      <th class="tbth " style="font-weight:normal !important"><?php  echo $sname?></th>
	  <th class="tbth " style="font-weight:normal !important"><?php  echo $email?></th>
	  <th class="tbth " style="font-weight:normal !important"><?php echo $role?></th>
	  <th class="tbth " style="font-weight:normal !important"><a href="user_details.php?profiles=<?php echo $username ?>"> View More</a></th>
    </tr>
	  <?php
	  $counter++;
	}
 echo "</table>";	
  }
?>