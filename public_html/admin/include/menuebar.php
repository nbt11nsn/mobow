<?php
defined('THE_MENUE') or die();
defined('THE_DB') || define('THE_DB', TRUE);
require_once(__DIR__ .'./../../../db.php');
$adm = mysqli_real_escape_string($con, $_SESSION['admin']);
$sqlkont="SELECT medstatus FROM felmeddelande WHERE medstatus = 1";
$iresult = mysqli_query($con, $sqlkont);
$num_rows = mysqli_num_rows($iresult);
if($adm){
$sqlnew="SELECT (SELECT COUNT(*) FROM edit_foretag WHERE status = 1) + (SELECT COUNT(*) FROM edit_kntper WHERE status = 1) AS count";
$resnew=mysqli_query($con, $sqlnew);
$assnew=mysqli_fetch_assoc($resnew);
$numnew=$assnew['count'];
echo"<div id = 'huvudmeny'>
  <nav>
    <ul>
      <li><a href='info.php' class='hemikon'>H</a></li> 
	  <li class='gotsub'><a href='#'>Skapa</a>
        <ul>
		<li><a href='newcontract.php'>Kontrakt och Företag</a></li>
        <li><a href='newcontact.php'>Användare</a></li>
		</ul>
      </li>
      <li><a href='invoice.php'>Faktura</a></li>
	  <li ";
    if($num_rows != 0){echo "id='statuskoll'";}
echo"><a href='report.php'>Felrapportering</a></li>
	  <li class='gotsub'><a href='#'>Radera</a>
        <ul>
		<li><a href='deletecontract.php'>Kontrakt och Företag</a></li>
        <li><a href='deletecontact.php'>Användare</a></li>
		</ul>
      </li>
      <li class='gotsub'><a href='#'>Editera</a>
        <ul>
          <li><a href='edit.php'>Inloggning</a></li>
          <li><a href='opening.php'>Öppettider</a></li>
          <li><a href='contract.php'>Kontrakt</a></li>
		  <li><a href='editcontact.php'>Användare</a></li>
        </ul>
      </li>
      <li ";
    if($numnew != 0){echo "id='statuskoll'";}
echo"><a href='companymessage.php'>Meddelande</a></li>
      <li><a href='logout.php' class='logikon'>L</a></li>
    </ul>
  </nav>
</div>";
}
else{
    $me = mysqli_real_escape_string($con, $_SESSION['username']);
    $sqlnew="SELECT COUNT(*) AS count FROM msg WHERE kontraktid IN (SELECT ID FROM kontrakt WHERE kontaktpersonid='$me') OR kontaktid='$me'";
    $resnew=mysqli_query($con, $sqlnew);
    $assnew=mysqli_fetch_assoc($resnew);
    $numnew=$assnew['count'];
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
		  <li><a href='editcontact.php'>Användare</a></li>
        </ul>
      </li>
      <li ";
        if($numnew != 0){echo "id='statuskoll'";}
        echo"><a href='companymessage.php'>Meddelande</a></li>
      <li><a href='logout.php' class='logikon'>L</a></li>
    </ul>
  </nav>
</div>";
}
?>