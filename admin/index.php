<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../css/admin.css">
    <title>Restaurant Website</title>

</head>
<body>
<!-- Menu Section Start-->
<?php include "./partials/menu.php"; ?>
<!--Menu Section End-->

<!--Main Content Section Start-->
<div class="main-content">
    <div class="wrapper">
        <h1>Dashboard</h1>
        <?php
        if(isset($_SESSION['login'])){
            echo $_SESSION['login'];
            unset($_SESSION['login']);
        }
        ?>
        <div class="col-4 text-center">
            <h1>5</h1>
            <br>
            Categories
        </div>
        <div class="col-4 text-center">
            <h1>5</h1>
            <br>
            Categories
        </div>
        <div class="col-4 text-center">
            <h1>5</h1>
            <br>
            Categories
        </div>
        <div class="col-4 text-center">
            <h1>5</h1>
            <br>
            Categories
        </div>
        <div class="clearfix"></div>
    </div>
</div>
<!--Main Content Section End-->

<!--Footer Section Starts-->
<?php include "./partials/footer.php"; ?>
<!--Footer Section Ends-->
</body>
</html>