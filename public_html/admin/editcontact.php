<?php
SESSION_start();
?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" media="screen" href="css/default.css" />
<link rel="stylesheet" type="text/css" media="screen" href="css/index.css" />
<?php
// tar bort all form av felrapportering
// defined('THE_ERROR') || define('THE_ERROR', TRUE);
// require_once('include/no_error.php');

// koppla upp mot databas
// defined('THE_DB') || define('THE_DB', TRUE);
// define('THE_DB', TRUE);
// require_once('../db.php');
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

<div id="infoframe">

	<form action="" method="post" id = "postContracts">
		<select name = "infodropdowntop" id = "infodropdowntop">		
		
		<?php 
		//Skriver ut kontaktpersonens info i dropdownmenyn
		$isadmin = mysqli_real_escape_string($con,$_SESSION['admin']);
		if($isadmin){
	$isql = "SELECT anvnamn, fornamn, efternamn
				FROM kontaktperson";
}
else{
$isql = "SELECT anvnamn, fornamn, efternamn
				FROM kontaktperson WHERE anvnamn = '".mysqli_real_escape_string($con,$_SESSION['username'])."'";
}				
	$iresult = mysqli_query($con, $isql);
	if (mysqli_num_rows($iresult) != 0) {
      while($irows = mysqli_fetch_assoc($iresult)) {	  
	  if(isset($_POST['infodropdowntop']) && $irows['anvnamn'] == $_POST['infodropdowntop']){
	  	  echo "<option value='".$irows['anvnamn']."' selected='selected' >".$irows['anvnamn']."</option>";
	  }
	else{
	  echo "<option value='".$irows['anvnamn']."'>".$irows['anvnamn']."</option>";
	}
    }

  }
  mysqli_free_result($iresult);	
	?>	
		<input type="submit" name = "choicebutton" id = "infochoicebutton" value="Välj kontakt">
		
				<?php 
		
		if(isset($_POST["choicebutton"])){
			$isql6 = "SELECT anvnamn, mobil, fornamn, efternamn, mejl FROM kontaktperson WHERE anvnamn = '".$_POST['infodropdowntop']."'";

	$iresult = mysqli_query($con, $isql6);
	if (mysqli_num_rows($iresult) != 0) {
      while($irows = mysqli_fetch_assoc($iresult)) {	 
	   if($isadmin){
		echo '<input type="submit" name="save" id="save" value="Spara" />';	
		}		
		else{
		echo '<input type="submit" name="save" id="save" value="Skicka" />';	}
	   echo '	   	   	
	  <fieldset>
		<legend class = "center"><b>'.$irows["anvnamn"].'</b></legend>	

		<label for="fnamn">Förnamn: </label>
		<input type="text" value="'.$irows['fornamn'].'" name = "fname" id = "fname"/>
		
		<label for="enamn">Efternamn: </label>
		<input type="text" value="'.$irows['efternamn'].'" name = "ename" id = "ename"/>
			
		<label for="tele">Telefon: </label>
		<input type="text" value="'.$irows['mobil'].'" name = "mobile" id = "mobile"/>
			
		<label for="mejl">Mejl: </label>
		<input type="text" value="'.$irows['mejl'].'" name = "mail" id = "mail"/>
	</fieldset> ';				
		}		
	}	
        mysqli_free_result($iresult);	
  }	
	if(isset($_POST['save'])){ // Editering av kontakt
	$error = false;
    $fo=mysqli_real_escape_string($con,$_POST['fname']);
    $ef=mysqli_real_escape_string($con,$_POST['ename']);
    $mo=mysqli_real_escape_string($con,$_POST['mobile']);
	$me=mysqli_real_escape_string($con,$_POST['mail']);

	if($isadmin){
    $sql3 = "UPDATE kontaktperson SET fornamn = '$fo', efternamn = '$ef', mobil = '$mo', mejl = '$me' WHERE anvnamn = '".$_POST['infodropdowntop']."'";
	}
	else {
	$sql3 = "INSERT INTO edit_kntper VALUES('$fo','$ef','$mo','$me',1,NULL, '".$_POST['infodropdowntop']."') 
	ON DUPLICATE KEY UPDATE fornamn='$fo',efternamn='$ef',mobil='$mo',mejl='$me',status=1, meddelande=NULL";
	}

        if(mysqli_query($con, $sql3)){
            echo "<div class='ok'>Uppdateringen lyckades</div>";
        }
        else{
            echo "<div class='error'>Uppdateringen misslyckades</div>";
        }
			
}
	?>	
</form>
</div>
</div><!--main-wrapper-->
<?php
defined('THE_FOOTER') || define('THE_FOOTER', TRUE);
require_once("include/footer.php");
?>


</body>
</html>



