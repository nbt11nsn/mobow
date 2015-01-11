<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
SESSION_start();
$useracc = "Ändringar på användarkonto";
$contract = "Ändringar på kontraktet";
$type = "Typ:";
$req = "Begärd förändring på:";
$status = "Status:";
$smsg = "meddelande";
$sumsg = "oläst meddelande";
$pmsg = "meddelanden";
$pumsg = "olästa meddelanden";
$approve = "Godkänn";
$approved = "Godkänd";
$deny = "Neka";
$denied = "Nekad";
$open = "Öppna";
$remove = "Ta bort";
function appdenmessage($ad)
{
    global $approved, $denied, $remove;
   echo"<tr>
   <td colspan='5'><b>Detta meddelande är redan ".($ad?$approved:$denied)."</b></td></tr>
   <tr><td colspan='5'>Vill du ta bort det?<br /><input type='submit' name='rmv' value='$remove'></td></tr>";
}
function decidebutton()
{
    global $remove, $approve, $deny;
	echo"<tr>
	<td class='tnb'><input type='submit' name='rmv' value='$remove'></td>
	<td class='tnb'></td>
	<td class='tnb'></td>
	<td><input type='submit' name='app' value='$approve'></td>
    <td><input type='button' onclick='div_show()' value='$deny'></td>
	</tr>";
}
?>
<!DOCTYPE html>
<html>
<head>
<script>
//Function To Displayfunktion visa popup
function div_show() {
document.getElementById('abc').style.display = "block";
}
//funktion dölj popup
function div_hide(){
document.getElementById('abc').style.display = "none";
}
</script>
<link href="./css/popup.css" rel="stylesheet">
<?php
defined('THE_SESSION') || define('THE_SESSION', TRUE);
require_once('include/checksession.php');
defined('THE_HEAD') || define('THE_HEAD', TRUE);
include_once("include/head.php");
?>
</head>
<body>
<?php
defined('THE_HEADER') || define('THE_HEADER', TRUE);
require_once("include/header.php");
?>
<div id="main-wrapper">
<?php
defined('THE_MENUE') || define('THE_MENUE', TRUE);
require_once("include/menuebar.php");
?>
<div id = "frame">
<?php
if(isset($_SESSION['admin']) && $_SESSION['admin']) // administratör
{
if(isset($_POST['app'])&&isset($_POST['omsg']))//godkänn ett meddelande
{
    $msg = mysqli_real_escape_string($con, $_POST['omsg']);
    if(is_numeric($msg)) // kontrakt
    {
        $sqllogo = "SELECT edit_foretag.logurl AS tmpurl, kontrakt.logurl AS url FROM edit_foretag JOIN kontrakt ON edit_foretag.kontraktid=kontrakt.ID WHERE kontraktid='$msg'";
        $reslogo = mysqli_query($con, $sqllogo);
        if(mysqli_num_rows($reslogo) != 0)//denna borde alltid validera 'true'
        {
            $asslogo = mysqli_fetch_assoc($reslogo);
            if($asslogo['tmpurl'] === null){}// inget att göra
            elseif($asslogo['tmpurl'] == '0') // ta bort logotyp
            {
                unlink( __DIR__."/../".$asslogo['url']);
            }
            else // byta logotyp
            {
                rename( __DIR__."/../".$asslogo['tmpurl'],  __DIR__."/../".$asslogo['url']);
            }
        }        
        $sqlsw = "UPDATE kontrakt SET currinfo = COALESCE((SELECT currinfo FROM edit_foretag WHERE kontraktid = '$msg'), currinfo), cihash = COALESCE((SELECT cihash FROM edit_foretag WHERE kontraktid = '$msg'), cihash), tele = COALESCE((SELECT tele FROM edit_foretag WHERE kontraktid = '$msg'), tele), hemsida = COALESCE((SELECT hemsida FROM edit_foretag WHERE kontraktid = '$msg'), hemsida), forecolor = COALESCE((SELECT forecolor FROM edit_foretag WHERE kontraktid = '$msg'), forecolor), backcolor = COALESCE((SELECT backcolor FROM edit_foretag WHERE kontraktid = '$msg'), backcolor), allminfo = COALESCE((SELECT allminfo FROM edit_foretag WHERE kontraktid = '$msg'), allminfo), aihash = COALESCE((SELECT aihash FROM edit_foretag WHERE kontraktid = '$msg'), aihash), ikonid = COALESCE((SELECT ikonid FROM edit_foretag WHERE kontraktid = '$msg'), ikonid), logurl = IF((SELECT logurl FROM edit_foretag WHERE kontraktid = '$msg')='0', NULL, logurl), logbredd = IF((SELECT logbredd FROM edit_foretag WHERE kontraktid = '$msg')='0', NULL, COALESCE((SELECT logbredd FROM edit_foretag WHERE kontraktid = '$msg'), logbredd)), loghojd = IF((SELECT loghojd FROM edit_foretag WHERE kontraktid = '$msg')='0', NULL, COALESCE((SELECT loghojd FROM edit_foretag WHERE kontraktid = '$msg'), loghojd)) WHERE kontrakt.ID = '$msg'";
        $sql = "UPDATE edit_foretag SET status='2' WHERE  edit_foretag.kontraktid='$msg';";
    }
    else // kontaktperson
    {
        $msg = substr($msg, 1);
        $sqlsw = "UPDATE kontaktperson SET fornamn = COALESCE((SELECT fornamn FROM edit_kntper WHERE kontaktid = '$msg'), fornamn), efternamn = COALESCE((SELECT efternamn FROM edit_kntper WHERE kontaktid = '$msg'), efternamn), mobil = COALESCE((SELECT mobil FROM edit_kntper WHERE kontaktid = '$msg'), mobil), mejl = COALESCE((SELECT mejl FROM edit_kntper WHERE kontaktid = '$msg'), mejl) WHERE anvnamn = '$msg'";
        $sql = "UPDATE edit_kntper SET status='2' WHERE  edit_kntper.kontaktid='$msg';";   
    }
	if(mysqli_query($con, $sqlsw) && mysqli_query($con, $sql))
	{echo"<p class='ok'>Uppdateringen godkänd</p>";}
	else
	{echo"<p class='error'>Uppdateringen gick inte att godkänna</p>";}
}
elseif(isset($_POST['den'])&&isset($_POST['omsg']))//neka ett meddelande
{
    $msg = mysqli_real_escape_string($con, $_POST['omsg']);
    $denmsg = mysqli_real_escape_string($con, $_POST['denymsg']);
    if(is_numeric($msg)) // kontrakt
    {
        $sqlmsg="INSERT INTO msg(meddelande, kontraktid) VALUES('$denmsg', '$msg')";
        mysqli_query($con, $sqlmsg);
        $sql = "UPDATE edit_foretag SET status='3', meddelande='".mysqli_insert_id($con)."' WHERE  edit_foretag.kontraktid='$msg'";
    }
    else // kontaktperson
    {
        $msg = substr($msg, 1);
        $sqlmsg="INSERT INTO msg(meddelande, kontaktid) VALUES('$denmsg', '$msg')";
        mysqli_query($con, $sqlmsg);
        $sql = "UPDATE edit_kntper SET status='3', meddelande='".mysqli_insert_id($con)."' WHERE  edit_kntper.kontaktid='$msg';";
    }
	if(mysqli_query($con, $sql))
    {echo"<p class='ok'>Uppdateringen nekat</p>";}
    else
	{echo"<p class='error'>Uppdateringen gick inte att neka</p>";}
}
elseif(isset($_POST['rmv'])&&isset($_POST['omsg']))//ta bort ett meddelande
{
    $msg = mysqli_real_escape_string($con, $_POST['omsg']);
    if(is_numeric($msg)) // kontrakt
    {
        $sql = "DELETE FROM edit_foretag WHERE kontraktid='$msg'";    
    }
    else // kontaktperson
    {
        $msg = substr($msg, 1);
        $sql = "DELETE FROM edit_kntper WHERE kontaktid='$msg'";
    }
	if(mysqli_query($con, $sql))
	{echo"<p class='ok'>Meddelandet borttaget</p>";}
	else
	{echo"<p class='error'>Meddelandet gick inte att ta bort</p>";}
}

    $sqlcount = "SELECT (SELECT COUNT(*) FROM edit_foretag) + (SELECT COUNT(*) FROM edit_kntper) AS numberofmessage FROM DUAL";
    $rescount = mysqli_query($con, $sqlcount);
    $asscount = mysqli_fetch_assoc($rescount);
    $nrofmessage = $asscount['numberofmessage'];

    $sqluncount = "SELECT (SELECT COUNT(*) FROM edit_foretag WHERE status = '1') + (SELECT COUNT(*) FROM edit_kntper WHERE status = '1') AS numbermsg FROM DUAL";
    $resuncount = mysqli_query($con, $sqluncount);
    $assuncount = mysqli_fetch_assoc($resuncount);
    $nrofunreadmsg = $assuncount['numbermsg'];

    if($nrofmessage < 1) // Det finns inga meddelanden
    {
        echo"Det finns inga meddelanden att visa";
    }
    else //Det finns meddelanden
    {
        echo"<form name='sendmsg' method='post' action=''>";
        echo"<table class='tmsg' width='80%'>";
        echo"<tr>";
        if($nrofunreadmsg < 2){echo"<td class='tnb'>$nrofunreadmsg $sumsg.</td>";}
        else{echo"<td class='tnb'>$nrofunreadmsg $pumsg.</td>";}
        echo"<td class='tnb'></td><td class='tnb'></td><td class='tnb'></td>";
        if($nrofmessage < 2){echo"<td class='tnb'>$nrofmessage $smsg.</td>";}
        else{echo"<td class='tnb'>$nrofmessage $pmsg.</td>";}
        echo"</tr>";
        $sqlknt = "SELECT edit_kntper.kontaktid AS kid, medstatus.info AS info FROM edit_kntper LEFT OUTER JOIN medstatus ON medstatus.ID = edit_kntper.status ORDER BY medstatus.ID";
        $sqlforetag = "SELECT edit_foretag.kontraktid AS kid, kontrakt.kontorsnamn AS namn, medstatus.info AS info FROM edit_foretag LEFT OUTER JOIN kontrakt ON edit_foretag.kontraktid = kontrakt.ID LEFT OUTER JOIN medstatus ON medstatus.ID = edit_foretag.status ORDER BY medstatus.ID";
        $resknt = mysqli_query($con, $sqlknt);
        $resforetag = mysqli_query($con, $sqlforetag);
        echo"<tr><td colspan='5'><select name='msg' id='msg' style='width:100%'>";
        while($row = mysqli_fetch_assoc($resknt))
        {
            $id = $row['kid'];
            $info = $row['info'];
            if($id == $_POST['msg'])
            {
                echo"<option value='!$id' selected>$useracc '$id' --- $status $info</option>";
            }
            else
            {
                echo"<option value='!$id'>$useracc '$id' --- $status $info</option>";
            }
        }
        while($row = mysqli_fetch_assoc($resforetag))
        {
            $id = $row['kid'];
            $namn = $row['namn'];
            $info = $row['info'];
            if($id == $_POST['msg'])
            {
                echo"<option value='$id' selected>$contract '$namn' --- $status $info</option>";
            }
            else
            {
                echo"<option value='$id'>$contract '$namn' --- $status $info</option>";
            }
        }
        echo"</select></td></tr>";
        echo"<tr><td colspan='5'><input type='submit' name='ope' value='$open'></td></tr></form>";

        if(isset($_POST['ope'])&&isset($_POST['msg']))//öppna ett meddelande
        {
            $msg = mysqli_real_escape_string($con, $_POST['msg']);
            echo"<form name='upmsg' method='post' action=''><input type='hidden' name='omsg' value='$msg' />";
            echo"<div id='abc'><div id='popupContact'>
<img id='popupclose' src='./../image/close.png' onclick ='div_hide()' />
<h2>Berätta varför neka?</h2>
<textarea id='popupmsg' name='denymsg' placeholder='Meddelande'></textarea>
<input type='submit' name='den' value='$deny'>
</div></div>";
            if(is_numeric($msg)) // kontrakt
            {
                $sqlq = "SELECT * FROM (SELECT edit_foretag.status, edit_foretag.kontraktid, edit_foretag.currinfo AS nycurrinfo, edit_foretag.tele AS nytele, edit_foretag.logurl AS nylogurl, edit_foretag.logbredd AS nylogbredd, edit_foretag.loghojd AS nyloghojd, edit_foretag.hemsida AS nyhemsida, edit_foretag.allminfo AS nyallminfo, edit_foretag.forecolor AS nyforecolor, edit_foretag.backcolor AS nybackcolor, edit_foretag.ikonid AS nyikonid, ikontyp.typ AS nytyp FROM edit_foretag LEFT OUTER JOIN ikontyp ON edit_foretag.ikonid = ikontyp.ID) AS t1 LEFT OUTER JOIN (SELECT kontrakt.ID, kontrakt.currinfo, kontrakt.tele, kontrakt.logurl, kontrakt.logbredd, kontrakt.loghojd, kontrakt.hemsida, kontrakt.allminfo, kontrakt.forecolor, kontrakt.backcolor, kontrakt.ikonid, kontrakt.kontorsnamn, ikontyp.typ FROM kontrakt LEFT OUTER JOIN ikontyp ON kontrakt.ikonid = ikontyp.ID) AS t2 ON t1.kontraktid = t2.ID WHERE t2.ID='$msg'";
                $resq = mysqli_query($con, $sqlq);
                $assq = mysqli_fetch_assoc($resq);
                echo"<tr><th colspan='5'>$contract '".$assq['kontorsnamn']."'<br /><br /></th></tr>";
                switch($assq['status'])
                {
                case '1'://oläst
                    echo"<tr><th colspan='2'>Nuvarande värde</th><th></th><th colspan='2'>Nytt värde</th></tr>";
                    if($assq['nycurrinfo'] != null)
                    {
                        echo "<tr><td colspan='2' class='tdb'>".$assq['currinfo']."</td><td><b>Aktuellt:</b></td><td colspan='2' class='tdb'>".$assq['nycurrinfo']."</td></tr>";
                    }
                    if($assq['nytele'] != null)
                    {
                        echo "<tr><td colspan='2' class='tdb'>".$assq['tele']."</td><td><b>Telefonnummer:</b></td><td colspan='2' class='tdb'>".$assq['nytele']."</td></tr>";
                    }
                    if($assq['nyhemsida'] != null)
                    {
                        echo "<tr><td colspan='2' class='tdb'><a href='".$assq['hemsida']."' target='_blank'>".$assq['hemsida']."</a></td><td><b>Hemsida:</b></td><td colspan='2' class='tdb'><a href='".$assq['nyhemsida']."' target='_blank'>".$assq['nyhemsida']."</a></td></tr>";
                    }
                    if($assq['nyallminfo'] != null)
                    {
                        echo "<tr><td colspan='2' class='tdb'>".$assq['allminfo']."</td><td><b>Information:</b></td><td colspan='2' class='tdb'>".$assq['nyallminfo']."</td></tr>";
                    }
                    if($assq['nyforecolor'] != null)
                    {
                        echo "<tr><td colspan='2' class='tdb' style='background-color:".$assq['forecolor'].";'></td><td><b>Förgrundsfärg:</b></td><td colspan='2' class='tdb' style='background-color:".$assq['nyforecolor'].";'></td></tr>";
                    }
                    if($assq['nybackcolor'] != null)
                    {
                        echo "<tr><td colspan='2' class='tdb' style='background-color:".$assq['backcolor'].";'></td><td><b>Bakgrundsfärg:</b></td><td colspan='2' class='tdb' style='background-color:".$assq['nybackcolor'].";'></td></tr>";
                    }
                    if($assq['nyikonid'] != null)
                    {
                        echo "<tr><td colspan='2' class='tdb'>".$assq['typ']."</td><td><b>Typ av verksamhet:</b></td><td colspan='2' class='tdb'>".$assq['nytyp']."</td></tr>";
                    }
                    if($assq['nylogurl'] == '0')
                    {
                        echo "<tr><td colspan='2' class='tdb'><img id='logga' src='./../".$assq['logurl']."' /></td><td><b>Logotyp:</b></td><td colspan='2' class='tdb'>Borttagning av logotyp</td></tr>";
                    }
                    elseif($assq['nylogurl'] != null)
                    {
                        echo "<tr><td colspan='2' class='tdb'><img id='logga' src='./../".$assq['logurl']."' /></td><td><b>Logotyp:</b></td><td colspan='2' class='tdb'><img id='logga' src='./../".$assq['nylogurl']."' /></td></tr>";
                    }
                    decidebutton();
                    echo"</table>";
                    break;
                case '2'://godkänd
                    appdenmessage(true);
					break;
                case '3'://nekad
                    appdenmessage(false);
					break;
                default:
                    break;
                }
            }
            else // kontaktperson
            {
                $msg = substr($msg, 1);
                $sqlq = "SELECT edit_kntper.status, edit_kntper.fornamn AS nyfornamn, edit_kntper.efternamn AS nyefternamn, edit_kntper.mobil AS nymobil, edit_kntper.mejl AS nymejl, kontaktperson.fornamn, kontaktperson.efternamn, kontaktperson.mobil, kontaktperson.mejl, kontaktperson.anvnamn FROM edit_kntper LEFT OUTER JOIN kontaktperson ON kontaktperson.anvnamn = edit_kntper.kontaktid WHERE kontaktperson.anvnamn='$msg'";
                $resq = mysqli_query($con, $sqlq);
                $assq = mysqli_fetch_assoc($resq);
                echo"<tr><th colspan='5'>$useracc '".$assq['anvnamn']."'<br /><br /></th></tr>";
                switch($assq['status'])
                {
                case '1'://oläst
                    echo"<tr><th colspan='2'>Nuvarande värde</th><th></th><th colspan='2'>Nytt värde</th></tr>";
                    if($assq['nyfornamn'] != null)
                    {
                        echo "<tr><td colspan='2' class='tdb'>".$assq['fornamn']."</td><td><b>Förnamn:</b></td><td colspan='2' class='tdb'>".$assq['nyfornamn']."</td></tr>";
                    }
                    if($assq['nyefternamn'] != null)
                    {
                        echo "<tr><td colspan='2' class='tdb'>".$assq['efternamn']."</td><td><b>Efternamn:</b></td><td colspan='2' class='tdb'>".$assq['nyefternamn']."</td></tr>";
                    }
                    if($assq['nymobil'] != null)
                    {
                        echo "<tr><td colspan='2' class='tdb'>".$assq['mobil']."</td><td><b>Mobil:</b></td><td colspan='2' class='tdb'>".$assq['nymobil']."</td></tr>";
                    }
                    if($assq['nymejl'] != null)
                    {
                        echo "<tr><td colspan='2' class='tdb'>".$assq['mejl']."</td><td><b>Mejl:</b></td><td colspan='2' class='tdb'>".$assq['nymejl']."</td></tr>";
                    }
                    decidebutton();
                    echo"</table>";
                    break;
                case '2'://godkänd
                    appdenmessage(true);
					break;
                case '3'://nekad
                    appdenmessage(false);
					break;
                default:
                    break;
                }
            }
            echo"</form>";
        }
    }
}
else // företag
{
    
}
?>
</div><!--frame-->
</div><!--main-wrapper-->
<?php
defined('THE_FOOTER') || define('THE_FOOTER', TRUE);
require_once("include/footer.php");
?>
</body>
</html>
