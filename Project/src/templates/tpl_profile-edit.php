<?php function draw_profile_settings($user) { ?>
    <div id="change-settings-tab">
        <h1 id="change-settings-title">Edit Profile</h4>
        <form>
            <div id="change-settings-name" class="change-settings-elem">
                <label> Name </label>
                <div class="div-aux">
                    <input id="user-form-name" type="text" value="Martim Silva">
                    <a href="#"><i class="material-icons" style="color:white;">arrow_forward_ios</i></a>
                </div>
            </div>

            <div id="change-settings-email" class="change-settings-elem">
                <label> Email </label>
                <div class="div-aux">
                    <input id="user-form-email" type="email" value="email@gmail.com">
                    <a href="#"><i class="material-icons" style="color:white;">arrow_forward_ios</i></a>
                </div>
            </div>

            <div id="change-settings-age" class="change-settings-elem">
                <label> Age </label>
                <div class="div-aux">
                    <input id="user-form-age" type="number" min="18" max="120" value="18">
                    <a href="#"><i class="material-icons" style="color:white;">arrow_forward_ios</i></a>
                </div>
            </div>

            <div id="change-settings-password1" class="change-settings-elem">
                <label> Password </label>
                <div class="div-aux">
                    <input id="form-control" type="password" value="11111">
                    <a href="#"><i class="material-icons" style="color:white;">arrow_forward_ios</i></a>
                </div>
            </div>
            <div id="change-settings-password2" class="change-settings-elem">
                <label> Confirm password </label>
                <div class="div-aux">
                    <input id="form-control" type="password" value="11111">
                    <a href="#"><i class="material-icons" style="color:white;">arrow_forward_ios</i></a>
                </div>
            </div>
        </form>
    </div>

    <style>
        @import url('https://fonts.googleapis.com/css?family=Montserrat:500&display=swap');

        #change-settings-tab a {
            text-decoration: none;
        }
        
        #change-settings-tab {
            background-color: rgb(39, 64, 89);
            border: solid 3px rgb(136, 189, 234);
            width: 400px;
            height: 600px;
            margin-left: 600px;
            padding: 40px;
        }

        #change-settings-tab label{
            font-family: "Montserrat", sans-serif;
            color: rgb(150, 152, 154);
        }

        #change-settings-tab h1{
            font-family: "Montserrat", sans-serif;
            color: grey;
        }

        #change-settings-tab input {
            border-style: none;
            background-color: rgb(39, 64, 89);
            color: white;
            width: 200px;
            padding-top: 15px;
        }

        #change-settings-tab form div{
            margin-bottom: 30px;            
        }

        #change-settings-tab button {
            background-color: rgb(39, 64, 89);
            border: none;
            color: white;
        }

        #change-settings-tab button:hover {
            text-decoration: underline;
            cursor: pointer;
        }

        .change-settings-elem {
            border-bottom: solid 1px rgb(136, 189, 234);   
        }

        .change-settings-elem:last-child {
            border-bottom: none; 
        }
    </style>
<?php } ?>
