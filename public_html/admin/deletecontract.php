<?php
SESSION_start();
error_reporting(-1);
ini_set('display_errors', 'On');
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

<script>
$(document).ready(function(){
    var selClone = $('#contracts').clone();
    $('#comp').change(function(){
        var val = $(this).val();
        $('#contracts').html(selClone.html())
        if(val != ""){
            $('#contracts option[class!='+val+']').remove();
        }
    });
});
</script> 


</head>
<body>
<?php
defined('THE_HEADER') || define('THE_HEADER', TRUE);
require_once("include/header.php");
defined('THE_ASESSION') || define('THE_ASESSION', TRUE);
require_once('include/checkasession.php');
?>
<div id="main-wrapper">
<?php
defined('THE_MENUE') || define('THE_MENUE', TRUE);
require_once("include/menuebar.php");
defined('THE_DB') || define('THE_DB', TRUE);
require_once(__DIR__ .'./../../db.php');
$adm = mysqli_real_escape_string($con, $_SESSION['admin']);
$usr = mysqli_real_escape_string($con, $_SESSION['username']);
if($adm){
    $isql = "SELECT kontrakt.ID, kontorsnamn, tele, logurl, gata, orgnr FROM kontrakt LEFT OUTER JOIN adress ON kontrakt.ID = adress.ID LEFT OUTER JOIN ikontyp ON kontrakt.ikonid = ikontyp.ID ORDER BY kontorsnamn";
    $sqlorg = "SELECT orgnr, namn FROM foretag ORDER BY orgnr";
}
else{
   
}
?>

<div id = "frame">
    <form action='' method='post' id ='postContracts' enctype="multipart/form-data">

<?php
if($adm){
    echo"<select name='comp' id='comp'>
<option value=''>Välj Organisationsnummer</option>";
    $orgresult = mysqli_query($con, $sqlorg);
    if (mysqli_num_rows($orgresult) != 0) {
    while($rows = mysqli_fetch_assoc($orgresult)) {
	if(isset($_POST['comp']) && $_POST['comp'] == $rows['orgnr'])
    {
      echo "<option value=".$rows['orgnr']." selected='selected' >".$rows['orgnr']." (".$rows['namn'].")</option>";	
	}
	else {
    echo "<option value=".$rows['orgnr'].">".$rows['orgnr']." (".$rows['namn'].")</option>";	
		}
	 }
    }
    echo"</select>";
    mysqli_free_result($orgresult);
}
    else{
    echo"<input type='hidden' name='comp' value=''>";
    }
    echo"<select name='contracts' id='contracts'>
	<option value='' class = 'choosecontract'>Välj Kontrakt</option>";
$iresult = mysqli_query($con, $isql);
if (mysqli_num_rows($iresult) != 0) {
  while($irows = mysqli_fetch_assoc($iresult)) {
      if(isset($_POST['contracts']) && $_POST['contracts'] == $irows['ID'])
    {
      echo "<option value=".$irows['ID']." class='".$irows['orgnr']."' selected='selected' >".$irows['kontorsnamn']." (".$irows['gata'].")</option>";
    }
    else {		
      echo "<option value=".$irows['ID']." class='".$irows['orgnr']."'>".$irows['kontorsnamn']." (".$irows['gata'].")</option>";
    }	
  }
}
mysqli_free_result($iresult);	
?>
</select> 
<input type="submit" name = "deleteContract" id = "delete" value="Ta Bort Kontrakt">
<input type="submit" name = "deleteCompany" id = "delete" value="Ta Bort Företag">
<?php
if(isset($_POST['contracts'])&&isset($_POST['deleteContract'])){
if($_POST['contracts']!=""){
$c=mysqli_real_escape_string($con,$_POST['contracts']);
$sqlqueryGETContract = "SELECT kontorsnamn, orgnr FROM kontrakt WHERE ID = ".$c;
$GETContract = mysqli_query($con,$sqlqueryGETContract);
$rows = mysqli_fetch_assoc($GETContract);
echo '<p style="margin:10px">Vill du verkligen ta bort kontoret: '.$rows["kontorsnamn"].', '.$rows["orgnr"].'?</p>
<input type="submit" name = "yesdeletecon" id = "yesdeletecon" value="Ja">
<input type="submit" name = "nodelete" id = "nodelete" value="Nej">';
}else {
echo "<p>Du måste välja ett kontrakt!</p>";
 }
}

if(isset($_POST['yesdeletecon'])){
  if(is_numeric($_POST['contracts'])){
    $c=mysqli_real_escape_string($con,$_POST['contracts']);
    $sqlquery = "DELETE FROM kontrakt WHERE id = '".$c."'";	
    if(mysqli_query($con, $sqlquery)){
	
	echo '<script type="text/javascript"> var reload = false;
var loc=""+document.location;
loc = loc.indexOf("?reload=")!=-1?loc.substring(loc.indexOf("?reload=")+10,loc.length):"";
loc = loc.indexOf("&")!=-1?loc.substring(0,loc.indexOf("&")):loc;
reload = loc!=""?(loc=="true"):reload;

function reloadPage() {
    if (!reload) 
        window.location.replace(window.location);
}

reloadPage();  </script>';	
      echo "<br /><br /><b>Uppdateringen lyckades</b>";
    }
    else{
      echo "<br /><br /><b>Uppdateringen misslyckades</b>";
    }
  }
 }
 
if(isset($_POST['deleteCompany'])){
$c=mysqli_real_escape_string($con,$_POST['comp']);
if($c == "")
{
echo "<p>Du måste välja ett organisationsnummer..!</p>";
}
else {
$sqlqueryGETContract = "SELECT namn, orgnr FROM foretag WHERE orgnr = '".$c."'";
$GETContract = mysqli_query($con,$sqlqueryGETContract);
$rows = mysqli_fetch_assoc($GETContract);
echo '<p style="margin:10px">Vill du verkligen ta bort företaget: '.$rows["namn"].', '.$rows["orgnr"].'?</p>
<input type="submit" name = "yesdeletecom" id = "yesdelete" value="Ja">
<input type="submit" name = "nodelete" id = "nodelete" value="Nej">';}
}

if(isset($_POST['yesdeletecom'])){
  if(isset($_POST['comp'])&&$_POST['comp']!=""){
    $c=mysqli_real_escape_string($con,$_POST['comp']);	
	$sqldeletecom = "DELETE FROM foretag WHERE orgnr = '".$c."'";	
    if(mysqli_query($con, $sqldeletecom)){
	
	echo '<script type="text/javascript"> var reload = false;
var loc=""+document.location;
loc = loc.indexOf("?reload=")!=-1?loc.substring(loc.indexOf("?reload=")+10,loc.length):"";
loc = loc.indexOf("&")!=-1?loc.substring(0,loc.indexOf("&")):loc;
reload = loc!=""?(loc=="true"):reload;

function reloadPage() {
    if (!reload) 
        window.location.replace(window.location);
}

reloadPage();  </script>';	
      echo "<br /><br /><b>Uppdateringen lyckades</b>";
    }
    else{
      echo "<br /><br /><b>Uppdateringen misslyckades</b>";
    }
  }
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