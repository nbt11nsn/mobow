<?php
SESSION_start();
defined('THE_DB') || define('THE_DB', TRUE);
require_once(__DIR__ .'./../db.php');
//$isql = "SELECT * FROM kontrakt LEFT OUTER JOIN adress ON kontrakt.ID = adress.ID LEFT OUTER JOIN ikontyp ON kontrakt.ikonid = ikontyp.ID";
$isql = "SELECT * FROM kontrakt LEFT OUTER JOIN adress ON kontrakt.ID = adress.ID LEFT OUTER JOIN (SELECT kontrakt.ID, IF (kontrakt.ID IN (SELECT kontrakt.ID FROM oppettider LEFT OUTER JOIN kontrakt ON oppettider.kontraktid = kontrakt.ID WHERE  veckodagarid = DAYOFWEEK(NOW()) AND oppet <= CURTIME() AND stangt >= CURTIME()), ikontyp.opimgurl, ikontyp.stimgurl) AS ikonurl FROM kontrakt LEFT OUTER JOIN ikontyp ON kontrakt.ikonid = ikontyp.ID) AS ikon ON kontrakt.ID = ikon.ID";
$sqloppen = "SELECT veckodagarid, DATE_FORMAT(oppet,'%H:%i') as oppet, DATE_FORMAT(stangt,'%H:%i') as stangt FROM oppettider JOIN veckodagar ON oppettider.veckodagarid = veckodagar.ID WHERE veckodagar.ID = DAYOFWEEK(NOW())";
$places = array();// innehåller alla platser ur databasen
if($iresult = mysqli_query($con, $isql)){
  if (mysqli_num_rows($iresult) != 0) {	
      while($irows = mysqli_fetch_assoc($iresult)) {	  
          $places[] = $irows;	  
      }
      mysqli_free_result($iresult);
  }
}
$openhours = array();// innehåller alla dagens öppettider
if($result = mysqli_query($con, $sqloppen)){
  if (mysqli_num_rows($result) != 0) {
    
      while($rows = mysqli_fetch_assoc($result)) {	 
          $openhours[] = $rows;		  
      }
      mysqli_free_result($result);
  }
}
mysqli_close($con);
?>
<!DOCTYPE html>
<html>
<head>


<?php
defined('THE_HEAD') || define('THE_HEAD', TRUE);
require_once("include/head.php");
?>
<script language="javascript" type="text/javascript" src = "include/googlemap.js"></script>
<script type="text/javascript">
    var obj = <?php echo json_encode($places, JSON_UNESCAPED_UNICODE); ?>;	
    var oppen = <?php echo json_encode($openhours, JSON_UNESCAPED_UNICODE);?>;
</script>

</head>
<body>

<?php
defined('THE_HEADER') || define('THE_HEADER', TRUE);
  require_once("include/header.php"); 
?>  

  <div id='google_container'>
  <div id= "googleMap">
    </div>  
  </div>
</div>

<?php
defined('THE_FOOTER') || define('THE_FOOTER', TRUE);
  require_once("include/footer.php");
?>
  
</body>
</html>


