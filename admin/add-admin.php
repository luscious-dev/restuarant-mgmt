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
    $full_name = $_POST["full_name"];
    $username = $_POST["username"];
    $password = md5($_POST["password"]); # Encrypt Password

    # Sql Query to save data into database
    $sql = "INSERT INTO tbl_admin (full_name,username,password) VALUES($full_name,$username,$password)";

    echo $sql;

    # Execute Query and save into database
    # To see if the query execites successfully
    $conn = mysqli_connect('localhost', 'root', '') or die(mysqli_error()); # Database connection
    $db_select = mysqli_select_db($conn, 'restaurant') or die(mysqli_error());
//    $res = mysqli_query($conn, $sql) or die(mysqli_error());
}

?>
