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
  define('THE_FOOTER', TRUE);
  require_once("include/footer.php");
?>
</body>
</html>

