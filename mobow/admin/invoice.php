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
    defined('THE_DB') || define('THE_DB', TRUE);
    require_once(__DIR__ .'./../../db.php');
    defined('THE_MENUE') || define('THE_MENUE', TRUE);
    require_once("include/menuebar.php");
    $adm = mysqli_real_escape_string($con, $_SESSION['admin']);
    echo" <div id='invoiceframe'>";
if(isset($_POST['upfak']) && $adm){
    $error=false;
    if(!isset($_POST['receiver'])&&!is_numeric($_POST['receiver'])){
	$error="Ingen mottagare vald";
    }else{$c=$_POST['receiver'];}

    if(!isset($_POST['fnamn'])){
	$error="Ogiltigt namn";
    }else{$fn=$_POST['fnamn'];}

    if(!isset($_POST['dat_fil'])){
	$error="Ogiltigt datum";
    }else{$df=$_POST['dat_fil'];}

    if(!empty($_FILES['pdf_fil']['name'])){
        $ok=true;
        $err="Error: ";
        $allow = array("application/pdf");
        if($_FILES["pdf_fil"]["size"] > 2000000) {
            $ok=false;
            $err.='För stor fil<br />';
        }
        if(!in_array($_FILES['pdf_fil']['type'], $allow)){
            $ok=false;
            $err.='Filformatet stöds inte<br />';
        }
        if($ok==false){
            echo "<div class='error'>$err</div>";
            $error="Gick inte att ladda upp fakturan";
        }
        else
        {
            $tmp_path = $_FILES['pdf_fil']['tmp_name'];
            $target = "faktura/"."faktura".$c."_".$df."_".$fn.".pdf";
            $abs_dir = __DIR__."/../".$target;
	    if(file_exists($abs_dir)){
		$error="Filen finns redan";
	    }
            else if(move_uploaded_file($tmp_path, $abs_dir)){
                $sqlq= "INSERT INTO faktura (namn, url, agarid, datum) VALUES('$fn', '$target', '$c', '$df')";
            }
            else{
                $error="Gick inte att ladda upp fakturan";
            }
        }
    }
    else{
	$error="Ingen faktura vald att ladda upp";
    }
    if(!$error){
        if(mysqli_query($con, $sqlq)){
            echo "<div class='ok'>Uppladdningen lyckades</div>";
        }
        else{
            echo "<div class='error'>Uppladdningen misslyckades</div>";
        }
    }
    else{
        echo "<div class='error'>$error</div>";
    }
}
if($adm){
    echo"
<div class='upload_pdf' >
    <form id='upload_form' enctype='multipart/form-data' method='post' action=''>
        <label for='fnamn'>Namn på fakturan:</label>
        <input required type='text' value='' id='fnamn' name='fnamn' maxlength='50' />";
    $sqlkont="SELECT kontorsnamn, ID, orgnr FROM kontrakt ORDER BY kontorsnamn";
    $kont = mysqli_query($con, $sqlkont);
    echo"
    <label for='receiver'>Fakturan tillhör:</label>
    <select required name='receiver' id='receiver'>";
    if (mysqli_num_rows($kont) != 0) {
	while($row = mysqli_fetch_assoc($kont)) {
	    echo"<option value=".$row['ID'].">".$row['kontorsnamn']."</option>";
	}
    }
    echo"</select>";
    mysqli_free_result($kont);
    echo"
        <label for='dat_fil'>Datum:</label>
        <input required type='date' name='dat_fil' id='dat_fil' value='".date('Y-m-d')."' />
	<label for='pdf_fil'>Ladda upp en faktura</label>
	<input required type='file' name='pdf_fil' id='pdf_fil' />
        <input type='reset' name='rst' id='rst' value='Återställ' />
	<input type='submit' id='upfak' name='upfak' accept='application/pdf' value='Ladda upp faktura' />
    </form>
</div>";
}
?>
	<div id="listframe">
	    <form action="" method="post" id = "postRows">
		<select name = "dropdown" id = "invoicedropdown">		
		    <?php
		    $isql = "SELECT ID, kontorsnamn FROM faktura NATURAL JOIN kontrakt";
		    $iresult = mysqli_query($con, $isql);
		    if (mysqli_num_rows($iresult) != 0) {
			while($irows = mysqli_fetch_assoc($iresult)) {
			    if(isset($_POST['dropdown']) && $irows['ID'] == $_POST['dropdown']){ 
				echo "<option value=".$irows['ID']." selected='selected' >".$irows['kontorsnamn']."</option>";
			    }
			    else{
				echo "<option value=".$irows['ID'].">".$irows['kontorsnamn']."</option>";
			    }
			}
		    }
		    mysqli_free_result($iresult);	
		    ?>	
		    <input type="submit" name = "choicebutton" id = "choicebutton" value="Välj kontrakt">
	    </form>
	    <?php
	    if(isset($_POST["choicebutton"])){
		$isql2 = "SELECT url, namn, datum FROM faktura LEFT OUTER JOIN kontrakt ON kontrakt.ID = faktura.agarid WHERE kontrakt.ID = '".$_POST['dropdown']."' ORDER BY Datum DESC";
		$iresult = mysqli_query($con, $isql2);
		if (mysqli_num_rows($iresult) != 0) {
		    while($irows2 = mysqli_fetch_assoc($iresult)) {
			echo "<a target='_blank' href = '../".$irows2['url']."' ><div id='invoicelistframe'>".$irows2['namn']." ".$irows2['datum']."</div></a>";
		    }
		}
		mysqli_free_result($iresult);
	    }	
	?>	
	</div>
    </div>
</div><!--main-wrapper-->

<?php
defined('THE_FOOTER') || define('THE_FOOTER', TRUE);
require_once("include/footer.php");
?>
</body>
</html>

