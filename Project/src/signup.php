<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Login</title>
		<link rel="stylesheet" href="styles/login.css">
	</head>
  
	<h1>Rentals NAV</h1>
		<section class="sign_in">
		<form action="signup_action.php" method="POST">
				<h2>Sign up</h2>
				<input name="name" type="text" placeholder="name" required maxlength=20/>
				<input name="age" type="number" placeholder="age" required min=18 max=120/>
                <input name="email" type="email" placeholder="email" required />
				<input name="password" type="password" placeholder="password" required maxlength=30/>
				<?php 
					if (isset($_GET["msg"])) {
						$msg = explode("%20",$_GET["msg"]);
						echo '<p>';
						foreach($msg as $item) {
							echo $item." ";
						}
						echo '</p>';
					}		
				?>
				<a href="#">Forgot your password?</a>
				<a href="#"><button class="signup_buttons">SIGN UP</button></a>
			</form>
		</section>
	</h1>
</html>
