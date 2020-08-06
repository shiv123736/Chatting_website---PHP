<?php
session_start();
if(!isset($_SESSION['logged_chat'])) {
    header("location:shiv.php");
    exit;
}
else {
    if((time()-$_SESSION['last_time']) > 120 ) {
      header("location:ichat_logout.php");
    }
    else
        $_SESSION['last_time'] = time();
}
$found = false;
$showerror = false;
$friend = "";
$sender_uname = $_SESSION['ichat_username'];
// if($_SERVER['REQUEST_METHOD'] == 'POST') {
if(isset($_POST['search'])) {
    include 'component_2/_db_connect.php';
    $new_friend = "";
    $new_friend = test_input($_POST['new_friend']);
    if( $new_friend != $sender_uname ) {   
        if (!empty($new_friend))  {
            $sql = "select * from user where username='$new_friend'";
            $result= $conn->query($sql);
            if($result->num_rows == 1)  {
                $row = $result->fetch_assoc();
                $friend = $row['username'];
                $found = false;
                $found = ' Given Username is found, Add him/her as new friend.';
            }
            else {
                $showerror = true;
                $showerror = ' Username is not found, Plese ask him/her username.';
            }
        }
        else { 
            $showeror = true;
            $showerror = ' Fill username.';
        }
        $conn->close();
    }
    else {
        $showeror = true;
            $showerror = ' Sorry, We cannot send friend request to this username.';
    }
}

if(isset($_POST['add_friend'])) {
    include 'component_2/_db_connect.php';
    $friend = $_GET['name'];
    $sql_1 = "select * from `user_friends` where (username='$sender_uname' AND friend_username = '$friend')";
    $result_1= $conn->query($sql_1);
    if($result_1->num_rows == 1)  {
        $showerror = true;
        $showerror = ' Friend Request already sent';
    }
    else {
        $sql_2 = "INSERT INTO `user_friends` (`username`, `friend_username`, `status`) VALUES ('$sender_uname', '$friend', '0')";
        $result_2= $conn->query($sql_2);
        if($result_2 == true)  {
            $found = true;
            $found = 'Friend Request Sent';
        }
        else
            $showeror = true;    
    } 
    $conn->close();
}
if(isset($_POST['accept_request'])) {
    include 'component_2/_db_connect.php';
    $friend_request = $_GET['name'];
        $sql = "INSERT INTO `user_friends` (`username`, `friend_username`, `status`) VALUES ('$sender_uname', '$friend_request', '1')";
        $result= $conn->query($sql);
        if($result == true)  {
            $sql = "update user_friends set status=1 where username='$friend_request' AND friend_username='$sender_uname'";
            $result= $conn->query($sql);
            if($result == true)  {
                $found = true;
                $found = " $sender_uname and $friend_request are friends now.";
            }             
        } 
        else{
            $showeror = true;
            $showeror = ' Sorry, There is technical problem'; 
        }  
    $conn->close();
}
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
        integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <title>Add new friend</title>
</head>

<body>
    <?php 
        include "component_2/_navbar.php";
    if($showerror)
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        '. $showerror. '
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>';

    if($found)
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        '. $found. '
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>';
?>
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="jumbotron jumbotron-fluid">
                    <div class="container">
                        <h1 class="display-4">Add more New Friend</h1>
                        <p class="lead">Please first ask him/her for username and Make Your Group Large</p>
                    </div>
                </div>

                <form action="ichat_newbuddy.php" method="post">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">@</span>
                        </div>
                        <input type="text" name="new_friend" class="form-control" placeholder="Your Friend Username" style="text-transform: lowercase;" aria-label="Your Friend Username" aria-describedby="button-addon2">
                        <div class="input-group-append">
                            <button class="btn btn-outline-success" type="submit" id="button-addon2"
                                name="search">Search</button>
                        </div>
                    </div>
                </form>
                <?php
    if($found) {
        echo '<ul class="list-group list-inline">
        <a href="#" class="list-group-item list-group-item-action">'.$friend.'<form action="ichat_newbuddy.php?name='.$friend.'" method="post"><button type="submit" class="btn btn-warning" style="position:absolute; right:2%;top:10%;" name="add_friend">Add Friend</button></form></a>
            </ul>';
    }
?>
            </div>
            <div class="col-md-3">
                <div class="jumbotron jumbotron-fluid">
                    <div class="container">
                        <p class="lead">Friend Requests :</p>
                    </div>
                </div>
                <?php
                 include 'component_2/_db_connect.php';
                 $sql_1 = "select * from user_friends where friend_username='$sender_uname' AND status=0";
                 $result_1= $conn->query($sql_1);
                 if($result_1->num_rows > 0)  {
                     while( $row = $result_1->fetch_assoc()) {
                         $friend_request = $row['username'];
                         echo ' <div class="media my-4">
                         <img class="mr-3" src="images/icon/icon_receiver.png" alt="Generic placeholder image" width="36px">
                         <div class="media-body">
                             <p class="mt-0">'.$friend_request.'</p>
                             <form action="ichat_newbuddy.php?name='.$friend_request.'" method="post">
                                 <button type="submit" class="btn btn-primary" name="accept_request">accept</button>
                             </form>
                         </div>
                     </div>';
                     } 
                     $conn->close();               
                 }
                 else
                     echo '<p class="mt-0">No Friend Request Received.</p>';
                ?>
            </div>
        </div>



    </div>

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