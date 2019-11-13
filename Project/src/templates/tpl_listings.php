<?php 

function draw_item($item){ ?>
  <article class='item'>
    <a href="item.php?id=<?=$item['id']?>">
    <!-- missing image -->
      <h1>
          <?=$item['title']?>
      </h1>
      <p><!-- missing star image --><?=$item['rating']?></p>
      <p class="comments"></p>
    </a>
</article>
<?php }

function draw_allListings($listings) { ?>
  <section id="listings">
    <?php foreach($listings as $item) { 
      draw_item($item);
    } ?>
  </section>

<?php }

?>
