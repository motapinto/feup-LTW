<?php
  try {
    $db = new PDO('sqlite:'.__DIR__.'/campus_rentals.db');
  }
  catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
    exit;
  }
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
?>