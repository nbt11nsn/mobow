<!DOCTYPE html>
<html>
<head>
<?php
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
  defined('THE_FOOTER') || define('THE_FOOTER', TRUE);
  require_once("include/footer.php");
?>
</body>
</html>

