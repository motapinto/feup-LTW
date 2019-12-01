<?php function draw_messages($messengers) { ?>
    <section id='chat-container'>
        <?php if($messengers !== -1) 
            draw_menu($messengers);
            $allMessengers = getAllMessengers($_SESSION['id']);
            $lastMessengerId = $allMessengers[0]['user'];
            draw_conversation($lastMessengerId);
        ?>
    </section>

<?php } ?>

<?php function draw_menu($messengers) { ?>
    <section id='messages-menu'>
        <article id="messages-search">
      		<input type="text" placeholder="search">
		</article>
		
    	<article id="messages-menu">
            <?php 
                $num = 0;
                foreach($messengers as $messenger) {
                    $num += 1;
                    $user = userProfile($messenger['user']);
                    $lastMessage = getLastMessageFromConversation($messenger['user'], $_SESSION['id']);
                    if($num == 1) { ?>
                        <div class="message-menu-item active">
                    <?php } if($num > 1) { ?>
                        <div class="message-menu-item ">
                    <?php } ?> 

                            <img width="50px" src="../../assets/icons/noone.png" alt="default">
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
		</article>
    </section>

<?php } ?>

<?php function draw_conversation($messengerId) { 
    
    $messenger = userProfile($messengerId);
    $conversation = getAllMessagesBetweenUsers($messengerId, $_SESSION['id']);
    // print_r($conversation);
    // print_r($messenger);
    ?>

    <section class="messages">
        <article id="messages-chatTitle">
            <img width="50px" src="../../assets/icons/noone.png" alt="default">
            <span> <?= $messenger['name'] ?> </span>
            <img width="50px" src="../../assets/icons/trash.png" alt="">
        </article>
    
        <article id="messages-chatSelected">
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
                            <img width="50px" src="../../assets/icons/noone.png" alt="default">
                            <div class="message-text"> <?=$message['message']?> </div>
                            <div class="message-time"> Apr 16</div>
                        </div>
                    </div>
                <?php } ?>
    
    
            <?php } ?>
    
        </article>
    
        <article id="messages-input">
            <img src="../../assets/icons/atta.png" alt="add attachment" width="25px">
            <input type="text" placeholder="write a message">
        </article>
    </section>
<?php  } ?>