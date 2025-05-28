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
      <h1 class = "text-center">Create Assignment</h1>

      <!--pass the course ID-->
      <?php
      echo "<input type='hidden' class='form-control' id='validationTooltip01' name='courseID' value='" . $_GET['courseID'] . "'>"
      ?>
      <hr></hr>

      <div class="row justify-content-center">
        <div class="col-sm-2">
          <label for="validationTooltip01">Assignment Title</label>
          <input type="text" class="form-control" id="validationTooltip01" placeholder="ex. Homework 1" name="title" required>
          <div class="valid-tooltip">
            Looks good!
          </div>
        </div>
        <div class="col-sm-2">
          <label for="start">Due Date:</label>
          <?php
          $aYearFromNow = date_format(date_add(date_create(date("Y-m-d")),date_interval_create_from_date_string("365 days")), "Y/m/d");

          echo "<input type='date' class='form-control' id='dueDate' name='dueDate' value='" . date("Y-m-d") . "'  min='" . date("Y-m-d") . "' max='" . $aYearFromNow . "' />";
          ?>
          <br>
        </div>

        <hr></hr>
        <div class="row justify-content-center">
          <section class="file-submission">
            <h2>Attach Assignment</h2>
            <!-- <input type="hidden" name ="MAX FILE SIZE" value = "1073741824"> -->
            <div class="mb-3">
              <label for="myfile" class="form-label">Upload File:</label>
              <input type="file" class="form-control" id="file" name="myFile">
              <small id="fileHelp" class="form-text text-muted">Accepted file formats: PDF, DOC, DOCX, ZIP, txt</small>
            </div>
            
            <div class="mb-3">
              <label for="notes" class="form-label">Notes:</label>
              <textarea class="form-control" id="notes" name="notes" rows="4" placeholder="Add any additional notes or comments"></textarea>
            </div>
          </section>
        </div>

        <div class="text-center">
          <button class="btn btn-primary" type="submit">Submit form</button>
        </div>
      </form>
      <br></br>
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
