<!DOCTYPE html>
<html>
<head>
<?php
  define('THE_HEAD', TRUE);
  include_once("include/head.php");
?>
</head>
<body>
<?php
  define('THE_HEADER', TRUE);
  require_once("include/header.php");
?>
<div id="main-wrapper">
<?php
  define('THE_MENUE', TRUE);
  require_once("include/menuebar.php");
?>
<div id = "frame">
  <div id = "text">
    <form action="" method="post" id = "accept">
      <input type="submit" value="Godkänn">
      <input type="submit" value="Neka">
    </form>
  </div>
</div><!--frame-->
</div><!--main-wrapper-->
<?php
  define('THE_FOOTER', TRUE);
  require_once("include/footer.php");
?>
</body>
</html>

