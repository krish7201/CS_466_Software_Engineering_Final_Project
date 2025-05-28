
<?php
date_default_timezone_set("America/Chicago");
$username = $_GET['user'];
$courseID = $_GET['courseID'];

//Database connection

$conn = mysqli_connect('database-1.cs1hkdhivv1o.eu-central-1.rds.amazonaws.com', 'admin', 'euDmg7+0Q4~', 'acastat-database');
if($conn->connect_error) {
    die('Connection Failed : '.$conn->connect_error);
}
else {

    $query = "SELECT userID FROM users WHERE username = '" . $username . "'";
    $result = mysqli_query($conn, $query);
    $result = $result -> fetch_all(MYSQLI_ASSOC);
    $userID = $result[0]['userID'];
    
    $stmt = $conn->prepare("INSERT INTO takes(courseID, userID)
        VALUES (?, ?)");	
    $stmt ->bind_param("ii", $courseID, $userID);
    $stmt ->execute();
    header("Location: ../search_course.php");
}
?>

