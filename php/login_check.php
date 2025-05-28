<?php

session_start();
date_default_timezone_set("America/Chicago");

$error = "";
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") { 

    // Check if the fields are not empty
    $con = mysqli_connect('database-1.cs1hkdhivv1o.eu-central-1.rds.amazonaws.com', 'admin', 'euDmg7+0Q4~', 'acastat-database');

    if ($con) {
        // remove all session variables
        session_unset();
        $uname = mysqli_real_escape_string($con, $_POST['Username']);
        $_SESSION["username"] = $uname;
        $pass = mysqli_real_escape_string($con, $_POST['Password']);
        $_SESSION["password"] = $pass;
        
        $sql = "SELECT username, password FROM users WHERE username = '$uname' AND password = '$pass'";
        $result = mysqli_query($con, $sql);

        if (mysqli_num_rows($result) == 1) {
            $_SESSION["loggedIn"] = True;
            // Username and password are correct
            header("location: ../home.php");
            exit();

        } else {
            // Incorrect username or password
            $error = "Invalid username or password";
            header('location: ../login.php?error=' . urlencode($error));
            exit;
        }
    } else {
        $error = "Unable to establish database connection.";
        header('location: ../login.php?error=' . urlencode($error));
        exit; 
    }

    mysqli_close($con);

} else {
    $error = "Must be logged in to access content.";
    header('location: ../login.php?error=' . urlencode($error));
    exit; 
}

?>