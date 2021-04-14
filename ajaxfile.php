<?php
include "config.php";

$condition = "1";
if($_GET['func']=="login"){
    if(isset($_GET['username']) && isset($_GET['password'])){
        $condition = " UserName=".$_GET['username']."AND Password=".$_GET['password'];
    }
    $userData = mysqli_query($con,"SELECT * from users WHERE ".$condition);

    $response = array();

    while($row = mysqli_fetch_assoc($userData)){

    $response[] = $row;
    }
}else if ($_GET['func']=="register"){
    if(isset($_GET['username']) && isset($_GET['password'])){
        $condition = "(".$_GET['username'].", ".$_GET['password'].")";
    }
    $userData = mysqli_query($con,"INSERT INTO users (UserName, Password) VALUES ".$condition);
}else if ($_GET['func']=="comment"){
    if(isset($_GET['comment'])){
        $condition = "(".$_GET['password'].")";
    }
    $userData = mysqli_query($con,"INSERT INTO Comments (comments) VALUES ".$condition);
}

echo json_encode($response);
exit;
