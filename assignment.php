<!DOCTYPE html>
<html lang="en">
<head><?php include "php/head.php"; exec("php php/head.php");?></head>
<body>
  <header><?php include "php/navbar.php"; exec("php php/navbar.php");?></header>

  <main class="container-fluid">
    <br>
    <!--https://getbootstrap.com/docs/5.0/forms/form-control/-->
    <form class="needs-validation" action="php/submit_assignment.php" method="post" enctype="multipart/form-data"  novalidate>
    <?php include "php/assignment-script.php"; exec("php php/assignment-script.php");?>
    </form>
    <br>
  </main>
  
  <footer class="footer"><?php include "php/footer.php"; exec("php php/footer.php");?></footer>
  
</body>
</html>