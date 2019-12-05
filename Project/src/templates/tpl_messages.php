<?php function draw_messages($messengers) { ?>
    <section id='chat-container'>
        <?php if($messengers !== -1) 
            draw_menu($messengers);
        else { ?>
            <h3>You have no messages.</h3>
        <?php }
        ?>
    </section>

<?php } ?>

<?php function draw_menu($messengers) { ?>
        <section id="messages-search">
      		<input type="text" placeholder="search">
		</section>
		
    	<section id="messages-menu">
            <?php 
                $num = 0;
                $allMessengers = getAllMessengers($_SESSION['id']);
                $lastMessengerId = $allMessengers[0]['user'];
                
                foreach($messengers as $messenger) {
                    $num += 1;
                    $user = userProfile($messenger['user']);
                    $lastMessage = getLastMessageFromConversation($messenger['user'], $_SESSION['id']);
                    $image = getUserImagePath($user['id'], 'MEDIUM');
                    if($num == 1) { ?>
                        <div class="message-menu-item active">
                    <?php } else { ?>
                        <div class="message-menu-item ">
                    <?php } ?> 

                            <img width="60px" height="60px" src="<?=$image?>" alt="default">
                            <div class="message-menu-item-title">
                            <?=$user['name']?>
                            </div>
                            <div class="message-menu-item-date">
                                Apr 16
                            </div>
                            <div class="message-menu-item-lastmsg">
                            <?=$lastMessage['message']?>
                            </div>
                        </div>
                <?php } ?>
        </section>
    <?php draw_conversation($lastMessengerId); ?>

<?php } ?>

<?php function draw_conversation($messengerId) { 
    
    $messenger = userProfile($messengerId);
    $conversation = getAllMessagesBetweenUsers($messengerId, $_SESSION['id']);
    $image = getUserImagePath($messengerId, 'MEDIUM');
    ?>

    <section id="messages-chatTitle">
        <img width="50px" height="50px" src="<?= $image ?>" alt="default">
        <span> <?= $messenger['name'] ?> </span>
    </section>
    
    <section id="messages-chatSelected">
        <?php foreach($conversation as $message) { 
            if($message['sender'] == $_SESSION['id']) { ?>
                <div class="message-row sent">
                    <div class="message-content">
                        <div class="message-text"> <?=$message['message']?> </div>
                        <div class="message-time"> Apr 16</div>
                    </div>
                </div>
            <?php }
            else { ?>
                <div class="message-row received">
                    <div class="message-content">
                        <img width="50px" src="<?= $image ?>" alt="default">
                        <div class="message-text"> <?=$message['message']?> </div>
                        <div class="message-time"> Apr 16</div>
                    </div>
                </div>
            <?php } ?>    
        <?php } ?>
    </section>

    <section id="messages-input">
            <img src="../../assets/icons/atta.png" alt="add attachment" width="25px">
            <input type="hidden" value='<?=$messengerId?>' id='receiver'>
            <input type="text" placeholder="write a message" id='message'>
            <button id="sendMessage"><i class="far fa-paper-plane"></i></button>
    </section>
<?php  } ?>