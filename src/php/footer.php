    <footer>
      <noscript>
        <div>
          <strong>Notice:</strong> Your browser does not support Javascript or it is disabled. The features of this page will be limited without javascript support.        
        </div>
      </noscript>
      <div class="half">
        <section id="news">
          <h3><a href="news.php">News</a></h3>
          <p><a value=""></a></p>
          <p><a value=""></a></p>
          <p><a value=""></a></p>
          <p id="expandNews"></p>
        </section>
      </div>
      <div class="half" id="events">
        <h3><a href = "events.php">Events</a></h3>
        <p><a value=""></a></p>
        <p><a value=""></a></p>
        <p><a value=""></a></p>
        <p id="expandEvents"></p>
      </div>
      <hr>
      <?php
       if(basename($_SERVER['REQUEST_URI']) === "signin.php")
        {
          echo '<br><br>';
        }
      ?>
      <div class="devs half">
        <p>All rights reserved &copy; 2018</p>
      </div>
      <div class="devs half">
        <h4>Developers</h4>
        <ul>
          <li>Bara Adnan - 1161357</li>
          <li>Rami Yahya - 1150383</li>
          <li>Wesam Misleh - 1152566</li>
           <?php
             if(basename($_SERVER['REQUEST_URI']) === "signin.php")
              {
                echo '<br><br>';
              }
           ?>
        </ul>
      </div>
    </footer>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
  </body>
</html>