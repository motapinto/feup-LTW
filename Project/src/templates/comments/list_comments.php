<section id="comments">
  <h1>
      Number of comment's: 
    <?=count($comments)?> 
  </h1>

  <?php foreach ($comments as $comment) { ?>
    <article class="comment">
      <div class="user">
        <?=$comment['name']?>
      </div>

      <div class="date">
        <?=date('Y-m-d H:i:s', $comment['published']);?>
      </div>

      <p>
        <?=$comment['text']?>
      </p>
    </article>
  <?php } ?>

  <form>
    <fieldset>
      <legend>Give your input...</legend>
      
      <label>Username
        <input type="text" name="username">
      </label>
      
      <label>Comment
        <textarea name="text"></textarea>
      </label>
      
      <input type="hidden" name="id" value="<?=$article['id']?>">
      <input type="submit" value="Reply">
    </fieldset>
  </form>
</section>
