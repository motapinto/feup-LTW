<?php function draw_profile($user) { 
    include_once("../database/comments.php");
    $id = $user['id'];
    $comments = getCommentsByUserId($id);
    $imagePath = "../../assets/images/noImage.jpg";
    if(file_exists("../../assets/images/thumbs_medium/u_$id.jpg"))
        $imagePath = "../../assets/images/thumbs_medium/u_$id.jpg";
    else if(file_exists("../../assets/images/thumbs_medium/u_$id.png"))
        $imagePath = "../../assets/images/thumbs_medium/u_$id.png";
    ?>
<!--*********************** PROFILE SIDEMENU ***********************-->
    <section class="profile">
        <section class='side-drawer'>
            <!-- USER PHOTO -->
            <article class="profile-photo">
                <img class="_1mgxxu3" src="<?=$imagePath?>" alt="User Photo" title="User Photo">
                <div class="profile-change-photo">
                    <form action="../actions/action_user_image.php" method="post" enctype="multipart/form-data">
                        <input type="file" name="image" id='image'>
                        <label for="image">Choose Image</label>
                        <input type="submit" name="Submit" value="Upload">
                    </form>
                </div>
            </article>
            
            <!-- USER NAME -->
            <header>
                <h1><?=$user['name']?></h1>
                <article class="rating">
                    <?php 
                    $rating = $user['rating'];
                    for($i = 0; $i < 5; $i++){
                        if ($rating <= 0) { ?>
                            <i class="material-icons"> star_border</i>
                        <?php }
                        else if ($rating <= 0.5) { ?>
                            <i class="material-icons"> star_half</i>
                        <?php }
                        else { ?>
                            <i class="material-icons"> star</i>
                        <?php }
                        $rating -= 1;
                    }
                    ?>
                </div>
            </header>

            <!-- SIDEBAR BUTTONS -->
            <article class='profile-userbuttons'>
                <a href='../properties/properties.php'>
                    <button type='button' class='circular-button'>Properties</button>
                </a>
                <a href='#'>
                    <button type='button' class='circular-button'>Message</button>
                </a>
            </article>

            <!-- SIDEBAR MENU -->
            <article class='profile-usermenu'>
                <i class="fas fa-bars"></i>
                <button class='no-button' onclick='profileOverview();'> Overview </button>
                
                <i class="fas fa-users-cog"></i>
                <button class='no-button' onclick='profileSettings();'> Profile Settings</button>
                
                <i class="fas fa-shield-alt"></i>
                <button class='no-button' onclick='profileSettings();'>Security Settings</button>

                <i class="far fa-comments"></i>
                <button class='no-button' onclick='profileComments();'>Comments</button>
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
                    <input id='name' type='text' value='<?=$user['name']?>'>
                    <button class="submit-button" onclick='submitForm(0);'>
                        <i class="fas fa-sync-alt"></i>
                    </button>
                </article>

                <article id='profile-setting-email' class='profile-setting-elem'>
                    <header> Email </header>
                    <input id='email' type='email' value='<?=$user['email']?>'>
                    <button class="submit-button" onclick='submitForm(1);'>
                        <i class="fas fa-sync-alt"></i>
                    </button>                
                </article>

                <article id='profile-setting-age' class='profile-setting-elem'>
                    <header> Age </header>
                    <input id='age' type='number' min='18' max='120' value='<?=$user['age']?>'>
                    <button class="submit-button" onclick='submitForm(2);'>
                        <i class="fas fa-sync-alt"></i>
                    </button>
                </article>

                <article id='profile-setting-password' class='profile-setting-elem'>
                    <header> Password </header>
                    <input id='password' type='password' value='' onkeyup='checkPass();'/>
                    <button class="submit-button" onclick='submitForm(3);'>
                        <i class="fas fa-sync-alt"></i>
                    </button>
                </article>

                <article id='profile-settings-confirm_password' class='profile-setting-elem'>
                    <header> Confirm password </header>
                    <input id='confirm_password' type='password' value='' onkeyup='checkPass();'/>
                </article>
                <footer id='profile-settings-msg'></footer>
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

