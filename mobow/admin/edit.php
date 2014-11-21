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
require_once("menuebar.php");
?>
<div id = "frame">
	<div id = "passframe">
	<form action="" method="post" id = "passchange">
		Gammalt lösenord: <input type="password" name="mobow"><br>
		Nytt Lösenord: <input type="password" name="mobow"><br>
		Upprepa Lösenord: <input type="password" name="mobow"><br>
	<input type="submit" value="Godkänn">
	</form>
	</div>
</div>
<?php
require_once("footer.php");
?>
</body>

</html>

