<?php include "./partials-front/menu.php"; ?>


<!-- CAtegories Section Starts Here -->
<section class="categories">
    <div class="container">
        <h2 class="text-center">Explore Foods</h2>

        <?php
        $sql = "SELECT * FROM tbl_category WHERE active='Yes' AND featured='Yes' LIMIT 3";
        $res = mysqli_query($conn, $sql);

        if ($res == true) {
            if (mysqli_num_rows($res) > 0) {
                while ($rows = mysqli_fetch_assoc($res)) {
                    $image_name = $rows['image_name'];
                    $title = $rows['title'];
                    $id = $rows['id'];

                    ?>
                    <a href="category-foods.php">
                        <div class="box-3 float-container">
                            <?php
                            if ($image_name == "") {
                                echo "<div class='error'>Image not Available</div>";
                            } else {
                                ?>
                                <img src="<?php echo SITEURL ?>images/category/<?php echo $image_name ?>"
                                     alt="<?php echo explode('.', $image_name)[0] ?>" class="img-responsive img-curve">
                                <?php
                            }
                            ?>


                            <h3 class="float-text text-white"><?php echo $title ?></h3>
                        </div>
                    </a>
                    <?php
                }
            } else {
                echo "No categories available at this time";
            }
        } else {
            $_SESSION['category'] = '<p class="error">Failed To get categories</p>';
        }
        ?>

        <div class="clearfix"></div>
    </div>
</section>
<!-- Categories Section Ends Here -->


<?php include "./partials-front/footer.php"; ?>
