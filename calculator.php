<!DOCTYPE html>
<html lang="en">
<head><?php include "php/head.php"; exec("php php/head.php");?></head>
<body>
  <header><?php include "php/navbar.php"; exec("php php/navbar.php");?></header>

  <!-- Calculator Scripts -->
  <link rel="stylesheet" href="css/calculator.css"/> 
  <script src="js/calculator.js"></script>

  <!-- Added classes -->
  <main class="container-fluid">
    <br>

    <div class="row">

      <!-- Grades Boxes -->
      <div class="col-md-5">
        <div class="grades-box">
          <h3 class="grades-header">Grades</h3>
        </div>
      </div>

      <!-- Final Grade Calculator Box -->
      <div class="col-md-7">
        <div class="ui-box">
          <h3 class="header">Final Grade Calculator</h3>

          <!-- Finds -->
          <div class="input-group">
            <label for="find">Find:</label>
            <select id="find" onchange="changeOptions()">
              <option value="final-exam">Final Exam Grade I Need</option>
              <option value="final-class">Final Class Grade</option> 
            </select>
          </div>

          <!-- Current Grade -->
          <div class="input-group">
            <label id="first-option-label" for="first-option">Current Grade:</label>
            <input type="text" class="form-control" id="first-option" placeholder="Enter current grade">
            <span>%</span>
          </div>

          <!-- Desired Grade -->
          <div class="input-group">
            <label id="second-option-label" for="second-option">Desired Grade:</label>
            <input type="text" class="form-control" id="second-option" placeholder="Enter grade">
            <span>%</span>
          </div>

          <!-- Final Exam Weight -->
          <div class="input-group">
            <label id="third-option-label" for="third-option">Final Exam Weight:</label>
            <input type="text" class="form-control" id="third-option" placeholder="Enter exam weight">
            <span>%</span>
          </div>

          <!-- Answer -->
          <label for="answer-box">Answer:</label>
          <input class="form-control" type="text" id="answer-box" readonly></input>
          <div class="button-group">
            <button id="clear-button" class="btn btn-primary">Clear</button>
            <button id="calculate-button" class="btn btn-primary">Calculate</button>
          </div>
        </div>
      </div>

    </div>

    <br>    
  </main>

  <footer class="footer"><?php include "php/footer.php"; exec("php php/footer.php");?></footer>
</body>
</html>
