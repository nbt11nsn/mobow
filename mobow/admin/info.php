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
	  	  echo "<option value=".$irows['anvnamn']." selected='selected' >".$irows['fornamn']." ".$irows['efternamn'].", ".$irows['kontorsnamn']."</option>";
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
			$isql6 = "SELECT kontorsnamn,kontrakt.orgnr, kontrakt.ID, stn, fornamn, efternamn, kontaktperson.anvnamn, mobil, mejl, sbesok, url, datum, postnr, stad, gata, foretag.namn 
						FROM kontaktperson
							LEFT OUTER JOIN kontrakt ON kontrakt.kontaktpersonid = anvnamn
							JOIN adress ON adress.ID = kontrakt.ID
							JOIN foretag ON foretag.orgnr = kontrakt.orgnr
							LEFT OUTER JOIN faktura ON faktura.agarid = kontrakt.ID GROUP BY kontorsnamn
							HAVING kontaktperson.anvnamn = '".$_POST['dropdown']."'";
	$iresult = mysqli_query($con, $isql6);
	if (mysqli_num_rows($iresult) != 0) {
      while($irows2 = mysqli_fetch_assoc($iresult)) {	  	
	  echo "<div id='invoicelistframe'>"
	  ."Koncern: ".$irows2['namn']."<br /> "
	  ."Kontor: ".$irows2['kontorsnamn']."<br /> "
	  ."Hyr antal stationer: ".$irows2['stn']."<br /> "
	  ."Senaste besök: ".$irows2['sbesok']."<br /> "
	  ."Nästa besök: ".$endDate."<br /> "
	  ."Adress: ".$irows2['gata'].", ".$irows2['postnr']." ".$irows2['stad']."<br /> "
	  ."Organisationsnummer: ".$irows2['orgnr']." <br /> "	  
	  ."Kontaktperson: ".$irows2['fornamn']." ".$irows2['efternamn']."<br /> "
	  ."Användarnamn: ".$irows2['anvnamn']."<br /> "
	  ."Telefonnummer: ".$irows2['mobil']."<br /> "
	  ."Mejl: ".$irows2['mejl']."<br /> "
	  ."Senaste faktura: ".$irows2['datum']." ".$irows2['url']."</div></a>";
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



