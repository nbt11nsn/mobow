<?php
defined('THE_DB') || define('THE_DB', TRUE);
require_once(__DIR__ .'./../../db.php');
$isql = "SELECT * FROM kontrakt LEFT OUTER JOIN adress ON kontrakt.adressID = adress.ID LEFT OUTER JOIN ikontyp ON kontrakt.ikonid = ikontyp.ID LEFT OUTER JOIN inforuta ON inforuta.ID = kontrakt.inforutaid";

if($iresult = mysqli_query($con, $isql)){
  if (mysqli_num_rows($iresult) != 0) {
      while($irows = mysqli_fetch_assoc($iresult)) {
	  
         echo "<option value=".$irows['ID'].">".$irows['kontorsnamn']."</option>";
      }
      mysqli_free_result($iresult);
  }
}

?>