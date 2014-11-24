<!DOCTYPE html>
<html>
<head>
<?php
  include_once("include/head.php");
?>
</head>
<body>
<?php
  require_once("include/header.php");
?>
<div id="main-wrapper">
<?php
  require_once("include/menuebar.php");
?>
<div id = "frame">
  <form action="" method="post" id = "accept">
    <select>
      <option value="Pagaende">Pågående</option>
      <option value="Godkand">Godkänd</option>
      <option value="Nekad">Nekad</option>
    </select> 
kontrakt!
    <input type="submit" value="Skicka">
  </form>
</div><!--frame-->
</div><!--main-wrapper-->
<?php
  require_once("include/footer.php");
?>
</body>
</html>

