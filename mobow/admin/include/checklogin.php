<?php
defined('THE_CHECK') or die("include checklog");
if(isset($_POST['login'])) 
{
  defined('THE_DB') || define('THE_DB', TRUE);
  require_once(__DIR__ .'./../../../db.php');
  $uname = mysql_real_escape_string($_POST['username']);
  $sql = "SELECT * FROM kontaktperson WHERE anvnamn = '$uname' LIMIT 1";
  $result = mysqli_query($con, $sql); 
  if (mysqli_num_rows($result) != 0) 
  {
  // det finns en användare
    $row = mysqli_fetch_assoc($result);
    mysql_free_result($result);
    if(password_verity($_POST['password'], $row['losen'])) 
    {
      if(password_needs_rehash($row['losen'], PASSWORD_DEFAULT))
      {
        //updatera databasen då hash bytts
        $newh = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $usql = "UPDATE kontaktperson SET losen = '$newh' WHERE ID = '".$row['ID']."'";
      if(mysqli_query($con, $usql)) 
      {
        //password uppdaterat
      }
      else 
      {
        // misslyckades uppdatera lösenord
        // ta bort innan release
        die("Fixa detta script, sql-frågan kanske?");
      }
    }
    // inloggad
    $_SESSION['first_name'] = $row['fornamn'];
    $_SESSION['last_name'] = $row['efternamn'];
    $_SESSION['mobile'] = $row['mobil'];
    $_SESSION['mail'] = $row['mejl'];
    $_SESSION['username'] = $row['anvnamn'];
    $_SESSION['admin'] = ($row['admin'] == 1);	
    header('Location: report.php');
    }
    else 
    {
        //fel lösenord
    }
  }
  else 
  {
      // användaren finns inte
  }
  mysqli_close($con);
}
?>