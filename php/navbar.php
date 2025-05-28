<style>#prevent-select {-webkit-user-select: none; /* Safari */-ms-user-select: none; /* IE 10 and IE 11 */user-select: none; /* Standard syntax */}</style>
<nav id="prevent-select" class="navbar navbar-expand-lg bg-body-tertiary">
    <div id="prevent-select" class="container-fluid" >

        <!--Logo-->
        <img id="prevent-select" src="assets/CAP_LOGO.png" alt="AcaStat Logo" width="5%" height="auto">
        <img id="prevent-select" src="assets/ACASTAT_TEXT.png" alt="AcaStat Text" width="6%" height="auto" style = "margin-right:1%">

        <!--nav tabs-->
        <ul class="nav nav-tabs me-auto mb-2 mb-lg-0" id="prevent-select" role="tablist">

            <!--Home-->
            <li class="nav-item">
                <a id="prevent-select" class="nav-link" style="color:black;" href="home.php">Home</a>
            </li>

            <!--Search Catalogue-->
            <li class="nav-item">
                <a id="prevent-select"  class="nav-link" style="color:black;" href="search_course.php">Course Catalogue</a>
            </li>

            <!--Institution-->
            <li class="nav-item dropdown">
                <a id="prevent-select"  class="nav-link dropdown-toggle" style="color:black;" role="button" data-bs-toggle="dropdown" aria-expanded="false">Institution</a>
                <ul class="dropdown-menu">
                    <li><a id="prevent-select"  class="dropdown-item" href="#">Action</a></li>
                    <!--<li><a id="prevent-select"  class="dropdown-item" href="#">Another action</a></li> [extra item example]-->
                </ul>
            </li>

            <!--Courses-->
            <li class="nav-item dropdown">
                <a id="prevent-select"  class="nav-link dropdown-toggle" style="color:black;" role="button" data-bs-toggle="dropdown" aria-expanded="false">Courses</a>
                <ul class="dropdown-menu">
                    <?php
                    //change username to userID
                    $query = "SELECT userID FROM users WHERE username = '" . $_SESSION["username"] . "'";
                    $return = mysqli_query($conn, $query);
                    $return = $return -> fetch_all(MYSQLI_ASSOC);
                    $userID = $return[0]['userID'];

                    //For students
                    $query = "SELECT * FROM users NATURAL JOIN takes NATURAL JOIN courses WHERE userID = '" . $userID . " ' ORDER BY courses.subject, courses.courseTitle";
                    $return = mysqli_query($conn, $query);
                    $return = $return -> fetch_all(MYSQLI_ASSOC);

                    if(count($return) != 0) {
                        echo "<li><a style='background-color:#000;' disabled>&nbsp;&nbsp;Taking:</a></li>";
                    }

                    foreach($return as $row) {
                      echo
                      "
                      <li>
                      <a id='prevent-select' class='dropdown-item' href='course.php?user=" . $_SESSION["username"] . "&courseID=". $row["courseID"] . "'>"
                      . $row['subject'] . " " . $row['courseCode'] . ": " . $row['courseTitle'] . "
                      </a>
                      </li>";
                    }

                    //For instructors
                    $query = "SELECT * FROM courses WHERE instructorID = '" . $userID . "' ORDER BY courses.subject, courses.courseTitle";
                    $return = mysqli_query($conn, $query);
                    $return = $return -> fetch_all(MYSQLI_ASSOC);

                    if(count($return) != 0) {
                        echo "<li><a>&nbsp;&nbsp;Teaching:</a></li>";
                    }

                    foreach($return as $row) {
                      echo "<li>
                      <a id='prevent-select' class='dropdown-item' href='course.php?user=" . $_SESSION["username"] . "&courseID=". $row["courseID"] . "'>"
                      . $row['subject'] . " " . $row['courseCode'] . ": " . $row['courseTitle'] . "
                      </a>
                      </li>";
                    }
                    ?>
                </ul>
            </li>

            <!--Tools-->
            <?php 
            if ($conn) {
                $uname = $_SESSION["username"];
                $sql = "SELECT * FROM users INNER JOIN admins WHERE username = '$uname' AND users.userID = admins.userID";
                $result = mysqli_query($conn, $sql);

                echo '<li class="nav-item dropdown">';
                echo '<a id="prevent-select"  class="nav-link dropdown-toggle" style="color:black;" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Tools</a>';
                echo '<ul class="dropdown-menu">';
                if (mysqli_num_rows($result) == 1) {
                    echo '<li><a id="prevent-select"  class="dropdown-item" href="create_user.php">Create New User</a></li>';
                    echo '<li><a id="prevent-select"  class="dropdown-item" href="create_course.php">Create New Course</a></li>';
                }
                echo '<li><a id="prevent-select"  class="dropdown-item" href="calculator.php">Grades/Calculator</a></li>';
                echo '<li><a id="prevent-select"  class="dropdown-item" href="planner.php">Planner</a></li>';
                echo '</ul>';
                echo '</li>';
            }
            ?>
        </ul>

        <!--Logout button-->
        <form action="php/logout.php" method="post" class="d-flex">
            <button type="submit" class="btn btn-outline-dark me-2">Sign Out <i class="bi bi-box-arrow-right"></i></button>
        </form>

    </div>
</nav>