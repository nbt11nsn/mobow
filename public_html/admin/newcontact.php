<?php
SESSION_start();
?>
<!DOCTYPE html>
<html>
<head>
<?php
defined('THE_SESSION') || define('THE_SESSION', TRUE);
require_once('include/checksession.php');
defined('THE_ASESSION') || define('THE_ASESSION', TRUE);
require_once('include/checkasession.php');
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
$getCompanies = "SELECT * FROM foretag";
$getContacts = "SELECT * FROM kontaktperson";
$getIcons = "SELECT * FROM ikontyp";
?>

<div id = "frame">
    <form action='' method='post' id ='postContracts' enctype="multipart/form-data">
<fieldset>
<legend><b>Användare</b></legend>
<li>
<label for="anvnamn">Användarnamn: (minst ett icke-numeriskt tecken)</label>
<input required type="text" align="left" value="" maxlength="100" name="username" id="username" />
</li>
<li>
<label for="fornamn">Förnamn: </label>
<input required type="text"  align="left" value = "" maxlength="100" value="frstnme" name="frstnme" id="frstnme" />
</li>
<li>
<label for="efternamn">Efternamn: </label>
<input required type="text"  align="left" value = "" maxlength="100"name="lstnme" id="lstnme" />
</li>
<li>
<label for="mobil">Mobilnummer: </label>
<input type="text"  align="left" value = "" maxlength="100" name="mobile" id="mobile" />
</li>
<li>
<label for="mejl">Mejl: </label>
<input required type="text"  align="left" value = "" maxlength="100"  name="mail" id="mail" />
</li>
<li>
<label for="losen">Lösenord: </label>
<input required type="text"  align="left" value = "" maxlength="100" name="password" id="password" />
</li>
<label for="administr">Administrator: </label>
<input type="checkbox"  align="left" value = "" maxlength="100" name="admin" id="admin" />
</li>
</fieldset>
<input type="reset" name="rst" id="rst" value="Återställ" />
<input type="submit" name="save" id="save" value="Spara" />
</frame>


<?php	
if(isset($_POST['save'])&&!empty($_POST['username'])&&!empty($_POST['frstnme'])&&!empty($_POST['lstnme'])
&&!empty($_POST['mail'])&&!empty($_POST['password'])){
	$name=mysqli_real_escape_string($con,$_POST['username']);
    $first=mysqli_real_escape_string($con,$_POST['frstnme']);
    $last=mysqli_real_escape_string($con,$_POST['lstnme']);
	if(!empty($_POST['mobile'])){$mob=mysqli_real_escape_string($con,$_POST['mobile']);}else{$mob="";}
	$mail=mysqli_real_escape_string($con,$_POST['mail']);	
	$pass=password_hash(mysqli_real_escape_string($con,$_POST['password']), PASSWORD_DEFAULT);
	$admincheck = 0;
	
	if (isset($_POST['admin'])) {
	$admincheck = 1;}
			$hash = password_hash($pass, PASSWORD_DEFAULT);			        
		$insertContact = "INSERT INTO kontaktperson values('".$name."','".$first."','".$last."','".$mob."','".$mail."','".$pass."',".$admincheck.")";	
        if(mysqli_query($con, $insertContact)){
            echo "<div class='ok'>Ny användare har skapats</div>";
        }
        else{
            echo "<div class='error'>Lyckades inte lägga till en ny användare</div>";
        }		
}
?>