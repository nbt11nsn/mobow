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
<label for="anvnamn">Användarnamn: </label>
<input required type="text"  align="left" value = "" maxlength="100"  name="username" id="username" />
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
<label for="mobil">Mobil nummer: </label>
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
</fieldset>
<input type="reset" name="rst" id="rst" value="Återställ" />
<input type="submit" name="save" id="save" value="Spara" />
</frame>


<?php
if(isset($_POST['postContracts']&&!empty($_POST['username'])&&!empty($_POST['frstnme'])&&!empty($_POST['lstnme'])
&&!empty($_POST['mobile'])&&!empty($_POST['mail'])&&!empty($_POST['password']))){

}
?>