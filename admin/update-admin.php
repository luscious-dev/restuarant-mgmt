
<?php include './partials/menu.php'; ?>

<?php
    # Get the ID of selected admin
    $id = $_GET['id'];
    $sql = "SELECT * FROM tbl_admin WHERE id=$id";

    $res = mysqli_query($conn,$sql);
    if($res==true){
        # Check if there are at least one rows
        $count = mysqli_num_rows($res);
        if($count > 0){
            $row = mysqli_fetch_assoc($res);
            $fullname = $row['full_name'];
            $username = $row['username'];
        }else{
            header("location:".SITEURL."admin/manage-admin.php");
        }
    }

?>

<div class="main-content">
    <div class="wrapper">
        <h1>Upadate Admin</h1>
        <form action="" method="post">
            <table class="tbl-full">
                <tr>
                    <td style="width: 104px">Full Name: </td>
                    <td>
                        <input type="text" name="full_name" value="<?php echo $fullname ?>">
                    </td>
                </tr>
                <tr>
                    <td style="width: 104px">Username: </td>
                    <td>
                        <input type="text" name="username" value="<?php echo $username ?>">
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" value="Update Admin" name="submit" class="btn-action btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
        <?php
            if(isset($_POST['submit'])){
                $updated_fullname = $_POST['full_name'];
                $updated_username = $_POST['username'];

                $sql = "UPDATE tbl_admin SET full_name='$updated_fullname',username='$updated_username' WHERE id=$id";
                $res = mysqli_query($conn, $sql);

                if($res==true){
                    $_SESSION['updated'] = "<p class='success'>Admin Updated Successfully</p>";
                    header("location:".SITEURL.'admin/manage-admin.php');
                }else{
                    $_SESSION['updated'] = "<p class='error'>Admin Update Failed</p>";
                    header("location:".SITEURL.'admin/manage-admin.php');
                }
            }
        ?>
    </div>
</div>

<?php include "./partials/footer.php"?>
