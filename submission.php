<!DOCTYPE html>
<html lang="en">
<head><?php include "php/head.php"; exec("php php/head.php");?></head>
<body>
  <header><?php include "php/navbar.php"; exec("php php/navbar.php");?></header>

  <main class="container-fluid mt-5">
    <!-- Assignment Details Section -->
    <section class="assignment-details mb-5">
      <h2>Assignment Details</h2>
      <div id="assignmentInfo" class="assignment-info">
        <p><strong>Assignment Title:</strong> <span id="assignmentTitle"></span></p>
        <p><strong>Deadline:</strong> <span id="assignmentDeadline"></span></p>
        <p><strong>Description:</strong> <span id="assignmentDescription"></span></p>
      </div>
    </section>

    <hr></hr>

    <!-- File Submission Section -->
    <section class="file-submission">
      <h2>Submit Your Work</h2>
      <form id="assignmentForm" action="php/submit_assignment.php" method="post" onsubmit="return validateForm()">
        <!-- <input type="hidden" name ="MAX FILE SIZE" value = "1073741824"> -->
        <div class="mb-3">
          <label for="myfile" class="form-label">Upload File:</label>
          <input type="file" class="form-control" id="myfile" name="myfile" accept=".pdf,.doc,.docx, .ZIP, .txt" onchange="enableSubmitButton()" />
          <small id="fileHelp" class="form-text text-muted">Accepted file formats: PDF, DOC, DOCX, ZIP, txt</small>
        </div>
        <div class="mb-3">
          <label for="notes" class="form-label">Notes:</label>
          <textarea class="form-control" id="notes" name="notes" rows="4" placeholder="Add any additional notes or comments"></textarea>
        </div>
        <br>
        <div class="text-center">
          <button type="submit" id="submitBtn" class="btn btn-primary" disabled>Submit Assignment</button>
        </div>
      </form>
    </section>
  </main>

  <script src="js/submission.js"></script>

  <footer class="footer"><?php include "php/footer.php"; exec("php php/footer.php");?></footer>
</body>
</html>