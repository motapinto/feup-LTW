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
    <div id="user">
        <section class="side-drawer">
            <!-- USER PHOTO -->
            <div class="profile-photo">
                <img class="_1mgxxu3" src="<?=$imagePath?>" alt="User Photo" title="User Photo">
                <div class="profile-change-photo">
                    <form action="../actions/action_user_image.php" method="post" enctype="multipart/form-data">
                        <input type="file" name="image" id='image'>
                        <label for="image">Choose Image</label>
                        <input type="submit" name="Submit" value="Upload">
                    </form>
                </div>
            </div>
            
            <!-- USER NAME -->
            <header>
                <h1><?=$user['name']?></h1>
                <div class="rating">
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
                </div>
            </header>

            <!-- SIDEBAR BUTTONS -->
            <div class="profile-userbuttons">
                <a href="../properties/properties.php">
                    <button type="button" class="circular-button">Properties</button>
                </a>
                <a href="#">
                    <button type="button" class="circular-button">Message</button>
                </a>
            </div>

            <!-- SIDEBAR MENU -->
            <div class="profile-usermenu">
                <ul class="usermenu">
                    <li>
                        <i class="material-icons"> menu </i>
                        <button class='no-button' onclick='profileOverview();'> Overview </button>
                    </li>
                    <li>
                        <i class="material-icons"> settings </i>
                        <button class='no-button' onclick='profileSettings();'> Account Settings </button>
                    </li>
                    <li>
                        <i class="material-icons"> star_border </i>
                        <a href="#"> Rating </a>
                    </li>
                    <li>
                        <i class="material-icons"> insert_comment </i>
                        <button class='no-button' onclick='profileComments();'> Comments </button>
                    </li>
                </ul>
            </div>
        </section> 
    </div>

<!--*********************** PROFILE OVERVIEW ***********************-->
    <div id='profile-overview-tab' class='selected-tab'>
    </div>


<!--*********************** PROFILE SETTINGS ***********************-->
    <div id='profile-settings-tab' class='selected-tab'>
        <h1 id='profile-settings-title'>Edit Profile</h4>
        <form action='../actions/action_profile_change.php' method='POST'>
            <div id='profile-setting-name' class='profile-setting-elem'>
                <label> Name </label>
                <div class='profile-settings-aux-div'>
                    <input name='name' type='text' value='<?=$user['name']?>'>
                    <a href="#"><i class="material-icons" style="color:rgb(176, 183, 187);">arrow_forward_ios</i></a>
                </div>
            </div>

            <div id='profile-setting-email' class='profile-setting-elem'>
                <label> Email </label>
                <div class='profile-settings-aux-div'>
                    <input name='email' type='email' value='<?=$user['email']?>'>
                    <a href="#"><i class="material-icons" style="color:rgb(176, 183, 187);">arrow_forward_ios</i></a>
                    <span id='profile-settings-msg-email'></span>
                </div>
            </div>

            <div id='profile-setting-age' class='profile-setting-elem'>
                <label> Age </label>
                <div class='profile-settings-aux-div'>
                    <input name='age' type='number' min='18' max='120' value='<?=$user['age']?>'>
                    <a href="#"><i class="material-icons" style="color:rgb(176, 183, 187);">arrow_forward_ios</i></a>
                </div>
            </div>

            <div id='profile-setting-password' class='profile-setting-elem'>
                <label> Password </label>
                <div class='profile-settings-aux-div'>
                    <input id='password' type='password' value='' onkeyup='checkPass();'/>
                    <a href="#"><i class="material-icons" style="color:rgb(176, 183, 187);">arrow_forward_ios</i></a>
                </div>
            </div>

            <div id='profile-settings-confirm_password' class='profile-setting-elem'>
                <label> Confirm password </label>
                <div class='profile-settings-aux-div'>
                    <input id='confirm_password' type='password' value='' onkeyup='checkPass();'/>
                    <a href="#"><i class="material-icons" style="color:rgb(176, 183, 187);">arrow_forward_ios</i></a>
                    <span id='profile-settings-msg-pass'></span>
                </div>
            </div>
        </form>
    </div>

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
            document.getElementById('profile-settings-msg-pass').innerHTML = '';
            document.getElementById('profile-settings-submit').disabled = false;
        }
        else {
            document.getElementById('confirm_password').style.backgroundColor  = 'rgb(246, 220, 220)';
            document.getElementById('confirm_password').style.border = 'solid 1px rgb(233, 76, 76)'
            document.getElementById('profile-settings-msg-pass').innerHTML = 'The password\'s dont\'t match';
            document.getElementById('profile-settings-msg-pass').style.color = 'red';
            document.getElementById('profile-settings-submit').disabled = true;
        }
    }

    function submitForm(){
        let name = document.getElementById('profile-setting-name').innerHTML.value;
        let email = document.getElementById('profile-setting-email').innerHTML.value;
        let age = document.getElementById('profile-setting-age').innerHTML.value;
        let password = document.getElementById('profile-setting-password').innerHTML.value;
        let confirm_password = document.getElementById('profile-setting-confirm_password').innerHTML.value;

        let requestName = split(name, ' ');
        requestName = requestName.join('+');
        let requestEmail = email.replace('@', '%40');
        let request = 'name=' + requestName + '&' + 'email=' + requestEmail + '&' + 'age=' + age + '&'+ 'password=' + password + '&' + 'control=' + confirm_password;
        
        let xhttp = new XMLHttpRequest();
        let asynchronous = true;

        // Define what happens on successful data submission
        xhttp.addEventListener('load', function(event) {
            alert('Yeah! Data sent and response loaded.');
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
        position: absolute;
        display: flex; /* or inline-flex */
        flex-direction: column ;
        width: 280px;
        height: 500px; 
        background-color: white;
        padding: 50px;
        margin: 50px;
        border: solid 1px rgb(175, 175, 175);
        align-items:center;
    }

    .profile-photo {
        display: flex;
        flex-direction: column;
        align-items:center;
    }

    .profile-photo a:hover{
        text-decoration: underline;
    }

    .profile-photo a{
        color: black;
        font-family: "Montserrat", sans-serif;
    }

    .profile-name {
        text-align: center;
        color: black;
        font-family: "Montserrat", sans-serif;
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
        display: flex; /* or inline-flex */
        flex-direction: column ; 
        margin: 10px;
        border-top: solid 3px rgb(136, 189, 234);
        border-bottom: solid 3px rgb(136, 189, 234);
    }

    .usermenu {
        list-style-type: none;
        padding-left: 10%;
    }

    .usermenu li {
        padding-bottom: 8px;
    }

    .usermenu li a {
        list-style-type: none;
    }

    .usermenu a{
        font-size: 20px;
        font-family: "Montserrat", sans-serif;
        color: black;
    }

    .usermenu a:hover{
        text-decoration: underline;
    }

    .upload-photo {  
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
        color: rgb(0, 102, 102);
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
        display:flex;
        color: #F9A602;
        align-items: center;
    }


/*************************      COMMON      *************************/
    .selected-tab {
        display: none;
        background-color: white;
        width: 400px;
        height: 600px;
        margin-left: 600px;
        padding: 40px;
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
        width: 350px;
        text-align: center;
        padding-top: 15px;
        border-radius: 5px;
    }

    #profile-settings-tab input:focus {
        border: solid rgb(176, 183, 187) 2px;
    }

    .profile-settings-aux-div{
        margin-bottom: 25px;            
    }

    .profile-setting-elem {
        margin-bottom: 25px;      
        border-bottom: solid 1px rgb(136, 189, 234);   
    }

    .profile-setting-elem:last-child {
        border: none;
    }
</style>

