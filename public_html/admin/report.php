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
$isql = "SELECT info, felmeddelande.ID, kontorsnamn,feltext,  orgnr, anvnamn FROM felmeddelande JOIN kontaktperson ON anvnamn
 = fronid JOIN kontrakt ON kontaktpersonid = anvnamn JOIN feltyp ON feltypid = feltyp.ID JOIN felstatus ON felstatus.ID = felmeddelande.medstatus WHERE tillid = '".mysqli_real_escape_string($con, $_SESSION['username'])."' GROUP BY felmeddelande.ID";
 }
else
{
$isql = "SELECT info, felmeddelande.ID, anvnamn, feltext FROM felmeddelande JOIN kontaktperson ON anvnamn = fronid JOIN feltyp
 ON feltypid = feltyp.ID JOIN felstatus ON felstatus.ID = felmeddelande.medstatus WHERE tillid = '".mysqli_real_escape_string($con, $_SESSION['username'])."' GROUP BY felmeddelande.ID";
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
    <select name = "reports" id = "reports">
	<?php 
	if(!$isadmin){
	echo "<option value= -1> Ny Felrapport </option>";
	}
	else echo "<option> Välj Felrapport </option>";
	$iresult = mysqli_query($con, $isql);
	if ($iresult !== FALSE && mysqli_num_rows($iresult) != 0) {
      while($irows = mysqli_fetch_assoc($iresult)) {	  
		  echo "<option value=".$irows['ID']." class = '".$irows['info']."' >".$irows['anvnamn']." ".$irows['feltext']." ".$irows['info']."</option>";
      }
    mysqli_free_result($iresult);	
	}
	?>
    </select> 		
    <input type="submit" name = "accept" id = "accept" value="Välj">  
	<input type="submit" name = "send" id = "send" value="Skicka">	
   <?php 

	 if(isset($_POST['accept'])) {
	 
	if($_POST['reports'] == -1) {
	$newmessage = true;
	
	echo  '<form action="" method="post" id = "messages">
      <ul>	
	  <li>
	  <label>Från: </label>
	  <input type="text" readonly align="left"  value = "'.mysqli_real_escape_string($con, $_SESSION['username']).'" maxlength="50" id="frm" name="frm" />
	</li>	
	<li>
	  <label>Ämne </label>
	  <input type="text" align="left" maxlength="50" name = "feltext" id = "feltext" />
	</li>
	<li>
	  <label>Meddelande: </label>
	 <textarea cols="40" rows="5" input type="text" name="newMessage" id = "newMessage"></textarea>
	</li>
	<li>';
	}
		 else if($isadmin){					 
				$status = "UPDATE felmeddelande SET medstatus=2 WHERE ID = ".$_POST['reports']; 
					mysqli_query($con, $status);				
					}			
	

	  $isql3 = "SELECT feltext, info, text, fronid, anvnamn FROM felmeddelande JOIN kontaktperson ON anvnamn = fronid JOIN feltyp
	 ON feltyp.ID = felmeddelande.feltypid JOIN felstatus ON felstatus.id = felmeddelande.medstatus
	 WHERE felmeddelande.ID = ".mysqli_real_escape_string($con,$_POST['reports']);
	 
	$options = "SELECT ID, info FROM felstatus";	
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
	  <input type="text" readonly align="left"  value = "'.$irows["info"].'" maxlength="50" id="infoinput" name="infoinput" />
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
  
  if(isset($_POST['send'])&&!empty($_POST["newMessage"])&&!empty($_POST["feltext"])){ 
  $message = mysqli_real_escape_string($con, $_POST["newMessage"]);  
  	$new_txt = mysqli_real_escape_string($con, $_POST["feltext"]);
	$usrname = mysqli_real_escape_string($con, $_SESSION["username"]);
	$fromusr = mysqli_real_escape_string($con, $_POST["frm"]);
	$io = 'Oläst';
  if($isadmin){
    $io = mysqli_real_escape_string($con, $_POST["infooptions"]);
	}
	else {
	if($fromusr != $usrname){
	 $io = mysqli_real_escape_string($con, $_POST["infoinput"]);}
	}
	if($isadmin){
   $sqli4 = "INSERT INTO felmeddelande VALUES(0, '".$message."', ".$io.",
   (SELECT ID FROM feltyp WHERE feltext = '".$new_txt."' LIMIT 1), '".$usrname."',
   '".$fromusr."');"; 
   }
   else { 
   if($fromusr == $usrname){
   $fromusr = 'AdminM';
   $newFeltext = "INSERT INTO feltyp VALUES(0, '".$new_txt."')";
   mysqli_query($con, $newFeltext);
   $getId = "(SELECT feltext FROM feltyp WHERE ID = (SELECT LAST_INSERT_ID() FROM feltyp LIMIT 1))";
   $textresult = mysqli_query($con, $getId);
   $lastId = mysqli_fetch_assoc($textresult);
	$new_txt =  $lastId['feltext'];
   } 
   
    $sqli4 = "INSERT INTO felmeddelande VALUES(0, '".$message."', (SELECT ID FROM felstatus WHERE info = '".$io."' LIMIT 1),
   (SELECT ID FROM feltyp WHERE feltext = '".$new_txt."' LIMIT 1), '".$usrname."',
   '".$fromusr."');";   
   }
echo $sqli4;
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

