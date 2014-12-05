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
?>

<div id = "frame">
    <form action='' method='post' id ='postContracts' enctype="multipart/form-data">
    <select name='contracts' id='contracts'>
<?php 
$iresult = mysqli_query($con, $isql);
if (mysqli_num_rows($iresult) != 0) {
  while($irows = mysqli_fetch_assoc($iresult)) {
      if($_POST['contracts'] == $irows['ID'])
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
$isql2 = "SELECT kontrakt.ID, kontorsnamn, sbesok, tele, logurl, gata, stn, allminfo, currinfo, hemsida, forecolor, backcolor, postnr, stad FROM kontrakt LEFT OUTER JOIN adress ON kontrakt.adressID = adress.ID LEFT OUTER JOIN ikontyp ON kontrakt.ikonid = ikontyp.ID WHERE kontrakt.ID = '".$_POST['contracts']."'";
$iresult = mysqli_query($con, $isql2);
if (mysqli_num_rows($iresult) != 0) {
  $irows = mysqli_fetch_assoc($iresult);
}	  
echo '<ul><li>
<label for="kontor">Namn: </label>
<input type="text" align="left"  maxlength="50" value = "'.$irows["kontorsnamn"].'"  name="kontor" id="kontor" />
</li>
<li>
<label for="sbesok">Senaste besök: </label>
<input type="date" align="left" value = "'.$irows["sbesok"].'"  name="sbesok" id="sbesok" />
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
<input type="color" align="left"  value = "'.$irows["forecolor"].'" maxlength="7" value="forecolor" name="forecolor" id="forecolor" />
</li>
<li>
<label for="backcolor">Bakgrundsfärg: </label>
<input type="color" align="left"  value = "'.$irows["backcolor"].'" maxlength="7" value="backcolor" name="backcolor" id="backcolor" />
</li>
<li>
<label for="postnr">Postnummer: </label>
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
<label for="logga">Nuvarande bild: </label>';
if(isset($irows["logurl"])){
  echo"<img id='logga' style='width:50px;' src='./../".$irows['logurl']."' />";
  echo"<input type='submit' name='rmimg' id='rmimg' value='Ta bort bild' />";
  echo"</li><li><label for='logo'>Byt bild:</label>";
}
else{
  echo"Ingen bild vald</li><li><label for='logo'>Välj bild:</label>";
}
echo'
<input type="file" accept="image/*" align="left" maxlength="256" name="logo" id="logo" />
</li>
<li class="submit">
<input type="reset" name="rst" id="rst" value="Återställ" />
<input type="submit" name="save" id="save" value="Spara" />
</li>
</ul>
</form>';
}

if(isset($_POST['rmimg'])&&isset($_POST['contracts'])){
  if(is_numeric($_POST['contracts'])){
    $c=$_POST['contracts'];
    $sqlquery = "UPDATE kontrakt SET kontrakt.logurl=NULL, kontrakt.logbredd=NULL, kontrakt.loghojd=NULL WHERE kontrakt.ID='$c'";
    mysqli_query($con, $sqlquery);
    if(mysqli_query($con, $sqlquery)){
      echo "<br /><br /><b>Uppdateringen lyckades</b>";
    }
    else{
      echo "<br /><br /><b>Uppdateringen misslyckades</b>";
    }
  }
}

if(isset($_POST['save'])&&isset($_POST['gata'])&&isset($_POST['stn'])&&isset($_POST['stad'])&&isset($_POST['contracts'])&&isset($_POST['kontor'])&&isset($_POST['sbesok']))
{
    $error = false;
    $g=mysqli_real_escape_string($con,$_POST['gata']);
    $ss=mysqli_real_escape_string($con,$_POST['stad']);
    $k=mysqli_real_escape_string($con,$_POST['kontor']);
    if(is_numeric($_POST['stn'])){
        $s=$_POST['stn'];
    }
    else{$error="Ogiltigt antal stationer";}
    if(is_numeric($_POST['contracts'])){
        $c=$_POST['contracts'];
    }
    else{$error="Kontraktet finns inte";}
    $sql3 = "UPDATE kontrakt, adress SET kontrakt.kontorsnamn = '$k', adress.gata = '$g', kontrakt.stn = '$s', adress.stad = '$ss'";



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
            echo $err;
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
            echo "<br /><br /><b>Uppdateringen lyckades</b>";
        }
        else{
            echo "<br /><br /><b>Uppdateringen misslyckades</b>";
        }
    }
    else{
        echo "<br /><br /><b>$error</b>";
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