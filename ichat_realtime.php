<?php
session_start();
if(!isset($_SESSION['logged_chat'])) {
    header("location:shiv.php");
    exit;
}
if(isset($_GET['name'])){
    $dost = $_GET['name'];
}
    $status = "";
    $not_found = false;
    // $receiver_uname = $_SESSION['friend'];
    $receiver_uname = $dost;
    $sender_uname = $_SESSION['ichat_username'];
 
    include "component_2/_db_connect.php";
    $sql = "select * from user_friends where username='$sender_uname' AND friend_username='$receiver_uname'";
    $result = $conn->query($sql);
    if($result->num_rows == 0) {
        $not_found = true;
    }
    else {
        $sql = "select status from user where username = '$receiver_uname'";
                $result = $conn->query($sql);
                if($result->num_rows == 1) {
                    $row = $result->fetch_assoc();
                    $GLOBALS["status"] = $row['status'];
                }
                $conn->close();
    }
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- <meta http-equiv="refresh" content="3"> -->
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
        integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js">
    </script>
    <title>iChat</title>
</head>

<body>
    <?php
    if(!$not_found) {     
    echo '</div>
                <div class="intro">
                    <div class="media p-2 bg-dark text-light">
                        <img src="images/icon/icon_sender.png" class="mr-3" alt="..." width="36px">
                            <div class="media-body">
                                <h5 class="mt-0">'.$receiver_uname.'</h5>
                                <small id="emailHelp" class="form-text text-success">'.$GLOBALS["status"].'</small>
                            </div>
                    </div>
                </div>
            </div>';
    }
    if($not_found) {
        echo'<div class="jumbotron jumbotron-fluid">
                <div class="container">
                    <h1 class="display-4">No Friend Found</h1>
                    <p class="lead">Please Add him/her as a friend</p>
                </div>
            </div>';
    }   
if(!$not_found) {
                include "component_2/_db_connect.php";
                $sql = "select * from ichat where (sender_username='$sender_uname' AND receiver_username='$receiver_uname') OR (sender_username='$receiver_uname' AND receiver_username='$sender_uname') order by sno DESC";
                $result = $conn->query($sql);
                if( $result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        $sender_username = $row['sender_username'];
                        $receiver_username = $row['receiver_username'];
                        $message_content = $row['message']; 
                        $date = $row['date']; 
                        $time = substr($date,11,5);
                         
                        if($sender_username == $sender_uname AND $receiver_username == $receiver_uname) { 
                        echo  '                      
                                        <div class="media p-2" style="background-color: white;">
                                            <small id="emailHelp" class="form-text text-muted">'.$time.'</small>
                                            <div class="media-body text-right ">
                                                <h5 class="mt-0 mb-1">'.$sender_uname.'</h5>
                                                <p>'.$message_content.'</p>
                                            </div>
                                            <img src="images/icon/icon_sender.png" class="ml-3" alt="..." width="36px">
                                        </div>';
                        }
                        else if($sender_username == $receiver_uname AND $receiver_username == $sender_uname) {
                        
                        echo  ' <div class="media p-2" style="background-color: whitesmoke;">
                                    <img class="mr-3" src="images/icon/icon_receiver.png" alt="" width="36px">
                                    <div class="media-body">
                                        <h5 class="mt-0">'.$receiver_uname.'</h5>
                                        <p>'.$message_content.'</p>
                                    </div>
                                    <small id="emailHelp" class="form-text text-muted">'.$time.'</small>
                                </div>
                                ';                   
                        }                    
                    }                    
                }
            }
?>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"
        integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous">
    </script>
</body>

</html>