<!DOCTYPE html>
<html lang="en">
<head><?php include "php/head.php"; exec("php php/head.php");?></head>
<body>
  <header><?php include "php/navbar.php"; exec("php php/navbar.php");?></header>
  <!-- include libraries(jQuery, bootstrap) -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

  <!-- include summernote css/js -->
  <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>

  <main class="container-fluid">

    <form class="needs-validation" action="php/create-announcement-handler.php" method="post" novalidate>

      <h1 class = "text-center">Create New Announcement</h1>

      <div class = "text-center"> 

        <!--Post Title-->
        <div class="row justify-content-center">
          <div class="col-sm-4">
            <label for="validationTooltip01">Post Title</label>
            <input type="text" class="form-control" id="validationTooltip01" placeholder="MyPostTitle" name="postTitle" required>
            <div class="valid-tooltip">
              Looks good!
            </div>
          </div>
        </div>
        <br>
        <!--Text Editor-->
        <div class="row justify-content-center">
          <div class="col-sm-8">
            <textarea id="summernote" name="postText"></textarea>
            <script>
              $(document).ready(function() {
                $('#summernote').summernote();
                $('div.note-editable').height('33.5vh');
              });
            </script>


            <div class="invalid-tooltip">
              Please choose a unique and valid username.
            </div>
          </div> 
        </div>
        <button class="btn btn-primary" type="submit">Submit form</button>
      </div>

    </form>
  </main>

  <footer class="footer"><?php include "php/footer.php"; exec("php php/footer.php");?></footer>
</body>
</html>