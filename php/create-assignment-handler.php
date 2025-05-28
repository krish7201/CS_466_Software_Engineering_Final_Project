<?php
session_start();
date_default_timezone_set("America/Chicago");

$assignmentID = rand(1000,9999);
$courseID = $_POST['courseID'];
$title = $_POST['title'];
$submissionDate = date("Y-m-d");
$dueDate = $_POST['dueDate'];
$fileName = basename($_FILES['myFile']["name"]);
$notes = $_POST['notes'];

//File Check/Setup
$target_dir = "../assignments/";
$target_file = $target_dir . basename($_FILES["myFile"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));



// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}

// Check file size
if ($_FILES["myFile"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}

// Allow certain file formats
if($imageFileType != "pdf" && $imageFileType != "doc" && $imageFileType != "docx" && $imageFileType != "zip" && $imageFileType != "txt" ) {
  echo "Sorry, only PDF, DOC, DOCX, ZIP, and txt files are allowed.";
  $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
  // if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["myFile"]["tmp_name"], $target_file)) {
      echo "The file ". htmlspecialchars( basename( $_FILES["myFile"]["name"])). " has been uploaded.";
  } else {
      echo "Sorry, there was an error uploading your file.";
  }
}

//Database connection

$conn = mysqli_connect('database-1.cs1hkdhivv1o.eu-central-1.rds.amazonaws.com', 'admin', 'euDmg7+0Q4~', 'acastat-database');
if($conn->connect_error) {
    die('Connection Failed : '.$conn->connect_error);
}
else {
    $stmt = $conn->prepare("INSERT INTO assignments(assignmentID, courseID, title, submissionDate, dueDate, fileName, notes)
        VALUES (?, ?, ?, ?, ?, ?, ?)");	
    $stmt ->bind_param("iisssss", $assignmentID, $courseID, $title, $submissionDate, $dueDate, $fileName, $notes);
    $stmt ->execute();

    echo "creation successful";
    $stmt->close();
    $conn->close();

    header("Location: ../course_assignments_instructor.php?user=" . $_SESSION["username"] . "&courseID=". $_POST["courseID"] . "");
}

?>