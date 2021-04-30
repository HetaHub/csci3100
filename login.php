<?php
//Connect to database comments and report if cannot connect to database
$link = mysqli_connect("localhost", "root", "", 'users') 
		or die ('connect fault' . mysqli_error());

//Get the input username and password
$username=$_POST['username'];
$password=$_POST['password'];

//Select and check the input username and password with the database and return whether it is success or not.
$sql="select * from users where UserName='$username' AND Password='$password'";
$result=mysqli_query($link,$sql);
if($result->num_rows!=0){
	//if success, add the data to cookies
	$cookie_name = "username";
	$cookie_value = "$username";
	setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day
	$result -> free_result();
	$sql_ts = "SELECT * FROM users WHERE UserName='$username'";
	$result = $link->query($sql_ts);
	$row = $result->fetch_assoc();
	setcookie("totalscore", $row["TotalScore"], time() + (86400 * 30), "/"); // 86400 = 1 day
	setcookie("maxscore", $row["MaxScore"], time() + (86400 * 30), "/"); // 86400 = 1 day
	setcookie("playcount", $row["PlayCount"], time() + (86400 * 30), "/"); // 86400 = 1 day
	echo 'Login success';
}else{
	echo 'Wrong username or password!';
}

//Close the database connection
mysqli_close($link);
//Button for returning to the previous page
$url = htmlspecialchars($_SERVER['HTTP_REFERER']);
echo "<br><a href='$url'>Press here to Go Back</a>"; 
?>
