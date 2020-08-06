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
    $dost="";
    if(isset($_GET['name'])){
        $dost = $_GET['name'];
    }
    $showerror = false;
    $submit_alert = false;
    $receiver_uname = $dost;
    $sender_uname = $_SESSION['ichat_username'];
if(isset($_POST['remove_friend'])){
    include 'component_2/_db_connect.php';
    $remove_friend = $_GET['remove'];
    $sql = "DELETE FROM `user_friends` WHERE username = '$sender_uname' AND friend_username = '$remove_friend'";
    $result = $conn->query($sql);
    if( $result == true ) {
        $sql_1 = "DELETE FROM `user_friends` WHERE username = '$remove_friend' AND friend_username = '$sender_uname'";
        $result_1 = $conn->query($sql_1);
        if( $result_1 == true ) {
            $submit_alert = true;
            $submit_alert = ' Remove as a friend successfully.';
        }
    }
    else {
        $showerror = true;
        $showerror = ' Sorry, There is some technical issue';
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
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script> -->
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <title>iChat</title>
    <style>
    body,
    html {
        height: 100%;
        box-sizing: border-box;
        margin: 0;
        padding: 0;
    }

    .chat {
        max-height: 100vh;
    }

    #bottom_msg_bar {
        padding: 10px 10px;
        position: fixed;
        bottom: 0px;
        left: 0px;
    }

    #frame {
        /* max-height: 88vh; */
        position: fixed; 
         bottom: 0px;
        left: 0px;
        height: 50px;
        /* overflow: hidden; */
    }

    .content {
        max-height: 79vh;
        overflow: auto;
    }
    </style>
</head>

<body>
    <?php 
    include "component_2/_navbar.php";
    include "component_2/modal.php";
    if($showerror)
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        '. $showerror. '
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>';

    if($submit_alert)
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        '. $submit_alert. '
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>';
?>

    <div class="container chat px-0">
        <?php
    if(!isset($_GET['name'])) {
        echo '<div class="jumbotron jumbotron-fluid">
        <div class="container">
          <h1 class="display-4">Your Friends List</h1>
        </div>
      </div>';
        include "component_2/_db_connect.php";
            $sql = "select sno, friend_username from user_friends where username = '$sender_uname' AND status=1";
            $result = $conn->query($sql);
            if($result->num_rows > 0) {
                echo '<div class="list-group">';
               while($row = $result->fetch_assoc()) {
                   $friend = $row['friend_username'];
                   $id = $row['sno'];
                //    $_SESSION['dost'] = $friend;
                   echo '<a href="'.htmlspecialchars($_SERVER["PHP_SELF"]).'?name='.$friend.'" class="list-group-item list-group-item-action">'.$friend.'<form action="'.htmlspecialchars($_SERVER["PHP_SELF"]).'?remove='.$friend.'" method="post"><button type="submit" class="btn btn-warning" style="position:absolute; right:2%;top:10%;" name="remove_friend" id"friend_remove">Remove</button></form></a>';
               }
               echo '</div>';
            }
            $conn->close();
    }
if(isset($_GET['name'])) {
    echo ' <div class="content" style="background-color: #eee;" id="auto"></div>
    <div class="embed-responsive embed-responsive-21by9" id="frame">
  <iframe class="embed-responsive-item" src="message_sent.php?name='.$dost.'"></iframe>
</div>';
    }
?>
    </div>




    <!-- input message  -->

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script
  src="https://code.jquery.com/jquery-3.5.1.min.js"
  integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
  crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"
        integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous">
    </script>
    <script>
    // $(document).ready(function() {
    //     $("button").click(function() {
    //         $('#maaf').scrollTop($(document).height());
    //     });
    // });
    // window.onload = function() {
    //     var ele = document.getElementById('auto_click').click();
    //     console.log('working');
    //     $(document).ready(function() {
    //         $(document).scrollTop($(document).height());
    //     });
    // }
    // window.onload = function() {
    //     var button = document.getElementById('auto_click');
    //         button.click(); // this will make it click again every 1000 miliseconds
    // };

    // $(document).ready(function() {
    //     $("button").click(function() {
    //         $(document).scrollTop($(document).height());
    //     });
    // });
    

    function loadDoc() {
        setInterval(() => {
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("auto").innerHTML = this.responseText;
                }
            };
            xhttp.open("GET", "ichat_realtime.php?name=<?php echo $dost;?>", true);
            xhttp.send();
        }, 1000);

    }
    loadDoc();
    </script>
</body>

</html>