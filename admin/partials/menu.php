<link rel="stylesheet" href="../css/admin.css">
<?php
    include '../config/constants.php';
    include 'login-check.php';
?>
<?php
    # Authorization/Access control
    // Check whether the user is logged in or not
?>
<!--Menu Section-->
<div class="menu text-center">
    <div class="wrapper">
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="manage-admin.php">Admin</a></li>
            <li><a href="manage-category.php">Category</a></li>
            <li><a href="manage-food.php">Food</a></li>
            <li><a href="manage-order.php">Order</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </div>
</div>