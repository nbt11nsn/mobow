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
$currentContract = 1;


?>
<div id = "frame">
  <form action="" method="post">
    <select name = "contracts">
	<?php 
	
	$iresult = mysqli_query($con, $isql);
	if (mysqli_num_rows($iresult) != 0) {
      while($irows = mysqli_fetch_assoc($iresult)) {
	  if($currentContract == $irows['ID'])
	  {
		
		  $currentContract = $_POST["contracts"];
	  echo "<option value=".$irows['ID']." selected='selected' >".$irows['kontorsnamn']."</option>";
	  }
	  
	  else {		
		  echo "<option value=".$irows['ID'].">".$irows['kontorsnamn']."</option>";}	
	 }      
  }
  mysqli_free_result($iresult);	
	?>
    </select> 
	
		kontrakt!		
    <input type="submit" name = "accept" id = "accept" value="Välj">  
   <?php 


	
	
	if(isset($_POST['save'])) 
	{
	$sql3 = "UPDATE kontrakt SET logurl = '".$_POST["logo"]."',tele = '".$_POST["telefonenbr"]."' WHERE kontrakt.ID = '".$_POST['contracts']."'";
	mysqli_query($con, $sql3);	
	}
	//kontorsnamn, tele, stn, multipart logo(url + bred + höjd), hemsida, oppet,
	//allminfo, forecolor, backcolor, ikonID, postnr, stad, gata, googlemap long lat,
	
	   $isql2 = "SELECT kontrakt.ID, kontorsnamn, tele, logurl, gata FROM kontrakt LEFT OUTER JOIN adress ON kontrakt.adressID = adress.ID
LEFT OUTER JOIN ikontyp ON kontrakt.ikonid = ikontyp.ID WHERE kontrakt.ID = '".$currentContract."'";
   $iresult = mysqli_query($con, $isql2);
	if (mysqli_num_rows($iresult) != 0) {
	$irows = mysqli_fetch_assoc($iresult);
	 }
	
   
  echo  '<form action="" method="post" id = "editContract">
      <ul>
	<li>
	  <label for="Tele">Telefon: </label> 
	  <input type="text" maxlength="50" value = "'.$irows["tele"].'"  name="telefonenbr" />
	</li>
	<li>
	  <label for="logourl">Logga: </label>
	  <input type="text" value = "'.$irows["logurl"].'" maxlength="50" value="logo" name="logo" />
	</li>
	
	<li class="submit">
	  <input type="submit" name="save" id="save" value="Spara" />
	</li>
      </ul>
    </form>';
		?>
   </form>
</div><!--frame-->
</div><!--main-wrapper-->
<?php
defined('THE_FOOTER') || define('THE_FOOTER', TRUE);
require_once("include/footer.php");
?>
</body>
</html>