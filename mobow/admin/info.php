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
</div><!--main-wrapper-->
<div id="frame">
<div id = "overviewinfo">
<div> 		<?php 
//Skriver ut antal teckanade avtal
$isql2 = "SELECT count(ID) FROM kontrakt";		
	$iresult = mysqli_query($con, $isql2);
	if (mysqli_num_rows($iresult) != 0) {
      while($irows = mysqli_fetch_assoc($iresult)) {	    
	  echo "<div>"."Du har för närvarande ".$irows['count(ID)']." tecknade avtal"."</div>";	
    }
  }
  mysqli_free_result($iresult);	
	?>
	</div> 
	
<div> 
		<?php 
		//Skriver ut antal uthyrda stationer
$isql3 = "SELECT SUM(stn) FROM kontrakt";		
	$iresult = mysqli_query($con, $isql3);
	if (mysqli_num_rows($iresult) != 0) {
      while($irows = mysqli_fetch_assoc($iresult)) {	  	  
	  echo "<div>"."Du har för närvarande ".$irows['SUM(stn)']." stationer uthyrda"."</div>";	
    }
  }
  mysqli_free_result($iresult);	
	?>
</div> 



<div> 		
<?php 
//Skriver ut senaste och nästa besök
$isql4 = "SELECT kontorsnamn, sbesok FROM kontrakt ";
	$iresult = mysqli_query($con, $isql4);
	if (mysqli_num_rows($iresult) != 0) {
      while($irows = mysqli_fetch_assoc($iresult)) { 
	  	  	  $startDate = $irows['sbesok'];
		$endDate = date("Y-m-d", strtotime("$startDate +6 month"));
		 
	  echo "<div>"."Senaste besöket på ".$irows['kontorsnamn']." var: ".$irows['sbesok']."</div><div>"."Nästa besök är: ".$endDate."</div>";


	}
  }
  mysqli_free_result($iresult);	

	?> 
	</div> 


	<form action="" method="post" id = "postRows">
		<select name = "dropdown" id = "invoicedropdown">		
		<?php 
		//Skriver ut kontaktpersonens info
	$isql = "SELECT * FROM kontaktperson JOIN kontrakt on kontrakt.kontaktpersonid = kontaktperson.anvnamn";		
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
</div>


<?php
defined('THE_FOOTER') || define('THE_FOOTER', TRUE);
require_once("include/footer.php");
?>

<?php // Anteckningar

// knapparna skall komma upp endast om ett företag har gjort en felrapport/editerat info. 
// **KLAR**dirigera vidare vid ett knapptryck till rätt flik
?>


</body>
</html>



