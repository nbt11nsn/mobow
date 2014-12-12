<?php
defined('THE_MENUE') or die();
defined('THE_DB') || define('THE_DB', TRUE);
require_once(__DIR__ .'./../../../db.php');
$adm = mysqli_real_escape_string($con, $_SESSION['admin']);
if($adm){
echo"<div id = 'huvudmeny'>
  <nav>
    <ul>
      <li><a href='info.php' class='hemikon'>H</a></li> 
      <li><a href='newcontract.php'>Nytt kontrakt</a></li> 
      <li><a href='invoice.php'>Faktura</a></li>
      <li><a href='report.php'>Felrapportering</a></li>
      <li class='gotsub'><a href='#'>Editera</a>
        <ul>
          <li><a href='edit.php'>Inloggning</a></li>
          <li><a href='opening.php'>Öppettider</a></li>
          <li><a href='contract.php'>Kontrakt</a></li>
        </ul>
      </li>
      <li><a href='order.php'>Beställning</a></li>
      <li><a href='companymessage.php'>Meddelande</a></li>
      <li><a href='logout.php' class='logikon'>L</a></li>
    </ul>
  </nav>
</div>";
}
else{
echo"<div id = 'huvudmeny'>
  <nav>
    <ul>
      <li><a href='info.php' class='hemikon'>H</a></li>
      <li><a href='invoice.php'>Faktura</a></li>
      <li><a href='report.php'>Felrapportering</a></li>
      <li class='gotsub'><a href='#'>Editera</a>
        <ul>
          <li><a href='edit.php'>Inloggning</a></li>
          <li><a href='opening.php'>Öppettider</a></li>
          <li><a href='contract.php'>Kontrakt</a></li>
        </ul>
      </li>
      <li><a href='order.php'>Beställning</a></li>
      <li><a href='companymessage.php'>Meddelande</a></li>
      <li><a href='logout.php' class='logikon'>L</a></li>
    </ul>
  </nav>
</div>";
}
?>