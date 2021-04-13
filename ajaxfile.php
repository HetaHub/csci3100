<?php
include "config.php";

$condition = "1";
if($_GET['function']=="login"){
    if(isset($_GET['username']) && isset($_GET['password'])){
        $condition = " UserName=".$_GET['username']."AND Password=".$_GET['password'];
    }
    $userData = mysqli_query($con,"select * from csci3100db WHERE ".$condition);

    $response = array();

    while($row = mysqli_fetch_assoc($userData)){

    $response[] = $row;
    }
}else if ($_GET['function']=="register"){
    if(isset($_GET['username']) && isset($_GET['password'])){
        $condition = "(".$_GET['username'].", ".$_GET['password'].")";
    }
    $userData = mysqli_query($con,"insert into csci3100db (UserName, Password) values ".$condition);
}

echo json_encode($response);
exit;
