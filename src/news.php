<?php
  require_once('php/header.php');
?>
    <main class="bg">
      <section class="full-width styledMain">
        <h1>News</h1>
      </section>
    </main>
    <main class="maincontent half" id="maCont">

   <?php
      require_once 'php/DatabaseAPI.php';

      $db = new Database();

      $data = $db->select(array("short_story", "full_story"), "news", null, null, null, "newsID desc", null);

      foreach($data as $news)
      {
        echo '<p><a value="' . $news['full_story'] . '">' . $news['short_story'] . '</a></p>';
      }
    ?>

    </main>
    <div class="half" id="expand"></div>
<?php
  require_once('php/footer.php');
?>