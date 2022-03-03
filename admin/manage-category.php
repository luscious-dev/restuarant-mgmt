<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Category</title>
</head>
<body>
<?php include "./partials/menu.php" ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Manage Category</h1>
        <?php
        if (isset($_SESSION['add'])) {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }
        ?>
        <a href="<?php echo SITEURL . 'admin/add-category.php' ?>" class="btn btn-primary">Add Category</a>

        <table class="tbl-full">
            <tr>
                <th>S.N.</th>
                <th>Title</th>
                <th>Image</th>
                <th>Features</th>
                <th>Active</th>
                <th>Actions</th>
            </tr>

            <?php
            $sql = "SELECT * FROM tbl_category";
            $res = mysqli_query($conn, $sql);

            if ($res == true) {
                $sn = 1;
                $count = mysqli_num_rows($res);
                if ($count > 0) {
                    while ($row = mysqli_fetch_assoc($res)) {
                        $title = $row['title'];
                        if ($row['image_name'] == ''){
                            $image_name = "<span class='error'>No Image</span>";
                        }else{
                            $tmp = $row['image_name'];
                            $image_name = "<img src='../images/category/$tmp'>";
                        }

                        $featured = $row['featured'];
                        $active = $row['active'];
                        echo "
                        <tr>
                            <td>$sn</td>
                            <td>$title</td>
                            <td>$image_name</td>
                            <td>$featured</td>
                            <td>$active</td>
                            <td>
                                <a href='#' class='btn-secondary btn-action'>Update Category</a>
                                <a href='#' class='btn-danger btn-action'>Delete Category</a>
                            </td>
                        </tr>";
                        $sn++;
                    }
                }else{
                    echo "<tr>
                            <td colspan='6'><div class='error'>No Food Category Added</div></td>
                        </tr>";
                }

            }
            ?>

        </table>
    </div>
</div>
<?php include "./partials/footer.php" ?>
</body>
</html>