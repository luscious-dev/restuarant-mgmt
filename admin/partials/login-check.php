<?php
    # If a user session is not set, then the user is not logged in
    if(!isset($_SESSION['user'])){
        # Redirect to the login page
        $_SESSION['no-login-message'] = "<p class='error'>Please login to access Admin panel</p>";

        header("location:".SITEURL."admin/login.php");
    }
?>