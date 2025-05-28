<?php
session_start();
date_default_timezone_set("America/Chicago");
$userType = $_POST['options-outlined'];
$userID = rand(10000000,99999999);
$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$username = $_POST['username'];
$password = $_POST['password'];
$address = $_POST['address'];
$apartment = $_POST['apartment'];
$city = $_POST['city'];
$state = $_POST['state'];
$zipCode = $_POST['zipCode'];

//Database connection

$conn = mysqli_connect('database-1.cs1hkdhivv1o.eu-central-1.rds.amazonaws.com', 'admin', 'euDmg7+0Q4~', 'acastat-database');
if($conn->connect_error) {
    die('Connection Failed : '.$conn->connect_error);
}
else {
    $stmt = $conn->prepare("INSERT INTO users(userID, firstName, lastName, phone, email, username, password, address, apartment, city, state, zipCode)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");	
    $stmt ->bind_param("isssssssissi", $userID, $firstName, $lastName, $phone, $email, $username, $password, $address, $apartment, $city, $state, $zipCode);
    $stmt ->execute();

    $table = "";
    if($userType == 'student') {
        $table = 'students';
    }
    else if ($userType == 'instructor') {
        $table = 'instructors';
    }
    else {
        $table = 'admins';
    }
    $stmt = $conn->prepare("INSERT INTO " . $table . "(userID) VALUES (?)");
    $stmt ->bind_param("i", $userID);
    $stmt ->execute();

    echo "registration successful";
    $stmt->close();
    $conn->close();
    header("Location: ../create_user.php");
}



?>