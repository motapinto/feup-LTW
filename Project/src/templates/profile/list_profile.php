<?php function drawProfile($user) { ?>
<section id="user">
    <article>
        <header>
            <h1>
                Profile
            </h1>
        </header>

        <footer>
            <div class="name">
                name: <?=$user['name']?>
            </div>

            <div class="age">
                age: <?=$user['age']?>
            </div>

            <div class="email">
                email: <?=$user['email']?>
            </div>
        </footer>
    </article>
</section>

<?php } ?>
