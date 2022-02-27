<?php include "partials/menu.php"; ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Admin</h1>
        <form action="" method="post">
            <table>
                <tr>
                    <td style="width: 100px">Full Name:</td>
                    <td><input type="text" name="full_name" placeholder="Enter your name"></td>
                </tr>
                <tr>
                    <td style="width: 100px">Username:</td>
                    <td><input type="text" name="username" placeholder="Enter your username"></td>
                </tr>
                <tr>
                    <td style="width: 100px">Password:</td>
                    <td><input type="password" name="password" placeholder="Enter your password"></td>
                </tr>
                <tr>
                    <td colspan=2>
                        <input type="submit" name="submit" value="Add Admin" class="btn-secondary btn-action">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>
<?php include "partials/footer.php"; ?>

<?php
//    Process the value from the form and save in database
//    Check whether the submit button is clicked or not
if (isset($_POST["submit"])) {

    # 1. Get input from the user
    $full_name = $_POST["full_name"];
    $username = $_POST["username"];
    $password = md5($_POST["password"]); # Encrypt Password

    # 2. Create Sql Query to save data into database
    $sql = "INSERT INTO tbl_admin SET full_name='$full_name',username='$username',password='$password'";


    # res holds a boolean value to see if the query executes successfully
    # 3. Execute Query and save into database
    $res = mysqli_query($conn, $sql) or die(mysqli_error());

    # 4. Check whether the query is executed successfully and show appropriate messages
    if ($res == True) {
        # echo "Data Inserted";
        # Create a session variable to display message
        $_SESSION['add'] = "<p class='success'>Admin Added Successfully</p>"; # Displaying session message

        # Redirect Page
        header("location:" . SITEURL . 'admin/manage-admin.php');
    } else {
        # echo "Failed to insert Data";
        # Create a session variable to display message
        $_SESSION['add'] = "<p class='error'>Failed to Add Admin</p>";

        # Redirect Page
        header("location:" . SITEURL . 'admin/add-admin.php');
    }
}

?>
