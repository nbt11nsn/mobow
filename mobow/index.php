<?php
SESSION_start();
defined('THE_DB') || define('THE_DB', TRUE);
require_once(__DIR__ .'./../db.php');
$isql = "SELECT * FROM kontrakt LEFT OUTER JOIN adress ON kontrakt.adressID = adress.ID LEFT OUTER JOIN ikontyp ON kontrakt.ikonid = ikontyp.ID LEFT OUTER JOIN inforuta ON inforuta.ID = kontrakt.inforutaid";
$places = array();// innehåller alla platser ur databasen
if($iresult = mysqli_query($con, $isql)){
  if (mysqli_num_rows($iresult) != 0) {
      while($irows = mysqli_fetch_assoc($iresult)) {
          $places[] = $irows;
      }
      mysqli_free_result($iresult);
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
//require_once('include/googlemaps.php'); ?>
<script language="javascript" type="text/javascript" src = "include/googlemaps.js"></script>
<!--<script language="javascript" type="text/javascript" src="include/googlemaps.js"></script>-->
<script type="text/javascript">
    var obj = <?php echo json_encode($places, JSON_UNESCAPED_UNICODE); ?>;
</script>

</head>
<body>

<?php
defined('THE_HEADER') || define('THE_HEADER', TRUE);
  require_once("include/header.php"); 
?>  

  <div id='google_container'>
  <div id= "googleMap">
  <div class="location"></div>
    </div>  
  </div>
</div>

<?php
defined('THE_FOOTER') || define('THE_FOOTER', TRUE);
  require_once("include/footer.php");
?>
  
</body>
</html>


