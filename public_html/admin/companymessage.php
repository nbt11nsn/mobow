<?php
SESSION_start();
?>
<!DOCTYPE html>
<html>
<head>
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
if(isset($_SESSION['admin']) && $_SESSION['admin'])
{
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
    $deny = "Neka";
    $open = "Öppna";
    $remove = "Ta bort";

if(isset($_POST['app'])&&isset($_POST['msg']))//godkänn ett meddelande
{
    $msg = mysqli_real_escape_string($con, $_POST['msg']);
    if(is_numeric($msg)) // kontrakt
    {
        $sql = "UPDATE edit_foretag SET status='4' WHERE  edit_foretag.kontraktid='$msg';";
        if(mysqli_query($con, $sql))
        {echo"<p class='ok'>Uppdateringen godkänd</p>";}
        else
        {echo"<p class='error'>Uppdateringen gick inte att godkänna</p>";}
    }
    else // kontaktperson
    {
        $msg = substr($msg, 1);
        $sql = "UPDATE edit_kntper SET status='4' WHERE  edit_kntper.kontaktid='$msg';";
        if(mysqli_query($con, $sql))
        {echo"<p class='ok'>Uppdateringen godkänd</p>";}
        else
        {echo"<p class='error'>Uppdateringen gick inte att godkänna</p>";}
    }
}
elseif(isset($_POST['den'])&&isset($_POST['msg']))//neka ett meddelande
{
    $msg = mysqli_real_escape_string($con, $_POST['msg']);
    if(is_numeric($msg)) // kontrakt
    {
        $sql = "UPDATE edit_foretag SET status='3' WHERE  edit_foretag.kontraktid='$msg';";
        if(mysqli_query($con, $sql))
        {echo"<p class='ok'>Uppdateringen nekat</p>";}
        else
        {echo"<p class='error'>Uppdateringen gick inte att neka</p>";}
    }
    else // kontaktperson
    {
        $msg = substr($msg, 1);
        $sql = "UPDATE edit_kntper SET status='3' WHERE  edit_kntper.kontaktid='$msg';";
        if(mysqli_query($con, $sql))
        {echo"<p class='ok'>Uppdateringen nekat</p>";}
        else
        {echo"<p class='error'>Uppdateringen gick inte att neka</p>";}
    }
}
elseif(isset($_POST['rmv'])&&isset($_POST['msg']))//ta bort ett meddelande
{
    $msg = mysqli_real_escape_string($con, $_POST['msg']);
    if(is_numeric($msg)) // kontrakt
    {
        $sql = "DELETE FROM edit_foretag WHERE kontraktid='$msg'";
        if(mysqli_query($con, $sql))
        {echo"<p class='ok'>Meddelandet borttaget</p>";}
        else
        {echo"<p class='error'>Meddelandet gick inte att ta bort</p>";}
    }
    else // kontaktperson
    {
        $msg = substr($msg, 1);
        $sql = "DELETE FROM edit_kntper WHERE kontaktid='$msg'";
        if(mysqli_query($con, $sql))
        {echo"<p class='ok'>Meddelandet borttaget</p>";}
        else
        {echo"<p class='error'>Meddelandet gick inte att ta bort</p>";}
    }
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
        echo"<td class='tnb'></td><td class='tnb'></td>";
        if($nrofmessage < 2){echo"<td class='tnb'>$nrofmessage $smsg.</td>";}
        else{echo"<td class='tnb'>$nrofmessage $pmsg.</td>";}
        echo"</tr>";
        $sqlknt = "SELECT edit_kntper.kontaktid AS kid, medstatus.info AS info FROM edit_kntper LEFT OUTER JOIN medstatus ON medstatus.ID = edit_kntper.status ORDER BY medstatus.ID";
        $sqlforetag = "SELECT edit_foretag.kontraktid AS kid, kontrakt.kontorsnamn AS namn, medstatus.info AS info FROM edit_foretag LEFT OUTER JOIN kontrakt ON edit_foretag.kontraktid = kontrakt.ID LEFT OUTER JOIN medstatus ON medstatus.ID = edit_foretag.status ORDER BY medstatus.ID";
        $resknt = mysqli_query($con, $sqlknt);
        $resforetag = mysqli_query($con, $sqlforetag);
        echo"<tr><td colspan='4'><select name='msg' id='msg' style='width:100%'>";
        while($row = mysqli_fetch_assoc($resknt))
        {
            $id = $row['kid'];
            $info = $row['info'];
            echo"<option value='!$id'>$useracc '$id' --- $status $info</option>";
        }
        while($row = mysqli_fetch_assoc($resforetag))
        {
            $id = $row['kid'];
            $namn = $row['namn'];
            $info = $row['info'];
            echo"<option value='$id'>$contract '$namn' --- $status $info</option>";
        }
        echo"</select></td></tr>";

        if(isset($_POST['ope'])&&isset($_POST['msg']))//öppna ett meddelande
        {
            $msg = mysqli_real_escape_string($con, $_POST['msg']);
            if(is_numeric($msg)) // kontrakt
            {
                $sqlq = "SELECT edit_foretag.currinfo AS nycurrinfo, edit_foretag.tele AS nytele, edit_foretag.logurl AS nylogurl, edit_foretag.logbredd AS nylogbredd, edit_foretag.loghojd AS nyloghojd, edit_foretag.hemsida AS nyhemsida, edit_foretag.allminfo AS nyallminfo, edit_foretag.forecolor AS nyforecolor, edit_foretag.backcolor AS nybackcolor, edit_foretag.ikonid AS nyikonid, kontrakt.currinfo, kontrakt.tele, kontrakt.logurl, kontrakt.logbredd, kontrakt.loghojd, kontrakt.hemsida, kontrakt.allminfo, kontrakt.forecolor, kontrakt.backcolor, kontrakt.ikonid FROM edit_foretag LEFT OUTER JOIN kontrakt ON edit_foretag.kontraktid = kontrakt.ID WHERE kontrakt.ID='$msg'";
                $resq = mysqli_query($con, $sqlq);
                $assq = mysqli_fetch_assoc($resq);
            }
            else // kontaktperson
            {
                $msg = substr($msg, 1);
                $sql = "SELECT edit_kntper.fornamn AS nyfornamn, edit_kntper.efternamn AS nyefternamn, edit_kntper.mobil AS nymobil, edit_kntper.mejl AS nymejl, kontaktperson.fornamn, kontaktperson.efternamn, kontaktperson.mobil, kontaktperson.mejl FROM edit_kntper LEFT OUTER JOIN kontaktperson ON kontaktperson.anvnamn = edit_kntper.kontaktid WHERE kontaktperson.anvnamn='$msg'";
                $resq = mysqli_query($con, $sqlq);
                $assq = mysqli_fetch_assoc($resq);
            }
        }

        echo"<tr>
             <td><input type='submit' name='ope' value='$open'></td>
             <td><input type='submit' name='app' value='$approve'></td>
             <td><input type='submit' name='den' value='$deny'></td>
             <td><input type='submit' name='rmv' value='$remove'></td>
             </tr>";
        echo"</table>";
        echo"</form>";
    }
}
else
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

