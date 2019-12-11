<?php function draw_profile($user, $canEditProfile=false) { 
    $allComments = getAllUserRelatedComments($user['id']);
    $rents = getAllRentsByUser($_SESSION['id']);
    $image = getUserImagePath($user['id'], 'MEDIUM');
    $rents = getAllRentsByUser($user['id']);
    $now = date("Y-m-d");
?>
<!--*********************** PROFILE SIDEMENU ***********************-->
    <section class='profile'>
        <section class='side-drawer'>
            <!-- USER PHOTO -->
            <article class='profile-photo'>
                <img class='_1mgxxu3' src='<?=$image?>' alt='User Photo' title='User Photo'>
                <div class='profile-change-photo'>
                    <form action='../actions/action_user_image.php' method='post' enctype='multipart/form-data'>
                        <input type='file' name='image' id='image'>
                        <label for='image'>Choose Image</label>
                        <input id="photo-submit" type='submit' name='Submit' value='Upload'>
                    </form>
                </div>
            </article>
            
            <!-- USER NAME -->
            <header>
                <h1 id='user-name'><?=$user['name']?></h1>
                <article class='rating'>
                    <?php draw_rating($user['rating']); ?>
                </article>
            </header>

            <!-- SIDEBAR BUTTONS -->
            <article class='profile-userbuttons'>
                <button class='circular-button' id="properties-button">Properties</button>
                <?php if($canEditProfile) { ?> 

                <button class='circular-button' id="messages-button"> Messages </button> 

                <?php } ?>    
                <?php if(!$canEditProfile) { ?> 
                <button type='button' class='circular-button' id="send-message-button"> Send Message </button> 
                <?php } ?>   
            </article>

            <!-- SIDEBAR MENU -->
            <article class='profile-usermenu'>
                <i class='fas fa-bars' style="padding-top: 1em"></i>
                <button class='no-button' style="padding-top: 1em" id="overview-button"> Overview </button>
                
                <i class='fas fa-users-cog'></i>
                <button class='no-button' id="profile-button"> Profile Details</button>  
                <?php if($canEditProfile) { ?>
                    <i class='fas fa-shield-alt'></i>
                    <button class='no-button' id="security-button">Security Details</button>  
                <?php } ?>       
                <i class='far fa-comments'></i>
                <button class='no-button' id="comments-button">Comments</button>  
            </article>
        </section> 

<!--*********************** PROFILE OVERVIEW ***********************-->
        <section id='profile-overview-tab' class='selected-tab'>
            <h1>Rent History</h1>
            <?php if(count($rents) === 0) { ?>
                <p>Rent history empty</p>
            <?php } ?>

                <ul class="scrollable-overview">
                <?php foreach ($rents as $rent) { 
                    
                    $image = getFirstImagePathOfProperty($rent['property_id'], 'MEDIUM');
                    $property = getListingById($rent['property_id']);
                    preg_match('/([0-9]{4})-([0-9]{2})-([0-9]{2})/', $rent['initial_date'], $date_init_array);
                    preg_match('/([0-9]{4})-([0-9]{2})-([0-9]{2})/', $rent['final_date'], $date_final);
                    $date_init = $date_init_array[3].'-'.$date_init_array[2].'-'.$date_init_array[1];
                    $date_final = $date_final[3].'-'.$date_final[2].'-'.$date_final[1];
                    ?>
                    <li class='profile-overview-elem'>          
                    <a href="../listings/item.php?id=<?= $rent['property_id'] ?>">
                        <header class="overview-details"> 
                            <img src="<?= $image ?>" alt="property photo" width="200" heigth="200">
                            <div>
                                <h2> <?= $property['title'] ?></h2>
                                <span> <?=$property['city']?> </span>
                                <span class="overview-date"> 
                                    <?= $date_init ?>
                                    <i class="fas fa-arrow-right"></i>
                                    <?= $date_final ?>
                                </span>
                                <span class="overview-price"> Total: <?= $rent['price'] ?>&euro; </span>
                                <span class="overview-guests"> Guests: <?=$rent['adults'] + $rent['children'] + $rent['babies'] ?> </span>
                            </div>
                        </header>
                    </a>

                    <?php if($canEditProfile) { 
                        if(strcmp($date_init_array[1].'-'.$date_init_array[2].'-'.$date_init_array[3], $now) > 0) { ?>
                            <input class="rent-id" type="hidden" value="<?=$rent['id']?>">
                            <input class="owner" type="hidden" value="<?=$rent['id']?>">
                            <button class="cancel-button"> Cancel </button>
                        <?php }
                    } ?>

                    </li>                    
                <?php } ?>
        </section>
<!--*********************** PROFILE SETTINGS ***********************-->
        <section id='profile-settings-tab' class='selected-tab'>
            <h1 id='profile-settings-title'>Edit Profile</h1>
                <article id='profile-setting-name' class='profile-setting-elem'>
                    <header> Name </header>
                    <?php if($canEditProfile) { ?>
                    <input id='name' type='text' value='<?=$user['name']?>'>
                    <i id='icon-name'></i>
                    <?php } ?>    
                    <?php if(!$canEditProfile) { ?> 
                    <input value='<?=$user['name']?>' style="border:none; color:black; background-color: white;" disabled> 
                    <?php } ?>  
                </article>

                <article id='profile-setting-email' class='profile-setting-elem'>
                    <header> Email </header>
                    <?php if($canEditProfile) { ?>
                    <input id='email' type='email'  value='<?=$user['email']?>'>
                    <button id="email-button"> Save </button>
                    <?php } ?>    
                    <?php if(!$canEditProfile) { ?> 
                    <input value='<?=$user['email']?>' style="border:none; color:black; background-color: white;" disabled> 
                    <?php } ?>    
                </article>

                <article id='profile-setting-age' class='profile-setting-elem'>
                    <header> Age </header>
                    <?php if($canEditProfile) { ?>
                    <input id='age' type='number' value='<?=$user['age']?>'>
                    <i id='icon-age'></i>
                    <?php } ?>    
                    <?php if(!$canEditProfile) { ?> 
                    <input value='<?=$user['age']?>' style="border:none; color:black; background-color: white;" disabled> 
                    <?php } ?>  
                </article>

                <article class='profile-setting-elem'>
                    <?php if($canEditProfile) { ?>
                    <header> Delete User </header>
                    <span> All your information will be deleted with no possibility to cancelling after confirm</span>
                    <button id="delete-button">
                        <i class="fas fa-user-slash" style="color: red"></i>
                    </button>
                    <?php } ?>     
                </article>

                <p id='msg-name'></p>
                <p id='msg-email'></p>
                <p id='msg-age'></p>
        </section>
<!--*********************** PROFILE SECURITY ***********************-->
        <section id='profile-security-tab' class='selected-tab'>
            <?php if($canEditProfile) { ?>
                <h1 id='profile-security-title'>Security Details</h1>
                    <article id='profile-security-password' class='profile-setting-elem'>
                        <header> Current Password </header>
                        <input id='current-password' type='password' value=''>
                    </article>

                    <article id='profile-setting-password' class='profile-setting-elem'>
                        <header> New Password </header>
                        <input type='password' id='password' disabled >
                            <button id='password-change' style='display:none;'> Save</button>
                    </article>

                    <article id='profile-settings-confirm_password' class='profile-setting-elem'>
                        <header> Confirm password </header>
                        <input id='confirm_password' type='password' disabled >
                    </article>
                    <p id='msg-password'></p>
                    <p id='msg-password1'></p>
                    <p id='msg-password2'></p>
            <?php } ?>
        </section>

<!--*********************** PROFILE COMMENTS ***********************-->
        <section id='profile-comments-tab' class='selected-tab'>
            <?php 
            $nComments = count($allComments);
            if($nComments === 1) { ?>
                <h1>1 related comment </h1>
            <?php } else { ?>
                <h1><?=count($allComments)?> related comments </h1>
            <?php } ?>

            <ul class="scrollable-comments">

                <?php foreach($allComments as $comment) { 
                    $user = userProfile($comment['commentator']);
                    $image = getUserImagePath($comment['commentator'], 'SMALL'); 
                    preg_match('/([0-9]{4})-([0-9]{2})-([0-9]{2})/', $comment['date'], $date);
                    $date = $date[3].'-'.$date[2].'-'.$date[1];
                    ?>
                    <li class='profile-comments-elem'>          
                    <a href="../listings/item.php?id=<?= $comment['property_id'] ?>">
                        <header class="comment-details"> 
                            <img src="<?= $image ?>" alt="user photo" width="200" heigth="200">
                            <div>
                                <h2> <?= $user['name'] ?> </h2>
                                <span class="comments-ratings"> <?= draw_rating($comment['rating']) ?> </span>
                                <span class="comments-date"> <?= $date ?> </span>
                            </div>
                        </header>
                        <p> <?=$comment['comment']?> </p>
                    </a>
                    </li>
                <?php } ?>

            </ul> 
        </section>

<!--********************* PROFILE SEND MESSAGE *********************-->
        <section id='profile-sendMessage-tab' class='selected-tab'>
            <h1 id='profile-settings-title'>Edit Profile</h1>
                <section id='profile-sendMessage' class='profile-setting-elem'>
                    <textarea name="message" id="message" cols="10" rows="10"></textarea> 
                    <input id='receiver' name="receiver" type="hidden" value='<?=$user['id']?>'>
                    <button class="no-button" id='sendMessage'> Send Message </button>
                    <p id='sendMessage-msg'></p>
                </section>
        </section>
<!--*********************** SECTION END ****************************-->
    </section>>
<?php } ?>

<script>
    function aux(rentId) {
        if (confirm("You are about to cancel your reservation. Are you sure?"))
            alert('yes')
        else 
            alert('no')
    }

</script>