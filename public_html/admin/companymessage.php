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
    $useracc = "Användarkonto";
    $contract = "Kontrakt";
    $type = "Typ:";
    $req = "Begärd förändring på:";
    $status = "Status:";
    $smsg = "meddelande";
    $sumsg = "oläst meddelande";
    $pmsg = "meddelanden";
    $pumsg = "olästa meddelanden";

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
        echo"<table class='tmsg'>";
        echo"<tr><td class='tnb'></td>";
        if($nrofunreadmsg < 2){echo"<td class='tnb'>$nrofunreadmsg $sumsg.</td>";}
        else{echo"<td class='tnb'>$nrofunreadmsg $psmsg.</td>";}
        if($nrofmessage < 2){echo"<td class='tnb'>$nrofmessage $smsg.</td>";}
        else{echo"<td class='tnb'>$nrofmessage $pmsg.</td>";}
        echo"</tr>";
        echo"<tr><th>$type</th><th>$req</th><th>$status</th></tr>";
        $sqlknt = "SELECT edit_kntper.kontaktid AS kid, medstatus.info AS info FROM edit_kntper LEFT OUTER JOIN medstatus ON medstatus.ID = edit_kntper.status";
        $sqlforetag = "SELECT edit_foretag.kontraktid AS kid, kontrakt.kontorsnamn AS namn, medstatus.info AS info FROM edit_foretag LEFT OUTER JOIN kontrakt ON edit_foretag.kontraktid = kontrakt.ID LEFT OUTER JOIN medstatus ON medstatus.ID = edit_foretag.status";
        $resknt = mysqli_query($con, $sqlknt);
        $resforetag = mysqli_query($con, $sqlforetag);
        while($row = mysqli_fetch_assoc($resknt))
        {
            $id = $row['kid'];
            $info = $row['info'];
            echo"<tr>
            <td>$useracc</td>
            <td>$id</td>
            <td>$info</td>
            </tr>";
        }
        while($row = mysqli_fetch_assoc($resforetag))
        {
            $id = $row['kid'];
            $namn = $row['namn'];
            $info = $row['info'];
            echo"<tr>
            <td>$contract</td>
            <td>$namn</td>
            <td>$info</td>
            </tr>";
        }
        echo"</table>";
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

