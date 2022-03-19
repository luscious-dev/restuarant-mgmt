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
        if (isset($_SESSION['remove'])) {
            echo $_SESSION['remove'];
            unset($_SESSION['remove']);
        }
        if (isset($_SESSION['delete'])) {
            echo $_SESSION['delete'];
            unset($_SESSION['delete']);
        }
        if (isset($_SESSION['no-category-found'])) {
            echo $_SESSION['no-category-found'];
            unset($_SESSION['no-category-found']);
        }
        if (isset($_SESSION['update'])) {
            echo $_SESSION['update'];
            unset($_SESSION['update']);
        }
        ?>
        <a href="<?php echo SITEURL . 'admin/add-category.php' ?>" class="btn btn-primary">Add Category</a>

        <table class="tbl-full">
            <tr>
                <th>S.N.</th>
                <th>Title</th>
                <th>Image</th>
                <th>Featured</th>
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
                        $id=$row['id'];
                        $title = $row['title'];
                        $image_name = $row['image_name'];
                        if ($image_name == ''){
                            $image = "<span class='error'>No Image</span>";
                        }else{
                            $image = "<img src='../images/category/$image_name'>";
                        }

                        $featured = $row['featured'];
                        $active = $row['active'];

                        ?>


                        <tr>
                            <td><?php echo $sn ?></td>
                            <td><?php echo $title ?></td>
                            <td><?php echo $image ?></td>
                            <td><?php echo $featured ?></td>

                            <td><?php echo $active ?></td>
                            <td>
                                <a href='<?php echo SITEURL."admin/update-category.php?id=$id" ?>' class='btn-secondary btn-action'>Update Category</a>
                                <a href='<?php echo SITEURL."admin/delete-category.php?id=$id&image_name=$image_name" ?>' class='btn-danger btn-action'>
                                    Delete Category
                                </a>
                            </td>
                        </tr>
            <?php
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