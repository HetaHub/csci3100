<?php
include "config.php";

$condition = "1";
if($_GET['func']=="login"){
    if(isset($_GET['username']) && isset($_GET['password'])){
        $condition = " UserName=".$_GET['username']."AND Password=".$_GET['password'];
    }
    $userData = mysqli_query($con,"select * from users WHERE ".$condition);

    $response = array();

    while($row = mysqli_fetch_assoc($userData)){

    $response[] = $row;
    }
}else if ($_GET['func']=="register"){
    if(isset($_GET['username']) && isset($_GET['password'])){
        $condition = "(".$_GET['username'].", ".$_GET['password'].")";
    }
    $userData = mysqli_query($con,"insert into users (UserName, Password) values ".$condition);
}else if ($_GET['func']=="comment"){
    if(isset($_GET['comment'])){
        $condition = "(".$_GET['password'].")";
    }
    $userData = mysqli_query($con,"insert into users (comments) values ".$condition);
}

echo json_encode($response);
exit;
