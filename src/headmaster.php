<?php
  session_start();

  if(!isset($_SESSION['id']) || $_SESSION['userType'] != 'Headmaster')
    header("location: index.php");

  require_once('php/header.php');
?>
    <main class="bg">
      <section class="full-width styledMain">
        <h1>Admin Panel</h1>
      </section>
    </main>
    <?php 

      require_once 'php/DatabaseAPI.php';

      $db = new Database();

      $count = $db->select(array("count(applicID)"), "applications", "status = 'Pending'", null, null, null, null)[0]['count(applicID)'];

      if($count > 0)
      {
        echo '
          <main class="maincontent">
          <h3 style="color:#8c0007">New Student Applications</h3><br>
          <table cellpadding="5" border=1 align="center">
            <thead>
              <tr bgcolor="#ffe2e4">
                <th>First Name</th>
                <th>Last Name</th>
                <th>Gender</th>
                <th>DOB</th>
                <th>Grade</th>
                <th>Average</th>
                <th>Email</th>
                <th>Interests</th>
                <th>Father Name</th>
                <th>Father Job</th>
                <th>Father Phone</th>
                <th>Mother Name</th>
                <th>Mother Job</th>
                <th>Mother Phone</th>
                <th>Parents Email</th>
                <th>Payment Details</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
        ';
      
          $data = $db->select(array("*"), "applications", "status = 'Pending'", null, null, "applicID desc", null);

           foreach ($data as $appl)
           {
              echo '<tr>';
              echo '<td>'. $appl['first_name'] . '</td>';
              echo '<td>'. $appl['last_name'] . '</td>';
              echo '<td>'. $appl['gender'] . '</td>';
              echo '<td>'. $appl['dob'] . '</td>';
              echo '<td>'. $appl['grade'] . '</td>';
              echo '<td>'. $appl['average'] . ' %</td>';
              echo '<td>'. $appl['email'] . '</td>';
              echo '<td>'. $appl['interests'] . '</td>';
              echo '<td>'. $appl['father_name'] . '</td>';
              echo '<td>'. $appl['father_job'] . '</td>';
              echo '<td>'. $appl['father_phone'] . '</td>';
              echo '<td>'. $appl['mother_name'] . '</td>';
              echo '<td>'. $appl['mother_job'] . '</td>';
              echo '<td>'. $appl['mother_phone'] . '</td>';
              echo '<td>'. $appl['parents_email'] . '</td>';
              echo '<td>'. $appl['payment'] . '</td>';
              echo '<td width="150" align="center">';
              echo '<input type="button" class="btn-default" onclick="acceptAppl('.$appl['applicID'].');" value="Accept">';
              echo ' ';
              echo '<input type="button" class="btn-default" onclick="rejectAppl('.$appl['applicID'].');" value="Reject">';
              echo '</td>';
              echo '</tr>';
           }  

           echo '
            </tbody>
            </table>
            </main>';
        }    
      ?>
    <main class="maincontent">
    <form method="post" action="" id="addEventNewsForm" class="third">
      <fieldset>
        <legend>Add Events/News</legend>
        <br>
        <label>Short Story</label><br>
        <input type="text" name="new_short_story"  id="new_short_story" required><br><br>
        <label>Full Story</label><br>
        <textarea name="new_full_story" rows="10" cols="40" id="new_full_story" required></textarea>
        <br><br>
        <label>Type:</label>&nbsp;&nbsp;
        <select name="eventNewsType" id="eventNewsType" required>
          <option value="events" selected>Event</option>
          <option value="news">News</option>
        </select>
        <br><br>
        <input type="submit" class="btn-default" value="Add">
        <br>
      </fieldset>
    </form>
    <div class="third"></div> 
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
    <form method="post" action="" id="addRemoveTeachers" class="twoThirds" style="padding-top: 0px">
      <fieldset>
        <legend>Add Teacher</legend>
        <br>
        <label>Name</label>
        <input type="text" name="newT_name"  id="newT_name" required>
        <label style="margin-left: 20px;">ID</label>
        <input type="text" name="newT_ID"  id="newT_ID" required><br><br>
        <label>Gender</label>
        <select name="newT_gender" id="newT_gender" required style="margin-left: 10px;">
          <option value="Male" selected>Male</option>
          <option value="Female">Female</option>
        </select>
        <label style="margin-left: 20px;">Date of birth</label>
        <input type="date" name="newT_dob" id="newT_dob" required>
        <br><br>
        <label>Phone number</label>
        <input type="text" name="newT_phone" id="newT_phone" required>
        <label style="margin-left: 20px;">Email Address</label>
        <input type="email" name="newT_email" id="newT_email" required>
        <label style="margin-left: 20px;">Salary</label>
        <input type="number" name="newT_salary" id="newT_salary" step="0.001" style="width: 55px;" required>
        <br><br>
        <label>Username</label>
        <input type="text" name="newT_username" id="newT_username" required>
        <label style="margin-left: 20px;">Password</label>
        <input type="password" name="newT_password" id="newT_password" required>
        <br><br>
        <input type="submit" class="btn-default" value="Add">
        <br>
      </fieldset>
      <fieldset>
        <legend>Remove Teacher</legend>
        <select name="removeTeacher" id="teacherRM">
        <option selected></option>
        <?php
          require_once 'php/DatabaseAPI.php';

          $db = new Database();

          $data = $db->select(array("name", "ID"), "employees", "type = 'Teacher'", null, null, "eID desc", null);

          foreach($data as $teacher)
          {
            echo '<option value="' . $teacher['ID'] . '">' . $teacher['name'] . ' | ' . $teacher['ID'] . '</option>';
          }
        ?>
        </select>
        <input type="button" class="btn-default" style="margin-left: 15px; font-size: .9em;padding: 5px;" value="Remove" id="removeTeacher">
      </fieldset>
    </form>
    <div class="third"></div>
    <form method="post" action="" id="addRemoveSections" class="third" style="padding-top: 0px;width: 38%;">
      <fieldset>
        <legend>Add Section</legend>
        <label style="margin-left: 10px;">to grade: </label>
        <select name="add_section_to" id="add_section_to" required style="margin-left: 10px;">
          <option selected></option>
          <?php
            for ($i = 7; $i <= 12; $i++)
              echo '<option value="' . $i . '">' . $i . '</option>';
          ?>
        </select>
        <input type="button" class="btn-default" style="margin-left: 15px; font-size: .9em;padding: 5px;" value="Add" id="addSec">
      </fieldset>
      <fieldset>
        <legend>Delete Section</legend>
        <label style="margin-left: 10px;">from grade: </label>
        <select name="del_from_grade" id="del_from_grade" required style="margin-left: 10px;">
          <option selected></option>
          <?php
            for ($i = 7; $i <= 12; $i++)
              echo '<option value="' . $i . '">' . $i . '</option>';
          ?>
        </select>
        <label style="margin-left: 10px;">section #: </label>
        <select name="del_section" id="del_section" required>
        </select>
        <input type="button" class="btn-default" style="margin-left: 15px; font-size: .9em;padding: 5px;" value="Delete" id="delSec">
      </fieldset>
    </form>
    <div class="third"></div>
    <div class="third" style="width: 27%"></div>
    <form method="post" action="" id="movStd" class="third" style="padding-top: 0px; width: 38%;">
      <fieldset>
        <legend>Move a Student to Another Section</legend>
        <label style="margin-left: 10px;">Student: </label>
        <select name="std_to_mov" id="std_to_mov" required style="margin-left: 10px;">
          <option selected></option>
         <?php
          require_once 'php/DatabaseAPI.php';

          $db = new Database();

          $data = $db->select(array("sID", "first_name", "last_name", "grade", "section"), "students", null, null, null, "sID desc", null);

          foreach($data as $std)
          {
            echo '<option value="' . $std['sID'] . '">' . $std['first_name'] . ' ' . $std['last_name'] . ' | Grade: ' . $std['grade'] . ' | Section: ' . $std['section'] . '</option>';
          }
        ?>
        </select>
        <label style="margin-left: 10px;">To section #: </label>
        <select name="mov_to_section" id="mov_to_section" required>
        </select>
        <input type="submit" class="btn-default" style="margin-left: 15px; font-size: .9em;padding: 5px;" value="Move" id="movStdToSec">
      </fieldset>
    </form>
    <div class="third"></div>
    <div class="third" style="width: 28%;"></div>
    <form method="post" action="" id="updateSched" class="half" style="padding-top: 0px; width: 38%;">
      <fieldset>
        <legend>Update Course Schedule For:</legend>
        <label style="margin-left: 10px;">Grade #: </label>
        <select name="updGrade" id="updGrade" required style="margin-left: 10px;">
          <option selected></option>
          <?php
            for ($i = 7; $i <= 12; $i++)
              echo '<option value="' . $i . '">' . $i . '</option>';
          ?>
        </select>
        <label style="margin-left: 10px;">Section #: </label>
        <select name="updSec" id="updSec" required>
        </select>
        <label style="margin-left: 10px;">Lecture #: </label>
        <select name="updLec" id="updLec" required style="margin-left: 10px;">.
        <option selected></option>
          <?php
            for ($i = 1; $i <= 8; $i++)
              echo '<option value="' . $i . '">' . $i . '</option>';
          ?>
        </select><br><br>
        <label style="margin-left: 10px;">Subject: </label>
        <input type="text" name="updSub" id="updSub" required>
        <label style="margin-left: 10px;">Teacher: </label>
        <select name="updTeacher" id="updTeacher">
        <option selected></option>
        <?php
          require_once 'php/DatabaseAPI.php';

          $db = new Database();

          $data = $db->select(array("name", "ID"), "employees", "type = 'Teacher'", null, null, "eID desc", null);

          foreach($data as $teacher)
          {
            echo '<option value="' . $teacher['ID'] . '">' . $teacher['name'] . ' | ' . $teacher['ID'] . '</option>';
          }
        ?>
        </select>
        <input type="submit" class="btn-default" style="margin-left: 15px; font-size: .9em;padding: 5px;" value="Update" id="updateSchedAction">
      </fieldset>
    </form>
    <div class="third"></div>
    <div class="third" style="width: 28%;"></div>
    </main>
<?php
  require_once('php/footer.php');
?>