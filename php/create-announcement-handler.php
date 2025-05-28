<?php
session_start();
date_default_timezone_set("America/Chicago");


$postTitle = $_POST['postTitle'];
$postText = $_POST['postText'];
$courseID = $_SESSION['courseID'];
$userID = $_SESSION['userID'];

echo "<pre>"; print_r($_POST); echo "</pre>";
//Database connection

$conn = mysqli_connect('database-1.cs1hkdhivv1o.eu-central-1.rds.amazonaws.com', 'admin', 'euDmg7+0Q4~', 'acastat-database');
if($conn->connect_error) {
    die('Connection Failed : '.$conn->connect_error);
}
else {
    $stmt = $conn->prepare("INSERT INTO announcements(instructorID, courseID, postTitle, postText)
        VALUES (?, ?, ?, ?)");	
    $stmt ->bind_param("iiss",$userID, $courseID, $postTitle, $postText);
    $stmt ->execute();

    echo "registration successful";
    $stmt->close();
    $conn->close();
    header("Location: ../course.php?user=" . $_SESSION["username"] . "&courseID=". $_SESSION['courseID']);
}

?>