<?php
SESSION_start();
?>
<!DOCTYPE html>
<html>
<head>
<?php
defined('THE_SESSION') || define('THE_SESSION', TRUE);
require_once('include/checksession.php');
defined('THE_HEAD') || define('THE_HEAD', TRUE);
include_once("include/head.php");
?>
</head>
<body>
<?php
defined('THE_HEADER') || define('THE_HEADER', TRUE);
require_once("include/header.php");
?>
<div id="main-wrapper">
<?php
defined('THE_MENUE') || define('THE_MENUE', TRUE);
require_once("include/menuebar.php");
if(isset($_POST['chpasswd'])||isset($_POST['achpasswd'])){
    defined('THE_FUNC') || define('THE_FUNC', TRUE);
    require_once(__DIR__ .'./../../functions.php');
    if(isset($_POST['chpasswd'])){
        echo upasswd($_POST, false);
    }
    else if(isset($_POST['achpasswd'])){
        echo upasswd($_POST, true);
    }
}
?>
<div id="center">
<div id="frame_edit">
    <form action="" method="post" id="passchange">
    <fieldset style="border:0"><legend><b>Uppdatera ditt lösenord</b></legend>
	<ul>
    <li>
    <label for="gpasswd">Gammalt lösenord: </label>
    <input type="password" id="gpasswd" name="gpasswd" maxlength="50" required autofocus />
    </li>
    <li>
    <label for="npasswd">Nytt lösenord: </label>
    <input type="password" id="npasswd" name="npasswd" maxlength="50" required />
    </li>
    <li>
    <label for="cpasswd">Upprepa nytt lösenord: </label>
    <input type="password" id="cpasswd" name="cpasswd" maxlength="50" required />
    </li>
    <li class="submit"><input type="submit" id="chpasswd" name="chpasswd" value="Uppdatera" /></li>
	</ul>
    </fieldset>
    </form>
</div><!--frame_edit-->
<?php
if($_SESSION['admin']){
    defined('THE_DB') || define('THE_DB', TRUE);
    require(__DIR__ .'./../../db.php');
    $uid = mysqli_real_escape_string($con, $_SESSION['username']);
    $sqliquery = "SELECT fornamn, efternamn, anvnamn FROM kontaktperson WHERE anvnamn <> '$uid'";
    $resultat = mysqli_query($con, $sqliquery);
    echo"<div id='frame_admedit'>
    <form action='' method='post' id='admchange'>
    <fieldset style='border:0'><legend><b>Byt lösenord på användare</b></legend>
	<ul>
    <li><select name='uuid' id='uuid'>";
    if (mysqli_num_rows($resultat) != 0){
        while($rows = mysqli_fetch_assoc($resultat)) {
            echo "<option value=".$rows['anvnamn'].">".$rows['anvnamn']." (".$rows['fornamn']." ".$rows['efternamn'].")</option>";	
        }
    }
    echo"</select>";
    mysqli_free_result($resultat);
echo"
    </li>
    <li>
    <label for='gpasswd'>Admin lösenord: </label>
    <input type='password' id='apasswd' name='apasswd' maxlength='50' required autofocus />
    </li>
    <li>
    <label for='npasswd'>Nytt lösenord: </label>
    <input type='password' id='npasswd' name='npasswd' maxlength='50' required />
    </li>
    <li>
    <label for='cpasswd'>Upprepa nytt lösenord: </label>
    <input type='password' id='cpasswd' name='cpasswd' maxlength='50' required />
    </li>
    <li class='submit'><input type='submit' id='achpasswd' name='achpasswd' value='Byt' /></li>
	</ul>
    </fieldset>
    </form>
</div><!--frame_admedit-->
";
}
?>
</div><!--center-->
</div><!--main-wrapper-->
<?php
defined('THE_FOOTER') || define('THE_FOOTER', TRUE);
require_once("include/footer.php");
?>
</body>
</html>

