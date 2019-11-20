<?php function draw_profile($user) { ?>
    <div id="user">
        <section class="side-drawer">
            <!-- USER PHOTO -->
            <div class="profile-photo">
                <div style="display: inline-block;border-radius:20px;">
                    <div class="photo" style="height: 120px; width: 120px; display: block;">
                        <img class="_1mgxxu3" src="https://www.google.com/url?sa=i&source=images&cd=&ved=2ahUKEwiqgZXS8-vlAhWpzoUKHT63Ab8QjRx6BAgBEAQ&url=https%3A%2F%2Fstackoverflow.com%2Fq%2F38576264&psig=AOvVaw3Zgglh2B6Xw7fusxBqulSU&ust=1573896532418510" height="120" width="120" alt="User Photo" title="User Photo">
                    </div>
                </div>
                <div class="profile-change-photo">
                <i class="material-icons" style="color:white;">attach_file</i>
                    <a href="edit-photo.php" class="change-photo" >
                        Update
                    </a>                
                </div>
            </div>
            
            <!-- USER NAME -->
            <header>
                <div class="profile-name">
                    <h1><?=$user['name']?></h1>
                </div>
            </header>

            <!-- SIDEBAR BUTTONS -->
            <div class="profile-userbuttons">
                <button type="button" class="profile-userbuttons-properties">Properties</button>
                <button type="button" class="profile-userbuttons-message">Message</button>
            </div>

            <!-- SIDEBAR MENU -->
            <div class="profile-usermenu">
                <ul class="usermenu">
                    <li class="overview">
                    <i class="material-icons" style="color:white;">view_headline</i>
                        <a href="#"> Overview </a>
                    </li>
                    <li class="settings">
                        <i class="material-icons" style="color:white;">perm_identity</i>
                        <a href="#"> Account Settings </a>
                    </li>
                    <li class="rating">
                        <i class="material-icons" style="color:white;">star_border</i>
                        <a href="#"> Rating </a>
                    </li>
                    <li class="comments">
                        <i class="material-icons" style="color:white;">comment</i>
                        <a href="#"> Comments </a>
                    </li>
                </ul>
            </div>
        </section> 
    </div>

    <style>  

        a {
            text-decoration: none;
        }

        .side-drawer {
            position: fixed;
            display: flex; /* or inline-flex */
            flex-direction: column ;
            width: 20%;
            height: 60%; 
            background-color: rgb(39, 64, 89);
            padding: 50px;
            margin: 50px;
            border: solid 3px rgb(136, 189, 234);
        }


        .profile-photo {
            margin-left: 4em;
            border-radius: 50%;
        }

        .profile-photo a:hover{
            text-decoration: underline;
        }

        .profile-photo a{
            color: white;
            font-family: "Montserrat", sans-serif;
        }

        .profile-name {
            text-align: center;
            color: white;
            font-family: "Montserrat", sans-serif;
        }

        .profile-userbuttons {
            display: flex;
            flex-direction: row ;
        }

        .profile-userbuttons button{
            display: flex;
            border: 1px solid white;
            background-color: rgb(136, 189, 234);
            color: rgb(39, 64, 89);
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
            color: white;
        }

        .usermenu a:hover{
            text-decoration: underline;
        }

        .upload-photo {
            
        }

    </style>
<?php } ?>
