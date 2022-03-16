<?php
include '../config/constants.php';
$id = $_GET['id'];
$image_name = $_GET['image_name'];

if (isset($id) and isset($image_name)) {
        # Delete physical image
    if($image_name != ""){
        $path = "../images/category/$image_name";
        # Returns a boolean value. It deletes a file
        $remove = unlink($path);

        if($remove == False){
            $_SESSION['remove'] = '<p class="error">Failed to remove catgory image</p>';
            # Redirect
            header("location:".SITEURL.'admin/manage-category.php');

            # Stop process
            die();
        }
    }

    $sql = "DELETE FROM tbl_category WHERE id=$id";

    $res = mysqli_query($conn,$sql);

    if($res == true){
        $_SESSION['delete'] = "<p class='success'>Category Deleted Successfully</p>";
        header("location:".SITEURL.'admin/manage-category.php');
    }else{
        $_SESSION['delete'] = "<p class='error'>Failed To Delete Category</p>";
        header("location:".SITEURL.'admin/manage-category.php');
    }

} else {
    # Prevent users from accessing the delete category page without selecting a category
    header('location:' . SITEURL . 'admin/manage-category.php');
}


?>