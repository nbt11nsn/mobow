<?php
defined('THE_MENUE') or die();
defined('THE_DB') || define('THE_DB', TRUE);
require_once(__DIR__ .'./../../../db.php');
$adm = mysqli_real_escape_string($con, $_SESSION['admin']);
$sqlkont="SELECT medstatus FROM felmeddelande WHERE medstatus = 1";
$iresult = mysqli_query($con, $sqlkont);
$num_rows = mysqli_num_rows($iresult);
if($adm){
if($num_rows != 0){
echo"<div id = 'huvudmeny'>
  <nav>
    <ul>
      <li><a href='info.php' class='hemikon'>H</a></li> 
      <li><a href='newcontract.php'>Nytt kontrakt</a></li> 
      <li><a href='invoice.php'>Faktura</a></li>
	  <li id='statuskoll'><a href='report.php'>Felrapportering</a></li>
	  <li class='gotsub'><a href='#'>Ta bort</a>
        <ul>
		<li><a href='deletecontract.php'>Kontrakt & Företag</a></li>
        <li><a href=''>Kontaktpersoner</a></li>
		</ul>
      <li class='gotsub'><a href='#'>Editera</a>
        <ul>
          <li><a href='edit.php'>Inloggning</a></li>
          <li><a href='opening.php'>Öppettider</a></li>
          <li><a href='contract.php'>Kontrakt</a></li>
        </ul>
      </li>
      <li><a href='companymessage.php'>Meddelande</a></li>
      <li><a href='logout.php' class='logikon'>L</a></li>
    </ul>
  </nav>
</div>";}
else{
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
      <li><a href='companymessage.php'>Meddelande</a></li>
      <li><a href='logout.php' class='logikon'>L</a></li>
    </ul>
  </nav>
</div>";
}
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
      <li><a href='companymessage.php'>Meddelande</a></li>
      <li><a href='logout.php' class='logikon'>L</a></li>
    </ul>
  </nav>
</div>";
}
?>