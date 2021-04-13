<?php

$host = "csci3100server.database.windows.net"; 
$user = "csci3100admin"; 
$password = "Csci3100pw"; 
$dbname = "csci3100db"; 

$con = mysqli_connect($host, $user, $password,$dbname);
if (!$con) {
  die("Connection failed: " . mysqli_connect_error());
}
