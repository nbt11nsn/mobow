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
    $isql = "SELECT kontrakt.ID, kontorsnamn, tele, logurl, gata, orgnr FROM kontrakt LEFT OUTER JOIN adress ON kontrakt.adressID = adress.ID LEFT OUTER JOIN ikontyp ON kontrakt.ikonid = ikontyp.ID ORDER BY kontorsnamn";
    $sqlorg = "SELECT orgnr, namn FROM foretag ORDER BY orgnr";
}
else{
    $isql = "SELECT kontrakt.ID, kontorsnamn, tele, logurl, gata, orgnr FROM kontaktperson LEFT OUTER JOIN kontrakt ON kontrakt.kontaktpersonid = kontaktperson.anvnamn LEFT OUTER JOIN adress ON kontrakt.adressID = adress.ID LEFT OUTER JOIN ikontyp ON kontrakt.ikonid = ikontyp.ID WHERE kontaktperson.anvnamn = '$usr' ORDER BY kontorsnamn";
}
?>

<div id = "frame">
    <form action='' method='post' id ='postContracts' enctype="multipart/form-data">

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
    echo"<select required name='contracts' id='contracts'>";
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
<input type="submit" name = "accept" id = "accept" value="Välj kontrakt">

<?php

if(isset($_POST['accept'])&&is_numeric($_POST['contracts'])) 
{
$isql2 = "SELECT kontrakt.ID, kontorsnamn, sbesok, tele, logurl, gata, stn, allminfo, currinfo, hemsida, forecolor, backcolor, postnr, stad, ikonid FROM kontrakt LEFT OUTER JOIN adress ON kontrakt.adressID = adress.ID WHERE kontrakt.ID = '".$_POST['contracts']."'";
$iresult = mysqli_query($con, $isql2);
$sqlikon = "SELECT ID, typ FROM ikontyp";
$resultikon = mysqli_query($con, $sqlikon);
if (mysqli_num_rows($iresult) != 0) {
  $irows = mysqli_fetch_assoc($iresult);
}	  
echo '<ul>';
if($adm){
echo"
<li>
<label for='kontor'>Namn: </label>
<input required type='text' align='left'  maxlength='50' value = '".$irows['kontorsnamn']."'  name='kontor' id='kontor' />
</li>
<li>
<label for='sbesok'>Senaste besök: </label>
<input required type='date' align='left' value = '".$irows['sbesok']."' name='sbesok' id='sbesok' />
</li>
<li>
<label for='typ'>Typ av verksamhet: </label>
<select required name='typ' id='typ'>";
if (mysqli_num_rows($resultikon) != 0) {
  while($ikons = mysqli_fetch_assoc($resultikon)) {
      if($irows['ikonid'] == $ikons['ID'])
    {
      echo "<option value=".$ikons['ID']." selected='selected' >".$ikons['typ']."</option>";
    }
    else {
      echo "<option value=".$ikons['ID']." >".$ikons['typ']."</option>";
    }	
  }
}
mysqli_free_result($resultikon);
}
echo"
</select> 
</li>
";
echo'
<li>
<label for="telefonenbr">Telefon: </label>
<input type="tel" align="left"  maxlength="20" value = "'.$irows["tele"].'"  name="telefonenbr" id="telefonenbr" />
</li>';
if($adm){
echo'
<li>
<label for="stn">Antal stationer: </label>
<input required type="number" align="left"  value = "'.$irows["stn"].'" maxlength="11" value="stn" name="stn" name="stn" />
</li>';}
echo'
<li>
<label for="hemsida" >Hemsida (kom ihåg http://): </label>
<input type="url" align="left" value = "'.$irows["hemsida"].'" maxlength="256" value="hemsida" name="hemsida" id="hemsida" />
</li>
<li>
<label for="allminfo">Information: </label>
<textarea cols="40" rows="5" input type="text" name="allminfo" id="allminfo">'.strip_tags($irows["allminfo"]).'</textarea>
</li>
<li>
<label for="allminfo">Aktuellt: </label>
<textarea cols="40" rows="5" input type="text" name="currinfo" id="currinfo">'.strip_tags($irows["currinfo"]).'</textarea>
</li>
<li>
<label for="forecolor">Förgrundsfärg: </label>
<input type="color" align="left"  value = "'.$irows["forecolor"].'" maxlength="7" name="forecolor" id="forecolor" />
</li>
<li>
<label for="backcolor">Bakgrundsfärg: </label>
<input type="color" align="left"  value = "'.$irows["backcolor"].'" maxlength="7" name="backcolor" id="backcolor" />
</li>';
if($adm){
echo'
<li>
<label for="postnr">Postnummer: </label>
<input type="number" align="left"  value = "'.$irows["postnr"].'" maxlength="11" value="postnr" name="postnr" id="postnr" />
</li>
<li>
<label for="stad">Stad: </label>
<input required type="text" align="left"  value = "'.$irows["stad"].'" maxlength="100" value="stad" name="stad" id="stad" />
</li>
<li>
<label for="gata">Gata: </label>
<input required type="text"  align="left" value = "'.$irows["gata"].'" maxlength="100" value="gata" name="gata" id="gata" />
</li>';}
echo'
<li>
<label for="logga">Nuvarande bild: </label>';
if(isset($irows["logurl"])){
  echo"<img id='logga' src='./../".$irows['logurl']."' />";
  if($adm){
  echo"<input type='submit' name='rmimg' id='rmimg' value='Ta bort bild' />";
  }
  else{
  echo"<input type='submit' name='forrmimg' id='forrmimg' value='Ta bort bild' />";
  }
  echo"</li><li><br /><label for='logo'>Byt bild (jpeg,bmp,gif,png <2MB):</label>";
}
else{
  echo"Ingen bild vald</li><li><label for='logo'>Välj bild:</label>";
}
echo'<input type="file" accept="image/*" align="left" maxlength="256" name="logo" id="logo" /></li>
<li class="submit">
<input type="reset" name="rst" id="rst" value="Återställ" />';
if($adm){echo'<input type="submit" name="save" id="save" value="Spara" />';}
else{echo'<input type="submit" name="forsave" id="forsave" value="Spara" />';}
echo'
</li>
</ul>
</form>';
}

if(isset($_POST['rmimg'])&&isset($_POST['contracts'])){
  if(is_numeric($_POST['contracts'])){
    $c=$_POST['contracts'];
    $sqlquery = "UPDATE kontrakt SET kontrakt.logurl=NULL, kontrakt.logbredd=NULL, kontrakt.loghojd=NULL WHERE kontrakt.ID='$c'";
    if(mysqli_query($con, $sqlquery)){
      echo "<br /><br /><b>Uppdateringen lyckades</b>";
    }
    else{
      echo "<br /><br /><b>Uppdateringen misslyckades</b>";
    }
  }
}

if(isset($_POST['forrmimg'])&&isset($_POST['contracts'])){
  if(is_numeric($_POST['contracts'])){
    $c=$_POST['contracts'];
    $sqlquery = "INSERT INTO edit_foretag(kontraktid, logurl, logbredd, loghojd)VALUES($c,NULL,NULL,NULL) ON DUPLICATE KEY UPDATE logurl=NULL, logbredd=NULL, loghojd=NULL";
    if(mysqli_query($con, $sqlquery)){
      echo "<br /><br /><b>Förfrågan om att ta bort bild skickat till admin</b>";
    }
    else{
      echo "<br /><br /><b>Gick inte att ta emot uppdatering</b>";
    }
  }
}

if(isset($_POST['save'])&&isset($_POST['gata'])&&isset($_POST['stn'])&&isset($_POST['stad'])&&isset($_POST['contracts'])&&isset($_POST['kontor'])&&isset($_POST['sbesok'])&&isset($_POST['typ']))
{
    $error = false;
    $g=mysqli_real_escape_string($con,$_POST['gata']);
    $ss=mysqli_real_escape_string($con,$_POST['stad']);
    $k=mysqli_real_escape_string($con,$_POST['kontor']);
    $ty=mysqli_real_escape_string($con,$_POST['typ']);
    if(is_numeric($_POST['stn'])){
        $s=$_POST['stn'];
    }
    else{$error="Ogiltigt antal stationer";}
    if(is_numeric($_POST['contracts'])){
        $c=$_POST['contracts'];
    }
    else{$error="Kontraktet finns inte";}
    $sql3 = "UPDATE kontrakt, adress SET kontrakt.kontorsnamn = '$k', adress.gata = '$g', kontrakt.stn = '$s', adress.stad = '$ss', kontrakt.ikonid = '$ty'";



    if(!empty($_FILES['logo']['name'])){
        $ok=true;
        $err="Error: ";
        $allow = array("image/jpeg", "image/gif", "image/bmp", "image/png");
        if($_FILES["logo"]["size"] > 2000000) {
            $ok=false;
            $err.='För stor fil<br />';
        }
        if(!in_array($_FILES['logo']['type'], $allow)){
            $ok=false;
            $err.='Filformatet stöds inte<br />';
        }
        if($ok==false){
            echo "<div class='error'>$err</div>";
            $error="Gick inte att ladda upp bilden";
        }
        else
        {
            $tmp_path = $_FILES['logo']['tmp_name'];
            $li = getimagesize($tmp_path);
            $lw = $li[0];
            $lh = $li[1];
            $ext = pathinfo($_FILES['logo']['name'], PATHINFO_EXTENSION);
            $target = "image/logo/"."kontrakt".$c.".".$ext;
            $abs_dir = __DIR__."/../".$target;
            if(move_uploaded_file($tmp_path, $abs_dir)){
                $sql3.= ", kontrakt.logurl = '$target', kontrakt.logbredd = '$lw', kontrakt.loghojd = '$lh'";
            }
            else{
                $error="Gick inte att ladda upp bilden";
            }
        }
    }
    if(isset($_POST['sbesok'])){
        $d=mysqli_real_escape_string($con,$_POST['sbesok']);
    }else{$d="";}
    $sql3.= ", kontrakt.sbesok= '$d'";
    if(isset($_POST['currinfo'])){
        $ci=mysqli_real_escape_string($con,nl2br($_POST['currinfo']));
    }else{$ci="";}
    $sql3.= ", kontrakt.currinfo = '$ci'";
    if(isset($_POST['allminfo'])){
        $a=mysqli_real_escape_string($con,nl2br($_POST['allminfo']));
    }else{$a="";}
    $sql3.= ", kontrakt.allminfo = '$a'";
    if(isset($_POST['postnr']) && is_numeric($_POST['postnr'])){
        $p=$_POST['postnr'];
    }else{$p="";}
    $sql3.= ", adress.postnr = '$p'";
    if(isset($_POST['hemsida'])){
        $h=mysqli_real_escape_string($con,$_POST['hemsida']);
    }else{$h="";}
    $sql3.= ", kontrakt.hemsida = '$h'";
    if(isset($_POST['forecolor'])){
        $f=mysqli_real_escape_string($con,$_POST['forecolor']);
    }else{$f="";}
    $sql3.= ", kontrakt.forecolor = '$f'";
    if(isset($_POST['backcolor'])){
        $b=mysqli_real_escape_string($con,$_POST['backcolor']);
    }else{$b="";}
    $sql3.= ", kontrakt.backcolor = '$b'";
    if(isset($_POST['telefonenbr'])){
        $t=mysqli_real_escape_string($con,$_POST['telefonenbr']);
    }else{$t="";}
    $sql3.= ", kontrakt.tele = '$t'";
    $sql3.=" WHERE kontrakt.adressid = adress.ID AND kontrakt.ID = '$c'";
    if(!$error){
        if(mysqli_query($con, $sql3)){
            echo "<div class='ok'>Uppdateringen lyckades</div>";
        }
        else{
            echo "<div class='error'>Uppdateringen misslyckades</div>";
        }
    }
    else{
        echo "<div class='error'>$error</div>";
    }
}

if(isset($_POST['forsave']))
{
    $error = false;
    if(is_numeric($_POST['contracts'])){
        $c=$_POST['contracts'];
    }
    else{$error="Kontraktet finns inte";}

    if(!empty($_FILES['logo']['name'])){
        $ok=true;
        $err="Error: ";
        $allow = array("image/jpeg", "image/gif", "image/bmp", "image/png");
        if($_FILES["logo"]["size"] > 2000000) {
            $ok=false;
            $err.='För stor fil!<br />';
        }
        if(!in_array($_FILES['logo']['type'], $allow)){
            $ok=false;
            $err.='Filformatet stöds inte!<br />';
        }
        if($ok==false){
            $imgexist = false;
            echo "<div class='error'>$err</div>";
            $error="Gick inte att ladda upp bilden";
        }
        else
        {
            $tmp_path = $_FILES['logo']['tmp_name'];
            $li = getimagesize($tmp_path);
            $lw = $li[0];
            $lh = $li[1];
            $ext = pathinfo($_FILES['logo']['name'], PATHINFO_EXTENSION);
            $target = "image/logo/tmp"."kontrakt".$c.".".$ext;
            $abs_dir = __DIR__."/../".$target;
            if(move_uploaded_file($tmp_path, $abs_dir)){
                $imgexist = true;
            }
            else{
                $imgexist = false;
                $error="Gick inte att ladda upp bilden";
            }
        }
    }
    else{
        $imgexist = false;
    }
    if(isset($_POST['currinfo'])){
        $ci=mysqli_real_escape_string($con,nl2br($_POST['currinfo']));
    }else{$ci="";}

    if(isset($_POST['allminfo'])){
        $a=mysqli_real_escape_string($con,nl2br($_POST['allminfo']));
    }else{$a="";}

    if(isset($_POST['hemsida'])){
        $h=mysqli_real_escape_string($con,$_POST['hemsida']);
    }else{$h="";}

    if(isset($_POST['forecolor'])){
        $f=mysqli_real_escape_string($con,$_POST['forecolor']);
    }else{$f="";}

    if(isset($_POST['backcolor'])){
        $b=mysqli_real_escape_string($con,$_POST['backcolor']);
    }else{$b="";}

    if(isset($_POST['telefonenbr'])){
        $t=mysqli_real_escape_string($con,$_POST['telefonenbr']);
    }else{$t="";}

if($imgexist){
    $sql3 = "INSERT INTO edit_foretag(kontraktid, currinfo, tele, logurl, logbredd, loghojd, hemsida, allminfo, forecolor, backcolor)VALUES('$c','$ci','$t','$target','$lw','$lh','$h','$a','$f','$b') ON DUPLICATE KEY UPDATE currinfo='$ci', tele='$t', logurl='$target',logbredd='$lw',loghojd='$lh',hemsida='$h',allminfo='$a',forecolor='$f',backcolor='$b'";
}
else{
    $sql3 = "INSERT INTO edit_foretag(kontraktid, currinfo, tele, hemsida, allminfo, forecolor, backcolor)VALUES('$c','$ci','$t','$h','$a','$f','$b') ON DUPLICATE KEY UPDATE currinfo='$ci',tele='$t',hemsida='$h',allminfo='$a',forecolor='$f',backcolor='$b'";
}
    if(!$error){
        if(mysqli_query($con, $sql3)){
            echo "<div class='ok'>Förfrågan om uppdatering av information är skickat till administratör</div>";
        }
        else{
            echo "<div class='error'>Gick inte att skicka förfrågan om uppdatering</div>";
        }
    }
    else{
        echo "<div class='error'>$error</div>";
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