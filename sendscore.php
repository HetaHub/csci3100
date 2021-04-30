<?php
//Connect to database comments and report if cannot connect to database
$conn = new mysqli("localhost", "root", "", 'users');
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

//Get the username and get the record from the database
$username=$_POST["username"];
$sqls="SELECT * FROM users WHERE UserName='$username'";

$result=$conn->query($sqls);
$row = $result->fetch_assoc();
//Get the original total score of the user
$sssss=$row["TotalScore"];
//Get the score of this game attempt
$score_this = $_POST["score"];
//Add them up
$score=$score_this+$sssss;
//Add the play count by 1
$count=$row["PlayCount"]+1;

//Update the total score and play count to the database
$sql="UPDATE users SET TotalScore='$score' WHERE UserName='$username'";
$sql_c="UPDATE users SET PlayCount='$count' WHERE UserName='$username'";
if ($conn->query($sql) === TRUE && $conn->query($sql_c) === TRUE) {
  echo "The total score of Player $username is $score.";
} else {
  echo "Error updating record: ' . $conn->error";
}
//Update the cookies of the total score and play count
setcookie("totalscore", $score, time() + (86400 * 30), "/"); // 86400 = 1 day
setcookie("playcount", $count, time() + (86400 * 30), "/"); // 86400 = 1 day

//Check if the score of this game attempt is the highest, if yes then update the max score to the database
if ($score_this>$row["MaxScore"]){
	$sql_Max="UPDATE users SET MaxScore='$score_this' WHERE UserName='$username'";
	if ($conn->query($sql_Max) === TRUE) {
		//Also update the cookie of the max score
		setcookie("maxscore", $score_this, time() + (86400 * 30), "/"); // 86400 = 1 day
	}
}

//Close the database connection
$conn->close();
?>
