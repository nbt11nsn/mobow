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
<div id="frame">
  <div id="text">
    <form action="" method="post" id = "accept">
      <select>
	<option value="Pagaende">Pågående</option>
	<option value="Godkand">Godkänd</option>
	<option value="Nekad">Nekad</option>
      </select> 
      <input type="submit" value="Skicka" />
    </form>
  </div>
</div>
</div><!--main-wrapper-->
<?php
  require_once("footer.php");
?>
</body>
</html>

