<?php
session_start();

// Leave session
session_destroy();

// Go back to login page
header("Location: ../login.php");
exit();
?>
