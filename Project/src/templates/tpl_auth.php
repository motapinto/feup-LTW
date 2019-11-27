<?php function draw_login() { ?>
    <section class="log_in">
        <img class="logo" src="../../assets/logo.png" alt="logo">
        <a href="../listings/listings_all.php">
            <button>Continue without login</button>
        </a> 
        <h2>Log in</h2>
        <input id='login-email' name="email" class="auth-input" type="email" placeholder="email" required/>
        <input id='login-password' name="password" class="auth-input" type="password" placeholder="password" maxlength=30 required/>
        <?php if(isset($_SESSION['msg'])) { ?>
            <p><?=$_SESSION['msg']?></p>
        <?php } ?>
        <p id='login-msg'></p>
        <a href="#">Forgot your password?</a>
        <button onclick="submitLogin();" class="loginin_button">LOG IN</button>
        <button class="signup_button" formaction="signup.php" formmethod="post">SIGN UP</button>
    </section>
<?php } ?>

<?php function draw_signup() { ?>
    <section class="sign_up">
        <img class="logo" src="../../assets/logo.png" alt="logo">
        <a href="../listings/listings_all.php">
            <button>Continue without signup</button>
        </a> 
        <form action="../actions/action_signup.php" method="POST">
            <h2>Sign up</h2>
            <input name="name" type="text" class="auth-input" placeholder="name" required maxlength=20/>
            <input name="age" type="number" class="auth-input" placeholder="age" required min=18 max=120/>
            <input name="email" type="email" class="auth-input" placeholder="email" required />
            <input type="password" name="password" class="auth-input" pattern="(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}" title="Minimum eight characters, at least one uppercase letter, one lowercase letter, one number and one special character" placeholder="Password">
            <a href="#">Forgot your password?</a>
            <a href="#"><button class="signup_buttons">SIGN UP</button></a>
            <button class="loginin_button">LOG IN</button>
        </form>
    </section>
<?php } ?>