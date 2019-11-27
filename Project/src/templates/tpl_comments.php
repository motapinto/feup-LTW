<?php
include_once('../database/images.php');
include_once('../templates/tpl_common.php');

function draw_comment($comment) {
    $image = getUserImagePath($comment['user_id']);?>
    <article class='comment'>
        <img src=<?= getUserImagePath($comment['user_id'], 'SMALL') ?> alt="Image of <?= $image ?>">
        <h3><?= $comment['name'] ?></h3>
        <h6><?= $comment['date'] ?>  Rating:<?= $comment['rating'] ?></h6> <!-- missing star image -->
        <p><?= $comment['comment'] ?></p>
    </article>
<?php }


function draw_allComments($comments) { ?>
  <section id="comments">
    <h2>Comments</h2>
    <?php foreach ($comments as $comment) {
        draw_comment($comment);
      } ?>
  </section>
<?php }

?>