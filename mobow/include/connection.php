<?php
// Start XML file, create parent node


defined('THE_DB') || define('THE_DB', TRUE);
require_once(__DIR__ .'./../../db.php');

// Select all the rows in the markers table

$query = "SELECT * FROM kontrakt LEFT OUTER JOIN adress ON kontrakt.adressID = adress.ID LEFT OUTER JOIN ikontyp ON kontrakt.ikonid = ikontyp.ID";

function parseToXML($htmlStr)
{
$xmlStr=str_replace('<','&lt;',$htmlStr);
$xmlStr=str_replace('>','&gt;',$xmlStr);
$xmlStr=str_replace('"','&quot;',$xmlStr);
$xmlStr=str_replace("'",'&#39;',$xmlStr);
$xmlStr=str_replace("&",'&amp;',$xmlStr);
return $xmlStr;
}


$result = mysqli_query($con,$query);
if (!$result) {
  die('Invalid query: ' . mysqli_error());
}

header("Content-type: text/xml");

// Start XML file, echo parent node
echo '<markers>';  
// Iterate through the rows, printing XML nodes for each
while ($row = @mysqli_fetch_assoc($result)){
  // ADD TO XML DOCUMENT NODE 
  echo '<marker ';
  echo 'name="' . parseToXML($row['kontorsnamn']) . '" ';
  echo 'address="' . parseToXML($row['stad']) . '" ';
  echo 'lat="' . $row['lat'] . '" ';
  echo 'lng="' . $row['long'] . '" ';
  echo 'type="restaurant"';
  echo '/>';
}

// End XML file
echo '</markers>';

?>
