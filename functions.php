<?php
//error_reporting(-1);
//ini_set('display_errors', 'On');
defined('THE_FUNC') or die("include processes");    
  function upasswd($post, $adm) {   
    if(isset($adm) && !$adm) {
      defined('THE_DB') || define('THE_DB', TRUE);
      require(__DIR__ .'/db.php'); 
      $pass1 = mysqli_real_escape_string($con, $post['npasswd']);
      $pass2 = mysqli_real_escape_string($con, $post['cpasswd']);
      $password = mysqli_real_escape_string($con, $post['gpasswd']);
      if ((!$password) || (!$pass1) || (!$pass2)) {
        return "<div class='error'>Information saknas</div>";
      } 
      if ($pass1 !== $pass2) {
        return "<div class='error'>Nytt lösenord matchar inte upprepningen!</div>";
      }
      $uname = mysqli_real_escape_string($con, $_SESSION['username']);
      $sql = "SELECT * FROM kontaktperson WHERE anvnamn = '$uname' LIMIT 1";
      $result = mysqli_query($con, $sql); 
      if (mysqli_num_rows($result) != 0) {
        $row = mysqli_fetch_assoc($result);
        mysqli_free_result($result);
        if(password_verify($password, $row['losen'])) 
        {
          $hash = password_hash($pass2, PASSWORD_DEFAULT);
          $usql = "UPDATE kontaktperson SET losen = '$hash' WHERE anvnamn = '".$row['anvnamn']."'";
          if(mysqli_query($con, $usql)) {
              mysqli_close($con);
              return "<div class='ok'>Lösenordet har uppdaterats.</div>";
          } 
          else {mysqli_close($con); return "<div class='error'>Lösenordet kunde inte uppdateras!</div>";}
        } 
        else {mysqli_close($con); return "<div class='error'>Inkorrekt Lösenord!</div>";}
      } 
      else {mysqli_close($con); return "<div class='error'>Fel lösenord!</div>";}
    }
    else if(isset($adm) && $adm) {
      defined('THE_DB') || define('THE_DB', TRUE);
      require(__DIR__ .'/db.php');
      $pass1 = mysqli_real_escape_string($con,$post['npasswd']);
      $pass2 = mysqli_real_escape_string($con,$post['cpasswd']);
      $password = mysqli_real_escape_string($con,$post['apasswd']);
      $who = mysqli_real_escape_string($con,$post['uuid']);
      if ((!$password) || (!$pass1) || (!$pass2)) {
        return "<div class='error'>Information saknas</div>";
      } 
      if ($pass1 !== $pass2) {
        return "<div class='error'>Nytt lösenord matchar inte upprepningen!</div>";
      }
      $uname = mysqli_real_escape_string($con, $_SESSION['username']);
      $sql = "SELECT * FROM kontaktperson WHERE anvnamn = '$uname' LIMIT 1";
      $result = mysqli_query($con, $sql); 
      if (mysqli_num_rows($result) != 0) {
        $row = mysqli_fetch_assoc($result);
        mysqli_free_result($result);
        if(password_verify($password, $row['losen'])) 
        {
          $hash = password_hash($pass2, PASSWORD_DEFAULT);
          $usql = "UPDATE kontaktperson SET losen = '$hash' WHERE anvnamn = '".$who."'";
          if(mysqli_query($con, $usql)) {
            mysqli_close($con);
              return "<div class='ok'>Lösenordet har uppdaterats.</div>";
          } 
          else {mysqli_close($con); return "<div class='error'>Lösenordet kunde inte uppdateras!</div>";}
        } 
        else {mysqli_close($con); return "<div class='error'>Inkorrekt Lösenord!</div>";}
      } 
      else {mysqli_close($con); return "<div class='error'>Fel lösenord!</div>";}
    } 
    else{return "<div class='error'>Något gick fel.</div>";}
  }