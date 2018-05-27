<?php
  require_once('php/header.php');
?>
    <main class="bg">
      <section class="full-width styledMain">
        <h1>Events</h1>
      </section>
    </main>
    <main class="maincontent half" id="maCont">
    <?php
      require_once 'php/DatabaseAPI.php';

      $db = new Database();

      $data = $db->select(array("short_story", "full_story"), "events", null, null, null, "eventID desc", null);

      foreach($data as $event)
      {
        echo '<p><a value="' . $event['full_story'] . '">' . $event['short_story'] . '</a></p>';
      }
    ?>
    </main>
    <div class="half" id="expand"></div>
<?php
  require_once('php/footer.php');
?>