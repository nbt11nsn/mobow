<!DOCTYPE html>
<html>
<head>
<?php
 include_once("head.php");
?>
</head>
<body>
<?php
  require_once("header.php");
?>
<div id="main-wrapper">
<?php
  require_once("menuebar.php");
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
  require_once("footer.php");
?>
</body>
</html>

