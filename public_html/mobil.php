<?php
SESSION_start();
mb_internal_encoding('UTF-8');
mb_http_output('UTF-8');
mb_http_input('UTF-8');

defined('THE_DB') || define('THE_DB', TRUE);
require_once(__DIR__ .'./../db.php');

//$sqloppen = "SELECT kontraktid,veckodagarid, DATE_FORMAT(oppet,'%H:%i') as oppet, DATE_FORMAT(stangt,'%H:%i') as stangt FROM kontrakt LEFT OUTER JOIN (SELECT * from oppettider JOIN veckodagar ON oppettider.veckodagarid = veckodagar.ID WHERE veckodagar.ID = DAYOFWEEK(NOW())) as tider on kontrakt.ID = tider.kontraktid ORDER BY kontrakt.ID";

$sqloppen = "SELECT kontraktid, veckodagarid, COALESCE(DATE_FORMAT(altoppet,'%H:%i'), DATE_FORMAT(oppet,'%H:%i')) as oppet, COALESCE(DATE_FORMAT(altstangt,'%H:%i'), DATE_FORMAT(stangt,'%H:%i')) as stangt FROM kontrakt LEFT OUTER JOIN (SELECT oppettider.*, specialtider.specstart, specialtider.specslut, specialtider.altoppet, specialtider.altstangt, specialtider.stangt AS isstangt from oppettider JOIN veckodagar ON oppettider.veckodagarid = veckodagar.ID LEFT OUTER JOIN (SELECT * FROM specialtider WHERE CURDATE() BETWEEN specialtider.specstart AND specialtider.specslut) AS specialtider ON oppettider.kontraktid=specialtider.kontraktid WHERE veckodagar.ID = DAYOFWEEK(NOW()) AND (specialtider.stangt IS NULL OR specialtider.stangt <> 1) GROUP BY oppettider.kontraktid) as tider ON kontrakt.ID = tider.kontraktid ORDER BY kontrakt.ID";

//$isql = "SELECT * FROM kontrakt LEFT OUTER JOIN adress ON kontrakt.ID = adress.ID LEFT OUTER JOIN (SELECT kontrakt.ID, IF (kontrakt.ID IN (SELECT kontrakt.ID FROM oppettider LEFT OUTER JOIN kontrakt ON oppettider.kontraktid = kontrakt.ID WHERE  veckodagarid = DAYOFWEEK(NOW()) AND oppet <= CURTIME() AND stangt >= CURTIME()), ikontyp.opimgurl, ikontyp.stimgurl) AS ikonurl FROM kontrakt LEFT OUTER JOIN ikontyp ON kontrakt.ikonid = ikontyp.ID) AS ikon ON kontrakt.ID = ikon.ID";

$isql = "SELECT * FROM kontrakt LEFT OUTER JOIN adress ON kontrakt.ID = adress.ID LEFT OUTER JOIN (SELECT kontrakt.ID, IF (kontrakt.ID IN (SELECT kontraktid FROM (SELECT oppettider.kontraktid, oppettider.veckodagarid, COALESCE(specialtider.altoppet, oppettider.oppet) AS oppet, COALESCE(specialtider.altstangt, oppettider.stangt) AS stangt, specialtider.specstart, specialtider.specslut, specialtider.stangt AS isstangt from oppettider JOIN veckodagar ON oppettider.veckodagarid = veckodagar.ID LEFT OUTER JOIN (SELECT * FROM specialtider WHERE CURDATE() BETWEEN specialtider.specstart AND specialtider.specslut) AS specialtider ON oppettider.kontraktid=specialtider.kontraktid WHERE veckodagar.ID = DAYOFWEEK(NOW()) AND (specialtider.stangt IS NULL OR specialtider.stangt <> 1) GROUP BY oppettider.kontraktid) as tider WHERE CURTIME() BETWEEN oppet AND stangt), ikontyp.opimgurl, ikontyp.stimgurl) AS ikonurl FROM kontrakt LEFT OUTER JOIN ikontyp ON kontrakt.ikonid = ikontyp.ID) AS ikon ON kontrakt.ID = ikon.ID";

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
require_once("include/headmobil.php");
?>
<meta charset=UTF-8 />
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" media="screen" href="css/mobil.css" />

<script language="javascript" type="text/javascript" src = "include/googlemap.js"></script>
<script type="text/javascript">
    var obj = <?php echo json_encode($places, JSON_UNESCAPED_UNICODE); ?>;	
    var oppen = <?php echo json_encode($openhours, JSON_UNESCAPED_UNICODE);?>;
</script>

</head>
<body>

<?php
defined('THE_HEADER') || define('THE_HEADER', TRUE);
  require_once("include/headermobil.php"); 
?>  
  <div id='google_container'>
  <div id= "googleMap">
    </div>  
  </div>
</div>

</body>
<script type="text/javascript">
 
var theScroll;
function scroll() {
    theScroll = new iScroll('infowindow');
}
document.addEventListener('DOMContentLoaded', scroll, false);
</script>

<script type="text/javascript" src="../iscroll-4/src/iScroll-lite.js"></script>
</html>




