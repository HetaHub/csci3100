<?php
//Check whether the repeated password is the same as the password input
if(trim($_POST['password'])!=trim($_POST['rpwd']))
{
	echo "Wrong repeated Password";
	$url = htmlspecialchars($_SERVER['HTTP_REFERER']);
	echo "<br><a href='$url'>Press here to Go Back</a>"; 
	exit;
}

//Connect to database comments and report if cannot connect to database
$conn = new mysqli("localhost", "root", "", 'users');
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

//Get the input username and password
$username=$_POST['username'];
$password=$_POST['password'];

//Select and check whether the input username has been used before with the database and return whether it is success or not.
$sql_check="select * from users where UserName='$username'";
$result=mysqli_query($conn,$sql_check);
if($result->num_rows!=0){
	//if the username is used before, close the database connection, show the message and provide the button for returning to the previous page
	$conn->close();
	echo 'This username has been used.';
	$url = htmlspecialchars($_SERVER['HTTP_REFERER']);
	echo "<br><a href='$url'>Press here to Go Back and name a new one.</a>"; 
	exit;
}

//if the username is not used, insert the user info into the database and return whether it is success or not.
$sql="insert into users (UserName, Password) values('$username','$password')";
if ($conn->query($sql) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

//Close the database connection
$conn->close();
//Button for returning to the previous page
$url = htmlspecialchars($_SERVER['HTTP_REFERER']);
echo "<br><a href='$url'>Press here to Go Back</a>"; 
?>
