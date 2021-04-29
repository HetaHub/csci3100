<?php
$conn = new mysqli("localhost", "root", "", 'comments');

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$comment=htmlspecialchars($_POST['comment']);
 
$sql="insert into comments (comments) values('$comment')";

if ($conn->query($sql) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
  $url = htmlspecialchars($_SERVER['HTTP_REFERER']);
  echo "<br><a href='$url'>Press here to Go Back</a>"; 
?>
