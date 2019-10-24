<?php
  include_once('database/connection.php');
  include_once('database/news.php');
  include_once('templates/common/header.php');
  include_once('templates/common/footer.php');
  
  drawHeader('News Item');

?>
  <form action="actions/action_edit_news.php" method="POST">
    <fieldset>
        <input hidden id="id" value="<?=$_GET['id']?>" name ="id">
        <label>Title: <input type="text" name="title" id="Title"> </label>
        <label>Introduction: <textarea id="introduction" name="intro"></textarea></label>
        <label>Text: <textarea id="text" name="text"></textarea></label>
        <input type="submit" value="Submit">
    </fieldset>
  </form>
<?php

  drawFooter();
?>