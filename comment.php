<?php
//Connect to database comments
$conn = new mysqli("localhost", "root", "", 'comments');

//Report if cannot connect to database
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

//Get the input comment
$comment=htmlspecialchars($_POST['comment']);

//Insert the comment to the database and return whether insertion is success or not.
$sql="insert into comments (comments) values('$comment')";
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
