<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../css/admin.css">
    <title>Admin</title>
</head>
<body>
<!-- Menu Section Start-->
<?php include "./partials/menu.php"; ?>
<!--Menu Section End-->

<!--Main Content Section Start-->
<div class="main-content">
    <div class="wrapper">
        <h1>Manage Admin</h1>
        <br>
        <?php
            if (isset($_SESSION['add'])) {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }
            if(isset($_SESSION['delete'])){
                echo $_SESSION['delete'];
                unset($_SESSION['delete']);
            }
            if(isset($_SESSION['updated'])){
                echo $_SESSION['updated'];
                unset($_SESSION['updated']);
            }
            if(isset($_SESSION['password-not-matched'])){
                echo $_SESSION['password-not-matched'];
                unset($_SESSION['password-not-matched']);
            }
            if(isset($_SESSION['user-not-found'])){
                echo $_SESSION['user-not-found'];
                unset($_SESSION['user-not-found']);
            }
            if(isset($_SESSION['password-changed'])){
                echo $_SESSION['password-changed'];
                unset($_SESSION['password-changed']);
            }

        ?>
        <!--        Button to Add Admin-->
        <a href="add-admin.php" class="btn btn-primary">Add Admin</a>

        <table class="tbl-full">
            <tr>
                <th>S.N.</th>
                <th>Full Name</th>
                <th>Username</th>
                <th>Actions</th>
            </tr>
            <?php
            # Query to get all admin
            $sql = "SELECT * FROM tbl_admin";
            # Execute Query
            $res = mysqli_query($conn, $sql);

            if ($res == True) {
                # Count rows to check if we have data in the database
                $count = mysqli_num_rows($res);
                $sn = 1; # create a variable and assign it as 1

                if ($count > 0) {
                    # We have data in the database
                    while ($rows = mysqli_fetch_assoc($res)) {
                        $id = $rows['id'];
                        $full_name = $rows['full_name'];
                        $username = $rows['username'];

                        ?>
                        <tr>
                            <td><?php echo $sn++ ?></td>
                            <td><?php echo $full_name ?></td>
                            <td><?php echo $username ?></td>
                            <td>
                                <a href="<?php echo SITEURL."admin/update-password.php?id=$id" ?>" class="btn-primary btn-action">Update Password</a>
                                <a href="<?php echo SITEURL."admin/update-admin.php?id=$id" ?>" class="btn-secondary btn-action">Update Admin</a>
                                <a href="<?php echo SITEURL."/admin/delete-admin.php?id=$id&name=$username" ?>" class="btn-danger btn-action">Delete Admin</a>
                            </td>
                        </tr>
                        <?php
                    }
                } else {
                    # We have no data in database
                }
            }
            ?>
        </table>
    </div>
</div>
<!--Main Content Section End-->

<!--Footer Section Starts-->
<?php include "./partials/footer.php"; ?>
<!--Footer Section Ends-->
</body>
</html>