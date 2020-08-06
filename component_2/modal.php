<!-- LOGIN Modal -->
<div class="modal fade" id="login_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Log in</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                    <div class="form-group">
                        <label for="uname">Username</label>
                        <input type="text" class="form-control" id="uname" name="uname" aria-describedby="emailHelp" style="text-transform: lowercase;">
                    </div>
                    <div class="form-group">
                        <label for="pass">Password</label>
                        <input type="password" class="form-control" id="pass" name="pass" style="text-transform: lowercase;">
                        <small id="emailHelp" class="form-text text-muted">We'll never share your password with anyone
                            else.</small>
                    </div>
                    <button type="submit" class="btn btn-primary">Move to chat</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Signup Modal -->
<div class="modal fade" id="signup_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Sign up</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
                    <div class="form-group">
                        <label for="uname">Username</label>
                        <input type="text" class="form-control" id="uname" name="uname" aria-describedby="emailHelp">
                        <small id="emailHelp" class="form-text text-muted">Unique username</small>
                    </div>
                    <div class="form-group">
                        <label for="pass">Password</label>
                        <input type="password" class="form-control" id="pass" name="pass">
                        <small id="emailHelp" class="form-text text-muted">We'll never share your username with anyone
                            else.</small>
                    </div>
                    <div class="form-group">
                        <label for="pass">Confirm Password</label>
                        <input type="password" class="form-control" id="conn_pass" name="con_pass">
                    </div>
                    <div class="form-group">
                        <label for="fname">Friend name</label>
                        <input type="text" class="form-control" id="fname" name="fname" aria-describedby="emailHelp">
                    </div>
                    <button type="submit" class="btn btn-primary">Sign up</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- friend list Modal -->
<div class="modal fade" id="friends_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Your Friends List</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">


                <div class="list-group">
                    <a href="chat.php?name=yash" class="list-group-item list-group-item-action active">yash</a>
                    <a href="chat.php?name=raju" class="list-group-item list-group-item-action">raju</a>
                    <a href="#" class="list-group-item list-group-item-action">Morbi leo risus</a>
                    <a href="#" class="list-group-item list-group-item-action">Porta ac consectetur ac</a>
                    <a href="#" class="list-group-item list-group-item-action disabled" tabindex="-1"
                        aria-disabled="true">Vestibulum at eros</a>
                </div>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>