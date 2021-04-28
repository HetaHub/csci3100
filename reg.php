<?php
if(trim($_POST['password'])!=trim($_POST['rpwd']))
{
	echo "Wrong repeated Password";
	$url = htmlspecialchars($_SERVER['HTTP_REFERER']);
	echo "<br><a href='$url'>Press here to Go Back</a>"; 
	exit;
}

$conn = new mysqli("localhost", "root", "", 'users');

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$username=$_POST['username'];
$password=$_POST['password'];
 
$sql="insert into users (UserName, Password) values('$username','$password')";

if ($conn->query($sql) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
  $url = htmlspecialchars($_SERVER['HTTP_REFERER']);
  echo "<br><a href='$url'>Press here to Go Back</a>"; 
?>