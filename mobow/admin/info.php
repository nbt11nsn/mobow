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
?>

</div><!--main-wrapper-->
<div id="frame">
 <div id = "overviewinfo">
hej
</div>
   	<form>
		<div>
		<input type="button" name="btn2" id="btn" style="width: 300px; height: 50px;" value="En felrapport har skapats" onclick="location.href='report.php'"/>
		<input type="button" name="btn2" id="btn" style="width: 300px; height: 50px;" value="En kund vill ändra sin information" onclick="location.href='companymessage.php'"/>
		</form>
		</div>
    </form>
  </div>
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



