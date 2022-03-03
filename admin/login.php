<?php
include "../config/constants.php";
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../css/admin.css">
    <title>Login - Food Order System</title>
</head>
<body>
    <div class="login">
        <h1 class="text-center">Login</h1>
        <?php
            if(isset($_SESSION['login'])){
                echo $_SESSION['login'];
                unset($_SESSION['login']);
            }
        if(isset($_SESSION['no-login-message'])){
            echo $_SESSION['no-login-message'];
            unset($_SESSION['no-login-message']);
        }
        ?>
        <!--    Login Form Starts    -->
        <form action="" method="post">
            <label for="username">Username: <input placeholder="Enter Username" type="text" id="username" name="username"></label>
            <label for="password">Password: <input placeholder="Enter Password" type="password" id="password" name="password"></label>
            <input class="btn btn-primary" name="submit" type="submit" value="Login">
        </form>
        <!--    Login Form Ends    -->
        <p class="text-center">Created By <a href="github.com/luscious-dev">Olawale</a></p>
    </div>
</body>
</html>

<?php


    if(isset($_POST['submit'])){
        $username = $_POST['username'];
        $password = md5($_POST['password']);

        $sql = "SELECT * FROM tbl_admin WHERE username='$username'";
        $res = mysqli_query($conn,$sql);

        $count = mysqli_num_rows($res);
        if($count==1){
            $correct_password=mysqli_fetch_assoc($res)['password'];
            if($correct_password == $password){
                $_SESSION['login'] = "<p class='success'>Login Successful</p>";

                # This value will be unset/removed on log out.
                # The code to enforce authorization will be added in the menu file because it is used in every file
                $_SESSION['user'] = $username;
                header('location:'.SITEURL.'admin/index.php');
            }
            else{
                $_SESSION['login'] = "<p class='error'>Incorrect Password</p>";
                header('location:'.SITEURL.'admin/login.php');
            }
        }
        else{
            $_SESSION['login'] = "<p class='error'>Incorrect Username</p>";
        }
    }
?>