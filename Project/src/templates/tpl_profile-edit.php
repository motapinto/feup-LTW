<?php function draw_profile_settings($user) { ?>
    <div id="change-settings-tab">
        <h1 id="change-settings-title">Edit Profile</h4>
        <form action='../actions/action_profile_change.php' method='POST'>
            <?php if(isset($_SESSION['msg'])) { ?> 
                <p><?=$_SESSION['msg']?></p>
            <?php } ?>
            <div class="change-settings-elem">
                <label> Name </label>
                <div>
                    <input name="name" type="text" value="<?=$user['name']?>">
                </div>
            </div>

            <div class="change-settings-elem">
                <label> Email </label>
                <div>
                    <input name="email" type="email" value="<?=$user['email']?>">
                </div>
            </div>

            <div class="change-settings-elem">
                <label> Age </label>
                <div>
                    <input name="age" type="number" min="18" max="120" value="<?=$user['age']?>">
                </div>
            </div>

            <div class="change-settings-elem">
                <label> Password </label>
                <div>
                    <input name="password" type="password" value="">
                </div>
            </div>
            <div class="change-settings-elem">
                <label> Confirm password </label>
                <div>
                    <input name="control" type="password" value="">
                </div>
            </div>
            <button>Submit</button>
        </form>
    </div>

    <style>
        #change-settings-tab {
            background-color: white;
            width: 400px;
            height: 600px;
            margin-left: 600px;
            padding: 40px;
        }

        #change-settings-tab label{
            color: black;
        }

        #change-settings-tab h1{
            color: grey;
        }

        #change-settings-tab input {
            border-style: none;
            color: grey;
            width: 400px;
            text-align: center;
            padding-top: 15px;
        }

        #change-settings-tab form div{
            margin-bottom: 25px;            
        }

        #change-settings-tab button {
            margin-left: 35%;
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
            border: none;
        }

        /*https://css-tricks.com/snippets/css/turn-off-number-input-spinners/ */
        input[type=number]::-webkit-inner-spin-button, 
        input[type=number]::-webkit-outer-spin-button { 
            -webkit-appearance: none; 
            margin: 0; 
        }
    </style>
<?php } ?>
