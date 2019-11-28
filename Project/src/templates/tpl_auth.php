<?php function draw_login() { ?>
    <section class="log_in">
        <img class="logo" src="../../assets/logo.png" alt="logo">
        <a href="../listings/listings_all.php">
            <button>Continue without login</button>
        </a> 
        <article class="login-elem">
            <h2>Log in</h2>
            <input id='login-email' name="email" class="auth-input" type="email" placeholder="email" required/>
            <input id='login-password' name="password" class="auth-input" type="password" placeholder="password" maxlength=30 required/>
            <p id='login-msg'></p>
            <a href="#">Forgot your password?</a>
            <button onclick="submitLogin();" class="loginin_button">LOG IN</button>
            <a href="signup.php"><button class="signup_button">SIGN UP</button></a>
        </article>
    </section>
    <p>Copyright © FEUP | Developed by Martim Pinto da Silva and Luís Ramos</p>
<?php } ?>

<?php function draw_signup() { ?>
    <section class="sign_up">
        <img class="logo" src="../../assets/logo.png" alt="logo">
        <a href="../listings/listings_all.php">
            <button>Continue without signup</button>
        </a> 
        <article class="login-elem">
            <h2>Sign up</h2>
            <input name="name" type="text" id="signup-name" class="auth-input" placeholder="name" required maxlength=20/>
            <input name="age" type="number" id="signup-age" onkeyup="checkAge2();" class="auth-input" placeholder="age" required min=18 max=120/>
            <input name="email" type="email" id="signup-email" onkeyup="aa();" class="auth-input" placeholder="email" required />
            <input type="password" name="password" id="signup-password" class="auth-input" pattern="(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[A-Za-z\d]{8,}" title="Minimum eight characters, at least one uppercase letter, one lowercase letter and one number" placeholder="Password">
            
            <span class="signup-msg-name"></span> 
            <span class="signup-msg-age"></span> 
            <span class="signup-msg-email"></span> 
            <span class="signup-msg-password1"></span> 
            <span class="signup-msg-password2"></span> 

            <a href="#">Forgot your password?</a>
            <a href="#"><button class="signup_buttons">SIGN UP</button></a>
            <a href="login.php"><button class="loginin_button">LOG IN</button></a>
        </article>
    </section>
<?php } ?>

<script>
function aa() {
    let email = document.getElementById('signup-email').value;
    let emailTest = new RegExp("^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$");
    let isLegal = emailTest.test(email);

    if(isLegal) {
        document.getElementById('signup-msg-email').innerHTML = '';
        document.getElementById('signup-email').style.backgroundColor = 'white';
        document.getElementById('signup-email').style.border = 'solid 1px rgb(176, 183, 187)';
        submitForm(1);
    }
    else {
        alert(isLegal);
        document.getElementById('signup-msg-email').innerHTML = 'Failled to change email';
    }
}

function checkAge2() {
    if(document.getElementById('signup-age').value >= 18) {
        document.getElementById('signup-age').style.backgroundColor = 'white';
        document.getElementById('signup-age').style.border = 'solid 1px rgb(176, 183, 187)';
        document.getElementById('signup-msg-age').innerHTML = '';
    }
    else {
        document.getElementById('signup-msg-age').style.color = 'red';
        document.getElementById('signup-age').style.backgroundColor = 'rgb(246, 220, 220)';
        document.getElementById('signup-age').style.border = 'solid 1px rgb(233, 76, 76)';
        document.getElementById('signup-msg-age').innerHTML = 'Must be over than 18';
    }
}

</script>