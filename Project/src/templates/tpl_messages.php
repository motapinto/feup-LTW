<?php function draw_messages($messengers) { ?>
    <section id='messages'>
    <?php foreach($messengers as $messenger) { 
        draw_conversation($messenger);
    } ?>
    </section>

<?php } ?>

<?php function draw_conversation($messenger) { ?>
    <section class='chatbox'>
        <section class="chatLogs">
    <?php 
        $conversation = getAllMessagesBetweenUsers($_SESSION['id'], $messenger['user']);
        $user = userProfile($messenger['user']);
        $self = userProfile($_SESSION['id']);
        $userImage = getUserImagePath($user['id'], 'MEDIUM');
        $selfImage = getUserImagePath($self['id'], 'MEDIUM');
        foreach($conversation as $item) { 
            draw_item($item, $user, $self, $userImage, $selfImage);
        } 
    ?>
            <article class="chat-form">
                <textarea></textarea>
                <button><i class="fas fa-paper-plane"></i></button>
            </article>
        </section>
    </section>
<?php  } ?>

<?php function draw_item($item, $user, $self, $userImage, $selfImage) { ?>
    <?php if($item['sender'] === $self['id']) { ?>
        <article class="chat friend">
            <a href="../profile/profile.php?id=<?=$user['id']?>">
                <div class="user-photo">
                    <!-- <img class='_1mgxxu3' src='//$userImage?>' alt='User Photo' title='User Photo'> -->
                </div>
            </a>
            <p> <?=$user['name']?> </p>
            <p class="chat-message"> <?=$item['message']?> </p>
            <p id="chat-date"> <?=$item['date']?> </p>
        </article>
    <?php } ?>
    <?php if($item['sender'] === $user['id']) { ?>
        <article class="chat self">
            <a href="../profile/profile.php?id=<?=$self['id']?>">
                <div class="user-photo">
                    <!-- <img class='_1mgxxu3' src='//$selfImage?>' alt='User Photo' title='User Photo'> -->
                </div>
            </a>
            <p class="chat-message"> <?=$item['message']?> </p>
            <p> <?=$item['date']?> </p>
        </article>
    <?php } ?>

<?php  } ?>

<style>
.chatbox {
    box-sizing: border-box;
    width: 500px;
    min-width: 390px;
    height: 600px;
    background: #fff;
    padding: 25px;
    margin: 20px auto;
    box-shadow: 0 3px #ccc
}

.chatLogs {
    padding: 10px;
    width: 100%;
    height: 450px;
    overflow-x: hidden;
    overflow-y: scroll;
}

.chat-form textarea::-webkit-scrollbar {
    width: 10px;
}

.chat-form textarea::-webkit-scrollbar-thumb {
    border-radius: 5px;
    background: rgba(0,0,0,-1);
}

.chat {
    display: flex;
    flex-flow: row wrap;
    align-items: flex-start;
    margin-bottom: 10px;    
}

.chat .user-photo {
    width: 60px;
    height: 60px;
    background: #ccc;
    border-radius: 50%
}

.chat .chat-message {
    width: 70%;
    padding: 15px;
    margin: 5px 10px 0;
    
    border-radius: 10px;
    font-size: 15px;
}

.friend .chat-message {
    background: rgb(220, 220, 220);
    color: black;
}

.self .chat-message {
    background: teal;
    color: #fff;
    order: -1;
}

.chat-form {
    margin-top: 20px;
    display: flex;
    align-items: flex-start
}

.chat-form textarea {
    background: #fbfbfb;
    width: 75%;
    height: 50px;
    border: 2px solid #eee;
    border-radius: 3px;
    resize: none;
    padding: 10px;
    font-size: 18px;
    color: #333;
}

.chat-form textarea: focus {
    background: #fff;
}

.chat-form button {
    background: #1ddced;
    font-size: 30px;
    border: none;
    color: #fff;
    padding: 5px 15px;
    margin: 0 10px;
    border-radius: 3px;
    box-shadow: 0 3px 0 #0eb2c1;
    cursor: pointer;

    -webkit-transition: background .2s ease;
    -moz-transition: background .2s ease;
    -o-transition: background .2s ease;
}

.chat-form button:hover {
    background: #13c8d9;
}

#chat-date {
    color: grey;
}





</style>