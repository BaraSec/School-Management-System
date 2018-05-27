<?php
  session_start();
  
  if(!isset($_SESSION['id']) || $_SESSION['userType'] != 'Teacher')
    header("location: index.php");

  require_once('php/header.php');
?>
    <main class="bg">
      <section class="full-width styledMain">
        <h1>Teacher Panel</h1>
      </section>
    </main>
    <main class="maincontent">
    <div class="twoThirds">
    <h3 style="color:#8c0007; margin-bottom: 0">My Time Table</h3><br>
    <?php
      require_once 'php/DatabaseAPI.php';

      $db = new Database();
      
      echo '<table cellpadding=8 border=1><tr bgcolor="#ffe2e4">
            <th>Lec #1</th><th>Lec #2</th><th>Lec #3</th><th>Lec #4</th><th>Lec #5</th><th>Lec #6</th><th>Lec #7</th><th>Lec #8</th></tr>
            <tr>
            ';

            for($i = 1; $i <= 8; $i++)
            {
              $TT = $db->select(array("grade", "section", 'lec' . $i . '_subject'), "course_schedule", "lec" . $i . "_teacher = " . $_SESSION['id'], null, null, null, null)[0];
              if($TT != null)
                echo '<td>Grade: '. $TT['grade'] . '<br> Section: ' . $TT['section'] . '<br>Subject: ' . $TT['lec' . $i . '_subject'] . '</td>';
              else
                echo '<td align="center">-</td>';
            }
            echo '</tr></table>';
    ?>
  </div>
    <form method="post" action="" id="updatePWform" class="third">
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
    <form method="post" action="" id="viewStd" class="half" style="padding-top: 0px; width: 38%;">
      <fieldset>
      <legend>View Student's Information</legend>
      <br><select name="StdtoView" id="StdtoView">
      <option selected></option>
      <?php
        require_once 'php/DatabaseAPI.php';

        $db = new Database();

        $cond = "lec1_teacher = " . $_SESSION['id'];

        for($i = 2; $i <= 8; $i++)
          $cond .= " or lec" . $i . "_teacher = " . $_SESSION['id'];

        $data = $db->exec('select sID, first_name, last_name, grade, section from students as s1 where exists (select grade from course_schedule where (' . $cond . ') and section = s1.section and grade = s1.grade)');

        foreach($data as $std)
          echo '<option value="' . $std['sID'] . '">' . $std['first_name'] . ' ' . $std['last_name'] . ' | Grade: ' . $std['grade'] . ' | Section: ' . $std['section'] . '</option>';
      ?>
      </select>
      <div id="stdInfo"></div>
      </fieldset>
    </form>
    <div class="half"></div>
    <form method="post" action="" id="addM" class="half" style="padding-top: 0px; width: 38%;">
      <fieldset>
        <legend>Add Exam/Assignment Marks</legend><br>
        <label style="margin-left: 10px;">Name: </label>
        <input type="text" name="mName" id="mName" style="width: 14%;" required>
        <label style="margin-left: 10px;">Grade #: </label>
        <select name="mGrade" id="mGrade" required>
          <option selected></option>
          <?php
            require_once 'php/DatabaseAPI.php';

            $db = new Database();

            $data = $db->select(array("grade"), "course_schedule", $cond, null, null, null, null);

            foreach($data as $grade)
              echo '<option value="' . $grade['grade'] . '">' . $grade['grade'] . '</option>';
          ?>
        </select>
        <label style="margin-left: 10px;">Section #: </label>
        <select name="mSec" id="mSec" required>
        </select>
        <label style="margin-left: 10px;">Subject: </label>
        <select name="mSub" id="mSub" required style="margin-left: 10px;">.
        <option selected></option>
        </select><br><br>
        <div id="stds"></div>
        <input type="submit" class="btn-default" style="margin-left: 536px; font-size: .9em;padding: 5px;" value="Add">
      </fieldset>
    </form>
    <div class="third"></div>
    <div class="third" style="width: 28%;"></div>
    </main>
    </main>
<?php
  require_once('php/footer.php');
?>