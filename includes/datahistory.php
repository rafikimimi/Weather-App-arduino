<div class="colltodaypannel"style="background-color: #f4f6f6">
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
<div style="background-color:#eaeded ;height:200px;width:100%;float:left;border-radius:4px;text-align:left">
<h2 style="font-size:20px;font-family:Times New Roman;font-weight: bold;">Select Records Range</h2>
<form method="POST" style="overflow:auto;width:100%">
<div style="float:left;height:60px;width:49%;margin-top:10px">
<div style="float:left;width:20%;height:100%;">
<h2 style="font-size:22px;font-family:Times New Roman;font-weight: bold;">From<h2>
</div>
<div style="float:left;width:78%">
<input type="text" value="<?php echo date('Y/m/d H:i:s')?>" id="datetimepicker4" name="datetimepicker4"/>
</div>
</div>
<div style="float:left;height:60px;width:49%;;margin-left:2%;margin-top:10px">
<div style="float:left;width:20%;height:100%;">
<h2 style="font-size:22px;font-family:Times New Roman;font-weight: bold;">To<h2>
</div>
<div style="float:left;width:78%">
<input type="text" value="<?php echo date('Y/m/d H:i:s')?>" id="datetimepicker5" name="datetimepicker5"/>
</div>
</div>
<button type="submit" class="loginbutton" 
 name="view" id="view" style="width:15%; height:40px; margin-right:3%;
 border-radius:5px; float:right;margin-top:2%">View</button>
</form>
</div>
<?php
if(isset($_POST['view']))
{
	$from=date("Y/m/d ",strtotime(sqlSafe($_POST['datetimepicker4'])));
	$to=date("Y/m/d ",strtotime(sqlSafe($_POST['datetimepicker5'])));
	 $query=mysql_query("SELECT * FROM meteolologydata WHERE addedtime>='$from' AND  addedtime<='$to' ") or die(mysql_error());
	 if(mysql_num_rows($query)>0){
		 $totatemp=0;
		$totalhumidy=0;
		?>
		<div style=" float:left;width:100%;text-align:left;background-color:white">
<h2 style="font-size:20px;font-family:Times New Roman;font-weight: bold;">Records</h2>
<h2 style="font-size:20px;font-family:Times New Roman;font-weight: bold;">Location : Dodoma<?php echo " " .date('l jS \ F Y')?></h2>
</div>
	<table class="mytable" style="margin-top:5%">
    <tr class="tablerow">
	<th class="tbth tableh" style="width:20%">Temperature<?php echo " T "."(°C)"?></th>
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
 <h2 style="font-size:20px;font-family:Times New Roman;font-weight: bold;" >Record Summary From <?php echo "  ".$from."To"." ".$to?></h2>
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
	 }else
	 {
		ErrorMsg("No any record From" ."  " .$from ."  To ".$to);
	 }

}
?>
</div>
<script src="datetimepicker-master/jquery.js"></script>
<script src="datetimepicker-master/build/jquery.datetimepicker.full.js"></script>
<script>
$.datetimepicker.setLocale('en');

$('#datetimepicker_format').datetimepicker({value:'2015/04/15 05:03', format: $("#datetimepicker_format_value").val()});
console.log($('#datetimepicker_format').datetimepicker('getValue'));

$("#datetimepicker_format_change").on("click", function(e){
	$("#datetimepicker_format").data('xdsoft_datetimepicker').setOptions({format: $("#datetimepicker_format_value").val()});
});
$("#datetimepicker_format_locale").on("change", function(e){
	$.datetimepicker.setLocale($(e.currentTarget).val());
});

$('#datetimepicker').datetimepicker({
dayOfWeekStart : 1,
lang:'en',
disabledDates:['1986/01/08','1986/01/09','1986/01/10'],
startDate:	'1986/01/05'
});
$('#datetimepicker').datetimepicker({value:'2015/04/15 05:03',step:10});

$('.some_class').datetimepicker();

$('#default_datetimepicker').datetimepicker({
	formatTime:'H:i',
	formatDate:'d.m.Y',
	//defaultDate:'8.12.1986', // it's my birthday
	defaultDate:'+03.01.1970', // it's my birthday
	defaultTime:'10:00',
	timepickerScrollbar:false
});

$('#datetimepicker_mask').datetimepicker({
	mask:'9999/19/39 29:59'
});
$('#datetimepicker4').datetimepicker();
$('#open').click(function(){
	$('#datetimepicker4').datetimepicker('show');
});
$('#close').click(function(){
	$('#datetimepicker4').datetimepicker('hide');
});
$('#reset').click(function(){
	$('#datetimepicker4').datetimepicker('reset');
});
$('#datetimepicker5').datetimepicker();
$('#open').click(function(){
	$('#datetimepicker5').datetimepicker('show');
});
$('#close').click(function(){
	$('#datetimepicker5').datetimepicker('hide');
});
$('#reset').click(function(){
	$('#datetimepicker5').datetimepicker('reset');
});
var logic = function( currentDateTime ){
	if (currentDateTime && currentDateTime.getDay() == 6){
		this.setOptions({
			minTime:'11:00'
		});
	}else
		this.setOptions({
			minTime:'8:00'
		});
};
var dateToDisable = new Date();
	dateToDisable.setDate(dateToDisable.getDate() + 2);
$('#datetimepicker11').datetimepicker({
	beforeShowDay: function(date) {
		if (date.getMonth() == dateToDisable.getMonth() && date.getDate() == dateToDisable.getDate()) {
			return [false, ""]
		}

		return [true, ""];
	}
});
$('#datetimepicker_dark').datetimepicker({theme:'dark'})


</script>
