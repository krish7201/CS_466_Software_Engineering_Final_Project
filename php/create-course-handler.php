<?php
session_start();
date_default_timezone_set("America/Chicago");
$courseID = rand(1000,9999);
$courseTitle = $_POST['courseTitle'];
$subject = $_POST['subject'];
$code = $_POST['code'];
$semester = $_POST['semester'];
$year = $_POST['year'];
$instructorID = $_POST['instructor'];
$photoIndex = rand(1,10);

//Database connection

$conn = mysqli_connect('database-1.cs1hkdhivv1o.eu-central-1.rds.amazonaws.com', 'admin', 'euDmg7+0Q4~', 'acastat-database');
if($conn->connect_error) {
    die('Connection Failed : '.$conn->connect_error);
}
else {
    $stmt = $conn->prepare("INSERT INTO courses(courseID, courseTitle, subject, courseCode, semester, year, instructorID, photoIndex)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)");	
    $stmt ->bind_param("issisiii", $courseID, $courseTitle, $subject, $code, $semester, $year, $instructorID, $photoIndex);
    $stmt ->execute();

    echo "creation successful";
    $stmt->close();
    $conn->close();
    header("Location: ../create_course.php");
}



?>