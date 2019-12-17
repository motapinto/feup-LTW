<?php function draw_item($item, $owner=false) { 
    $comments = getCommentsByPropertyId($item['id']);
    $user = userProfile($item['user_id']);
    $images = getImagePathsByPropertyId($item['id']);
    ?>

    <section id='listing'>
        <article id='property'>
            <h2><?=$item['title']?></h2>
            <p><?=$item['description']?></p>
            <p>Property type: 
            <?php
                switch ($item['property_type']) {
                case 0:
                    ?> House </p>
                    <p><?= $item['street']?> door <?=$item['door_number']?> <?=$item['city']?></p>
                    <?php
                    break;
                case 1:
                    ?> Apartment </p>
                    <p><?= $item['street']?> door <?=$item['door_number']?> nº<?=$item['apartment_number']?> <?=$item['city']?></p>
                    <?php
                    break;
                default:
                    ?> Undefined </p><?php
                    break;
                } 
            ?>
            </p>
            
            <p>Owner: 
                <a href="../profile/profile.php?id=<?=$user['id']?>">
                    <?=$user['name']?>
                </a>
            </p>
        </article>
        <article id="property-images">
            <div id="galleria">
            <?php 
            foreach($images as $image) { ?>
                    <a href="<?=$image?>">
                        <img title="Image Tile - feature in progress"
                        alt="Image description - feature in progress"
                        src="<?=$image?>" />
                    </a>
            <?php } ?>
            </div>
        </article>
        <aside id='rent'>
            <?php if(!isset($_SESSION['id'])){ ?>
                <p>To rent please <a href="../authentication/login.php">log in</a>.</p>
            <?php } else { ?>
                <header id='rent-header'>
                    <p id='rent-price'>
                        €<?=$item['price_day']?>
                    </span>
                    <span>
                        per night
                    </p>
                    <i id='rent-star' class='material-icons'> star</i>
                    <span class='rent-rating_comments'>
                        <?=floor ($item['rating'])?>
                        (<?=numberCommentsByProperty($item['id'])?> comments)
                    </span>
                </header>

                <section class='rent-body'>
                    <input id='csrf' type="hidden" value='<?=$_SESSION['csrf']?>'>
                    <input id='id' name='id' type='hidden' value="<?=$item['id']?>">
                    <p>Check In and Check Out</p>
                    <input id="calendar" type='daterange' name='daterange' value="Check In - Check Out" min=<?=date('Y-m-d')?> required>
                    <p>Number of Guests: <span id="current-guests">1</span><button id='dropdown-btn' type="button"><i class="fas fa-chevron-down"></i></button></p>
                    <section id='dropdown'>
                        <p>Maximum number of guests: <?=$item['guests']?></p>  
                        <input id="guests" type="hidden" value="<?=$item['guests']?>">
                        <section id='change-guests'>
                            <label>Number of adults</label>
                            <button id="adults-sub" class="button-guests" type="button">-</button>
                            <input id="adults" type="number" disabled name="adults" min='1' max="<?=$item['guests']?>" value="1">
                            <button id="adults-add" class="button-guests" type="button">+</button>
                            <label>Number of children</label>
                            <button id="children-sub" class="button-guests" type="button">-</button>
                            <input id="children" type="number" disabled name="children" min='0' max="<?=$item['guests']?>" value="0">
                            <button id="children-add" class="button-guests" type="button">+</button>
                            <label>Number of babies</label>
                            <button id="babies-sub" class="button-guests" type="button">-</button>
                            <input id="babies" type="number" disabled name="babies" min='0' max="<?=$item['guests']?>" value="0">
                            <button id="babies-add" class="button-guests" type="button">+</button>
                            <span class='error' id='msg-guests'></span>
                        </section>
                    </section>
                    <button id='rent-button' class="btn">Rent</button>
                </section>
            <?php } ?>
        </aside>
        
        <?php draw_allComments($comments);
        
        if(isset($_SESSION['id'])){ ?>
        <form id='comment_form' action='../actions/action_comment.php' method='POST'>
            <input type="hidden" name="csrf" value="<?=$_SESSION['csrf']?>">
            <h4>Leave a comment</h4>
            <textarea name='comment' cols='40' rows='5' placeholder='Describe your experience' required></textarea>
            <input name='rating' type="number" min="1" max="5" required placeholder='Rate this property'>
            <input name='property_id' type='hidden' value='<?=$item['id']?>'/>
            <button id='comment_button' class='btn'>Comment</button>
        </form>
        <?php }
        else { ?>
        <p id='comment_form'>To leave a comment please <a href="../authentication/login.php">log in</a>.</p>
        <?php } ?>
    </section>
 <?php } ?>
