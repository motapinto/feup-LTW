<?php function draw_login() { ?>
    <section class="log_in">
        <img class="logo" src="../../assets/logo.png" alt="logo">
        <a href="../listings/listings_all.php">
            <button>Continue without login</button>
        </a> 
        <article class="login-elem">
            <h2>Log in</h2>
            <input id="email" name="email" type="email" placeholder="email" required/>
            <input id="password" name="password" type="password" placeholder="password" maxlength=30 required/>
            <p id='login-msg'></p>
            <a href="#">Forgot your password?</a>
            <button onclick="submitLogin();" class="loginin_button">LOG IN</button>
            <a href="signup.php"><button class="signup_button">SIGN UP</button></a>
        </article>
    </section>
<?php } ?>

<?php function draw_signup() { ?>
    <section class="sign_up">
        <img class="logo" src="../../assets/logo.png" alt="logo">
        <a href="../listings/listings_all.php">
            <button>Continue without signup</button>
        </a> 
        <section class="login-elem">
            <h2>Sign up</h2>
            <input name="name" type="text" id="name" onkeyup="checkName();" placeholder="name" required maxlength=50/>
            <input name="age" type="number" id="age" onkeyup="checkAge();" placeholder="age" required min=18 max=120/>
            <input name="email" type="email" id="email" onkeyup="checkEmail();" placeholder="email" required />
            <input type="password" name="password" id="password" onkeyup="checkPass();" title="Minimum eight characters, at least one uppercase letter, one lowercase letter and one number" placeholder="Password">
            
            <span id="msg-name"></span> 
            <span id="msg-age"></span> 
            <span id="msg-email"></span> 
            <span id="msg-password1"></span> 

            <a href="#">Forgot your password?</a>
            <button onclick="submitSignup();" class="signup_buttons" type="button">SIGN UP</button>
            <a href="login.php"><button class="loginin_button" type="button">LOG IN</button></a>
        </section>
    </section>
<?php } ?>