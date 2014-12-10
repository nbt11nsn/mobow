<?php
SESSION_start();
?>
<!DOCTYPE html>
<html>
<head>
<script src= "js/blink.js"></script>
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

<div id="frame">
<div id = "overviewinfo">
	</div> 
	
	
	<form action="" method="post" id = "postRows">
		<select name = "dropdown" id = "invoicedropdown">		
		<?php 
		//Skriver ut kontaktpersonens info
	$isql = "SELECT anvnamn, fornamn, efternamn, kontorsnamn 
				FROM kontaktperson JOIN kontrakt on kontrakt.kontaktpersonid = kontaktperson.anvnamn";		
	$iresult = mysqli_query($con, $isql);
	if (mysqli_num_rows($iresult) != 0) {
      while($irows = mysqli_fetch_assoc($iresult)) {	  
	  if(isset($_POST['dropdown']) && $irows['anvnamn'] == $_POST['dropdown']){
	  	  echo "<option value=".$irows['anvnamn']." selected='selected' >".$irows['fornamn']."</option>";
	  }
	else{
	  echo "<option value=".$irows['anvnamn'].">".$irows['fornamn']." ".$irows['efternamn'].", ".$irows['kontorsnamn']."</option>";
	}
    }
  }
  mysqli_free_result($iresult);	
	?>	
		<input type="submit" name = "choicebutton" id = "choicebutton" value="Välj kontakt">
		</form>
				<?php 
		$startDate = $irows['sbesok'];
		$endDate = date("Y-m-d", strtotime("$startDate +6 month"));
		if(isset($_POST["choicebutton"])){
			$isql6 = "SELECT SUM(stn), postnr, stad, gata, kontorsnamn, fornamn, efternamn, mobil, mejl, sbesok 
						FROM kontaktperson LEFT OUTER JOIN kontrakt ON kontrakt.kontaktpersonid = kontaktperson.anvnamn JOIN adress on kontrakt.ID = adress.ID
							WHERE kontaktperson.anvnamn = '".$_POST['dropdown']."'";
	$iresult = mysqli_query($con, $isql6);
	if (mysqli_num_rows($iresult) != 0) {
      while($irows2 = mysqli_fetch_assoc($iresult)) {
	  	
	  echo "<div id='invoicelistframe'>"
	  ."Företag: ".$irows2['kontorsnamn']."<br /> "
	  ."Hyr antal stationer: ".$irows2['SUM(stn)']."<br /> "
	  ."Senaste besök: ".$irows2['sbesok']."<br /> "
	  ."Nästa besök: ".$endDate."<br /> "
	  ."Adress: ".$irows2['gata'].", ".$irows2['postnr']." ".$irows2['stad']."<br /> "
	  ."Organisationsnummer: ". " <br /> "	  
	  ."Kontaktperson: ".$irows2['fornamn']." ".$irows2['efternamn']."<br /> "
	  ."Telefonnummer: ".$irows2['mobil']."<br /> "
	  ."Mejl: ".$irows2['mejl']."<br /> "
	  ."Senaste faktura: ". "</div></a>";
		}
	}
	  mysqli_free_result($iresult);
  }	
	?>	
</div>
 </form>
</div><!--main-wrapper-->
<?php
defined('THE_FOOTER') || define('THE_FOOTER', TRUE);
require_once("include/footer.php");
?>


</body>
</html>



