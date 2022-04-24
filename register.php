<?php
include("includes/config.php");
include("includes/classes/Account.php");
$account = new Account($con);
include("includes/handlers/register-handler.php");
include("includes/handlers/login-handler.php");

function getInputValue($name) {
	if(isset($_POST[$name])) {
		echo $_POST[$name];
	}
}

?>

<html>
<head>
	<title>Spotify But Better</title>

	<link rel="stylesheet" type="text/css" href="assets/css/register.css">

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="assets/js/register.js"></script>
</head>
<body>
<?php

if(isset($_POST['registerButton'])) {
	echo '<script>
			$(document).ready(function() {
				$("#loginForm").hide();
				$("#registerForm").show();
			});
		</script>';
}
else {
	echo '<script>
			$(document).ready(function() {
				$("#loginForm").show();
				$("#registerForm").hide();
			});
		</script>';
}

?>

<div id="background">

    <div id="loginContainer">

	<div id="inputContainer">
		<form id="loginForm" action="register.php" method="POST">
			<h2>Login to your account</h2>
			<p>
			    <?php echo $account->getError("Your email or password is wrong"); ?>
				<label for="loginUsername">Username</label>
				<input id="loginUsername" name="loginUsername" type="text" placeholder="e.g. bartSimpson" required>
			</p>
			<p>
				<label for="loginPassword">Password</label>
				<input id="loginPassword" name="loginPassword" type="password" required>
			</p>

			<button type="submit" name="loginButton">Log In</button>

			<div class="hasAccountText">
						<span id="hideLogin">Don't have an account yet? Signup here.</span>
			</div>
			
		</form>
		<form id="registerForm" action="register.php" method="POST">
			<h2>Create Your Free Account</h2>
			<p>
				<?php echo $account->getError("Your username must be between 5 and 25 characters"); ?>
				<?php echo $account->getError("Username is already taken"); ?>
				<label for="loginUsername">Username</label>
				<input id="loginUsername" name="loginUsername" type="text" placeholder="e.g. bartSimpson" value="<?php getInputValue('loginUsername') ?>" required>
			</p>
			<p>
				<?php echo $account->getError("Your first name must be between 2 and 25 characters"); ?>
				<label for="firstName">First Name</label>
				<input id="firstName" name="firstName" type="text" placeholder="e.g. Bart" value="<?php getInputValue('firstName') ?>" required>
			</p>
			<p>
				<?php echo $account->getError("Your last name must be between 2 and 25 characters"); ?>
				<label for="lastName">Last Name</label>
				<input id="lastName" name="lastName" type="text" placeholder="e.g. Simpson" value="<?php getInputValue('lastName') ?>" required>
			</p>
			<p> 
				<?php echo $account->getError("Your emails don't match"); ?>
				<?php echo $account->getError("Email is invalid"); ?>
				<?php echo $account->getError("Email already in use"); ?>
				<label for="email">Email</label>
				<input id="email" name="email" type="email" placeholder="e.g. bart@gmail.com" value="<?php getInputValue('email') ?>" required>
			</p>
			<p>

				<label for="email2">Confirm Email</label>
				<input id="email2" name="email2" type="email" placeholder="e.g. bart@gmail.com" value="<?php getInputValue('email2') ?>" required>
			</p>
			<p>
				<?php echo $account->getError("Your passwords don't match"); ?>
				<?php echo $account->getError("Your password can only contain numbers and letters"); ?>
				<?php echo $account->getError("Your password must be between 5 and 30 characters"); ?>
				<label for="password">Password</label>
				<input id="password" name="password" type="password" required>
			</p>
			<p>
				<label for="password2">Confirm Password</label>
				<input id="password2" name="password2" type="password" required>
			</p>

			<button type="submit" name="registerButton">Sign Up</button>
			<div class="hasAccountText">
						<span id="hideRegister">Already have an account? Log in here.</span>
					</div>
		</form>
	</div>
	<div id="loginText">
				<h1>Get great music, right now</h1>
				<h2>Listen to loads of songs for free</h2>
				<ul>
					<li>Discover music you'll fall in love with</li>
					<li>Create your own playlists</li>
					<li>Follow artists to keep up to date</li>
				</ul>
			</div>
</div>
</div>

</body>
</html>