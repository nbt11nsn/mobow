<?php
SESSION_start();
mb_internal_encoding('UTF-8');
mb_http_output('UTF-8');
mb_http_input('UTF-8');

defined('THE_DB') || define('THE_DB', TRUE);
require_once(__DIR__ .'./../db.php');
//$isql = "SELECT * FROM kontrakt LEFT OUTER JOIN adress ON kontrakt.adressID = adress.ID LEFT OUTER JOIN ikontyp ON kontrakt.ikonid = ikontyp.ID LEFT OUTER JOIN inforuta ON inforuta.ID = kontrakt.inforutaid";
$isql = "SELECT * FROM kontrakt LEFT OUTER JOIN adress ON kontrakt.adressID = adress.ID LEFT OUTER JOIN ikontyp ON kontrakt.ikonid = ikontyp.ID";
$isql2 = "SELECT * FROM oppettider LEFT OUTER JOIN kontrakt on oppettider.kontraktid = kontraktID";
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
<meta charset=UTF-8 />
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" media="screen" href="css/mobil.css" />
<script language="javascript" type="text/javascript" src = "include/googlemap.js"></script>
<script type="text/javascript">
    var obj = <?php echo json_encode($places, JSON_UNESCAPED_UNICODE); ?>;	
    var oppen = <?php echo json_encode($openhours, JSON_UNESCAPED_UNICODE);?>;
</script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script> 
  <!--[if IE]>
    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
  <![endif]-->
 
</head>
<body>
<div id = 'mobow-header'>
<img src = "image/Mobow.png"/>
</div>
 <div id='google_container' >
 <div id= "googleMap">
    </div>  
  </div>
</div>


</body>
</html>


