<?php
defined('THE_DB') or die();
$db="mobowdb";
$usr="root";
$host="localhost";
$con = mysqli_connect($host,$usr,"",$db) or die("Error: " . mysqli_error($con));
?>