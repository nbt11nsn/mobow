<?PHP
if (!(isset($_SESSION['username']) && $_SESSION['username'] != '')) {
session_destroy();
header ("Location: index.php");
}
?>