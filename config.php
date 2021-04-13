<?php

$host = "csci3100server.database.windows.net"; 
$user = "csci3100guest"; 
$password = "Csci3100pw"; 
#<<<<<<< HEAD
//$dbname = "Csci3100db";
//=======
$dbname = "csci3100db";
//>>>>>>> a0e4387e944ced7e0f52c69ba424252a1d2e189a

$con = mysqli_connect($host, $user, $password,$dbname);
if (!$con) {
  die("Connection failed: " . mysqli_connect_error());
}
