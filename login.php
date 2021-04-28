<?php
$conn = new mysqli("localhost", "root", "", 'users');

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$username=$_POST['username'];
$password=$_POST['password'];
 
$sql="select * from users where UserName='$username' AND Password='$password'";

$result=mysqli_query($link,$sql);
if($result->num_rows!=0){
	echo 'Login in sucess';
}else{
	echo 'Wrong username or password!';
}
mysqli_close($link);
$url = htmlspecialchars($_SERVER['HTTP_REFERER']);
echo "<br><a href='$url'>Press here to Go Back</a>"; 
?>
