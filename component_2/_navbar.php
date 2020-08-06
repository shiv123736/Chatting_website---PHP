<?php
$show = false;
if(isset($_SESSION['logged_chat'])) {
    $show = true;
}
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark" style="height:auto; postition:fixed;">
    <a class="navbar-brand" href="ichat.php">iChat</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
     <!-- <li class="nav-item">
                <a class="nav-link" href="#" data-toggle="modal" data-target="#friends_modal">Friends</a>
            </li> -->
            
<?php
            if($show) {
                echo '
            
            <li class="nav-item active">
                <a class="nav-link" href="ichat_profile.php">Profile<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="shiv.php">Friends<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="ichat_newbuddy.php">Add new friend</a>
            </li>';
            }
?>
            <!-- <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    Dropdown
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="#">Action</a>
                    <a class="dropdown-item" href="#">Another action</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">Something else here</a>
                </div>
            </li> -->

            <li class="nav-item">
                <a class="nav-link" href="#">Contact</a>
            </li>
        </ul>
        <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-success my-2 my-sm-0" type="submit">Search</button>
        </form>
        <div class="ml-4">
            <!-- <button class="btn btn-outline-success" data-toggle="modal" data-target="#login_modal">Login</button> -->
<?php          
if($show)
echo '<a href="ichat_logout.php" class="btn btn-outline-danger text-danger">Log out</a>';
?>
        </div>
    </div>
</nav>