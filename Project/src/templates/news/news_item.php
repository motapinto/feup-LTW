<article>
    <header>
        <h1>
            <?=$article['title']?>
        </h1>
    </header>
    
    <p> <?=$article['introduction']?> </p>
    <p> <?=$article['fulltext']?> </p>

    <footer>
        <div class="author">
            author: <?=$article['username']?>
        </div>
        
        <div class="date">
            date:  <?=date('Y-m-d H:i:s', $article['published']);?>
        </div>

        <?php $tags = explode(',', $article['tags']); ?>

        <div class="tags">
            <?php foreach ($tags as $tag) { ?>
                <a href="list_news.php?tag=<?=$tag?>">
                    #<?=$tag?>
                </a>
            <?php } ?>
        </div>
    </footer>
</article>