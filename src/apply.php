<?php
  require_once('php/header.php');
?>
    <main class="bg">
      <section class="full-width styledMain">
        <h1>Apply</h1>
      </section>
    </main>
    <main class="maincontent">
      <h3>Submit Application</h3>
      <form action="" id="applyForm" method="post">
        <br>
        <fieldset>
          <br>
          <legend>Student's information</legend>
          <label>First name:</label>
          <input type="text" name="first_name" id="first_name" style="margin-right:10px;" required>
          <label>Last name:</label>
          <input type="text" name="last_name" id="last_name" required>
          <br><br>
          <label>Gender:</label>&nbsp;&nbsp;
          <select name="gender" id="gender" required>
            <option value="Male" selected>Male</option>
            <option value="Female">Female</option>
          </select>
          <br><br>
          <label>Date of birth:</label><br>
          <input type="date" name="dob" id="dob" required>
          <br><br>
          <label>Grade:</label><br>
          <input type="number" name="grade" id="grade" step="1" min="7" max="12" required>
          <br><br>
          <label>Last year's marks' average:</label><br>
          <input type="number" name="average" id="average" step="0.01" required>
          <br><br>
          <label>Email Address:</label><br>
          <input type="email" name="email" id="email" required>
          <br><br>
          <label>Interests:</label><br>
          <textarea name="interests" rows="10" cols="40" id="interests" required></textarea>
        </fieldset>
        <br>
        <fieldset>
          <legend>Parents' information</legend>
          <h5>Father</h5>
          <label>Name:</label><br>
          <input type="text" name="father_name" id="father_name" required>
          <br><br>
          <label>Job:</label><br>
          <input type="text" name="father_job" id="father_job" required>
          <br><br>
          <label>Phone Number:</label><br>
          <input type="text" name="father_phone" id="father_phone" required>
          <h5>Mother</h5>
          <label>Name:</label><br>
          <input type="text" name="mother_name" id="mother_name" required>
          <br><br>
          <label>Job:</label><br>
          <input type="text" name="mother_job" id="mother_job" required>
          <br><br>
          <label>Phone Number:</label><br>
          <input type="text" name="mother_phone" id="mother_phone" required>
          <br><br>
          <label>Payment Details:</label><br>
          <input type="text" name="payment" id="payment" required>
          <br><br>
          <label style="font-weight: bold;">Email Address to recieve acceptance/rejection result:</label><br>
          <input type="email" name="parents_email" id="parents_email" required>
          <br><br>
        </fieldset>
        <br>
        <input type="submit" class="btn-default">
      </form>
    </main>
<?php
  require_once('php/footer.php');
?>