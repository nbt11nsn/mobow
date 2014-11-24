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

<div id = "text">
<form action="<?php echo  htmlspecialchars($_SERVER["PHP_SELF"]);
?>" method="post" id = "pass">
   Användarnamn: <input type="text" name="username"><br>
   Lösenord: <input type="password" name="password"><br>
   <input type="submit" value="Logga in">
</form>
</div>
<?php
require_once("footer.php");
?>
</body>

</html>

