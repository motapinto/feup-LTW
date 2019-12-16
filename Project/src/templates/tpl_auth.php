<?php function draw_login() { ?>
    <section id="log_in">
        <img class="logo" src="../../assets/logo.png" alt="logo">
        <button class="btn" id="continue-btn">Continue without login</button>
        <article class="login-elem">
            <h2>Log in</h2>
            <input id="email" name="email" type="email" placeholder="email" required/>
            <input id="password" name="password" type="password" placeholder="password" maxlength=30 required/>
            <p id='login-msg'></p>
            <a href="#">Forgot your password?</a>
            <button class="btn"  id="login-btn">LOG IN</button>
            <button class="btn" id="signup-btn">SIGN UP</button>
        </article>
    </section>
<?php } ?>

<?php function draw_signup() { ?>
    <section id="sign_up">
        <img class="logo" src="../../assets/logo.png" alt="logo">
        <button class="btn" id="continue-btn">Continue without signup</button>
        <section class="login-elem">
            <h2>Sign up</h2>
            <input name="name" type="text" id="name" placeholder="name" required maxlength=50/>
            <input name="age" type="number" id="age" placeholder="age" required min=18 max=120/>
            <input name="email" type="email" id="email" placeholder="email" required />
            <input type="password" name="password" id="password" title="Minimum eight characters, at least one uppercase letter, one lowercase letter and one number" placeholder="Password">
            <input type="password" name="confirm_password" id="confirm_password" title="Minimum eight characters, at least one uppercase letter, one lowercase letter and one number" placeholder="Password">
            
            <span id="msg-name"></span> 
            <span id="msg-age"></span> 
            <span id="msg-email"></span> 
            <span id="msg-password1"></span> 
            <span id="msg-password2"></span> 
            <a href="#">Forgot your password?</a>
            <button type="submit" class="btn" id="signup-btn">SIGN UP</button>
            <button type="submit" class="btn" id="login-btn">LOG IN</button>
        </section>
    </section>
<?php } ?>