<?php function draw_messages($messengers) { ?>
  <section id='messages'>
    <?php foreach($messengers as $messenger) { 
      draw_conversation($messenger);
    } ?>
  </section>

<?php } ?>