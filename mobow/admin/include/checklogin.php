<?php
session_start();
defined('THE_CHECK') or die();
if($_SERVER["REQUEST_METHOD"] == "POST") {

  defined('THE_DB') || define('THE_DB', TRUE);
  require_once(__DIR__ .'./../../../db.php');
  $sql = "SELECT  anvnamn, losen, fornamn, efternamn, mobil, mejl, admin 
  FROM kontaktperson WHERE anvnamn = '".$_POST['username']."' AND 
  losen = '".$_POST['password']."'"; 

$result = $con->query($sql); 

if ($result->num_rows > 0) {
// output data of each row
  while($row = $result->fetch_assoc()) {
    $_SESSION['first_name'] = $row['fornamn'];
    $_SESSION['last_name'] = $row['efternamn'];
    $_SESSION['mobile'] = $row['mobil'];
    $_SESSION['mail'] = $row['mejl'];
    $_SESSION['username'] = $row['anvnamn'];
    $_SESSION['admin'] = ($row['admin'] == 1);	
    header('Location: report.php');
	exit;	
  }
} 
else {
  echo "<p>Fel användarnamn eller lösenord!!</p>";
}
mysqli_close($con);
}
?>