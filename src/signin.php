<?php

  session_start();
  
  if(isset($_SESSION['id']))
    header("location: ../../../../../../Projects/School System Project/index.php");

  require_once('php/header.php');
?>
    <main class="bg-login">
      <div class="login_section">
        <form method="POST" action="" id="loginForm">
          <input type="text" class="text_input" placeholder="Username" name="username" required id="username">
          <input type="password" class="text_input" placeholder="Password" name="password" required id="password"><br><br>
          <input type="hidden" name="key" value="signin">
          <p>
            <button type="submit" class="submit">Sign in</button>
            <label style="color:black; font-weight: bold">&nbsp;&nbsp;&nbsp;&nbsp; Remember me </label>
            <input type="checkbox" checked name="rememberme">
          </p>
          <br><label hidden style="border-color:#5b4f25; color: #990008; font-weight: bold; border-style: solid; border-radius: 5px;padding: 5px;" id="error"></label>
          <br><br>
          <div>
          </div>
        </form>
      </div>
    </main>
<?php
  require_once('php/footer.php');
?>