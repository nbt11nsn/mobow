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
    $isql = "SELECT info, felmeddelande.ID, kontorsnamn, feltext, orgnr, anvnamn FROM felmeddelande JOIN kontaktperson ON anvnamn
 = fronid JOIN kontrakt ON kontaktpersonid = anvnamn JOIN feltyp ON feltypid = feltyp.ID JOIN felstatus ON felstatus.ID
 = felmeddelande.medstatus WHERE tilladmin='1' GROUP BY felmeddelande.ID";
}
else
{
    $isql = "SELECT info, felmeddelande.ID, anvnamn, feltext FROM felmeddelande JOIN kontaktperson ON anvnamn = fronid JOIN feltyp
 ON feltypid = feltyp.ID JOIN felstatus ON felstatus.ID = felmeddelande.medstatus WHERE tilladmin='0' AND fronid = '".mysqli_real_escape_string($con, $_SESSION['username'])."' GROUP BY felmeddelande.ID";
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
        echo "<option value='-1'> Ny Felrapport </option>";
	}
	else 
    {
        echo "<option value='-2'> Välj Felrapport </option>";
    }
$iresult = mysqli_query($con, $isql);
if ($iresult !== FALSE && mysqli_num_rows($iresult) != 0) {
    while($irows = mysqli_fetch_assoc($iresult)) {
        if(isset($_POST['reports']) && $_POST['reports'] == $irows['ID'])
        {
            echo "<option value=".$irows['ID']." selected = 'selected' class = '".$irows['info']."' >".$irows['anvnamn']." ".$irows['feltext']." ".$irows['info']."</option>";
        }
        else 
        { 
            echo "<option value=".$irows['ID']." class = '".$irows['info']."' >".$irows['anvnamn']." ".$irows['feltext']." ".$irows['info']."</option>";
		}
    }
    mysqli_free_result($iresult);	
}
?>
</select> 		
<input type="submit" name = "accept" id = "accept" value="Välj"> 
	<input type="submit" name = "delete" id = "delete" onclick='javascript: return (confirm("Vill du verkligen ta bort meddelandet?"))' value="Ta bort">	
<?php 
    if(isset($_POST['accept'])&&$_POST["reports"]!=-2) {
        echo '<input type="submit" name = "send" id = "send" value="Skicka">';
        if($_POST['reports'] == -1) {
            $newmessage = true;
            
            echo'<form action="" method="post" id = "messages"><fieldset><legend class="center"><b>Nytt Meddelande</b></legend>
      <ul>	
	  <li>
	  <label>Från: </label>
	  <input type="text" readonly align="left"  value = "'.mysqli_real_escape_string($con, $_SESSION['username']).'" maxlength="50" id="frm" name="frm" />
	</li>	
	<li>
	  <label>Ämne: </label>';           
            echo"<select name='feltext' id='feltext'>";
            $sqlfeltyp="SELECT ID, feltext FROM feltyp";
            $resfeltyp=mysqli_query($con, $sqlfeltyp);
            while($row=mysqli_fetch_assoc($resfeltyp))
            {
                echo "<option value=".$row['ID'].">".$row['feltext']."</option>";
            }
            echo"</select>";
            echo'</li>
	<li>
	  <label>Meddelande: </label>
	 <textarea cols="40" rows="5" input type="text" name="newMessage" id = "newMessage"></textarea>
	</li>
	<li></fieldset>';
        }
        else if($isadmin){					 
            $status = "UPDATE felmeddelande SET medstatus=2 WHERE ID = ".$_POST['reports']." AND medstatus = 1"; 
            mysqli_query($con, $status);				
        }			
        
        
        $isql3 = "SELECT felmeddelande.feltypid AS felid, feltext, info, text, fronid, anvnamn FROM felmeddelande JOIN kontaktperson ON anvnamn = fronid JOIN feltyp
	 ON feltyp.ID = felmeddelande.feltypid JOIN felstatus ON felstatus.id = felmeddelande.medstatus
	 WHERE felmeddelande.ID = ".mysqli_real_escape_string($con,$_POST['reports']);
        
        $options = "SELECT ID, info FROM felstatus WHERE info != 'Oläst'";	
        $iresultoptions = mysqli_query($con, $options);
        $iresult = mysqli_query($con, $isql3);
        
        if ($iresult !== FALSE && mysqli_num_rows($iresult) != 0 && $iresultoptions !== FALSE && mysqli_num_rows($iresultoptions)) {
            $irows = mysqli_fetch_assoc($iresult);	
            echo  '<form action="" method="post" id = "messages"><fieldset><legend class="center"><b>Meddelande</b></legend>
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
	  <label>Ämne </label>';          
            echo"<select name='feltext' id='feltext'>";
            $sqlfeltyp="SELECT ID, feltext FROM feltyp";
            $resfeltyp=mysqli_query($con, $sqlfeltyp);
            while($row=mysqli_fetch_assoc($resfeltyp))
            {
                if($row['ID'] == $irows['felid'])
                {
                    echo "<option value=".$row['ID']." selected>".$row['feltext']."</option>";
                }
                else
                {
                    echo "<option value=".$row['ID'].">".$row['feltext']."</option>"; 
                }
            }
            echo"</select>";
            echo'</li>
	<li>
	  <label>Meddelande: </label>
	 <textarea cols="40" rows="5" readonly input type="text" name="meddelande">'.strip_tags($irows["text"]).'</textarea>
	</li>
	<li></fieldset><fieldset><legend class="center"><b>Svara</b></legend>';
            
            if($isadmin){
                echo '<label>Status</label><select name="infooptions" id="infooptions">';
                while($irowsO = mysqli_fetch_assoc($iresultoptions)){
                    echo "<option value=".$irowsO['ID'].">".$irowsO['info']."</option>";    	
                }
                echo '</select>';
            }
            echo'
	</li>
	<li>
	  <label for="newMessage">Nytt Meddelande: </label>
	   <textarea cols="40" rows="5" input type="text" name="newMessage" id = "newMessage"></textarea>
	</li>
	</fieldset>
      </ul>
 </form>
	';
        }
    }

if(isset($_POST['delete'])){  
    $sqldelete = "DELETE FROM felmeddelande WHERE ID = ".$_POST['reports'];
    mysqli_query($con, $sqldelete);
    echo '<script type="text/javascript"> var reload = false;
var loc=""+document.location;
loc = loc.indexOf("?reload=")!=-1?loc.substring(loc.indexOf("?reload=")+10,loc.length):"";
loc = loc.indexOf("&")!=-1?loc.substring(0,loc.indexOf("&")):loc;
reload = loc!=""?(loc=="true"):reload;

function reloadPage() {
    if (!reload) 
        window.location.replace(window.location);
}

reloadPage();  </script>';	
}

if(isset($_POST['send'])&&!empty($_POST["newMessage"])&&!empty($_POST["feltext"])){ 
    $message = mysqli_real_escape_string($con, $_POST["newMessage"]);  
  	$new_txt = mysqli_real_escape_string($con, $_POST["feltext"]);
	$usrname = mysqli_real_escape_string($con, $_SESSION["username"]);
	$fromusr = mysqli_real_escape_string($con, $_POST["frm"]);
    if($isadmin){
        $io = mysqli_real_escape_string($con, $_POST["infooptions"]);
        $sqli4 = "INSERT INTO felmeddelande(ID, text, medstatus,feltypid,fronid,tilladmin) VALUES(0, '".$message."', ".$io.", '".$new_txt."', '".$fromusr."','0')";
    }
    else
    {
        $sqli4 = "INSERT INTO felmeddelande(ID, text, medstatus, feltypid, fronid, tilladmin) VALUES(0, '".$message."', '1', '".$new_txt."', '".$usrname."','1')";
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