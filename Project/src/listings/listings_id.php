<?php
  include_once('database/connection.php');  // connects to the database
  include_once('database/listings.php');    // listings functions
  include_once('database/comments.php');    // comments functions

  if (!isset($_GET['id']) || id < 0)
    die("Invalid id!");

  include_once('templates/common/header.php');

  $listing = getListingById($_GET['id']);
  include_once('templates/listings/some_listing.php');

  $comments = getCommentsByPropertyId($_GET['id']);
  include_once('templates/comments/list_comments.php');
  
  include_once('templates/common/footer.php');
?>