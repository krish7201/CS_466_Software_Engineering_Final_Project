<?php
echo "<input type='hidden' class='form-control' id='assignmentID' name='assignmentID' value='" . $_GET['assignmentID'] . "'>";
echo "<input type='hidden' class='form-control' id='courseID' name='courseID' value='" . $_GET['courseID'] . "'>";
?>
<div class="mb-3">
  <?php
  $query = "SELECT * FROM assignments WHERE assignmentID='" . $_GET["assignmentID"] . "'";
  $return = mysqli_query($conn, $query);
  $return = $return -> fetch_all(MYSQLI_ASSOC);
  $return = $return[0];

  echo "<label for='formFile' class='form-label'><b>" . $return['title'] . " submission box.</b></label>";
  ?>
  <input class="form-control" type="file" id="formFile" name="myfile">
</div>

<?php

    //check is user has already submitted
    //change username to userID
$query = "SELECT userID FROM users WHERE username = '" . $_SESSION["username"] . "'";
$return = mysqli_query($conn, $query);
$return = $return -> fetch_all(MYSQLI_ASSOC);
$userID = $return[0]['userID'];

    //find row if exists
$query = "SELECT userID FROM submissions  WHERE userID ='" . $userID . "' AND assignmentID='" . $_GET["assignmentID"] . "'";
$return = mysqli_query($conn, $query);
$return = $return -> fetch_all(MYSQLI_ASSOC);

if(count($return) == 0) {
  echo "<div class='mb-3'>
  <label for='exampleFormControlTextarea1' class='form-label'>Example textarea</label>
  <textarea class='form-control' id='notes' name='notes' rows='4' placeholder='Add any additional notes or comments'></textarea>
  </div>
  <div class='text-center'>
  <!--https://getbootstrap.com/docs/4.0/components/buttons/-->
  <button class='btn btn-primary' type='submit'>Submit Assignment</button>
  </div>";
} 
else {
  echo "<div class='mb-3'>
  <label for='exampleFormControlTextarea1' class='form-label'>Example textarea</label>
  <textarea class='form-control' id='notes' name='notes' rows='4' placeholder='' disabled></textarea>
  </div >
  <div class='text-center'>
  <!--https://getbootstrap.com/docs/4.0/components/buttons/-->
  <button class='btn btn-primary' type='submit' disabled>Submit Assignment</button><br>
  <p><b>Your file/s have been submitted</b></p>
  </div>";
}
?>