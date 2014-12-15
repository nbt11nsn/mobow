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

	<form action="" method="post" id = "postRows">
		<select name = "dropdown" id = "infodropdowntop">		
		
		<?php 
		//Skriver ut kontaktpersonens info i dropdownmenyn
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
	
		<input type="submit" name = "choicebutton" id = "infochoicebutton" value="Välj kontakt">		
		</form>
		<form action="" method="post" id = "infodropdownbottom">
				<?php 
		
		if(isset($_POST["choicebutton"])){
			$isql6 = "SELECT logurl, hemsida, typ, kontorsnamn, kontrakt.orgnr, stn, fornamn, efternamn,
			kontaktperson.anvnamn, mobil, mejl, sbesok, url, datum, postnr, stad, gata, foretag.namn
			FROM kontaktperson LEFT OUTER JOIN kontrakt ON kontrakt.kontaktpersonid = anvnamn JOIN adress ON adress.ID = adressid 
			JOIN foretag ON foretag.orgnr = kontrakt.orgnr JOIN ikontyp ON ikontyp.id = ikonid
			LEFT OUTER JOIN faktura ON faktura.agarid = kontrakt.ID WHERE kontaktperson.anvnamn = '".$_POST['dropdown']."'
			ORDER BY faktura.datum LIMIT 1";

	$iresult = mysqli_query($con, $isql6);
	if (mysqli_num_rows($iresult) != 0) {
      while($irows2 = mysqli_fetch_assoc($iresult)) {	
		$startDate = $irows2['sbesok'];
		$endDate = date("Y-m-d", strtotime("$startDate +6 month"));	  
	
	  /*echo "<div id='infolistframe'>"
	  ."Koncern: ".$irows2['namn']."<br /> "
	  ."Kontor: ".$irows2['kontorsnamn']."<br /> "
	  ."Kontorstyp: ".$irows2['typ']."<br /> "
	  ."Hemsida: "."<a target='_blank' href = '".$irows2['hemsida']."' >".$irows2['hemsida']."</a>"."<br/>"
	  ."Hyr antal stationer: ".$irows2['stn']."<br /> "
	  ."Senaste besök: ".$irows2['sbesok']."<br /> "
	  ."Nästa besök: ".$endDate."<br /> "
	  ."Adress: ".$irows2['gata'].", ".$irows2['postnr']." ".$irows2['stad']."<br /> "
	  ."Organisationsnummer: ".$irows2['orgnr']." <br /> "	  
	  ."Kontaktperson: ".$irows2['fornamn']." ".$irows2['efternamn']."<br /> "
	  ."Användarnamn: ".$irows2['anvnamn']."<br /> "
	  ."Telefonnummer: ".$irows2['mobil']."<br /> "
	  ."Mejl: ".$irows2['mejl']."<br /> "
	  ."Senaste faktura: "."<a target='_blank' href = '../".$irows2['url']."'>".$irows2['datum']."</a>"."<br/>";
		
	   echo "Logga som används i kartfunktionen: <img id='infologga' src='./../".$irows2['logurl']."' />";*/
	   
	   echo '	   
	   <fieldset>
		<legend><b>Information</b></legend>
	    <label for="knamn">Företag: </label>
	    <input type="text" value="'.$irows2['namn'].'" readonly id = "infotextframe"/>
		
		<label for="knamn">Kontor: </label>
		<input type="text" value="'.$irows2['kontorsnamn'].'" readonly id = "infotextframe"/>
			
		<label for="typ">Kontorstyp: </label>
		<input type="text" value="'.$irows2['typ'].'" readonly id = "infotextframe"/>
	
		<label for="stn">Hyr antal stationer: </label>
		<input type="text" value="'.$irows2['stn'].'" readonly id = "infotextframe"/>
			
		<label for="senaste">Senaste besök: </label>
		<input type="text" value="'.$irows2['sbesok'].'" readonly id = "infotextframe"/>
			
		<label for="nasta">Nästa besök: </label>
		<input type="text" value="'.$endDate.'" readonly id = "infotextframe"/>
			
		<label for="adress">Adress: </label>
		<input type="text" value="'.$irows2['gata'].", ".$irows2['postnr']." ".$irows2['stad'].'" readonly id = "infotextframe"/>
			
		<label for="org">Organisationsnummer: </label>
		<input type="text" value="'.$irows2['orgnr'].'" readonly id = "infotextframe"/>
			
		<label for="pers">Kontaktperson: </label>
		<input type="text" value="'.$irows2['fornamn']." ".$irows2['efternamn'].'" readonly id = "infotextframe"/>
			
		<label for="anv">Användarnamn: </label>
		<input type="text" value="'.$irows2['anvnamn'].'" readonly id = "infotextframe"/>
			
		<label for="tele">Telefon: </label>
		<input type="text" value="'.$irows2['mobil'].'" readonly id = "infotextframe"/>
			
		<label for="mejl">Mejl: </label>
		<input type="text" value="'.$irows2['mejl'].'" readonly id = "infotextframe"/>
		</fieldset>
		
		<fieldset>
		<legend><b>Övrig information</b></legend>
		<label for="hem">Hemsida: </label>

		<form action="https://www.google.se/" target="_blank" >
		<input type="submit" value="Hemsidan">
		</form>
		<a href = "google.com" target="_blank">
		<input type="text" value="'.$irows2['datum'].'" readonly id = "infotextframe"/>
		</a>	
		</fieldset>
		';
		}
		
	}
	//<input type="text"  value="'."<a target='_blank' href = '../".$irows2['url']."'>".$irows2['datum']."</a>".'" id = "infotextframe"/>
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



