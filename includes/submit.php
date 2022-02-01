<?php

// Check and see if hit the logout button, if so log them out.
if(isset($_GET['logout'])){
    logout();
}

// Check and see if the user submitted the form on the login page
if (isset($_GET['login'])) {
    
    // If they provided the right username and password then send them to the form, if not show access denied message
    if (isset($_POST["employee_submit"])){
        if (isAuthenticated($_POST["username"], $_POST["password"])) {
            header("location:index.php");
            die;
        }
        else{
            ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert" style="display: none;" id="failedLogin">
                <strong>Incorrect Username/Password!</strong> Please try again.
            </div>
            <script>
                function failedLogin(){
                    document.getElementById('failedLogin').style.display='block';
                }
                failedLogin();
            </script>
            <?php
        }
    }
}
?>