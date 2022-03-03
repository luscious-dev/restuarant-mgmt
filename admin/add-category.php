<?php include "./partials/menu.php" ?>

    <div class="main-content">
        <div class="wrapper">
            <h1>Add Category</h1>
            <?php
            if (isset($_SESSION['add'])) {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }
            if (isset($_SESSION['upload'])) {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
            ?>
            <!--    Add Category Form Starts    -->
            <!--    enctype attribute is required to upload files    -->
            <form action="" method="post" enctype="multipart/form-data">
                <table class="tbl-full">
                    <tr>
                        <td>Title:</td>
                        <td><input type="text" name="title" placeholder="Category Title"></td>
                    </tr>
                    <tr>
                        <td>Featured:</td>
                        <td>
                            <label><input type="radio" name="featured" value="Yes">Yes</label>
                            <label><input type="radio" name="featured" value="No">No</label>
                        </td>
                    </tr>
                    <tr>
                        <td>Active:</td>
                        <td>
                            <label><input type="radio" name="active" value="Yes">Yes</label>
                            <label><input type="radio" name="active" value="No">No</label>
                        </td>
                    </tr>
                    <tr>
                        <td>Select Image:</td>
                        <td>
                            <input type="file" name="image">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="submit" value="Add Category" name="submit" class="btn btn-secondary">
                        </td>
                    </tr>
                </table>
            </form>
            <!--    Add Category Form Ends    -->

            <?php
            if (isset($_POST['submit'])) {
                $title = $_POST['title'];
                # for radio input, we need to check if the button is selected or not
                if (isset($_POST['featured'])) {
                    # get values from form
                    $featured = $_POST["featured"];
                } else {
                    # set the default value
                    $featured = "No";
                }
                if (isset($_POST['active'])) {
                    # get values from form
                    $active = $_POST["active"];
                } else {
                    # set the default value
                    $featured = "No";
                }

                # Check whether image is selected or not
                // print_r($_FILES['image']);

                // die();  # Break the code here

                if (isset($_FILES['image']['name'])) {
                    # Upload the image
                    # To upload image, we need the image name, source path and destination path
                    $image_name = $_FILES['image']['name'];

                    # Auto rename
                    // Get image extension
                    # = explode('.',$image_name)[1];
                    $ext = end(explode('.',$image_name));

                    // Rename
                    $image_name = "Food Category ".rand(000,999).'.'.$ext;

                    $source_path = $_FILES['image']['tmp_name'];
                    $destination_path = "../images/category/".$image_name;

                    # Upload image
                    $upload = move_uploaded_file($source_path, $destination_path);

                    # Check whether the image is uploaded or not
                    if ($upload == false) {
                        $_SESSION['upload'] = "<p class='error'>Image Uploaded Failed</p>";
                        header("location:" . SITEURL . "admin/add-category.php");

                        # Stop the process
                        die();
                    }
                    # If image is not uploaded, then we will stop the process and redirect with error message
                } else {
                    # Don't upload image and set the immage name value as blank
                    $image_name = "";
                }

                $sql = "INSERT INTO tbl_category SET title='$title',image_name='$image_name', featured='$featured',active='$active'";
                $res = mysqli_query($conn, $sql);

                if ($res == true) {
                    $_SESSION['add'] = "<p class='success'>Category Added Successfully</p>";
                    header("location:" . SITEURL . "admin/manage-category.php");
                } else {
                    $_SESSION['add'] = "<p class='error'>Failed to Add Category</p>";
                    header("location:" . SITEURL . "admin/add-category.php");
                }
            }
            ?>
        </div>
    </div>

<?php include './partials/footer.php' ?>