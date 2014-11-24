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
<?php
  define('THE_CHECK', TRUE);
  require_once("include/checklogin.php");
?>
<div id="main-wrapper">
  <div id="login-wrapper">
    <form action="<?php echo  htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" id = "pass">
      <ul>
	<li>
	  <label for="username">Användarnamn: </label> 
	  <input type="text" maxlength="50" required autofocus id="username" />
	</li>
	<li>
	  <label for="password">Lösenord: </label>
	  <input type="password" maxlength="50" required id="password" />
	</li>
	<li class="submit">
	  <input type="submit" name="login" value="Logga in" />
	</li>
      </ul>
    </form>
  </div><!--login-wrapper-->
</div><!--main-wrapper-->
<?php
  define('THE_FOOTER', TRUE);
  require_once("include/footer.php");
?>
</body>
</html>

