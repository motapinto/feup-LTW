<?php function draw_login() { ?>
    <section class="log_in">
        <img class="logo" src="../../assets/logo.png" alt="logo">
        <a href="../listings/listings_all.php">
            <button>Continue without login</button>
        </a> 
        <article class="login-elem">
            <h2>Log in</h2>
            <input class="email" name="email" type="email" placeholder="email" required/>
            <input class="password" name="password" type="password" placeholder="password" maxlength=30 required/>
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
        <article class="login-elem">
            <h2>Sign up</h2>
            <input name="name" type="text" class="name" onkeyup="checkName();" placeholder="name" required maxlength=20/>
            <input name="age" type="number" class="age" onkeyup="checkAge();" placeholder="age" required min=18 max=120/>
            <input name="email" type="email" class="email" onkeyup="checkEmail();" placeholder="email" required />
            <input type="password" name="password" class="password" onkeyup="checkPass();" pattern="(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[A-Za-z\d]{8,}" title="Minimum eight characters, at least one uppercase letter, one lowercase letter and one number" placeholder="Password">
            
            <span class="msg-name"></span> 
            <span class="msg-age"></span> 
            <span class="msg-email"></span> 
            <span class="msg-password1"></span> 

            <a href="#">Forgot your password?</a>
            <button onclick="submitSignup();" class="signup_buttons">SIGN UP</button>
            <a href="login.php"><button class="loginin_button">LOG IN</button></a>
        </article>
    </section>
<?php } ?>

<script>
    function submitSignup() {
        let xhttp = new XMLHttpRequest();
        let asynchronous = true;

        if(!(checkName() && checkAge() && checkEmail() && checkPass()))
            return; 

            alert('2');


        let email = document.getElementsByClassName('email')[0].value;
        email = email.replace('@', '%40');
        email = 'email=' + email;

        let password = document.getElementsByClassName('password')[0].value;
        password = 'password=' + password;

        let name = document.getElementsByClassName('name')[0].value;
        name = 'name=' + name;

        let age = document.getElementsByClassName('age')[0].value;
        age = 'age=' + age;

        let request = email + '&' + password + '&' + name + '&' + age;
        alert(request);
        
        // Define what happens on successful data submission
        xhttp.addEventListener('load', function(event) {
            let response = JSON.parse(this.responseText);
            alert(response['response']);
            
            switch (response['response']) {
                //  success
                case 0:
                    window.location = '../authentication/login.php';
                    document.getElementsByClassName('msg-email')[0].innerHTML = '';
                    break;

                //  fail -> user exists
                default:
                    window.location = '../authentication/signup.php';
                    document.getElementsByClassName('msg-email')[0].innerHTML = 'Email already exists';
                    break;
            }
        });

        // Define what happens in case of error
        xhttp.addEventListener('error', function(event) {
            alert('Oops! Something goes wrong.');
        });

        xhttp.open('GET', '../actions/action_signup.php?' + request, asynchronous);
        xhttp.send();
    }
</script>