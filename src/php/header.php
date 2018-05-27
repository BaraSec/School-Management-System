<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Al-Salam School</title>
    <link href="https://fonts.googleapis.com/css?family=Signika|Open+Sans" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet">
    <link rel="stylesheet" href="css/main.css"/>
    <script type="text/javascript" src="js/main.js"></script>
    <script type="text/javascript" src="js/controller.js"></script>
  </head>
  <body>
    <header>
      <div class="logo">
        Al-Salam School
      </div>
      <nav>
        <div>
          <ul>
            <li><a class="active" href="../../../../../../Projects/School System Project/index.php">Home</a></li>
            <li><a href="about.php">About</a></li>
            <li><a href="admissions.php">Admissions</a></li>
            <li><a href="fees.php">Tuition and Fees</a></li>
            <li><a href="apply.php">Apply</a></li>
            <li><a href="contact.php">Contact us</a></li>
            <?php
              session_start();

              if (!isset($_SESSION['userType'])) 
              {
                echo '<li><a href="signin.php">Sign in</a></li>';
              }
              else if($_SESSION['userType'] == "Headmaster") 
              {
                echo '<li><a href="index.php" id="signout">Sign Out</a></li>
                      <li><a href="headmaster.php">'. $_SESSION['username'] .'</a></li>';
              }
              else if($_SESSION['userType'] == "Teacher")
              {
                echo '<li><a href="index.php" id="signout">Sign Out</a></li>
                      <li><a href="teacher.php">'. $_SESSION['username'] .'</a></li>';
              }
              else if($_SESSION['userType'] == "Student")
              {
                echo '<li><a href="index.php" id="signout">Sign Out</a></li>
                      <li><a href="student.php">'. $_SESSION['username'] .'</a></li>';
              }
            ?>
          </ul>
        </div>
      </nav>
    </header>