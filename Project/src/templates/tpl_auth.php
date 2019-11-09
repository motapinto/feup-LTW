<?php function draw_login() { ?>
    <section class="log_in">
        <form action="../actions/action_login.php" method="POST">
            <img class="logo" src="../../assets/logo.png" alt="logo">
            <h2>Log in</h2>
            <input name="email" type="email" placeholder="email" />
            <input name="password" type="password" placeholder="password" maxlength=30/>
            <a href="#">Forgot your password?</a>
            <button class="loginin_button" formaction="../actions/action_login.php" formmethod="post">LOG IN</button>
            <button class="signup_button" formaction="signup.php" formmethod="post">SIGN UP</button>
        </form>
    </section>
<?php } ?>

<?php function draw_signup() { ?>
    <section class="sign_up">
        <form action="../actions/action_signup.php" method="POST">
            <img class="logo" src="../../assets/logo.png" alt="logo">
            <h2>Sign up</h2>
            <input name="name" type="text" placeholder="name" required maxlength=20/>
            <input name="age" type="number" placeholder="age" required min=18 max=120/>
            <input name="email" type="email" placeholder="email" required />
            <input name="password" type="password" placeholder="password" required maxlength=30/>
            <a href="#">Forgot your password?</a>
            <a href="#"><button class="signup_buttons">SIGN UP</button></a>
        </form>
    </section>
<?php } ?>