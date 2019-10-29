
<section id="news">
<?php foreach($articles as $article) { ?>
    <article>
        <header>
            <h1>
                <a href="news_item.php?id=<?=$article['id']?>">
                    <?=$article['title']?>
                </a>
            </h1>
        </header>
        
        <p> <?=$article['introduction']?> </p>

        <footer>
            <div class="author">
                author: <?=$article['username']?>
            </div>
            
            <div class="date">
                date:  <?=date('Y-m-d H:i:s', $article['published']);?>
            </div>

            <?php $tags = explode(',', $article['tags']); ?>

            <div class="tags">
                tags: 
                <?php foreach ($tags as $tag) { ?>
                    <a href="list_news.php?tag=<?=$tag?>">
                        #<?=$tag?>
                    </a>
                <?php } ?>
            </div>
            
            <a class="comments" href="news_item.php?id=<?=$article['id']?>#comments">
                <?=$article['comments']?>
            </a>
        </footer>
    </article>
<?php } ?>
</section>