<?php
defined('THE_DB') or die("include DB");
$db="mobowdb";
$usr="root";
$host="localhost";
$pass="";
$con = mysqli_connect($host,$usr,$pass,$db) or die("Error: " . mysqli_error($con));
mysqli_set_charset($con, 'utf8');
mysqli_select_db($con, 'mobowdb');
?>