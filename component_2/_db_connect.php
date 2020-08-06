<?php
//connect to data base
$servername="localhost";
$username="root";
$password="";
$database="ichat";
$conn = new mysqli($servername, $username, $password, $database);
// if($conn->connect_error)
//     die("failed" .$conn->error());
// else
//     echo "success"  ;