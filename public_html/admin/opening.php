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
	if(isset($_POST['conts']) && $_POST['conts'] == $irows['ID'])
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
if(isset($_POST['accept'])&&isset($_POST['conts'])) 
{
    $index = 0;
    $who = mysqli_real_escape_string($con, $_POST['conts']);
    $sqldays = "SELECT ID, akro, veckonamn FROM veckodagar";
    $resultdays = mysqli_query($con, $sqldays);
    $namedays = array();
    while($row=mysqli_fetch_assoc($resultdays)){
        $namedays[] = $row;
    }
    mysqli_free_result($resultdays);
    $sql2 = "SELECT veckonamn, oppet, stangt, kontraktid, veckodagarid FROM veckodagar LEFT OUTER JOIN oppettider on veckodagarid = veckodagar.ID WHERE kontraktid = '".$who."' ORDER BY veckodagarid";
    $resultsql2 = mysqli_query($con, $sql2);
    $oppettiderna = array();
    if(mysqli_num_rows($resultsql2) != 0){
	while($row=mysqli_fetch_assoc($resultsql2)){
	    $oppettiderna[$row['veckodagarid']] = $row;
	}
    }
    mysqli_free_result($resultsql2);
    echo"<ul>";
    foreach($namedays as $day){
	echo"<li><label for='".$day['veckonamn']."' id='day'>".$day['veckonamn'].": </label></li><li><div id='openingFrame' class='background0'><div id='openingHours'><label>Öppnar: </label><input type='time' align='left' maxlength='50' value='";
	echo (isset($oppettiderna[$day['ID']])?$oppettiderna[$day['ID']]['oppet']:"");
	echo"'  name='".$day['akro']."_open' id='".$day['akro']."_open' /></div><div id = closingHours><label>Stänger: </label><input type='time' align='left' value='";
	echo (isset($oppettiderna[$day['ID']])?$oppettiderna[$day['ID']]['stangt']:"");
	echo"' name='".$day['akro']."_close' id='".$day['akro']."_close' /></div><div id='labels'><label>Stängt:</label><input type='checkbox' class='checkbox_' ";
	echo (isset($oppettiderna[$day['ID']])?"":"checked");
	echo" id='check_".$day['akro']."' name='check_".$day['akro']."' /></div></li>;";
    }
    echo"</ul><div class='submit'>
<input type='reset' name='rst' id='rst' value='Återställ' />
<input type='submit' name='save' id='save' value='Spara' />
</div></form>";
}

if(isset($_POST['save'])) {
    $sqlquery = "";
    $bool_rep = FALSE;
    $sqlrep = "REPLACE INTO oppettider (kontraktid,veckodagarid,oppet,stangt) VALUES ";
    $contractid = mysqli_real_escape_string($con, $_POST['conts']);
    $sqldays = "SELECT ID, akro, veckonamn FROM veckodagar";
    $resultdays = mysqli_query($con, $sqldays);
    $namedays = array();
    while($row=mysqli_fetch_assoc($resultdays)){
        $namedays[] = $row;
    }
    mysqli_free_result($resultdays);

    foreach($namedays as $day){
	$varID = mysqli_real_escape_string($con, $day['ID']);
	if(isset($_POST['check_'.$day['akro']])){
	    $sqlquery .= "DELETE FROM oppettider WHERE oppettider.kontraktid = '".$contractid."' AND oppettider.veckodagarid = '".$varID."';";
	}
	else if(isset($_POST[$day['akro'].'_open']) && isset($_POST[$day['akro'].'_close'])){
            if($bool_rep){$sqlrep .= ", ";}
            $bool_rep = TRUE;
            $day_open = mysqli_real_escape_string($con, $_POST[$day['akro'].'_open']);
            $day_close = mysqli_real_escape_string($con, $_POST[$day['akro'].'_close']);
            $sqlrep .= "(".$contractid.",'".$varID."','".$day_open."','".$day_close."')";
	}
    }
    if($bool_rep)
    {
        $sqlrep .= ";";
        $sqlquery .= $sqlrep;
    }
    mysqli_multi_query($con, $sqlquery);
    while (mysqli_next_result($con)){;}
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
