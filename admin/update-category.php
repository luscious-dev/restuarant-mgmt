<?php
include "./partials/menu.php";
?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Category</h1>
        <?php
            if(isset($_SESSION['failed-remove'])){
                echo $_SESSION['failed-remove'];
                unset($_SESSION['failed-remove']);
            }
        ?>
        <?php
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $sql = "SELECT * FROM tbl_category WHERE id=$id";
            $res = mysqli_query($conn, $sql);
            $count = mysqli_num_rows($res);

            if ($count == 1) {
                $row = mysqli_fetch_assoc($res);

                $title = $row['title'];
                $current_image = $row['image_name'];
                $featured = $row['featured'];
                $active = $row['active'];

            } else {
                $_SESSION['no-category-found'] = "<p class='error'>Category Not Found</p>";
                header("location" . SITEURL . "admin/manage-category.php");
            }
        } else {
            header("location" . SITEURL . "admin/manage-category.php");
        }
        ?>
        <form action="" method="post" enctype="multipart/form-data">
            <table class="tbl-full">
                <tr>
                    <td style="width: 135px">Title:</td>
                    <td>
                        <input type="text" name="title" value="<?php echo $title; ?>">
                    </td>
                </tr>
                <tr>
                    <td style="width: 135px">Current Image:</td>
                    <td>
                        <?php
                        if ($current_image != '') {
                            ?>
                            <img src="<?php echo SITEURL . 'images/category/' . $current_image ?>" alt="">
                            <?php
                        } else {
                            echo "<span class='error'>No Image</span>";
                        }
                        ?>

                    </td>
                </tr>
                <tr>
                    <td style="width: 135px">New Image</td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>
                <tr>
                    <td style="width: 135px">Featured:</td>
                    <td>
                        <label><input <?php if ($featured == 'Yes') {
                                echo "checked";
                            } ?> type="radio" name="featured" value="Yes"> Yes</label>
                        <label><input <?php if ($featured == 'No') {
                                echo "checked";
                            } ?> type="radio" name="featured" value="No"> No</label>
                    </td>
                </tr>
                <tr>
                    <td style="width: 135px">Active:</td>
                    <td>
                        <label><input <?php if ($active == 'Yes') {
                                echo "checked";
                            } ?> type="radio" name="active" value="Yes"> Yes</label>
                        <label><input <?php if ($active == 'No') {
                                echo "checked";
                            } ?> type="radio" name="active" value="No"> No</label>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="old_image" value="<?php echo $current_image ?>">
                        <input type="submit" class="btn btn-secondary" value="Update Category" name="submit">
                    </td>
                </tr>
            </table>
        </form>

        <?php
        if (isset($_POST['submit'])) {
            $new_title = $_POST['title'];

            if (isset($_FILES['image'])){
                $new_image = $_FILES['image'];
                $new_image_name = $new_image['name'];

                if($new_image_name != ""){
                    # Auto rename
                    // Get image extension
                    # = explode('.',$image_name)[1];
                    $ext = end(explode('.',$new_image_name));

                    // Rename
                    $new_image_name = "Food Category ".rand(000,999).'.'.$ext;
                    $source_path = $new_image['tmp_name'];
                    $destination_path = '../images/category/'.$new_image_name;

                    $upload = move_uploaded_file($source_path,$destination_path);

                    if($upload==true){
                        if($current_image != ""){
                            $remove = unlink("../images/category/".$current_image);

                            if($remove == false){
                                $_SESSION['failed-remove'] = "<p class='error'>Image removal failed</p>";
                                header("location:".SITEURL."admin/update-category.php");
                            }
                        }
                    }else{
                        $_SESSION['failed-remove'] = "<p class='error'>Image Upload Failed</p>";
                        header("location:".SITEURL."admin/update-category.php");
                    }
                }else{
                    $new_image_name = $_POST['old_image'];
                }
            }else{
                $new_image_name = $_POST['old_image'];
            }

            $new_featured = $_POST['featured'];
            $new_active = $_POST['active'];


            echo $current_image." ";

            $sql2 = "UPDATE tbl_category SET title='$new_title', featured='$new_featured',active='$new_active', image_name='$new_image_name' WHERE id=$id";
            $res2 = mysqli_query($conn,$sql2);

            if($res2 == true){
                $_SESSION['update'] = "<p class='success'>Category Updated Successfully!</p>";
                header("location:".SITEURL."admin/manage-category.php");
            }else{
                $_SESSION['update'] = "<p class='error'>Category Update Failed!</p>";
                header("location:".SITEURL."admin/manage-category.php");
            }

        }
        ?>
    </div>
</div>


<?php
include "./partials/footer.php";
?>
