<meta charset="utf-8" >
<meta http-equiv="X-UA-Compatible" content="IE=edge" >
<!--From Bootstrap documentation: Create a new index.html file in your project root. Include the <meta name="viewport"> tag as well for proper responsive behavior in mobile devices.-->
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>AcaStat</title>
<link rel = "icon" type= "assets/CAP_LOGO.png" href=/assets/CAP_LOGO.png>
<!-- Bootstrap core CSS -->
<link rel="stylesheet" href="css/common-styles.css">
<link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<link href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet">
<?php
session_start();
if (!isset($_SESSION["loggedIn"])) { include("php/login_check.php"); shell_exec("php login_check.php");}
$conn = mysqli_connect("database-1.cs1hkdhivv1o.eu-central-1.rds.amazonaws.com", "admin", "euDmg7+0Q4~", "acastat-database");
if($conn->connect_error) {die("Connection Failed : ".$conn->connect_error);}
?>
