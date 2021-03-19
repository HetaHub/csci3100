<?php
include "config.php";

$condition = "1";
if($_GET['function']=="login"){
    if(isset($_GET['username']) && isset($_GET['password'])){
        $condition = " username=".$_GET['username']."AND password=".$_GET['password'];
    }
    $userData = mysqli_query($con,"select * from user WHERE ".$condition);

    $response = array();

    while($row = mysqli_fetch_assoc($userData)){

    $response[] = $row;
    }
}else if ($_GET['function']=="register"){
    if(isset($_GET['username']) && isset($_GET['password'])){
        $condition = "(".$_GET['username'].", ".$_GET['password'].")";
    }
    $userData = mysqli_query($con,"insert into user (username, password) values ".$condition);
}

echo json_encode($response);
exit;