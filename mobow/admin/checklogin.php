<?php
if($_SERVER["REQUEST_METHOD"] == "POST") {
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mobowdb";

// Create connection
 $conn = mysqli_connect($servername, $username, $password, $dbname);
 // Check connection
 if (!$conn) {
     die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT  anvnamn, losen 
		FROM kontaktperson 
		WHERE anvnamn LIKE '".$_POST['username']."' AND losen LIKE '".$_POST['password']."'"; 


$result = $conn->query($sql); 

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        header('Location: report.php');   
    }
} else {
    echo "<p>Fel användarnamn eller lösenord!!</p>";
}

mysqli_close($conn);

}
?>