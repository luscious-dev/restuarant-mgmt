<?php
    include "../config/constants.php";




    if(isset($_GET['image']) and isset($_GET['id'])){
        $id = $_GET['id'];
        $image_name = $_GET['image'];
        if($image_name != ''){
            $path = "../images/food/".$image_name;
            $remove = unlink($path);

            if($remove == false){
                $_SESSION['upload'] = '<p class="error">Failed to remove food image</p>';
                # Redirect
                header("location:".SITEURL.'admin/manage-food.php');

                # Stop process
                die();
            }
        }

        $sql = "DELETE FROM tbl_food WHERE id=$id";
        $res = mysqli_query($conn,$sql);

        if($res == true){
            $_SESSION['delete'] = '<p class="success">Food Deleted Successfully</p>';
            header('location:'.SITEURL.'admin/manage-food.php');


        }else{
            $_SESSION['delete'] = '<p class="error">Failed to Delete Food</p>';
            header('location:'.SITEURL.'admin/manage-food.php');
        }
    }else{
        # Prevent Users from accessing this portion of the page
        $_SESSION['authorized'] = '<p class="error">Unauthorized access</p>';
        header('location:'.SITEURL.'admin/manage-food.php');
    }

?>