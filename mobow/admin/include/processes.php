<?php
defined('THE_PRO') or die("include processes");
if(!(isset($_SESSION['username']) && $_SESSION['username'] != '')) {
  defined('THE_DB') || define('THE_DB', TRUE);
  require_once(__DIR__ .'./../../../db.php');
    function upasswd($post, $adm) {
    if(isset($adm) && $adm) {
        $pass1 = $post['npasswd'];
        $pass2 = $post['cpasswd'];
        $password = $post['gpasswd'];
        $username = $post['username'];
        if ((!$password) || (!$pass1) || (!$pass2)) {
            return "Information saknas";
        } 
        if ($pass1 !== $pass2) {
            return "Lösenorden matchar inte";
        }
        $uname = mysqli_real_escape_string($con, $_SESSION['username']);
        $sql = "SELECT * FROM kontaktperson WHERE anvnamn = '$uname' LIMIT 1";
        $result = mysqli_query($con, $sql); 
        if (mysqli_num_rows($result) != 0) 
        {
            $row = mysqli_fetch_assoc($result);
            mysqli_free_result($result);
            if(password_verify($password, $row['losen'])) 
            {
                
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
        $new = md5($pass1);
        $this->query("UPDATE ".DBTBLE." SET password = '$new' WHERE username = '$username'");
        return "Password update successfull.";
    }
    }
}