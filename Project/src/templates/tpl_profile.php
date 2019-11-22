<?php function draw_profile($user) { ?>
<!--*********************** PROFILE SIDEMENU ***********************-->
    <div id='user'>
        <section class='side-drawer'>
            <!-- USER PHOTO -->
            <div class='profile-photo'>
                <div style='display: inline-block;border-radius:20px;'>
                    <div class='photo' style='height: 120px; width: 120px; display: block;'>
                        <img class='_1mgxxu3' src='https://www.google.com/url?sa=i&source=images&cd=&ved=2ahUKEwiqgZXS8-vlAhWpzoUKHT63Ab8QjRx6BAgBEAQ&url=https%3A%2F%2Fstackoverflow.com%2Fq%2F38576264&psig=AOvVaw3Zgglh2B6Xw7fusxBqulSU&ust=1573896532418510' height='120' width='120' alt='User Photo' title='User Photo'>
                    </div>
                </div>
                <div class='profile-change-photo'>
                    <i class='material-icons'>attach_file
                        <input type='file' name='image'>
                        <input type='submit' name='Submit'>
                    </i>
                    <a href='edit-photo.php' class='change-photo' >
                        Update
                    </a>                
                </div>
            </div>
            
            <!-- USER NAME -->
            <header>
                <div class='profile-name'>
                    <h1><?=$user['name']?></h1>
                </div>
            </header>

            <!-- SIDEBAR BUTTONS -->
            <div class='profile-userbuttons'>
                <a href='../properties/properties.php'>
                    <button type='button' class='circular-button'>Properties</button>
                </a>
                <a href='#'>
                    <button type='button' class='circular-button'>Message</button>
                </a>
            </div>

            <!-- SIDEBAR MENU -->
            <div class='profile-usermenu'>
                <ul class='usermenu'>
                    <li>
                        <i class='material-icons'> menu </i>
                        <button class='no-button' onclick='profileOverview();'> Overview </button>
                    </li>
                    <li>
                        <i class='material-icons'> settings </i>
                        <button class='no-button' onclick='profileSettings();'> Account Settings </button>
                    </li>
                    <li>
                        <i class='material-icons'> star_border </i>
                        <a href='#'> Rating </a>
                    </li>
                    <li>
                        <i class='material-icons'> insert_comment </i>
                        <a href='#'> Comments </a>
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
            <div id='profile-setting-name' class='profile-setting-elem'>
                <label> Name </label>
                    <input id='name' type='text' value='<?=$user['name']?>'>
                    <button onclick='submitForm(0);'><i class='material-icons'>arrow_forward_ios</i></button>
            </div>

            <div id='profile-setting-email' class='profile-setting-elem'>
                <label> Email </label>
                <input id='email' type='email' value='<?=$user['email']?>'>
                <button onclick='submitForm(1);'><i class='material-icons'>arrow_forward_ios</i></button>
                <span id='profile-settings-msg-email'></span>
            </div>

            <div id='profile-setting-age' class='profile-setting-elem'>
                <label> Age </label>
                <input id='age' type='number' min='18' max='120' value='<?=$user['age']?>'>
                <button onclick='submitForm(2);'><i class='material-icons'>arrow_forward_ios</i></button>
            </div>

            <div id='profile-setting-password' class='profile-setting-elem'>
                <label> Password </label>
                <input id='password' type='password' value='' onkeyup='checkPass();'/>
                <button onclick='submitForm(3);'><i class='material-icons'>arrow_forward_ios</i></button>
            </div>

            <div id='profile-settings-confirm_password' class='profile-setting-elem'>
                <label> Confirm password </label>
                <input id='confirm_password' type='password' value='' onkeyup='checkPass();'/>
                <span id='profile-settings-msg-pass'></span>
            </div>
    </div>
<?php } ?>

<script>
    function profileOverview() {
        document.getElementById('profile-settings-tab').style.display = 'none';
        document.getElementById('profile-overview-tab').style.display = 'display';
    }

    function profileSettings() {
        document.getElementById('profile-overview-tab').style.display = 'none';
        document.getElementById('profile-settings-tab').style.display = 'block';
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
            document.getElementById('profile-settings-msg-pass').innerHTML = 'The password\'s don\'t match';
            document.getElementById('profile-settings-msg-pass').style.color = 'red';
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
        position: absolute;
        display: flex; /* or inline-flex */
        flex-direction: column ;
        width: 280px;
        height: 500px; 
        background-color: white;
        padding: 50px;
        margin: 50px;
        border: solid 1px rgb(175, 175, 175);
    }

    .profile-photo {
        margin-left: 4em;
        border-radius: 50%;
    }

    .profile-photo a:hover{
        text-decoration: underline;
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
        font-family: 'Montserrat', sans-serif;
        color: black;
    }

    .usermenu a:hover{
        text-decoration: underline;
    }

    .upload-photo {  
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
        width:30em;
        text-align: center;
        border-radius: 5px;
    }

    #profile-settings-tab input:focus {
        border: solid rgb(176, 183, 187) 2px;
    }

    .profile-setting-elem label{
        grid-column: 1/ span 2;     
        margin-right: 1em;
    }

    .profile-setting-elem {
        display: grid;
        grid-template-columns: 1fr 1fr;
        padding-bottom: 2em;
        margin-bottom: 2em;
        border-bottom: solid 1px rgb(136, 189, 234);   
    }

    .profile-setting-elem:last-child {
        border: none;
    }
</style>

