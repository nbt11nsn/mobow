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
?>

<div id = "frame">
    <form action='' method='post' id ='postContracts' enctype="multipart/form-data">

<?php
echo '<ul><fieldset>
<legend><b>Kontor</b></legend>
<li>
<label for="kontor">Namn: </label>
<input type="text" align="left"  maxlength="50" value = ""  name="kontor" id="kontor" />
</li>
<li>
<label for="ocrnr">OCR nummer: </label>
<input type="text" align="left"  maxlength="50" value = ""  name="ocr" id="ocr" />
</li>
<li>
<label for="sbesok">Senaste besök: </label>
<input type="date" align="left" value = "'.date("Y-m-d").'"  name="sbesok" id="sbesok" />
</li>
<li>
<label for="telefonenbr">Telefon: </label>
<input type="tel" align="left"  maxlength="20" value = ""  name="telefonenbr" id="telefonenbr" />
</li>
<li>
<label for="stn">Antal stationer: </label>
<input type="number" align="left"  value = "" maxlength="11" value="stn" name="stn" name="stn" />
</li>
<li>
<label for="hemsida" >Hemsida (kom ihåg http://): </label>
<input type="url" align="left" value = "" maxlength="256" value="hemsida" name="hemsida" id="hemsida" />
</li>
<li>
<label for="allminfo">Information: </label>
<textarea cols="40" rows="5" input type="text" name="allminfo" id="allminfo"></textarea>
</li>
<li>
<label for="allminfo">Aktuellt: </label>
<textarea cols="40" rows="5" input type="text" name="currinfo" id="currinfo"></textarea>
</li>
<li>
<label for="forecolor">Förgrundsfärg: </label>
<input type="color" align="left"  value = "" maxlength="7" name="forecolor" id="forecolor" />
</li>
<li>
<label for="backcolor">Bakgrundsfärg: </label>
<input type="color" align="left"  value = "#FFFFFF" maxlength="7" name="backcolor" id="backcolor" />
</li>
<li>
<label for="logga">Nuvarande bild: </label>
Ingen bild vald</li><li><label for="logo">Välj bild:</label>
<input type="file" accept="image/*" align="left" maxlength="256" name="logo" id="logo" />
</li>
</fieldset>
<fieldset>
<legend><b>Adress</b></legend>
<li>
<label for="postnr">Postnummer: </label>
<input type="number" align="left"  value = "" maxlength="11"  name="postnr" id="postnr" />
</li>
<li>
<label for="stad">Stad: </label>
<input type="text" align="left"  value = "" maxlength="100"  name="stad" id="stad" />
</li>
<li>
<label for="gata">gata: </label>
<input type="text" align="left"  value = "" maxlength="100"  name="gata" id="gata" />
</li>
<li>
<label for="lng">longitud: </label>
<input type="text"  align="left" value = "" maxlength="100" name="lng" id="lng" />
</li>
<li>
<label for="lat">latitude: </label>
<input type="text"  align="left" value = "" maxlength="100" name="lat" id="lat" />
</li>
</fieldset>
<fieldset>
<legend><b>Användare</b></legend>
<li>
<label for="anvnamn">Användarnamn: </label>
<input type="text"  align="left" value = "" maxlength="100"  name="username" id="username" />
</li>
<li>
<label for="fornamn">Förnamn: </label>
<input type="text"  align="left" value = "" maxlength="100" value="frstnme" name="frstnme" id="frstnme" />
</li>
<li>
<label for="efternamn">Efternamn: </label>
<input type="text"  align="left" value = "" maxlength="100"name="lstnme" id="lstnme" />
</li>
<li>
<label for="mobil">Mobil nummer: </label>
<input type="text"  align="left" value = "" maxlength="100" name="mobile" id="mobile" />
</li>
<li>
<label for="mejl">Mejl: </label>
<input type="text"  align="left" value = "" maxlength="100"  name="mail" id="mail" />
</li>
<li>
<label for="losen">Lösenord: </label>
<input type="text"  align="left" value = "" maxlength="100" name="password" id="password" />
</li>
</fieldset>
<li class="submit">
<input type="reset" name="rst" id="rst" value="Återställ" />
<input type="submit" name="save" id="save" value="Spara" />
</li>
</ul>
</form>';


if(isset($_POST['rmimg'])&&isset($_POST['contracts'])){
  if(is_numeric($_POST['contracts'])){
    $c=$_POST['contracts'];
    $sqlquery = "UPDATE kontrakt SET kontrakt.logurl=NULL, kontrakt.logbredd=NULL, kontrakt.loghojd=NULL WHERE kontrakt.ID='$c'";
    mysqli_query($con, $sqlquery);
    if(mysqli_query($con, $sqlquery)){
      echo "<br /><br /><b>Sparningen lyckades</b>";
    }
    else{
      echo "<br /><br /><b>Sparningen misslyckades</b>";
    }
  }
}

if(isset($_POST['save'])&&isset($_POST['gata'])&&isset($_POST['stn'])&&isset($_POST['stad'])&&isset($_POST['kontor'])&&isset($_POST['sbesok'])
&&isset($_POST['ocr'])&&isset($_POST['username'])&&isset($_POST['frstnme'])&&isset($_POST['lstnme'])&&isset($_POST['mobile'])
&&isset($_POST['mail'])&&isset($_POST['password'])&&isset($_POST['telefonenbr'])&&isset($_POST['hemsida'])&&isset($_POST['allminfo'])
&&isset($_POST['currinfo'])&&isset($_POST['forecolor'])&&isset($_POST['backcolor'])&&isset($_POST['postnr'])&&isset($_POST['lng'])&&isset($_POST['lat']))
{
	$gata=mysqli_real_escape_string($con,$_POST['gata']);
    $stad=mysqli_real_escape_string($con,$_POST['stad']);
    $kont=mysqli_real_escape_string($con,$_POST['kontor']);
	$stn=mysqli_real_escape_string($con,$_POST['stn']);
	$sbesok=mysqli_real_escape_string($con,$_POST['sbesok']);
	$ocr=mysqli_real_escape_string($con,$_POST['ocr']);
	$usrn=mysqli_real_escape_string($con,$_POST['username']);
	$frst=mysqli_real_escape_string($con,$_POST['frstnme']);
	$lst=mysqli_real_escape_string($con,$_POST['lstnme']);
	$mob=mysqli_real_escape_string($con,$_POST['mobile']);
	$mail=mysqli_real_escape_string($con,$_POST['mail']);
	$pass=mysqli_real_escape_string($con,$_POST['password']);
	$tef=mysqli_real_escape_string($con,$_POST['telefonenbr']);
	$web=mysqli_real_escape_string($con,$_POST['hemsida']);
	$ainf=mysqli_real_escape_string($con,$_POST['allminfo']);
	$cinf=mysqli_real_escape_string($con,$_POST['currinfo']);
	$fc=mysqli_real_escape_string($con,$_POST['forecolor']);
	$bc=mysqli_real_escape_string($con,$_POST['backcolor']);
	$zip=mysqli_real_escape_string($con,$_POST['postnr']);
	$logo=mysqli_real_escape_string($con,$_FILES['logo']['name']);
	$lat=mysqli_real_escape_string($con,$_POST['lat']);
	$lng=mysqli_real_escape_string($con,$_POST['lng']);
	$error = false;
	
	
   
    if(!(is_numeric($stn)&&is_numeric($zip))){
		$error="Ogiltigt antal stationer";
	}
 
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
            $target = "image/logo/"."kontrakt".$kont.".".$ext;
            $abs_dir = __DIR__."/../".$target;
            if(move_uploaded_file($tmp_path, $abs_dir)){               
            }
            else{
                $error="Gick inte att ladda upp bilden";
            }
        }
    }
	


	
	 $insertAdress = "INSERT INTO adress values(null,'".$zip."','".$stad."','".$gata."',".$lng.",".$lat.");";
	$adressid = "(SELECT LAST_INSERT_ID())";
	
	$insertContract = "INSERT INTO kontrakt values(null,'".$kont."','".$sbesok."','".$cinf."','".$mob."',
	".$stn.",'".$target."','".$lw."','".$lh."','".$web."','".$ainf."','".$fc."','".$bc."','".$usrn."',".$adressid.", 1, '".$ocr."');";
	
	$insertNewUser = "INSERT INTO kontaktperson values('".$usrn."','".$frst."','".$lst."','".$mob."',
	'".$mail."','".$pass."', 0);";
	

    if(!$error){		
        if(mysqli_query($con, $insertAdress)&& mysqli_query($con, $insertNewUser)&&mysqli_query($con, $insertContract)){			
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