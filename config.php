<?php

$host = "localhost"; 
$user = "root"; 
$password = ""; 
#<<<<<<< HEAD
//$dbname = "Csci3100db";
//=======
$dbname = "users";
//>>>>>>> a0e4387e944ced7e0f52c69ba424252a1d2e189a

$con = mysqli_connect($host, $user, $password,$dbname);
if (!$con) {
  die("Connection failed: " . mysqli_connect_error());
}
