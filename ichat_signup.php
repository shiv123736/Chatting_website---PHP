<?php
$signup = false;
$showerror = false;
if($_SERVER['REQUEST_METHOD'] == 'POST') {
  include 'component_2/_db_connect.php';
  $username = $password = $con_password = "";
if (!empty($_POST["uname"]) && !empty($_POST["pass"]) && !empty($_POST["con_pass"]))  {
        $username= strtolower(test_input($_POST['uname']));
        $password= strtolower(test_input($_POST['pass']));
        $con_password= test_input($_POST['con_pass']);
        if($password == $con_password){
            $sql = "select * from user where username='$username'";
            $result= $conn->query($sql);
            if($result->num_rows == 1)  {
                $showerror = true;
                $showerror = ' Choose another username.';
            }
            else {
                $sql = "INSERT INTO `user` (`username`, `password`, `date`) VALUES ('$username', '$password', SYSDATE());";
                $result= $conn->query($sql);
                $signup = true;
                $signup = ' Account has been created successfully';
                session_start();
                $_SESSION['new_acc_alert'] = true;
                header("location:shiv.php");
            }
        }
        else {
            $showerror = true;
            $showerror = ' Password do not match';
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

<body>
<?php 
    include "component_2/_navbar.php";
    include "component_2/modal.php";
    if($signup) {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Great!</strong> '.$signup.'.
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
    }
    
?><div class="container">
<?php
    if(!isset($_GET['access'])) {
    echo '
        <div class="jumbotron">
            <h1 class="display-4">Hello, Welcome to iChat</h1>
            <p class="lead">This is a simple Chat Application</p>
            <hr class="my-4">
            <p>A good conversation starter can transform an awkward, stilted conversation into an interesting, enjoyable discussion. That important in sales, as having several conversation starters up your sleeve will help you form connections with prospects, referrals, and potential partners.</p>
            <!-- <a class="btn btn-primary btn-lg" href="ichat.php" role="button"></a> -->
            <p class="lead">New User ? If already have an account then Log in</p>
            <a href="ichat_signup.php?access=signup" class="btn btn-outline-primary text-primary" >Signup</a>
            <a href="shiv.php" class="btn btn-outline-success ">Log in</a>
        </div>';
    }
    if(isset($_GET['access'])) {
        echo '            
        <form action="ichat_signup.php?access=signup" method="post">
        <div class="form-group my-4">
            <label for="uname">Username</label>
            <input type="text" class="form-control" id="uname" name="uname" aria-describedby="emailHelp" style="text-transform: lowercase;">
            <small id="emailHelp" class="form-text text-muted">Unique username</small>
        </div>
        <div class="form-group">
            <label for="pass">Password</label>
            <input type="password" class="form-control" id="pass" name="pass">
            <small id="emailHelp" class="form-text text-muted">We will never share your username with anyone
                else.</small>
        </div>
        <div class="form-group">
            <label for="pass">Confirm Password</label>
            <input type="password" class="form-control" id="conn_pass" name="con_pass">
        </div>
        <button type="submit" class="btn btn-primary">Sign up</button>
        <a href="'.htmlspecialchars($_SERVER["PHP_SELF"]).'" class="btn btn-danger">Cancel</a>
    </form>';
    
    }
?>
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