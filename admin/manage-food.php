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
        if (isset($_SESSION['delete'])) {
            echo $_SESSION['delete'];
            unset($_SESSION['delete']);
        }
        if (isset($_SESSION['upload'])) {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }
        if (isset($_SESSION['authorized'])) {
            echo $_SESSION['authorized'];
            unset($_SESSION['authorized']);
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
                        $id = $row['id'];
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
                                <a href="<?php echo SITEURL; ?>admin/update-food.php?id=<?php echo $id; ?>" class="btn-secondary btn-action">Update Food</a>
                                <a href='<?php echo SITEURL."admin/delete-food.php?id=$id&image=$image_name" ?>' class="btn-danger btn-action">Delete Food</a>
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

        </table>
    </div>
</div>
<?php include "./partials/footer.php" ?>
</body>
</html>