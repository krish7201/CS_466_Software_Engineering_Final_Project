<!DOCTYPE html>
<html lang="en">
<head><?php include "php/head.php"; exec("php php/head.php");?></head>
<body>
  <header><?php include "php/navbar.php"; exec("php php/navbar.php");?></header>
  <link rel="stylesheet" href="css/search-course.css">
  <link rel="stylesheet" href="css/course.css">
  <link rel="stylesheet" href="css/course-assignments.css">
  <main class="container-fluid">
    <!--For icons: https://icons.getbootstrap.com/-->
    <!--For button link: https://stackoverflow.com/questions/36003670/how-to-put-a-link-on-a-button-with-bootstrap-->
    

    <form class="needs-validation" action="php/create-assignment-handler.php" method="post" enctype="multipart/form-data"  novalidate>
      <br>
      <h1 class = "text-center">Assignments</h1>
    </form>


    <hr></hr>

    

    <?php
      //obtain all assignments for the class
    $query = "SELECT * FROM assignments WHERE courseID = '" . $_GET["courseID"] . "'";
    $return = mysqli_query($conn, $query);
    $return = $return -> fetch_all(MYSQLI_ASSOC);
    
    foreach($return as $row) {
      echo 
          //"<form class='needs-validation' action='php/register-to-course.php?user=" . $_SESSION["username"] . "&courseID=". $result["courseID"] ."' method='get'>
      "<a class='tool-button' href='assignment.php?user=" . $_SESSION["username"] . "&courseID=". $_GET["courseID"]. "&assignmentID=". $row["assignmentID"] . "'>
      <div class='course-card'>
      <div>   
      <h1>" . $row["title"] . "</h1>
      <p>Uploaded: " . $row["submissionDate"] . "</p>
      <p>Due: " . $row["dueDate"] . "</p>
      </div>
      </div>
      </a>";
    }
    ?>
    
  </form>
</main>
<footer class="footer"><?php include "php/footer.php"; exec("php php/footer.php");?></footer>
</body>
</html>
