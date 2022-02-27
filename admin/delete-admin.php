<link rel="stylesheet" href="../css/admin.css">
<?php
    include "../config/constants.php";
    # Get the id of admin to be deleted
    $id =  $_GET['id'];

    # CReate SQL Query to delete the admin
    $sql = "DELETE FROM tbl_admin WHERE id=$id";
    $sql_username = "SELECT username FROM tbl_admin WHERE id=$id";

    # Redirect to the manage-admin page with message
    $res_user = mysqli_query($conn, $sql_username);
    $username =  mysqli_fetch_array($res_user)[0];
    $res = mysqli_query($conn,$sql);

    if($res == True){
        # If query executed successfully
        $_SESSION['delete'] = "<p class='success'>$username Deleted Successfully</p>";
        header("location:".SITEURL."admin/manage-admin.php");
    }else{
        #couldn't delete the admin
        $_SESSION['delete'] = "<p class='error'>Failed to delete $username</p>";
        header("location:".SITEURL."admin/manage-admin.php");
    }

?>