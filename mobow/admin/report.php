<!DOCTYPE html>
<html>
<head>
<?php
  session_start();
  include_once("include/head.php");
?>
</head>
<body>
<?php
  require_once("include/header.php");
?>
<div id="main-wrapper">
<?php
  require_once("include/menuebar.php");
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
      <input type="submit" value="Skicka" />
    </form>
  </div>
</div>
<?php
echo $_SESSION['first_name'].
   $_SESSION['last_name'].
   $_SESSION['mobile'].
   $_SESSION['mail'].
   $_SESSION['username'].
   $_SESSION['admin'];
?>
</div><!--main-wrapper-->
<?php
  require_once("include/footer.php");
?>
</body>
</html>

