<?PHP
defined('THE_ASESSION') or die("include checka");
if(!((isset($_SESSION['admin']) && $_SESSION['admin'] == '1'))) {
  session_destroy();
  header ("Location: index.php");
  die();
}
?>