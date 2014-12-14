<?php
  SESSION_start();
  if (isset($_SESSION['username']) && $_SESSION['username'] != '') {
    header ("Location: info.php");
  }
?>
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
<?php
defined('THE_CHECK') || define('THE_CHECK', TRUE);
require_once("include/checklogin.php");
?>
<div id="main-wrapper">
  <div id="login-wrapper">
    <form action="" method="post" id = "pass">
      <ul>
	<li>
	  <label for="username">Användarnamn: </label> 
	  <input type="text" maxlength="50" required autofocus id="username" name="username" />
	</li>
	<li>
	  <label for="password">Lösenord: </label>
	  <input type="password" maxlength="50" required id="password" name="password" />
	</li>
	<li class="submit">
	  <input type="submit" name="login" id="login" value="Logga in" />
	</li>
      </ul>
    </form>
  </div><!--login-wrapper-->
</div><!--main-wrapper-->
<?php
  defined('THE_FOOTER') || define('THE_FOOTER', TRUE);
  require_once("include/footer.php");
?>
</body>
</html>

