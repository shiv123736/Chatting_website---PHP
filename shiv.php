<?php
session_start();
if(isset($_SESSION['logged_chat'])) {
  header("location:ichat.php");
}
$login = false;
$showerror = false;
if($_SERVER['REQUEST_METHOD'] == 'POST') {
  include 'component_2/_db_connect.php';
  $username= $password= "";
  if (!empty($_POST["uname"]) && !empty($_POST["pass"]))  {
    $username= strtolower(test_input($_POST['uname']));
    $password= strtolower(test_input($_POST['pass']));
      // $sql = "select * from user where username='$username' AND password='$password'";
      $sql = "select * from user where username='$username'";
      $result= $conn->query($sql);
      if($result->num_rows == 1)  {
        while( $row = $result->fetch_assoc()) {
        //   if( password_verify($password, $row['password'])) {
            if( $password == $row['password']) {
                $login = true;
                session_start();
                $_SESSION['logged_chat'] = true;
                $_SESSION['ichat_username'] = $username;
                $_SESSION['last_time'] = time();
                $sql = "UPDATE `user` SET `status` = 'online' WHERE `user`.`username` = '$username'";
                $result= $conn->query($sql);
                header("location:ichat_profile.php");
          }
          else {
            $showerror = true;
            $showerror = ' Invalid Credentials.';
          }
        }
      }
      else {
        $showerror = true;
        $showerror = ' Invalid Credentials.';
      }
  }
  else { 
    $showeror = true;
    $showerror = ' Fill required details.';
  }
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

    <title>iChat</title>
</head>
<body><?php 
    include "component_2/_navbar.php";
    include "component_2/modal.php";
    if(isset($_SESSION['new_acc_alert'])){
      echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Great!</strong> Account created successfully.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
        </div>';
    }
    if($login) {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Great!</strong> You are logged in.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
        </div>';
    }
    if($showerror) {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>opps!</strong>' .$showerror.' 
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
        </div>';
    }?>
     <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
            <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="https://source.unsplash.com/1024x400/?friend" class="d-block w-100" alt="..."
                    id="slider_image">
                <div class="carousel-caption d-none d-md-block">
                    <h5>– Winnie the Pooh</h5>
                    <p>“If you live to be 100, I hope I live to be 100 minus 1 day, so I never have to live without
                        you.”</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="https://source.unsplash.com/1024x400/?best friend" class="d-block w-100" alt="..."
                    id="slider_image">
                <div class="carousel-caption d-none d-md-block">
                    <h5>– David Tyson</h5>
                    <p>“True friendship comes when the silence between two people is comfortable.”</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="https://source.unsplash.com/1024x400/?friendship" class="d-block w-100" alt="..."
                    id="slider_image">
                <div class="carousel-caption d-none d-md-block">
                    <h5>– Oscar Wilde</h5>
                    <p>“Ultimately the bond of all companionship, whether in marriage or in friendship, is
                        conversation.”</p>
                </div>
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
    <div class="container py-4">
        <div class="jumbotron">
            <h1 class="display-4">Hello, Welcome Back to iChat</h1>
            <p class="lead">Make more Conversation, Make more Friends</p>
            <hr class="my-4">
            <p>If You are Existing User then Login to your account or Create an account first.</p>
            <button class="btn btn-outline-success" data-toggle="modal" data-target="#login_modal">Login</button>
            <a href="ichat_signup.php" class="btn btn-outline-primary ">Signup</a>
            <!-- <a class="btn btn-primary btn-lg" href="ichat.php" role="button"></a> -->
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