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
<link rel="stylesheet" type="text/css" media="screen" href="css/main.css" />
<script type="text/javascript" src="js/script.js"></script>
</head>
<body>
<?php
defined('THE_HEADER') || define('THE_HEADER', TRUE);
require_once("include/header.php");
?>
<div id="main-wrapper">
<?php
defined('THE_DB') || define('THE_DB', TRUE);
require_once(__DIR__ .'./../../db.php');
defined('THE_MENUE') || define('THE_MENUE', TRUE);
require_once("include/menuebar.php");

?>
<div id = "invoiceframe">
  <div class="upload_form_cont" >
    <form id="upload_form" enctype="multipart/form-data" method="post" action="upload.php">
      <div>
        <div>
	  <label for="image_file">Ladda upp en fil</label>
	</div>
        <div>
	  <input type="file" name="image_file" id="image_file" onchange="fileSelected();" />
	</div>
      </div>
      <div>
        <input type="button" id = "uploadbutton" value="Ladda upp" onclick="startUploading()" />
      </div>
	  	
      <div id="fileinfo">
        <div id="filename"></div>
        <div id="filesize"></div>
        <div id="filetype"></div>
        <div id="filedim"></div>
      </div>
      <div id="error">Fel filformat
      </div>
      <div id="error2">Ett fel har inträffat under uppladdningen
      </div>
      <div id="abort">Uppladdningen avbröts
      </div>
      <div id="warnsize">Filen är för stor
      </div>
      <div id="progress_info">
        <div id="progress"></div>
        <div id="progress_percent">&nbsp;</div>
        <div class="clear_both"></div>
        <div>
          <div id="speed">&nbsp;</div>
          <div id="remaining">&nbsp;</div>
          <div id="b_transfered">&nbsp;</div>
          <div class="clear_both"></div>
        </div>
        <div id="upload_response"></div>
		 <div id = "listframe">	
		 </form>
		<?php
		 //ALLA filer som ligger i databasen genom URL. sedan visas filnamet i 
		 //en numrerad lista. en ladda hem knapp skall finnas för att kunna få hem fakturan igen.
		//skapa en array som hämtar info från URL i databasen och skriver ut dessa i en numrerad lista med namnet på pdf:en
		//target_blank på alla flikar för att öppna dom i nytt fönster
		?>
	<form action="" method="post" id = "postRows">
		<select name = "dropdown" id = "invoicedropdown">		
		<?php 	
		$isql = "SELECT ID, kontorsnamn 
					FROM faktura NATURAL JOIN kontrakt";
	$iresult = mysqli_query($con, $isql);
	if (mysqli_num_rows($iresult) != 0) {
      while($irows = mysqli_fetch_assoc($iresult)) {	  
	  if(isset($_POST['dropdown']) && $irows['ID'] == $_POST['dropdown']){
	  	  echo "<option value=".$irows['ID']." selected='selected' >".$irows['kontorsnamn']."</option>";
	  }
	else{
	  echo "<option value=".$irows['ID'].">".$irows['kontorsnamn']."</option>";
	}
    }
  }
  mysqli_free_result($iresult);	
	?>	
	<input type="submit" name = "choicebutton" id = "choicebutton" value="Välj kontrakt">
		</form>
				<?php 
		if(isset($_POST["choicebutton"])){
			$isql2 = "SELECT url, namn, datum 
						FROM faktura LEFT OUTER JOIN kontrakt ON kontrakt.ID = faktura.agarid 
							WHERE kontrakt.ID = '".$_POST['dropdown']."' ORDER BY Datum DESC";
	$iresult = mysqli_query($con, $isql2);
	if (mysqli_num_rows($iresult) != 0) {
      while($irows2 = mysqli_fetch_assoc($iresult)) {
	  echo "<a target='_blank' href = '../".$irows2['url']."' ><div id='invoicelistframe'>".$irows2['namn']." ".$irows2['datum']."</div></a>";
		}
	}
	  mysqli_free_result($iresult);
  }	
	?>	
      </div>
      </div>
    </form>
    <img id="preview"  />
  </div>  
</div>
</div><!--main-wrapper-->

<?php
defined('THE_FOOTER') || define('THE_FOOTER', TRUE);
require_once("include/footer.php");
?>
</body>
</html>

