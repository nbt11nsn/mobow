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
?>
<div id = "frame">
<?php 
if(isset($_SESSION['admin']) && $_SESSION['admin'])
{
    $sqlcount = "SELECT (SELECT COUNT(*) FROM edit_foretag) + (SELECT COUNT(*) FROM edit_kntper) AS numberofmessage FROM DUAL";
    $rescount = mysqli_query($con, $sqlcount);
    $asscount = mysqli_fetch_assoc($rescount);
    $nrofmessage = $asscount['numberofmessage'];
}
else
{
    
}
?>
</div><!--frame-->
</div><!--main-wrapper-->
<?php
defined('THE_FOOTER') || define('THE_FOOTER', TRUE);
require_once("include/footer.php");
?>
</body>
</html>

