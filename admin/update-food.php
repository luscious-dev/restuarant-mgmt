<?php include "./partials/menu.php" ?>

    <div class="main-content">
        <div class="wrapper">
            <h1>Update Food</h1>
            <?php
            if (isset($_SESSION['image-error'])) {
                echo $_SESSION['image-error'];
                unset($_SESSION['image-error']);
            }
            ?>
            <?php
            if (isset($_GET['id'])) {
                $id = $_GET['id'];
                $sql = "SELECT * FROM tbl_food WHERE id=$id";
                $res = mysqli_query($conn, $sql);

                if ($res == True) {
                    if (mysqli_num_rows($res) == 1) {
                        $row = mysqli_fetch_assoc($res);
                        $title = $row['title'];
                        $desc = $row['description'];
                        $price = $row['price'];
                        $image_name = $row['image_name'];
                        $category_id = $row['category_id'];
                        $active = $row['active'];
                        $featured = $row['featured'];
                    } else {
                        # Cannot have more than 1 result
                    }

                } else {
                    # Invalid Query
                }
            } else {
                # Redirect the user
                header("location:" . SITEURL . "admin/manage-food.php");
            }

            ?>
            <form action="#" method="post" enctype="multipart/form-data">
                <table class="tbl-full">
                    <tr>
                        <td style="width: 135px">Title:</td>
                        <td><input type="text" name="title" value="<?php echo $title ?>"></td>
                    </tr>
                    <tr>
                        <td style="width: 135px">Description:</td>
                        <td><textarea name="desc" cols="30" rows="5"><?php echo $desc ?></textarea></td>
                    </tr>
                    <tr>
                        <td style="width: 135px">Price:</td>
                        <td><input type="number" name="price" value="<?php echo $price ?>"></td>
                    </tr>
                    <tr>
                        <td style="width: 135px">Current Image:</td>
                        <td>
                            <?php
                            if ($image_name != '') {
                                ?>
                                <img src="../images/food/<?php echo $image_name ?>" alt="">
                                <?php
                            } else {
                                echo "<p class='error'>No Previous Image</p>";
                            }
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 135px">New Image:</td>
                        <td><input type="file" name="image" id=""></td>
                    </tr>
                    <tr>
                        <td style="width: 135px">Category:</td>
                        <td>
                            <select name="category">
                                <?php
                                $sql2 = "SELECT * FROM tbl_category WHERE active='Yes'";
                                $res2 = mysqli_query($conn, $sql2);

                                if ($res2 == true) {

                                    if (mysqli_num_rows($res2) > 0) {
                                        while ($row = mysqli_fetch_assoc($res2)) {
                                            $cat_name = $row['title'];
                                            $cat_id = $row['id'];
                                            ?>
                                            <option <?php if ($category_id == $cat_id) {
                                                echo "selected";
                                            } ?> value="<?php echo $cat_id ?>"><?php echo $cat_name ?></option>
                                            <?php
                                        }
                                    } else {
                                        ?>
                                        <option value="#">No Category Available</option>
                                        <?php
                                    }
                                }
                                ?>

                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 135px">Featured:</td>
                        <td><label><input <?php if ($featured == "Yes") {
                                    echo "checked";
                                } ?> type="radio" name="featured" value="Yes"> Yes</label>
                            <label><input <?php if ($featured == "No") {
                                    echo "checked";
                                } ?>
                                        type="radio" name="featured" value="No"> No</label></td>
                    </tr>
                    <tr>
                        <td style="width: 135px">Active:</td>
                        <td><label><input <?php if ($active == "Yes") {
                                    echo "checked";
                                } ?> type="radio" name="active" value="Yes"> Yes</label>
                            <label><input <?php if ($active == "No") {
                                    echo "checked";
                                } ?> type="radio"
                                     name="active"
                                     value="No">
                                No</label></td>
                    </tr>
                    <tr>
                        <td colspan="2">

                            <input class="btn btn-secondary" type="submit" name="submit" value="Update Food">
                        </td>
                    </tr>
                </table>
            </form>
            <?php
            if (isset($_POST['submit'])) {
                $new_title = $_POST['title'];
                $new_desc = $_POST['desc'];
                $new_price = $_POST['price'];

                if (isset($_FILES['image'])) {
                    $image = $_FILES['image'];
                    $new_image_name = $image['name'];

                    if ($new_image_name != '') {
                        $ext = explode('.', $new_image_name);
                        $ext = end($ext);
                        $new_image_name = "Food-Name-" . rand(0000, 9999) . "." . $ext;

                        $src = $image['tmp_name'];
                        $dest = "../images/food/" . $new_image_name;
                        $upload = move_uploaded_file($src, $dest);

                        if ($upload == true) {
                            if (isset($_POST['current_image'])) {
                                $old_image = $_POST['current_image'];
                                if ($old_image != "") {
                                    $delete = unlink("../images/food/" . $old_image);
                                    if ($delete == false) {
                                        $_SESSION['image-error'] = "<p class='error'>Something went wrong with old image removal</p>";
                                        header("location:" . SITEURL . "admin/update-food.php?id=$id");
                                    }
                                }
                            }
                        } else {
                            $_SESSION['image-error'] = "<p class='error'>Something went wrong with new image update</p>";
                            header("location:" . SITEURL . "admin/update-food.php?id=$id");
                            die();
                        }
                    } else {
//                        $new_image_name = $_POST['current_image'];
                        $new_image_name = $image_name;
                    }
                } else {
//                    $new_image_name = $_POST['current_image'];
                    $new_image_name = $image_name;
                }

                $new_category_id = $_POST['category'];
                $new_active = $_POST['active'];
                $new_featured = $_POST['featured'];


                $sql3 = "UPDATE tbl_food SET title='$new_title',description='$new_desc',price=$new_price,image_name='$new_image_name',category_id=$new_category_id,featured='$new_featured',active='$new_active' WHERE id=$id";

                $res3 = mysqli_query($conn, $sql3);
                if ($res3 == true) {
                    $_SESSION['update'] = '<p class="success">Food Updated Successfully</p>';
                    header("location:" . SITEURL . "admin/manage-food.php");
                } else {
                    $_SESSION['update'] = '<p class="error">Failed to Update Food</p>';
                    header("location:" . SITEURL . "admin/manage-food.php");
                }
            }
            ?>
        </div>
    </div>


<?php include "./partials/footer.php" ?>