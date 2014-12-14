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
<?php
defined('THE_MENUE') || define('THE_MENUE', TRUE);
require_once("include/menuebar.php");
defined('THE_DB') || define('THE_DB', TRUE);
require_once(__DIR__ .'./../../db.php');

$isql = "SELECT felmeddelande.fronid, kontrakt.kontorsnamn FROM felmeddelande JOIN kontrakt ON felmeddelande.fronid = kontrakt.ID WHERE felmeddelande.tillid = (SELECT kontrakt.ID FROM kontrakt WHERE kontrakt.kontaktpersonid = '".mysqli_real_escape_string($con, $_SESSION['username'])."') GROUP BY felmeddelande.fronid";


$currentContract = 1;
?>
<div id="main-wrapper">
<?php
  defined('THE_MENUE') || define('THE_MENUE', TRUE);
  require_once("include/menuebar.php");
?>
<div id = "frame">
  <div id = "text">
    <form action="" method="post" id = "postContracts">
    <select name = "contracts">
	<?php 
	
	$iresult = mysqli_query($con, $isql);
	if ($iresult !== FALSE && mysqli_num_rows($iresult) != 0) {
      while($irows = mysqli_fetch_assoc($iresult)) {	  
		  echo "<option value=".$irows['ID'].">".$irows['anvnamn']."</option>";
      }
    mysqli_free_result($iresult);	
	}
	?>
    </select> 		
    <input type="submit" name = "accept" id = "accept" value="Välj">  
   <?php 


	
	
	if(isset($_POST['save'])) 
	{
	$sql3 = "UPDATE kontrakt, adress SET gata = '".$_POST["gata"]."', stn = '".$_POST["stn"]."', oppet = '".mysqli_real_escape_string($con, nl2br($_POST["oppet"]))."', allminfo = '".mysqli_real_escape_string($con, nl2br($_POST["allminfo"]))."',
	hemsida = '".$_POST["hemsida"]."', forecolor = '".$_POST["forecolor"]."',	backcolor = '".$_POST["backcolor"]."', postnr = '".$_POST["postnr"]."',
	stad = '".$_POST["stad"]."', gata = '".$_POST["gata"]."', tele = '".$_POST["telefonenbr"]."', logurl = '".$_POST["logo"]."' WHERE kontrakt.ID = '".$_POST['contracts']."'";
	mysqli_query($con, $sql3);	
	}
	//kontorsnamn, tele, stn, multipart logo(url + bred + höjd), hemsida, oppet,
	//allminfo, forecolor, backcolor, ikonID, postnr, stad, gata, googlemap long lat,
	
	 if(isset($_POST['accept'])) {

	 $isql3 = "SELECT* FROM felmeddelande JOIN kontaktperson ON kontaktperson.ID = fronid
WHERE tillid = (SELECT ID FROM kontaktperson WHERE anvnamn = '".$_SESSION['username']."')";

   $iresult = mysqli_query($con, $isql3);
	if (mysqli_num_rows($iresult) != 0) {
	$irows = mysqli_fetch_assoc($iresult);
	 }
	echo  '<form action="" method="post" id = "messages">
      <ul>	
	  <label for="topic">Ämne: </label>
	  <input type="text" readonly align="left"  value = "'.$irows["amne"].'" maxlength="50" value="amne" name="amne" />
	</li>
	<li>
	  <label for="message" >Meddelande: </label>
	 <textarea cols="40" rows="5" readonly input type="text" value="meddelande" name="meddelande">'.strip_tags($irows["meddelande"]).'</textarea>
	</li>
	<li>
	  <label for="Topic" >Ämne </label>
	  <input type="text" align="left" maxlength="50" value = "Re: '.$irows["amne"].'" name="newTopic" />
	</li>
	<li>
	  <label for="newMessage">Nytt Meddelande: </label>
	   <textarea cols="40" rows="5" input type="text" name="newMessage"></textarea>
	</li>	
      </ul>
    </form>
		';
   
  }
  
  if(isset($_POST['send'])){
  $sqli4 = 'INSERT INTO felmeddelande VALUES(null,"'.$_POST["newMessage"].'",0,1,1, 0, "'.$_POST["newTopic"].'")';

  //"INSERT INTO felmeddelande VALUES(0,'".$_POST['newMessage']."',0,1,".$irows['tillid'].", ".$irows['fronid'].", '".$_POST['newTopic']."')";

  mysqli_query($con, $sqli4);
  
  }
  
		?>
		
		
		<input type="submit" name = "send" id = "send" value="Skicka"> 	
	
   </form>
  </div>
</div>
</div><!--main-wrapper-->
<?php
  defined('THE_FOOTER') || define('THE_FOOTER', TRUE);
  require_once("include/footer.php");
?>
</body>
</html>

