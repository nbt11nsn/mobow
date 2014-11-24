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
<?php
require_once("checklogin.php");
?>

<div id="main-wrapper">
<div id="login-wrapper">
<form action="<?php echo  htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" id = "pass">
<ul>
  <li>
   <label for="username">Användarnamn: </label> 
<input type="text" maxlength="50" required autofocus id="username">
</li>
  <li>
   <label for="password">Lösenord: </label>
<input type="password" maxlength="50" required id="password">
</li>
  <li class="submit">
   <input type="submit" name="login" value="Logga in">
</li>
</ul>
</form>
</div><!--login-wrapper-->
<?php
require_once("footer.php");
?>
</div><!--main-wrapper-->
</body>

</html>

