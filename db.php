<?php
defined('THE_DB') or die("include DB");
$db="mobowdb";
$usr="root";
$host="localhost";
$con = mysqli_connect($host,$usr,"",$db) or die("Error: " . mysqli_error($con));
mysqli_select_db($con, 'mobowdb');
?>