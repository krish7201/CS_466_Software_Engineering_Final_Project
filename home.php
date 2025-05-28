<!DOCTYPE html>
<html lang="en">
<head><?php include "php/head.php"; exec("php php/head.php");?></head>
<body>
  <header><?php include "php/navbar.php"; exec("php php/navbar.php");?></header>
  <link rel="stylesheet" href="css/home.css"/>
  <style>#prevent-select {-webkit-user-select: none; /* Safari */-ms-user-select: none; /* IE 10 and IE 11 */user-select: none; /* Standard syntax */}</style>
  <style>.prevent-select {-webkit-user-select: none; /* Safari */-ms-user-select: none; /* IE 10 and IE 11 */user-select: none; /* Standard syntax */}</style>


  <main class = "container-fluid">
    <!--For icons: https://icons.getbootstrap.com/-->
    <!--For button link: https://stackoverflow.com/questions/36003670/how-to-put-a-link-on-a-button-with-bootstrap-->

    <!--Home Page Banner-->
    <div id="prevent-select"class="jumbotron" >

      <h1 id="banner-text">Welcome back,
        <?php 
        $sql = "SELECT firstName, lastName FROM users WHERE username ='" . $_SESSION['username'] . "'";
        $result = mysqli_query($conn, $sql);
        $user = mysqli_fetch_all($result, MYSQLI_ASSOC);

        echo $user[0]['firstName'] . " " . $user[0]['lastName'] . ".";
        ?>
      </h1>

    </div>
    <br>
      <hr></hr>


      <!--Home Page Courses-->
      <div id="card-div" class="row row-cols-1 row-cols-md-3 g-4 text-center">
        <?php
        //change username to userID
        $query = "SELECT userID FROM users WHERE username = '" . $_SESSION["username"] . "'";
        $return = mysqli_query($conn, $query);
        $return = $return -> fetch_all(MYSQLI_ASSOC);
        $userID = $return[0]['userID'];

        $query = "SELECT * FROM users NATURAL JOIN takes NATURAL JOIN courses WHERE userID = '" . $userID . "'";
        $return = mysqli_query($conn, $query);
        $return = $return -> fetch_all(MYSQLI_ASSOC);
        
        foreach($return as $row) {
          echo
          "
          <div id='prevent-select' class='col'>
          <div class='card'>
            <!-- there's something messed up with the code, this a tag has to be here or the link won't work-->
            <a style='text-decoration:none' href='course.php?user=" . $_SESSION["username"] . "&courseID=". $row["courseID"] . "'>
            <img src='photos/banner-photos/" . $row["photoIndex"] . ".jpg' class='card-img-top' alt='...'>
            <div class='card-body'>
            <p class='card-university'>Winona State University</p>
            <p class='section'>" . $row['semester'] . " " . $row['year'] . "</p>
            <p class='card-text'>" . $row['subject'] . " " . $row['courseCode'] . ": " . $row['courseTitle'] . "</p>
          </div>
          </a>
          </div>
          </div>
          ";
        }

        $query = "SELECT * FROM courses WHERE instructorID = '" . $userID . "'";
        $return = mysqli_query($conn, $query);
        $return = $return -> fetch_all(MYSQLI_ASSOC);
          
        foreach($return as $row) {
          echo
          "
          <div id='prevent-select' class='col'>
          <div class='card'>
            <!-- there's something messed up with the code, this a tag has to be here or the link won't work-->
            <a style='text-decoration:none' href='course.php?user=" . $_SESSION["username"] . "&courseID=". $row["courseID"] . "'>
            <img src='photos/banner-photos/" . $row["photoIndex"] . ".jpg' class='card-img-top' alt='...'>
            <div class='card-body'>
            <p class='card-university'>Winona State University</p>
            <p class='section'>" . $row['semester'] . " " . $row['year'] . "</p>
            <p class='card-text'>" . $row['subject'] . " " . $row['courseCode'] . ": " . $row['courseTitle'] . "</p>
          </div>
          </a>
          </div>
          </div>
          ";
        }
        ?>
        
      </div>
      <br>
    </main>

    <footer class="footer"><?php include "php/footer.php"; exec("php php/footer.php");?></footer>
  </body>
  </html>
