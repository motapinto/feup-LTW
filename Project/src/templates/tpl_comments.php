<?php

function draw_comment($comment) { ?>
  <article class='comment'>
    <img class="image" src=<?= $comment['image'] ?> alt="Image of <?= $comment['name'] ?>">
    <h3><?= $comment['name'] ?></h3>
    <h4><?= $comment['date'] ?>  Rating:<?= $comment['rating'] ?></h4> <!-- missing star image -->
    <p><?= $comment['comment'] ?></p>
  </article>
<?php }


function draw_allComments($comments) { ?>
  <section id="comments">
    <?php foreach ($comments as $comment) {
        draw_comment($comment);
      } ?>
  </section>
<?php }

?>