<?php include "./partials/menu.php" ?>

    <div class="main-content">
        <div class="wrapper">
            <h1>Update Food</h1>
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
            }else{
                # Redirect the user
                header("location:".SITEURL."admin/manage-food.php");
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
                                if($image_name != ''){
                                    ?>
                                    <img src="../images/food/<?php echo $image_name ?>" alt="">
                                    <?php
                                }else{
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
                                            <option <?php if ($category_id == $cat_id) {echo "selected";} ?> value="<?php echo $cat_id ?>"><?php echo $cat_name ?></option>
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
                            <input type="hidden" name="id" value="<?php echo $id?>">
                            <input type="hidden" name="current_image" value="<?php echo $image_name?>">
                            <input class="btn btn-secondary" type="submit" name="submit" value="Update Food">
                        </td>
                    </tr>
                </table>
            </form>

        </div>
    </div>


<?php include "./partials/footer.php" ?>