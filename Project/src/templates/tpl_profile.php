<?php function draw_profile($user, $canEditProfile) { 
    include_once('../database/comments.php');
    include_once('../database/images.php');

    $comments = getCommentsByUserId($user['id']);
    $image = getUserImagePath($user['id'], 'MEDIUM');
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
                <a href='../properties/properties.php'>
                    <button type='button' class='circular-button'>Properties</button>
                </a>
                <a href='#'>
                    <button type='button' class='circular-button'>
                    <?php if($canEditProfile) { ?> Messages <?php } ?>    
                    <?php if(!$canEditProfile) { ?> Send Message <?php } ?>    
                    </button>
                </a>
            </article>

            <!-- SIDEBAR MENU -->
            <article class='profile-usermenu'>
                <i class='fas fa-bars'></i>
                <button class='no-button' onclick='profileSubMenu(0);'> Overview </button>
                
                <i class='fas fa-users-cog'></i>
                <button class='no-button' onclick='profileSubMenu(1);'> Profile Details</button>
                <?php if($canEditProfile) { ?>
                    <i class='fas fa-shield-alt'></i>
                    <button class='no-button' onclick='profileSubMenu(2);'>Security Details</button>
                <?php } ?>       
                <i class='far fa-comments'></i>
                <button class='no-button' onclick='profileSubMenu(3);'>Comments</button>
            </article>
        </section> 

<!--*********************** PROFILE OVERVIEW ***********************-->
    <section id='profile-overview-tab' class='selected-tab'>
    </section>
<!--*********************** PROFILE SETTINGS ***********************-->
    <section id='profile-settings-tab' class='selected-tab'>
        <h1 id='profile-settings-title'>Edit Profile</h1>
            <article id='profile-setting-name' class='profile-setting-elem'>
                <header> Name </header>
                <?php if($canEditProfile) { ?>
                <input class='name' type='text' onkeyup='checkName(true);' value='<?=$user['name']?>'>
                <i id='icon-name'></i>
                <?php } ?>    
                <?php if(!$canEditProfile) { ?> 
                <input value='<?=$user['name']?>' disabled> 
                <?php } ?>  
            </article>

            <article id='profile-setting-email' class='profile-setting-elem'>
                <header> Email </header>
                <?php if($canEditProfile) { ?>
                <input class='email' type='email' onkeyup="checkEmail(true);" value='<?=$user['email']?>'>
                <button onclick='submitForm(1)'> Save </button>
                <?php } ?>    
                <?php if(!$canEditProfile) { ?> 
                <input value='<?=$user['email']?>' disabled> 
                <?php } ?>    
            </article>

            <article id='profile-setting-age' class='profile-setting-elem'>
                <?php if($canEditProfile) { ?>
                <header> Age </header>
                <input class='age' type='number' onkeyup='checkAge(true);' value='<?=$user['age']?>'>
                <i id='icon-age'></i>
                <?php } ?>    
                <?php if(!$canEditProfile) { ?> 
                <input value='<?=$user['age']?>' disabled> 
                <?php } ?>  
            </article>
            <p class='msg-name'></p>
            <p class='msg-email'></p>
            <p class='msg-age'></p>
    </section>
<!--*********************** PROFILE SECURITY ***********************-->
    <section id='profile-security-tab' class='selected-tab'>
        <?php if($canEditProfile) { ?>
            <h1 id='profile-security-title'>Security Details</h1>
                <article id='profile-security-password' class='profile-setting-elem'>
                    <header> Current Password </header>
                    <input id='current-password' type='password' onkeyup='checkCurrentPassword();'value=''>
                </article>

                <article id='profile-setting-password' class='profile-setting-elem'>
                    <header> New Password </header>
                    <input type='password' id='password' onkeyup='checkPass();' disabled 
                        title='Minimum eight characters, at least one uppercase letter, one lowercase letter, one number and one special character'>
                        <button id='password-change' style='display:none;' onclick='submitForm();'> Save</button>
                </article>

                <article id='profile-settings-confirm_password' class='profile-setting-elem'>
                    <header> Confirm password </header>
                    <input id='confirm_password' type='password' value='' onkeyup='checkPass();' disabled >
                </article>
                <p class='msg-password'></p>
                <p class='msg-password1'></p>
                <p class='msg-password2'></p>
        <?php } ?>
    </section>

<!--*********************** PROFILE COMMENTS ***********************-->
        <section id='profile-comments-tab' class='selected-tab'>
            <?php 
            $nComments = count($comments);
            if($nComments === 1) { ?>
                <h1>1 comment</h1>
            <?php } else { ?>
                <h1><?=count($comments)?> comments</h1>
            <?php } ?>
        </section>
<!--*********************** SECTION END ****************************-->
    </section>>
<?php } ?>