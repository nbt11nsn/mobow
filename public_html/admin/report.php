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
$isadmin = mysqli_real_escape_string($con, $_SESSION['admin']);
if($isadmin){
$isql = "SELECT felmeddelande.ID, kontorsnamn,  orgnr, anvnamn FROM felmeddelande JOIN kontaktperson ON anvnamn
 = fronid JOIN kontrakt ON kontaktpersonid = anvnamn WHERE tillid = '".mysqli_real_escape_string($con, $_SESSION['username'])."'";
}
else
{
$isql = "SELECT felmeddelande.ID, anvnamn, feltext FROM felmeddelande JOIN kontaktperson ON anvnamn = fronid JOIN feltyp
 ON feltypid = feltyp.ID WHERE tillid = '".mysqli_real_escape_string($con, $_SESSION['username'])."'";
}

?>
<div id="main-wrapper">
<?php
  defined('THE_MENUE') || define('THE_MENUE', TRUE);
  require_once("include/menuebar.php");
?>
<div id = "frame">
  <div id = "text">
    <form action="" method="post" id = "postContracts">
    <select name = "contracts" id = "contracts">
	<?php 
	
	$iresult = mysqli_query($con, $isql);
	if ($iresult !== FALSE && mysqli_num_rows($iresult) != 0) {
      while($irows = mysqli_fetch_assoc($iresult)) {	  
		  echo "<option value=".$irows['ID'].">".$irows['anvnamn']." ".$irows['feltext']."</option>";
      }
    mysqli_free_result($iresult);	
	}
	?>
    </select> 		
    <input type="submit" name = "accept" id = "accept" value="Välj">  
	<input type="submit" name = "send" id = "send" value="Skicka">	
   <?php 

	
	 if(isset($_POST['accept'])) {

	 $isql3 = "SELECT feltext, Info, text, fronid, anvnamn FROM felmeddelande JOIN kontaktperson ON anvnamn = fronid JOIN feltyp
	 ON feltyp.ID = felmeddelande.feltypid JOIN medstatus ON medstatus.id = felmeddelande.medstatus
	 WHERE felmeddelande.ID = ".mysqli_real_escape_string($con,$_POST['contracts']);
	
	 
	 $options = "SELECT ID, info FROM medstatus";
	 
	 
	 
	$iresultoptions = mysqli_query($con, $options);
	$iresult = mysqli_query($con, $isql3);
	
	if ($iresult !== FALSE && mysqli_num_rows($iresult) != 0 && $iresultoptions !== FALSE && mysqli_num_rows($iresultoptions)) {
	$irows = mysqli_fetch_assoc($iresult);	
	echo  '<form action="" method="post" id = "messages">
      <ul>	
	  <li>
	  <label>Från: </label>
	  <input type="text" readonly align="left"  value = "'.$irows["anvnamn"].'" maxlength="50" id="frm" name="frm" />
	</li>
	 <li>
	  <label>Status: </label>
	  <input type="text" readonly align="left"  value = "'.$irows["Info"].'" maxlength="50" id="infoinput" name="infoinput" />
	</li>
	<li>
	  <label>Ämne </label>
	  <input type="text" readonly align="left" maxlength="50" name = "feltext" id = "feltext" value = "'.$irows["feltext"].'" />
	</li>
	<li>
	  <label>Meddelande: </label>
	 <textarea cols="40" rows="5" readonly input type="text" name="meddelande">'.strip_tags($irows["text"]).'</textarea>
	</li>
	<li>';
	
	if($isadmin){
	 echo '<label>Status</label>
	  <select name="infooptions" id="infooptions">';
	  
	  while($irowsO = mysqli_fetch_assoc($iresultoptions)){
	  echo "<option value=".$irowsO['ID'].">".$irowsO['info']."</option>";    	
	  }
	}
	echo '</select>
	</li>
	<li>
	  <label for="newMessage">Nytt Meddelande: </label>
	   <textarea cols="40" rows="5" input type="text" name="newMessage" id = "newMessage"></textarea>
	</li>	
      </ul>
    </form>
	';
   }
  }
  
  if(isset($_POST['send'])){ 
  $message = mysqli_real_escape_string($con, $_POST["newMessage"]);
  if($isadmin){
    $io = mysqli_real_escape_string($con, $_POST["infooptions"]);
	}
	else {
	 $io = mysqli_real_escape_string($con, $_POST["infoinput"]);
	}
	$new_txt = mysqli_real_escape_string($con, $_POST["feltext"]);
	$usrname = mysqli_real_escape_string($con, $_SESSION["username"]);
	$fromusr = mysqli_real_escape_string($con, $_POST["frm"]);
	if($isadmin){
   $sqli4 = "INSERT INTO felmeddelande VALUES(0, '".$message."', ". $io.",
   (SELECT ID FROM feltyp WHERE feltext = '".$new_txt."' LIMIT 1), '".$usrname."',
   '".$fromusr."');"; 
   }
   else {
    $sqli4 = "INSERT INTO felmeddelande VALUES(0, '".$message."', (SELECT ID FROM medstatus WHERE Info = '".$io."' LIMIT 1),
   (SELECT ID FROM feltyp WHERE feltext = '".$new_txt."' LIMIT 1), '".$usrname."',
   '".$fromusr."');";    
   }
	mysqli_query($con, $sqli4);  
  }
?>
	
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

