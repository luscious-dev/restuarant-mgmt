<?php include "partials/menu.php" ?>
<div class="menu-content">
    <div class="wrapper">
        <h1>Change Password</h1>
        <?php
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
        }
        ?>
        <form action="" method="post">
            <table class="tbl-full password-tbl">
                <tr>
                    <td>Current Password</td>
                    <td><input type="password" name="current_password" placeholder="Current Password"></td>
                </tr>
                <tr>
                    <td>New Password</td>
                    <td><input type="password" name="new_password" placeholder="New Password"></td>
                </tr>
                <tr>
                    <td>Confirm Password</td>
                    <td><input type="password" name="confirm_password" placeholder="Confirm Password"></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $_GET['id'] ?>">
                        <input type="submit" name="submit" value="Change Password" class="btn-action btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
    <?php
    if (isset($_POST["submit"])) {
        $current_password = md5($_POST['current_password']);
        $new_password = md5($_POST['new_password']);
        $confirm_password = md5($_POST['confirm_password']);
        $id = $_GET['id'];

        $sql = "SELECT * FROM tbl_admin WHERE id=$id AND password='$current_password'";
        $res = mysqli_query($conn, $sql);


        if ($res == true) {
            $count = mysqli_num_rows($res);
            if ($count == 1) {
                if (($new_password == $confirm_password) && ($new_password != $current_password)) {
                    $u_sql = "UPDATE tbl_admin SET password='$new_password' WHERE id=$id";
                    $u_res = mysqli_query($conn, $u_sql);

                    if ($u_res == true) {
                        echo 'here 1';
                        $_SESSION['password-changed'] = "<p class='success'>Password Updated Successfully</p>";
                        header("location:" . SITEURL . "admin/manage-admin.php");
                    } else {
                        echo 'here 2';
                        $_SESSION['password-changed'] = "<p class='error'>Password Could Not Be Changed</p>";
                        header("location:" . SITEURL . "admin/manage-admin.php");
                    }
                } else {
                    echo 'here 3';
                    if($new_password != $confirm_password){
                        $_SESSION['password-not-matched'] = "<p class='error'>Confirm password field did not match</p>";
                    }
                    if($new_password == $current_password){
                        $_SESSION['password-not-matched'] = "<p class='error'>New password can't be similar to previous one</p>";
                    }
                    
                    header("location:" . SITEURL . "admin/manage-admin.php");
                }
            }else{
                $_SESSION['user-not-found'] = "<p class='error'>Invalid Current Password</p>";
                header('location:'.SITEURL.'admin/manage-admin.php');
            }
        }
    }
    ?>
</div>

<?php include "partials/footer.php" ?>
