<?PHP
defined('THE_SESSION') or die("include checksess");
if (!(isset($_SESSION['username']) && $_SESSION['username'] != '')) {
  session_destroy();
  header ("Location: index.php");
}
?>