<?php
  session_start();
  
  if(!isset($_SESSION['id']) || $_SESSION['userType'] != 'Student')
    header("location: index.php");

  require_once('php/header.php');
?>
    <main class="bg">
      <section class="full-width styledMain">
        <h1>Student Panel</h1>
      </section>
    </main>
    <main class="maincontent">
    <h3 style="color:#8c0007">My information</h3><br>
    <?php
      require_once 'php/DatabaseAPI.php';

      $db = new Database();

      $data = $db->select(array("first_name", "last_name", "father_name", "father_job", "father_phone", "mother_name", "mother_job", "mother_phone", "grade", "section", "email", "parents_email", "username"), "students", "sID = " . $_SESSION['id'], null, null, null, null);
      
      echo '<table cellpadding=15 border=1 align="center"><tr bgcolor="#ffe2e4"><th>First Name</th>
            <th>Last Name</th>
            <th>Father Name</td>
            <th>Father Job</th>
            <th>Father Phone</th>
            <th>Mother Name</th>
            <th>Mother Job</th>
            <th>Mother Phone</th>
            <th>Grade</th>
            <th>Section</th>
            <th>Email</th>
            <th>Parents Email</th>
            <th>Username</th></tr>
            <tr>
            <td>'. $data[0]['first_name'] . '</td>
            <td>'. $data[0]['last_name'] . '</td>
            <td>'. $data[0]['father_name'] . '</td>
            <td>'. $data[0]['father_job'] . '</td>
            <td>'. $data[0]['father_phone'] . '</td>
            <td>'. $data[0]['mother_name'] . '</td>
            <td>'. $data[0]['mother_job'] . '</td>
            <td>'. $data[0]['mother_phone'] . '</td>
            <td>'. $data[0]['grade'] . '</td>
            <td>'. $data[0]['section'] . '</td>
            <td>'. $data[0]['email'] . '</td>
            <td>'. $data[0]['parents_email'] . '</td>
            <td>'. $data[0]['username'] . '</td>
            </tr>
      </table>
      '
    ?> 
    <div class="twoThirds">
    <h3 style="color:#8c0007; margin-bottom: 0">My Course Schedule</h3><br>
    <?php
      require_once 'php/DatabaseAPI.php';

      $db = new Database();

      $sched = $db->select(array("*"), "course_schedule", "grade = " . $data[0]['grade'] . " and section = " . $data[0]['section'], null, null, null, null)[0];
      
      echo '<table cellpadding=8 border=1><tr bgcolor="#ffe2e4"><th></th>
            <th>Lec #1</th><th>Lec #2</th><th>Lec #3</th><th>Lec #4</th><th>Lec #5</th><th>Lec #6</th><th>Lec #7</th><th>Lec #8</th></tr>
            <tr>
            <td>Teacher</td>
            ';
            for($i = 1; $i <= 8; $i++)
            {
              $teaName = $db->select(array("name"), "employees", "eID = " . $sched['lec' . $i . '_teacher'], null, null, null, null)[0]["name"];
              echo '<td>'. $teaName . '</td>';
            }
            echo '
            </tr><tr>
            <td>Subject</td> ';
            for($i = 1; $i <= 8; $i++)
              echo '<td>'. $sched['lec' . $i . '_subject'] . '</td>';
          echo '</tr></table>';
    ?> 
  </div>
    <form method="post" action="" id="updatePWform" class="third" style="margin-bottom: 0; padding-bottom: 0">
      <fieldset>
        <legend>Update My Password</legend>
        <br>
        <label>Current Password</label><br>
        <input type="password" name="currPW"  id="currPW" required><br><br>
        <label>New Password</label><br>
        <input type="password" name="newPW"  id="newPW" required><br><br>
        <label>Re-enter New Password</label><br>
        <input type="password" name="reNewPW"  id="reNewPW" required>
        <br><br>
        <input type="submit" class="btn-default" value="Update">
        <br>
      </fieldset>
    </form>
    <div class="twoThirds" style="padding-top: 0; margin-top: 0">
    <h3 style="color:#8c0007; margin-top: 0">My Marks</h3>
    <?php
      require_once 'php/DatabaseAPI.php';

      $db = new Database();

      $subsM = $db->selectDistinct(array("subject"), "marks", "grade = " . $data[0]['grade'] . " and section = " . $data[0]['section'], null, null, null, null);

      foreach($subsM as $subM)
      {
        echo '<h4 style="margin-left: 15px;">' . $subM['subject'] . ':</h4>';

        $mIDs = $db->select(array("mID", "name"), "marks", "grade = " . $data[0]['grade'] . " and section = " . $data[0]['section'] . " and subject = '" . $subM['subject'] . "'", null, null, null, null);

        foreach($mIDs as $mID)
        {
          $marksM = $db->select(array("mark"), "marks_students", "mID = " . $mID['mID'] . " and sID = " . $_SESSION['id'], null, null, null, null)[0];

          echo '<h4 style="color:#2c4977;margin-left: 30px"> - ' . $mID['name'] . ':&nbsp;&nbsp;&nbsp;' . $marksM['mark'] . '%</h4>';
        }
      }
    ?> 
  </div>
  </main>
<?php
  require_once('php/footer.php');
?>