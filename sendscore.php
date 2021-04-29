<?php

$conn = new mysqli("localhost", "root", "", 'users');

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$username=$_POST["username"];
$sqls="SELECT * FROM users WHERE UserName='$username'";

$result=$conn->query($sqls);
$row = $result->fetch_assoc();
$sssss=$row["TotalScore"];
$score_this = $_POST["score"];
$score=$score_this+$sssss;
$count=$row["PlayCount"]+1;

$sql="UPDATE users SET TotalScore='$score' WHERE UserName='$username'";
$sql_c="UPDATE users SET PlayCount='$count' WHERE UserName='$username'";
if ($score_this>$row["MaxScore"]){
	$sql_Max="UPDATE users SET MaxScore='$score_this' WHERE UserName='$username'";
	if ($conn->query($sql_Max) === TRUE) {
		setcookie("maxscore", $score_this, time() + (86400 * 30), "/"); // 86400 = 1 day
	}
}

if ($conn->query($sql) === TRUE && $conn->query($sql_c) === TRUE) {
  echo "The total score of Player $username is $score.";
} else {
  echo "<script type='text/javascript'>alert('Error updating record: ' . $conn->error);</script>";
}
setcookie("totalscore", $score, time() + (86400 * 30), "/"); // 86400 = 1 day
setcookie("playcount", $count, time() + (86400 * 30), "/"); // 86400 = 1 day

$conn->close();
?>
