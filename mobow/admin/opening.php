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

<script>
$(document).ready(function(){
    var selClone = $('#conts').clone();
    $('#comp').change(function(){
        var val = $(this).val();
        $('#conts').html(selClone.html())
        if(val != ""){
            $('#conts option[class!='+val+']').remove();
        }
    });
});
</script> 
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
$adm = mysqli_real_escape_string($con, $_SESSION['admin']);
if($adm){
$isql = "SELECT * FROM kontrakt";
}
else{
$isql = "SELECT * FROM kontrakt WHERE kontaktpersonid = '".mysqli_real_escape_string($con,$_SESSION['username'])."'";
}
$keys = array('Måndag', 'Tisdag', 'Onsdag', 'Torsdag', 'Fredag', 'Lördag', 'Söndag');
if($adm){
$sqlorg = "SELECT orgnr, namn FROM foretag ORDER BY orgnr";
}


?>
<div id = "frame">
<div id = "frameOpening">
    <form action='' method='post' id ='postOpeninghours' enctype="multipart/form-data">

<?php
    if($adm){
        echo"<select name='comp' id='comp'>
<option value=''>Välj organisationsnummer</option>";
        $orgresult = mysqli_query($con, $sqlorg);
        if (mysqli_num_rows($orgresult) != 0) {
            while($rows = mysqli_fetch_assoc($orgresult)) {
                echo "<option value=".$rows['orgnr'].">".$rows['orgnr']." (".$rows['namn'].")</option>";   
            }
        }
        echo"</select>";
        mysqli_free_result($orgresult);
    }
    else{
        echo"<input type='hidden' name='comp' value=''>";
    }
?>

    <select name='conts' id='conts'>
<?php 
$iresult = mysqli_query($con, $isql);
if (mysqli_num_rows($iresult) != 0) {
  while($irows = mysqli_fetch_assoc($iresult)) {
      if($_POST['conts'] == $irows['ID'])
    {
      echo "<option value='".$irows['ID']."' class='".$irows['orgnr']."' selected='selected' >".$irows['kontorsnamn']."</option>";
    }
    else {		
      echo "<option value='".$irows['ID']."' class='".$irows['orgnr']."'>".$irows['kontorsnamn']."</option>";
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
$isql2 = "SELECT veckonamn, oppet, stangt, kontraktid, veckodagarid, arStangt FROM veckodagar LEFT OUTER JOIN oppettider on veckodagarid = veckodagar.ID WHERE kontraktid = '".$_POST['conts']."' ORDER BY veckodagarid";
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
<label>Stängt:</label>';
if($irows["arStangt"] != 0) {
	echo '<input type="checkbox" class = "checkbox_" id="check_'.$namesdays[$index].'" name="check_'.$namesdays[$index++].'" value="Yes" checked/>';
	}
else { 
	echo '<input type="checkbox" class = "checkbox_" id="check_'.$namesdays[$index].'" name="check_'.$namesdays[$index++].'"/>';
	}
echo '
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
<input type="time" align="left"  maxlength="50" value = "00:00"  name="'.$namesdays[$index].'_open" id="'.$namesdays[$index].'_open" />

<input type="time" align="left" value = "00:00"  name="'.$namesdays[$index].'_close" id="'.$namesdays[$index].'_close" />
</div>
<div id = "labels">
<label>Stängt:</label>
<input type="checkbox" class = "checkbox_" id="checkbox_'.$namesdays[$index++].'"/>
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
$contractid = mysqli_real_escape_string($con, $_POST['conts']);
$mon_o = mysqli_real_escape_string($con, $_POST['mon_open']);
$mon_c = mysqli_real_escape_string($con, $_POST['mon_close']);
$thue_o = mysqli_real_escape_string($con, $_POST['thue_open']);
$thue_c = mysqli_real_escape_string($con, $_POST['thue_open']);
$wed_o = mysqli_real_escape_string($con, $_POST['wed_open']);
$wed_c = mysqli_real_escape_string($con, $_POST['wed_close']);
$thur_o = mysqli_real_escape_string($con, $_POST['thur_open']);
$thur_c = mysqli_real_escape_string($con, $_POST['thur_close']);
$fri_o = mysqli_real_escape_string($con, $_POST['fri_open']);
$fri_c = mysqli_real_escape_string($con, $_POST['fri_close']);
$sat_o = mysqli_real_escape_string($con, $_POST['sat_open']);
$sat_c = mysqli_real_escape_string($con, $_POST['sat_close']);
$sun_o = mysqli_real_escape_string($con, $_POST['sun_open']);
$sun_c = mysqli_real_escape_string($con, $_POST['sun_close']);
$mon_is_c = isset($_POST['check_mon']);
$thue_is_c = isset($_POST['check_thue']);
$wed_is_c = isset($_POST['check_wed']);
$thur_is_c = isset($_POST['check_thur']);
$fri_is_c = isset($_POST['check_fri']);
$sat_is_c = isset($_POST['check_sat']);
$sun_is_c = isset($_POST['check_sun']);




    $sqlquery = "REPLACE INTO oppettider (kontraktid,veckodagarid,oppet,stangt,arStangt)
	VALUES (".$contractid.",1,'".$mon_o."','".$mon_c."', '".$mon_is_c."' ),	
	(".$contractid.",2,'".$thue_o."','".$thue_c."', '".$thue_is_c."'),
	(".$contractid.",3,'".$wed_o."','".$wed_c."', '".$wed_is_c."'),
	(".$contractid.",4,'".$thur_o."','".$thur_c."', '".$thur_is_c."'),
	(".$contractid.",5,'".$fri_o."','".$fri_c."', '".$fri_is_c."'),
	(".$contractid.",6,'".$sat_o."','".$sat_c."', '".$sat_is_c."'),
	(".$contractid.",7,'".$sun_o ."','".$sun_c."', '".$sun_is_c."')
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