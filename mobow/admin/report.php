<!DOCTYPE html>
<html>

	<head>
	<?php
	session_start();
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
	<form action="" method="post" id = "accept">
		<select>
			<option value="Pagaende">Pågående</option>
			<option value="Godkand">Godkänd</option>
			<option value="Nekad">Nekad</option>
		</select> 

	<div id = "messageframecompany">
	meddelande från företaget
	</div>
	<div id = "messageframeadmin">
	meddelande från admin
	</div>
	<input type="submit" value="Skicka">
	</form>
	</div>
</div>
<?php
require_once("footer.php");
echo $_SESSION['first_name']. "1 ".
	$_SESSION['last_name']. " 2".
	$_SESSION['mobile']. " 3".
	$_SESSION['mail']. "4 ".
	$_SESSION['username']. " 5".
	$_SESSION['admin'];

?>
</body>

</html>

