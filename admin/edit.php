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
	<div id = "text">
	<form action="" method="post" id = "pass">
		Gammalt lösenord: <input type="text" name="mobow"><br>
		Nytt Lösenord: <input type="text" name="mobow"><br>
		Upprepa Lösenord: <input type="text" name="mobow"><br>
	<input type="submit" value="Godkänn">
	</form>
	</div>
</div>
<?php
require_once("footer.php");
?>
</body>

</html>

