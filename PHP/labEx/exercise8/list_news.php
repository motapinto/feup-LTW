<?php
  include_once('database/connection.php');
  include_once('database/news.php');
  include_once('templates/common/header.php');
  include_once('templates/common/footer.php');
  include_once('templates/news/list_news.php');

  drawHeader("List News");
  drawNews($db);
  drawFooter();
?>