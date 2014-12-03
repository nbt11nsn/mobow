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
$isql = "SELECT kontrakt.ID, kontorsnamn, tele, logurl, gata FROM kontrakt LEFT OUTER JOIN adress ON kontrakt.adressID = adress.ID
LEFT OUTER JOIN ikontyp ON kontrakt.ikonid = ikontyp.ID";
$_SESSION['currentContract'] = 1;
?>

<div id = "frame">
    <form action='' method='post' id ='postContracts'>
    <select name = 'contracts' id='contracts'>
<?php 
$iresult = mysqli_query($con, $isql);
if (mysqli_num_rows($iresult) != 0) {
  while($irows = mysqli_fetch_assoc($iresult)) {
    if($_SESSION['currentContract'] == $irows['ID'])
    {
      $_SESSION['currentContract'] = $_POST["contracts"];
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
<input type="submit" name = "accept" id = "accept" value="Välj">

<?php

if(isset($_POST['accept'])) 
{
$isql2 = "SELECT kontrakt.ID, kontorsnamn, tele, logurl, gata, stn, oppet, allminfo, hemsida, forecolor, backcolor, postnr, stad FROM kontrakt LEFT OUTER JOIN adress ON kontrakt.adressID = adress.ID LEFT OUTER JOIN ikontyp ON kontrakt.ikonid = ikontyp.ID WHERE kontrakt.ID = '".$_SESSION['currentContract']."'";
$iresult = mysqli_query($con, $isql2);
if (mysqli_num_rows($iresult) != 0) {
  $irows = mysqli_fetch_assoc($iresult);
}	  
echo '<ul><li>
<label for="kontor">Namn: </label>
<input type="text" align="left"  maxlength="50" value = "'.$irows["kontorsnamn"].'"  name="kontor" id="kontor" />
</li>
<li>
<label for="telefonenbr">Telefon: </label>
<input type="tel" align="left"  maxlength="20" value = "'.$irows["tele"].'"  name="telefonenbr" id="telefonenbr" />
</li>
<li>
<label for="stn">Antal stationer: </label>
<input type="number" align="left"  value = "'.$irows["stn"].'" maxlength="11" value="stn" name="stn" name="stn" />
</li>
<li>
<label for="oppet">Öppet tider: </label>
<textarea cols="40" rows="5" value="oppet" name="oppet" id="oppet">'.strip_tags($irows["oppet"]).'</textarea>
</li>
<li>
<label for="hemsida" >Hemsida: </label>
<input type="url" align="left" value = "'.$irows["hemsida"].'" maxlength="256" value="hemsida" name="hemsida" id="hemsida" />
</li>
<li>
<label for="allminfo">Allmäninfo: </label>
<textarea cols="40" rows="5" input type="text" value="allminfo" name="allminfo" id="allminfo">'.strip_tags($irows["allminfo"]).'</textarea>
</li>
<li>
<label for="forecolor">Förgrundsfärg: </label>
<input type="color" align="left"  value = "'.$irows["forecolor"].'" maxlength="7" value="forecolor" name="forecolor" id="forecolor" />
</li>
<li>
<label for="backcolor">Bakgrundsfärg: </label>
<input type="color" align="left"  value = "'.$irows["backcolor"].'" maxlength="7" value="backcolor" name="backcolor" id="backcolor" />
</li>
<li>
<label for="postnr">Postnummer (utan mellanslag): </label>
<input type="number" align="left"  value = "'.$irows["postnr"].'" maxlength="11" value="postnr" name="postnr" id="postnr" />
</li>
<li>
<label for="stad">Stad: </label>
<input type="text" align="left"  value = "'.$irows["stad"].'" maxlength="100" value="stad" name="stad" id="stad" />
</li>
<li>
<label for="gata">Gata: </label>
<input type="text"  align="left" value = "'.$irows["gata"].'" maxlength="100" value="gata" name="gata" id="gata" />
</li>
<li>
<label for="logo">Nuvarande logga: '.$irows["logurl"].'</label>
<input type="file" align="left" maxlength="256" name="logo" />
</li>
<li class="submit">
<input type="reset" name="rst" id="rst" value="Återställ" />
<input type="submit" name="save" id="save" value="Spara" />
</li>
</ul>
</form>';
}

if(isset($_POST['save'])&&isset($_POST['gata'])&&isset($_POST['stn'])&&isset($_POST['stad'])&&isset($_POST['contracts'])) 
{
    $g=mysqli_real_escape_string($con,$_POST['gata']);
    $s=is_numeric($_POST['stn']);
    $o=mysqli_real_escape_string($con, nl2br($_POST['oppet']));
    $a=mysqli_real_escape_string($con, nl2br($_POST['allminfo']));
    $h=mysqli_real_escape_string($con,$_POST['hemsida']);
    $f=mysqli_real_escape_string($con,$_POST['forecolor']);
    $b=mysqli_real_escape_string($con,$_POST['backcolor']);
    $p=is_numeric($_POST['postnr']);
    $ss=mysqli_real_escape_string($con,$_POST['stad']);
    $t=mysqli_real_escape_string($con,$_POST['telefonenbr']);
    $l=mysqli_real_escape_string($con,$_POST['logo']);
    $c=is_numeric($_POST['contracts']);
	$sql3 = "UPDATE kontrakt, adress SET adress.gata = '$g', kontrakt.stn = '$s', kontrakt.oppet = '$o', kontrakt.allminfo = '$a', kontrakt.hemsida = '$h', kontrakt.forecolor = '$f', kontrakt.backcolor = '$b', adress.postnr = '$p', adress.stad = '$ss', kontrakt.tele = '$t', kontrakt.logurl = '$l' WHERE kontrakt.adressid = adress.ID AND kontrakt.ID = '$c'";
	if(mysqli_query($con, $sql3)){
        echo "<br /><br /><b>Uppdateringen lyckades</b>";
    }
    else{
        echo "<br /><br /><b>Uppdateringen misslyckades</b>";
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