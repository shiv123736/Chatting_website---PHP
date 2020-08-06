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
if(isset($_GET['name'])){
    $dost = $_GET['name'];
}
    $status = "";
    $not_found = false;
    // $receiver_uname = $_SESSION['friend'];
    $sender_uname = $_SESSION['ichat_username'];
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
    <style>
    body,
    html {
        height: 100%;
    }

    #slider_image {
        height: 400px;
    }

    @media screen and (max-width: 900px) {
        #slider_image {
            height: auto;
        }
    }

    @media screen and (max-width: 500px) {
        #slider_image {
            height: auto;
        }
    }
    </style>
</head>


<body>
    <?php 
    include "component_2/_navbar.php";
    include "component_2/modal.php";
?>
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
            <h1 class="display-4">Hello, <?php echo $sender_uname;?></h1>
            <p class="lead">Welcome to your profile</p>
            <hr class="my-4">
            <p>Make a great first impression. People crave attention. They want to feel like you actually care about them. Make them feel special - <strong>iChat Team.</strong></p>
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