<?php 
session_start();
include 'component_2/_db_connect.php';
$username = $_SESSION['ichat_username'];
date_default_timezone_set("asia/kolkata");
$time = date("g:i a");
$sql = "UPDATE `user` SET `status` = 'offline on $time' WHERE `user`.`username` = '$username'";
$result= $conn->query($sql);
session_unset();
session_destroy();
header("location:shiv.php");
exit;