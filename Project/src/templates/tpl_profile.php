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
                        $nextRating = $rating - 1;
                        if (($rating - $nextRating) == 0) { ?>
                            <i class="material-icons"> star_border</i>
                        <?php }
                        else if (($rating - $nextRating) <= 0.5) { ?>
                            <i class="material-icons"> star_half</i>
                        <?php }
                        else { ?>
                            <i class="material-icons"> star</i>
                        <?php }
                        $rating = $nextRating;
                    }
                    ?>
                </article>
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
        <div id='profile-overview-tab' class='selected-tab'>
        </div>


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
        <div id='profile-comments-tab' class='selected-tab'>
            <?php 
            $nComments = count($comments);
            if($nComments === 1) { ?>
                <h1>1 comment</h1>
            <?php } else { ?>
                <h1><?=count($comments)?> comments</h1>
            <?php } ?>
        </div>
<!--*********************** SECTION END ****************************-->
    </section>>
<?php } ?>

<script>
    function profileOverview() {
        document.getElementById("profile-settings-tab").style.display = "none";
        document.getElementById("profile-comments-tab").style.display = "none";
        document.getElementById("profile-overview-tab").style.display = "display";
    }

    function profileSettings() {
        document.getElementById("profile-overview-tab").style.display = "none";
        document.getElementById("profile-comments-tab").style.display = "none";
        document.getElementById("profile-settings-tab").style.display = "block";
    }

    function profileComments() {
        document.getElementById("profile-overview-tab").style.display = "none";
        document.getElementById("profile-comments-tab").style.display = "block";
        document.getElementById("profile-settings-tab").style.display = "none";
    }

    function checkEmail() {
        var xhttp = new XMLHttpRequest();
        var asynchronous = true;

        //if(!isset($_POST['email']) || !isset($_POST['name']) || !isset($_POST['age']) || !isset($_POST['password']))
        
        xhttp.open('GET', 'getcustomer.php?q='+str, asynchronous);
        xhttp.send();

        /*if(se der erro dentro da funcao acrtion_profile_change) {
            document.getElementById('profile-settings-msg-email').innerHTML = 'Email already exists';
            document.getElementById('profile-settings-submit').disabled = false;
        }*/
    }

    function checkPass() {
        if(document.getElementById('password').value.length == 0 ||
            document.getElementById('password').value ==document.getElementById('confirm_password').value) {

            document.getElementById('password').style.backgroundColor = 'white';
            document.getElementById('password').style.border = 'solid 1px rgb(176, 183, 187)'
            document.getElementById('confirm_password').style.backgroundColor = 'white';
            document.getElementById('confirm_password').style.border = 'solid 1px rgb(176, 183, 187)'
            document.getElementById('profile-settings-msg').innerHTML = '';
            document.getElementById('profile-settings-submit').disabled = false;
        }
        else {
            document.getElementById('confirm_password').style.backgroundColor  = 'rgb(246, 220, 220)';
            document.getElementById('confirm_password').style.border = 'solid 1px rgb(233, 76, 76)'
            document.getElementById('profile-settings-msg').innerHTML = 'The password\'s don\'t match';
            document.getElementById('profile-settings-msg').style.color = 'red';
            document.getElementById('profile-settings-submit').disabled = true;
        }
    }

    function submitForm(option){
        let xhttp = new XMLHttpRequest();
        let asynchronous = true;
        let request, name, email, age, password;
  
        switch(option) {
            // user name
            case 0:
                name = document.getElementById('name').value;
                let requestName = name.split(' ');
                requestName = requestName.join('+');
                request = 'name=' + requestName;
                break;
            // user email
            case 1:
                email = document.getElementById('email').value;
                let requestEmail = email.replace('@', '%40');
                request = 'email=' + requestEmail;
                break;
            // user age
            case 2:
                age = document.getElementById('age').value;
                request = 'age=' + age;
                break;
            // user password
            case 3:
                password = document.getElementById('password').value;
                request = 'password=' + password;
                break;
            default:
                break;
        }

        // Define what happens on successful data submission
        xhttp.addEventListener('load', function(event) {
            switch(option) {
            // user email
            case 1:
                emailAfter = document.getElementById('email').value;
                if(email != emailAfter) {
                    document.getElementById('profile-settings-msg-email').innerHTML = 'Email already exists';
                    document.getElementById('profile-settings-msg-email').style.color = 'red';
                    alert('error');
                }
                else {
                    alert('no error');
                    document.getElementById('profile-settings-msg-email').innerHTML = '';
                }
                break;
            default:
                break;
        }
        });

        // Define what happens in case of error
        xhttp.addEventListener('error', function(event) {
            alert('Oops! Something goes wrong.');
        });

        xhttp.open('POST', '../actions/action_profile_change.php?'+request, asynchronous);
        xhttp.send();
    }
</script>

<style>
/************************* PROFILE SIDEMENU *************************/
    .side-drawer {
        display: flex; /* or inline-flex */
        flex-direction: column ;
        background-color: white;
        padding: 5%;
        margin: 5%;
        align-items:center;
    }

    .profile-photo {
        display: flex;
        flex-direction: column;
        align-items:center;
    }

    .profile-photo a{
        color: black;
        font-family: 'Montserrat', sans-serif;
    }

    .profile-name {
        text-align: center;
        color: black;
        font-family: 'Montserrat', sans-serif;
    }

    .profile-userbuttons {
        display: flex;
        flex-direction: row ;
    }

    .profile-userbuttons button{
        display: flex;
        border: 1px solid rgb(175,175,175);
        background-color: rgb(39, 64, 89);
        letter-spacing: 1px;
        margin: 10px;
        padding: 10px 20px;
    }

    .profile-usermenu {
        display: grid;
        grid-template-columns: 2em 10em;
        margin: 1em;
        padding: 1em 4em;
        border-top: solid 1px rgb(136, 189, 234);
        border-bottom: solid 1px rgb(136, 189, 234);
    }

    .profile-usermenu button, i {
        margin: 0.5em 0em;
    }

    .profile-photo img{
        border-radius: 50%;
        height: 10em;
        width: 10em; 
    }

    .profile-change-photo form input[type="file"]{
        display: none;
    }

    .profile-change-photo form label:hover{
        text-decoration: underline;
        cursor: pointer;
    }

    .profile-change-photo form label{
        color: teal;
        font-weight: bold;        
    }
    
    .profile-change-photo form{
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 1em;
        margin:0;
    }

    .profile-change-photo form *{
        margin: 0.1em;
    }

    .rating {
        color: #F9A602;
        display: flex;
        align-items: center;
        justify-content: center;
    }


/*************************      COMMON      *************************/
    .profile {
        display: grid;
        grid-template-columns: 35% 65%
    }
    .selected-tab {
        display: none;
        background-color: white;
        margin: 5%;
        padding: 0 5%;
        width: 60%;
        height: 45em;
        border-left: solid 1px rgb(175, 175, 175);
    }

/************************* PROFILE OVERVIEW *************************/
    /*a*/

/************************* PROFILE SETTINGS *************************/
    #profile-settings-title{
        color: grey;
    }

    #profile-settings-tab input {
        border: solid rgb(176, 183, 187) 1px;
        color: grey;
        text-align: center;
        border-radius: 5px;
        margin-right: 2%;
    }

    #profile-settings-tab input:focus {
        border: solid rgb(176, 183, 187) 2px;
    }

    .profile-setting-elem header{
        grid-column: 1/ footer 2;     
        margin-right: 1em;
    }

    .profile-setting-elem {
        display: grid;
        grid-template-columns: 88%   10%;
        padding-bottom: 2em;
        margin-bottom: 2em;
        border-bottom: solid 1px rgb(136, 189, 234);   
    }

    .profile-setting-elem:last-child {
        border: none;
    }

    .profile-setting-elem input{
        height: 2em;   
    }

    .submit-button {
        border: none;
        background-color: white;
        color: grey;
    }
    
    .submit-button:hover {
        color: black;
        cursor: pointer;
        animation: rotation 2s infinite linear;
    }

    @keyframes rotation {
        from {
            transform: rotate(0deg);
        }
        to {
            transform: rotate(359deg);
        }
    }
</style>

