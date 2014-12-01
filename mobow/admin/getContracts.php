<?php
defined('THE_DB') || define('THE_DB', TRUE);
require_once(__DIR__ .'./../../db.php');
$isql = "SELECT * FROM kontrakt LEFT OUTER JOIN adress ON kontrakt.adressID = adress.ID
LEFT OUTER JOIN ikontyp ON kontrakt.ikonid = ikontyp.ID";
$currentContract;


if(isset($_POST['accept'])) 
{
	$sql = "SELECT * FROM kontrakt LEFT OUTER JOIN adress ON kontrakt.adressID = adress.ID
	LEFT OUTER JOIN ikontyp ON kontrakt.ikonid = ikontyp.ID
	WHERE kontrakt.ID = ".$_POST['contracts'];
	echo "<script type = 'text/javascript'> alert('".$_POST['contracts']."')</script>";
	
	$result = mysqli_query($con, $sql);
	$contractInfo;
  if ($result && mysqli_num_rows($result) != 0) 
  {  
    $contractInfo = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
echo '<form action="" method="post" id = "editContract">
      <ul>
	<li>
	  <label for="Tele">Telefon: </label> 
	  <input type="text" maxlength="50" value = "'.$contractInfo['tele'].'"  name="telefonenbr" />
	</li>
	<li>
	  <label for="logourl">Logga: </label>
	  <input type="text" value = "'.$contractInfo['logurl'].'" maxlength="50" name="logo" />
	</li>
	
	<li class="submit">
	  <input type="submit" name="save" id="save" value="Spara" />
	</li>
      </ul>
    </form>';
	}	
	$currentContract = $_POST['contracts'];

}

if(isset($_POST['save'])) 
{
	$sql = "UPDATE kontrakt SET tele = '".$_POST["telefonenbr"]."' WHERE kontrakt.id = '".$_POST['contracts']."'";
	mysqli_query($con, $sql);
}


?>
