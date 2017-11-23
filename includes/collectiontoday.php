<div class="colltodaypannel">
<div style="width:100%;height:40px; background-color: #005ea6;float:left; text-align:left;">
 <?php 
  include "dbconnect.inc.php";
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
<div class="my-container">
<div style=" float:left;width:100%;text-align:left;background-color:white">
<h2 style="font-size:20px;font-family:Times New Roman;font-weight: bold;">Records</h2>
<h2 style="font-size:20px;font-family:Times New Roman;font-weight: bold;">Location : Dodoma<?php echo " " .date('l jS \ F Y')?></h2>
</div>
	 <?php
	 $query=mysql_query("SELECT * FROM meteolologydata WHERE addedtime>CURDATE()") or die(mysql_error());
	 if(mysql_num_rows($query)>0){
		$totatemp=0;
		$totalhumidy=0;
		?>
		<table class="mytable">
    <tr class="tablerow">
	<th class="tbth tableh" style="width:20%">Temprature<?php echo " T "."(°C)"?></th>
      <th class="tbth tableh" style="width:20%">Relative Humidity<?php echo "RH(%)"?></th>
	   <th class="tbth tableh" style="width:20%">Vapour Pressure<?php echo " (mmHg)"?></th>
      <th class="tbth tableh" style="width:20%">Dew Point<?php echo "Td "."(°C)"?></th>
	  <th class="tbth tableh" style="width:20%">Time</th>
	  <th class="tbth tableh">Meteorological Station</th>
    </tr>
		<?php
		
	 while($meteorology=mysql_fetch_array($query)){
		 $totatemp+= $meteorology['temperature'];
		 $totalhumidy+= $meteorology['humidity'];
	//$dewpoint=(243.04*(-log($meteorology['humidity']/100)+(17.625*$meteorology['temperature'])/(243.04+$meteorology['temperature'])))/(17.625-(-log($meteorology['humidity']/100))-(17.625*$meteorology['temperature'])/(243.04+$meteorology['temperature']))
	$dewpoint=pow(($meteorology['humidity']/100),(1/8))*(112+0.9*($meteorology['temperature']))+0.1*($meteorology['temperature'])-112;
	$vapour=$meteorology['humidity']/ 100 * 0.6108 * exp(17.27 * $meteorology['temperature'] / ($meteorology['temperature'] + 237.3));
		  ?>
	  <tr class="tablerow">
      <td class="tbth " style="width:20%"><?php echo number_format((float)$meteorology['temperature'], 2, '.', '')?></td>
      <td class="tbth " style="width:20%"><?php echo number_format((float)$meteorology['humidity'], 2, '.', '')?></td>
	  <td class="tbth " style="width:20%"><?php echo number_format((float)$vapour, 2, '.', '')?></td>
	  <td class="tbth " style="width:20%"><?php echo number_format((float)$dewpoint, 2, '.', '')?></td>
	  <td class="tbth " style="width:20%"><?php echo date("H:i:s",strtotime($meteorology['addedtime']))?></td>
	  <td class="tbth " ><?php echo $meteorology['stationname']?></td>
    </tr>
	  <?php
	 }
	 
	  ?>
	  
	   </table><br/>
	<div style=" float:left;width:100%;text-align:left">
 <h2 style="font-size:20px;font-family:Times New Roman;font-weight: bold;" > Day Record Summury</h2>
</div>
	  <?php
	  $duesum=pow(($totalhumidy/mysql_num_rows($query)/100),(1/8))*(112+0.9*($totatemp/mysql_num_rows($query)))+0.1*($totatemp/mysql_num_rows($query))-112;
	 $suvapour=$totalhumidy/mysql_num_rows($query)/100 * 0.6108 * exp(17.27 * $totatemp/mysql_num_rows($query) / ($totatemp/mysql_num_rows($query) + 237.3));
	 ?>
	 <table >
    <tr class="tablerow">
	  <th class="tbth tableh" style="width:20%">Temprature<?php echo " T "."(°C)"?></th>
      <th class="tbth tableh" style="width:20%">Relative Humidity<?php echo "RH(%)"?></th>
	   <th class="tbth tableh" style="width:20%">Vapour Pressure<?php echo " (mmHg)"?></th>
      <th class="tbth tableh" style="width:20%">Dew Point<?php echo "Td "."(°C)"?></th>
	  <th class="tbth tableh" style="width:20%">Time</th>
	  <th class="tbth tableh">Meteorological Station</th>
    </tr>
	<tr class="tablerow">
      <td class="tbth " style="width:20%"><?php echo number_format((float)$totatemp/mysql_num_rows($query), 2, '.', '') ?></td>
      <td class="tbth " style="width:20%"><?php echo number_format((float)$totalhumidy/mysql_num_rows($query), 2, '.', '')?></td>
	  <td class="tbth " style="width:20%"><?php echo number_format((float)$suvapour, 2, '.', '')?></td>
	  <td class="tbth " style="width:20%"><?php echo number_format((float)$duesum, 2, '.', '') ?></td>
	  <td class="tbth " style="width:20%"><?php echo date("H:i:s")?></td>
	  <td class="tbth " ><?php echo "DODOMA"?></td>
    </tr>
</table>	
	 <?php
	 }else{
			ErrorMsg("No any record  Today");
		 }
?>
</div>