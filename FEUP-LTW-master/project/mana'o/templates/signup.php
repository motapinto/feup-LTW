<?php
    include_once("../includes/init.php");
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>MANA'O Signup</title>
    <link href="../css/forms_style.css" rel="stylesheet"> 
    <link href="../css/forms_layout.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Julius+Sans+One" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:100" rel="stylesheet">
</head>

<body>
    <header>
        <img src="../images/dynamic_icon.gif" alt="Dynamic">
        <h1>m a n a' o</h1>
        <h3> 
            <?php
                include_once("../database/quotes.php");
                echo getRandomQuote();
            ?>
        </h3>
    </header>

    <section id="signup">

        <form action="../actions/signupAction.php" method="post">
            <input type="text" name="name" placeholder="Name">
            <input type="text" name="username" placeholder="Username">
            <input type="email" name="email" placeholder="Email">
            <input type="password" name="password" pattern="(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}" title="Minimum eight characters, at least one uppercase letter, one lowercase letter, one number and one special character">
            <input type="submit" value="Sign up">
        </form>

    </section>

    <nav id="login">
        <p>Already have an account? <a href="login.php">Login</a> </p>
    </nav>

    <p id="errors"> <?php echo htmlentities($error) ?> </p>

    <?php
    include_once("footer.php");
    ?>
