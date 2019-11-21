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
                    <i class="material-icons">attach_file
                        <input type="file" name="image">
                        <input type="submit" name="Submit">
                    </i>
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
                <a href="../properties/properties.php">
                    <button type="button" class="profile-userbuttons-properties">Properties</button>
                </a>
                <a href="#">
                    <button type="button" class="profile-userbuttons-message">Message</button>
                </a>
            </div>

            <!-- SIDEBAR MENU -->
            <div class="profile-usermenu">
                <ul class="usermenu">
                    <li>
                        <i class="material-icons"> menu </i>
                        <a href="#"> Overview </a>
                    </li>
                    <li>
                        <i class="material-icons"> settings </i>
                        <a href="#"> Account Settings </a>
                    </li>
                    <li>
                        <i class="material-icons"> star_border </i>
                        <a href="#"> Rating </a>
                    </li>
                    <li>
                        <i class="material-icons"> insert_comment </i>
                        <a href="#"> Comments </a>
                    </li>
                </ul>
            </div>
        </section> 
    </div>

    <style>  
        body {
            background-color: white;
        }


        .user a {
            text-decoration: none;
        }

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

    </style>
<?php } ?>
