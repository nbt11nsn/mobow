<!DOCTYPE html>
<html>
<head>
<?php
// starta session
// SESSION_start();

// tar bort all form av felrapportering
// define('THE_ERROR', TRUE);
// require_once('include/no_error.php');

// koppla upp mot databas
// define('THE_DB', TRUE);
// require_once('../db.php');

/*
* Skelett för PHP.
* Kopiera denna fil, ta bort denna kommentar samt de ovan
* som inte behövs och döp om kopian till vid skapande av
* nya php-sidor med grafiskt innehåll
*/
  define('THE_HEAD', TRUE);
  include_once("head.php"); // se till att denna fil finns
?>
</head>
<body>
<?php
  define('THE_HEADER', TRUE);
  require_once("header.php"); // se till att denna fil finns
?>
<div id="main-wrapper">
  Läste du instruktionerna?
<!-- 
  Lägg allt innehåll för den specifika sidan i denna div
-->
</div><!--main-wrapper-->
<?php
  define('THE_FOOTER', TRUE);
  require_once("footer.php"); // se till att denna fil finns
?>
</body>
</html>

