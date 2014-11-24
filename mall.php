<!DOCTYPE html>
<html>
<head>
<?php
// starta session
// SESSION_start();

// tar bort all form av felrapportering
// require_once('./include/no_error.php');

// koppla upp mot databas
// require_once('../db.php');

/*
* Skelett för PHP.
* Kopiera denna fil, ta bort denna kommentar samt de ovan
* som inte behövs och döp om kopian till vid skapande av
* nya php-sidor med grafiskt innehåll
*/
  include_once("head.php"); // se till att denna finns
?>
</head>
<body>
<?php
  require_once("header.php"); // se till att denna finns
?>
<div id="main-wrapper">
  Läste du instruktionerna?
<!-- 
  Lägg allt innehåll för den specifika sidan i denna div
-->
</div><!--main-wrapper-->
<?php
  require_once("footer.php"); // se till att denna finns
?>
</body>
</html>

