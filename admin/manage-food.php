<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Food</title>
</head>
<body>
<?php include "./partials/menu.php" ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Manage Food</h1>
        <?php
        if (isset($_SESSION['add'])) {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }
        ?>
        <a href="<?php echo SITEURL . 'admin/add-food.php' ?>" class="btn btn-primary">Add Food</a>

        <table class="tbl-full">
            <tr>
                <th>S.N.</th>
                <th>Title</th>
                <th>Description</th>
                <th>Price</th>
                <th>Image</th>
                <th>Category</th>
                <th>Featured</th>
                <th>Active</th>
                <th>Actions</th>
            </tr>
            <?php
            $sql = "SELECT * FROM tbl_food";
            $res = mysqli_query($conn, $sql);
            if ($res == true) {
                if (mysqli_num_rows($res) > 0) {
                    $count = 1;
                    while ($row = mysqli_fetch_assoc($res)) {
                        $title = $row['title'];
                        $description = $row['description'];
                        $price = $row['price'];
                        $image_name = $row['image_name'];

                        $cat_id = $row['category_id'];
                        $sql2 = "SELECT * FROM tbl_category WHERE id=$cat_id";
                        $res2 = mysqli_query($conn, $sql2);
                        if ($res2 == true) {
                            if (mysqli_num_rows($res2) == 1) {
                                $category = mysqli_fetch_assoc($res2)['title'];
                            }
                        } else {
                            # Something went wrong
                        }

                        $featured = $row['featured'];
                        $active = $row['active'];

                        ?>
                        <tr>
                            <td><?php echo $count++ ?></td>
                            <td><?php echo $title ?></td>
                            <td><?php echo $description ?></td>
                            <td><?php echo $price ?></td>
                            <td>
                                <?php
                                if ($image_name == "") {
                                    echo "<span class='error'>No Image Added</span>";
                                } else {
                                    ?>
                                    <img src="<?php echo SITEURL . 'images/food/' . $image_name ?>" alt="">
                                    <?php
                                }
                                ?>
                            </td>
                            <td><?php echo $category ?></td>
                            <td><?php echo $featured ?></td>
                            <td><?php echo $active ?></td>
                            <td>
                                <a href="#" class="btn-secondary btn-action">Update Food</a>
                                <a href="#" class="btn-danger btn-action">Delete Food</a>
                            </td>
                        </tr>
                        <?php
                    }
                } else {
                    # No entry in database
                    ?>
                    <tr>
                        <td colspan="9">No Food Has been entered</td>
                    </tr>
                    <?php
                }
            } else {
                # Failed to Fetch Data
            }
            ?>
            <!--            <tr>-->
            <!--                <td>1</td>-->
            <!--                <td>Olawale Akin-Odanye</td>-->
            <!--                <td>walz123</td>-->
            <!--                <td>-->
            <!--                    <a href="#" class="btn-secondary btn-action">Update Admin</a>-->
            <!--                    <a href="#" class="btn-danger btn-action">Delete Admin</a>-->
            <!--                </td>-->
            <!--            </tr>-->
            <!--            <tr>-->
            <!--                <td>2</td>-->
            <!--                <td>Abolade Olanrewaju</td>-->
            <!--                <td>sullchi_bitch</td>-->
            <!--                <td>-->
            <!--                    <a href="#" class="btn-secondary btn-action">Update Admin</a>-->
            <!--                    <a href="#" class="btn-danger btn-action">Delete Admin</a>-->
            <!--                </td>-->
            <!--            </tr>-->
            <!--            <tr>-->
            <!--                <td>3</td>-->
            <!--                <td>Ojenike Emmanuel</td>-->
            <!--                <td>elyk_slut</td>-->
            <!--                <td>-->
            <!--                    <a href="#" class="btn-secondary btn-action">Update Admin</a>-->
            <!--                    <a href="#" class="btn-danger btn-action">Delete Admin</a>-->
            <!--                </td>-->
            <!--            </tr>-->
        </table>
    </div>
</div>
<?php include "./partials/footer.php" ?>
</body>
</html>