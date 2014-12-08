<?php
SESSION_start();
?>
<!DOCTYPE html>
<html>
<head>
<?php
defined('THE_SESSION') || define('THE_SESSION', TRUE);
require_once('include/checksession.php');
defined('THE_HEAD') || define('THE_HEAD', TRUE);
include_once("include/head.php");
?>
<link rel="stylesheet" type="text/css" media="screen" href="css/opening.css" />


</head>
<body>
<?php
defined('THE_HEADER') || define('THE_HEADER', TRUE);
require_once("include/header.php");
?>
<div id="main-wrapper">
<?php
defined('THE_MENUE') || define('THE_MENUE', TRUE);
require_once("include/menuebar.php");
defined('THE_DB') || define('THE_DB', TRUE);
require_once(__DIR__ .'./../../db.php');
$isql = "SELECT * FROM kontrakt";

$keys = array('Måndag', 'Tisdag', 'Onsdag', 'Torsdag', 'Fredag', 'Lördag', 'Söndag');


?>
<div id = "frame">
<div id = "frameOpening">
    <form action='' method='post' id ='postOpeninghours' enctype="multipart/form-data">
    <select name='conts' id='conts'>
<?php 
$iresult = mysqli_query($con, $isql);
if (mysqli_num_rows($iresult) != 0) {
  while($irows = mysqli_fetch_assoc($iresult)) {
      if($_POST['conts'] == $irows['ID'])
    {
      echo "<option value=".$irows['ID']." selected='selected' >".$irows['kontorsnamn']."</option>";
    }
    else {		
      echo "<option value=".$irows['ID'].">".$irows['kontorsnamn']."</option>";
    }	
  }
}
mysqli_free_result($iresult);	
?>
</select> 
<input type="submit" name = "accept" id = "accept" value="Välj kontrakt">

<?php
if(isset($_POST['accept'])) 
{
$index = 0;
$namesdays = array("mon","thue","wed","thur","fri","sat","sun");
$isql2 = "SELECT veckonamn, oppet, stangt, kontraktid, veckodagarid FROM veckodagar LEFT OUTER JOIN oppettider on veckodagarid = veckodagar.ID WHERE kontraktid = '".$_POST['conts']."' ORDER BY veckodagarid";
$iresult = mysqli_query($con, $isql2);
echo '<ul>';
if (mysqli_num_rows($iresult) != 0) {
  while($irows = mysqli_fetch_assoc($iresult)){ 
echo '<li>
<label for="'.$irows["veckonamn"].'" id="day">'.$irows["veckonamn"].': </label></li><li>

<div id = "openingFrame">
<div id = "labels">
<label>Öppnar: </label>
<label>Stänger: </label>
</div>
<div class = "times">
<input type="time" align="left"  maxlength="50" value = "'.$irows['oppet'].'"  name="'.$namesdays[$index].'_open" id="'.$namesdays[$index].'_open" />
<input type="time" align="left" value = "'.$irows['stangt'].'"  name="'.$namesdays[$index].'_close" id="'.$namesdays[$index].'_close" />
</div>
<div id = "labels">
<label>Stängt:</label>
<input type="checkbox" class = "checkbox_" id="checkbox_'.$namesdays[$index++].'" value="Stängt"/>
</div>
</li>
';
} }
	else{		
	$isql3 = "SELECT veckonamn FROM veckodagar ORDER BY ID";
$iresult = mysqli_query($con, $isql3);
if (mysqli_num_rows($iresult) != 0) {
  while($irows = mysqli_fetch_assoc($iresult)){ 
	echo '<li>
<label for="'.$irows["veckonamn"].'" id="day">'.$irows["veckonamn"].': </label></li><li>

<div id = "openingFrame">
<div id = "labels">
<label>Öppnar: </label>
<label>Stänger: </label>
</div>
<div class = "times">
<input type="time" align="left"  maxlength="50" value = ""  name="'.$namesdays[$index].'_open" id="'.$namesdays[$index].'_open" />

<input type="time" align="left" value = ""  name="'.$namesdays[$index].'_close" id="'.$namesdays[$index].'_close" />
</div>
<div id = "labels">
<label>Stängt:</label>
<input type="checkbox" class = "checkbox_" id="checkbox_'.$namesdays[$index++].'" value="Stängt"/>
</div>
</li>
';	
	}
	
	mysqli_free_result($iresult);	
}}
	  echo '<div class="submit">
<input type="reset" name="rst" id="rst" value="Återställ" />
<input type="submit" name="save" id="save" value="Spara" />
</div>

</form>';

} 
	



if(isset($_POST['save'])) {
    $sqlquery = "REPLACE INTO oppettider (kontraktid,veckodagarid,oppet,stangt)
	VALUES (".$_POST['conts'].",1,'".$_POST['mon_open']."','".$_POST['mon_close']."'),	
	(".mysqli_real_escape_string($con, $_POST['conts']).",3,'".mysqli_real_escape_string($con, $_POST['thue_open'])."','".mysqli_real_escape_string($con, $_POST['thue_close'])."'),
	(".mysqli_real_escape_string($con, $_POST['conts']).",4,'".mysqli_real_escape_string($con, $_POST['wed_open'])."','".mysqli_real_escape_string($con, $_POST['wed_close'])."'),
	(".mysqli_real_escape_string($con, $_POST['conts']).",5,'".mysqli_real_escape_string($con, $_POST['thur_open'])."','".mysqli_real_escape_string($con, $_POST['thur_close'])."'),
	(".mysqli_real_escape_string($con, $_POST['conts']).",6,'".mysqli_real_escape_string($con, $_POST['fri_open'])."','".mysqli_real_escape_string($con, $_POST['fri_close'])."'),
	(".mysqli_real_escape_string($con, $_POST['conts']).",2,'".mysqli_real_escape_string($con, $_POST['sat_open'])."','".mysqli_real_escape_string($con, $_POST['sat_close'])."'),
	(".mysqli_real_escape_string($con, $_POST['conts']).",7,'".mysqli_real_escape_string($con, $_POST['sun_open'])."','".mysqli_real_escape_string($con, $_POST['sun_close'])."')
	;";	
	mysqli_query($con, $sqlquery);  
}

?>
</div><!--frame-->
</div><!--main-wrapper-->
<?php
defined('THE_FOOTER') || define('THE_FOOTER', TRUE);
require_once("include/footer.php");
?>
</body>
</html>