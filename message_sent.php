<?php
session_start();
    $dost="";
    if(isset($_GET['name'])){
        $dost = $_GET['name'];
    }
    $showerror = false;
    $submit_alert = false;
    $receiver_uname = $dost;
    $sender_uname = $_SESSION['ichat_username'];
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $message = "";
        if(!empty($_POST['message'])) {
            include "component_2/_db_connect.php";
            $message = test_input($_POST['message']);
            $sender_uname = $_SESSION['ichat_username'];
            $sql = "INSERT INTO `ichat` (`sender_username`, `receiver_username`, `message`, `date`) VALUES ('$sender_uname', '$receiver_uname', '$message', SYSDATE())";
            $result = $conn->query($sql);
            if($result == true) {
                $submit_alert = true;
                $submit_alert = '<strong> Sucess!</strong> Message sent.';
            }
            else {
            $showerror = true;
            $showerror = '<strong> Failed!</strong> Message not sent.';
            }
        }
        else {
            $showerror = true;
            $showerror = ' Type Message...';
        }
    }
    
    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
?><!doctype html>
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
if(isset($_GET['name'])) {
    echo '
    <form action="message_sent.php?name='.$dost.'" method="post">
        <div class="input-group" id="bottom_msg_bar">
            <input type="text" class="form-control" placeholder="Message..." aria-label="Recipients username"
                aria-describedby="message" name="message">
            <div class="input-group-append">
                <input class="btn btn-outline-primary" type="submit" value="Send">
            </div>
        </div>
    </form>
';
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