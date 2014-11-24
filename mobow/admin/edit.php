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
  <form action="" method="post" id = "passchange">
    <ul>
      <li>
	<label for="gpasswd">Gammalt lösenord: </label>
	<input type="password" id="gpasswd" maxlength="50" required autofocus />
      </li>
      <li>
	<label for="npasswd">Nytt lösenord: </label>
	<input type="password" id="npasswd" maxlength="50" required />
      </li>
      <li>
	<label for="cpasswd">Upprepa nytt lösenord: </label>
	<input type="password" id="cpasswd" maxlength="50" required />
      </li>
      <li class="submit">
	<input type="submit" value="Uppdatera" />
      </li>
    </ul>
  </form>
</div><!--frame-->
</div><!--main-wrapper-->
<?php
require_once("footer.php");
?>
</body>
</html>

