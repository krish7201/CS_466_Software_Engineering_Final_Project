<?php
session_start();
date_default_timezone_set("America/Chicago");

$submissionID = rand(10000000, 99999999);
$assignmentID = $_POST['assignmentID'];
$fileName = basename($_FILES['myfile']["name"]);
$myfile = $_FILES["myfile"];
$notes = $_POST['notes'];


//File Check/Setup
$target_dir = "../submission/";
$target_file = $target_dir . basename($_FILES["myfile"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));



// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}

// Check file size
if ($_FILES["myfile"]["size"] > 500000) {
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
    if (move_uploaded_file($_FILES["myfile"]["tmp_name"], $target_file)) {
      echo "The file ". htmlspecialchars( basename( $_FILES["myfile"]["name"])). " has been uploaded.";
  } else {
      echo "Sorry, there was an error uploading your file.";
  }
}

    //Database Connection
$conn = mysqli_connect('database-1.cs1hkdhivv1o.eu-central-1.rds.amazonaws.com', 'admin', 'euDmg7+0Q4~', 'acastat-database');
if($conn->connect_error) {
    die('Connection Failed : ' .$conn->connect_error);
}else{

    //get userID
    $query = "SELECT userID FROM users WHERE username = '" . $_SESSION["username"] . "'";
    $return = mysqli_query($conn, $query);
    $return = $return -> fetch_all(MYSQLI_ASSOC);
    $userID = $return[0]['userID'];
    echo $userID;
    $stmt = $conn->prepare("INSERT INTO submissions(submissionID, userID, assignmentID, fileName, notes)
        values(?, ?, ?, ?, ?)");
    $stmt->bind_param("iiiss", $submissionID, $userID, $assignmentID, $fileName, $notes);
    $stmt->execute();
    echo "Assignment Submission Successful";
    $stmt->close();
    $conn->close();

    header("Location: ../assignment.php?user=" . $_SESSION["username"] . "&courseID=". $_POST["courseID"] . "&assignmentID=". $_POST["assignmentID"] . "");
}
?>