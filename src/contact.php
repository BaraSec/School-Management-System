<?php
  require_once('php/header.php');
?>
    <main class="bg">
      <section class="full-width styledMain">
        <h1>Contact us</h1>
      </section>
    </main>
    <main class="maincontent">
      <h2> You are more than welcome! </h2>
      <section>
        <h4>Phone number</h4>
        032-52313531
        <h4>Email</h4>
        <a href="mailto: mail@alsalam-school.ps">mail@alsalam-school.ps</a>
        <h4>Location</h4>
        413 Hilal Street, Al-Tireh, Ramallah<br><br><br>
        <form method="post" action="" id="contactForm">
          <fieldset>
            <legend>You can comment or ask us a question here:</legend>
            <br>
            <label>Name (required)</label><br>
            <input type="text" name="name"  id="name" required><br><br>
            <label>Phone number (required)</label><br>
            <input type="text" name="phone" id="phone" required><br><br>
            <label>Email</label><br>
            <input type="email" name="email" id="email"><br><br>
            <label>Comment/Question (required)</label><br>
            <textarea name="feedback" rows="10" cols="40" id="feedback" required></textarea>
            <br>
            <input type="submit" class="btn-default">
            <br><br>
          </fieldset>
        </form>
        <br><br>
        <img src="images/location.jpg" title="School Location" alt="School Location">
      </section>
    </main>
<?php
  require_once('php/footer.php');
?>