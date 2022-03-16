<?php
include "./partials/menu.php"
?>


<div class="main-content">
    <div class="wrapper">
        <h1>Add Food</h1>
        <?php
            if(isset($_SESSION['upload'])){
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
        ?>

        <form action="#" enctype="multipart/form-data" method="post">
            <table class="tbl-full">
                <tr>
                    <td style="width: 125px">Title:</td>
                    <td><input type="text" name="title" placeholder="Title fo the food"></td>
                </tr>
                <tr>
                    <td style="width: 125px">Description:</td>
                    <td>
                        <textarea name="description" placeholder="Description of the food" id="" cols="30"
                                  rows="5"></textarea>
                    </td>
                </tr>
                <tr>
                    <td style="width: 125px">Price:</td>
                    <td>
                        <input type="number" name="price">
                    </td>
                </tr>
                <tr>
                    <td style="width: 125px">Select Image:</td>
                    <td><input type="file" name="image"></td>
                </tr>
                <tr>
                    <td style="width: 125px">Category:</td>
                    <td>
                        <select name="category">
                            <?php
                            $sql = "SELECT * FROM tbl_category WHERE active='Yes'";
                            $res = mysqli_query($conn, $sql);
                            if ($res == true) {
                                if (mysqli_num_rows($res) > 0) {
                                    while ($row = mysqli_fetch_assoc($res)) {
                                        $id = $row['id'];
                                        $title = $row['title'];
                                        ?>
                                        <option value="<?php echo $id ?>"><?php echo $title ?></option>
                                        <?php
                                    }
                                }else{
                                    ?>
                                    <option value="#">No Category Found</option>
                                    <?php
                                }
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td style="width: 125px">Featured:</td>
                    <td>
                        <label><input type="radio" name="featured" value="Yes"> Yes</label>
                        <label><input type="radio" name="featured" value="No"> No</label>
                    </td>
                </tr>
                <tr>
                    <td style="width: 125px">Active:</td>
                    <td>
                        <label><input type="radio" name="active" value="Yes"> Yes</label>
                        <label><input type="radio" name="active" value="No"> No</label>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Food" class="btn btn-secondary">
                    </td>
                </tr>
            </table>
        </form>

        <?php
            if(isset($_POST['submit'])){
                $title = $_POST['title'];
                $description = $_POST['description'];
                $price = $_POST['price'];

                if(isset($_FILES['image'])){
                    $image = $_FILES['image'];
                    $img_name = $image['name'];

                    # Reformat image name
                    if($img_name != ''){
                        $temp = explode('.',$img_name);
                        $ext = end($temp);
                        $image_name = "Food-Name-".rand(0000,9999).".".$ext;

                        $src_path = $image['tmp_name'];
                        $destination = "../images/food/".$image_name;
                        $upload = move_uploaded_file($src_path,$destination);

                        if($upload == false){
                            $_SESSION['upload'] = "<p class='error'>Food Image Upload Failed</p>";
                            header("location:".SITEURL."admin/add-food.php");
                            die();
                        }
                    }


                }else{
                    $image_name = '';
                }

                $category = $_POST['category'];
                if(isset($_POST['featured'])){
                    $featured = $_POST['featured'];
                }else{
                    $featured = 'No';
                }

                if(isset($_POST['active'])){
                    $active = $_POST['active'];
                }else{
                    $active = 'No';
                }

                $sql2 = "INSERT INTO tbl_food SET title='$title', description='$description',price=$price,image_name='$image_name',category_id=$category,featured='$featured',active='$active'";
                $res2 = mysqli_query($conn,$sql2);

                if($res2 == true){
                    $_SESSION['add'] = "<p class='success'>Food Added Successfully</p>";
                    header("location:".SITEURL."admin/manage-food.php");
                }else{
                    $_SESSION['add'] = "<p class='error'>Failed to Add Food</p>";
                    header("location:".SITEURL."admin/manage-food.php");
                }
            }
        ?>
    </div>
</div>


<?php
include "./partials/footer.php"
?>
