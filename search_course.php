<!DOCTYPE html>
<html lang="en">
<head><?php include "php/head.php"; exec("php php/head.php");?></head>
<body>
  <header><?php include "php/navbar.php"; exec("php php/navbar.php");?></header>
  <link rel="stylesheet" href="css/search-course.css">
  <link rel="stylesheet" href="css/course.css">
  <main class="container-fluid" role="main">
    <!--For icons: https://icons.getbootstrap.com/-->
    <!--For button link: https://stackoverflow.com/questions/36003670/how-to-put-a-link-on-a-button-with-bootstrap-->
    <br>
    <form class="needs-validation" action="php/search-course-handler.php" method="post" novalidate>

      <h1 class = "text-center">Search Course Catalogue</h1>

      <hr></hr>

      <div class="row justify-content-center">
        <div class="col-sm-2">
          <label for="state" class="col-sm-2 control-label">Subject</label>
          <select class="form-control" id="subject" name="subject">
            <option value="">N/A</option>
            <option value="ACCT">Accounting</option>
            <option value="ARTS">Art</option>
            <option value="BIOL">Biology</option>
            <option value="CHEM">Chemistry</option>
            <option value="COMM">Communication</option>
            <option value="COMP">Computer Science</option>
            <option value="ECON">Economics</option>
            <option value="ENGL">English</option>
            <option value="GEOG">Geograhy</option>
            <option value="HIST">History</option>
            <option value="MATH">Math</option>
            <option value="MUSC">Msuic</option>
            <option value="PHYS">Physics</option>
            <option value="PSYC">Physcology</option>
            <option value="SOCI">Sociology</option>
          </select>
        </div>


        <div class="col-sm-2">
          <label for="validationTooltip08">Course Code</label>
          <input type="text" class="form-control" id="validationTooltip08" placeholder="ex. 244" name="code" required>
          <div class="valid-tooltip">
            Looks good!
          </div>
        </div>


        <div class="col-sm-2">
          <label for="state" class="col-sm-2 control-label">Semester</label>
          <select class="form-control" id="semester" name="semester">
            <option value="">N/A</option>
            <option value="Fall">Fall</option>
            <option value="Spring">Spring</option>
            <option value="Summer">Summer</option>
          </select>
        </div>

        <div class="col-sm-2">
          <label for="state" class="col-sm-2 control-label">Year</label>
          <select class="form-control" id="year" name="year">
            <option value="">N/A</option>
            <option value="2024">2024</option>
            <option value="2025">2025</option>
            <option value="2026">2026</option>
            <option value="2027">2027</option>
            <option value="2028">2028</option>
          </select>
        </div>

        <div class="col-sm-2">
          <label for="state" class="col-sm-2 control-label">Instructor</label>
          <select class="form-control" id="instructor" name="instructor">
            <option value="">N/A</option>
            <?php
            $sql = "SELECT firstName, lastName, instructors.userID FROM instructors INNER JOIN users ON users.userID = instructors.userID ORDER BY lastName";

            $result = mysqli_query($conn, $sql);

            $instructors = mysqli_fetch_all($result, MYSQLI_ASSOC);

            foreach($instructors as $row) {
              echo "<option value='" . $row["userID"] . "'>" . $row["lastName"] . ", " . $row["firstName"] . "</option>";
            } 
            ?>
          </select>
        </div>
      </div>

      <hr></hr>
      <div class="text-center">
        <button class="btn btn-primary" type="submit">Search</button>
      </div>
    </form>

    <hr></hr>

    

    <?php
    ini_set('display_errors', 0);
    if($_SESSION["result"] != "") {
      foreach($_SESSION["result"] as $result) {
        echo 
          //"<form class='needs-validation' action='php/register-to-course.php?user=" . $_SESSION["username"] . "&courseID=". $result["courseID"] ."' method='get'>
        "<div class='course-card'>
        <div>   
        <h1>" . $result["subject"] . ": " . $result["courseTitle"] . "</h1>
        <p>" . $result["semester"] . " " . $result["year"] . ", " . $result["firstName"] . " " . $result["lastName"] . "</p>
        </div>";
        
              //change username to userID
        $query = "SELECT userID FROM users WHERE username = '" . $_SESSION["username"] . "'";
        $return = mysqli_query($conn, $query);
        $return = $return -> fetch_all(MYSQLI_ASSOC);
        $userID = $return[0]['userID'];

              //where logged in user and course exists
        $query = "SELECT userID, courseID FROM takes WHERE userID = '" . $userID . "' AND courseID='" . $result["courseID"] . "'";
        $return = mysqli_query($conn, $query);
        $return = $return -> fetch_all(MYSQLI_ASSOC);
        
        if(count($return) == 0) {
          echo 
          "<div class='register-button'>
          <a id='register' href='php/register-to-course.php?user=" . $_SESSION["username"] . "&courseID=". $result["courseID"] ."'>Register</a>
          </div>
          </div>
          </form><br>";
        }
        else {
          echo 
          "<div class='register-button'>
          <a id='registered' href='php/unregister-to-course.php?user=" . $_SESSION["username"] . "&courseID=". $result["courseID"] ."'>Registered</a>
          </div>
          </div>
          </form><br>";
        }
      }
    }
    ?>
    
  </form>
  </main>
  <footer class="footer"><?php include "php/footer.php"; exec("php php/footer.php");?></footer>
</body>
</html>
