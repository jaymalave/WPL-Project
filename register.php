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
</head>
<body>

	<div id="inputContainer">
		<form id="loginForm" action="register.php" method="POST">
			<h2>Login to your account</h2>
			<p>
				<label for="loginUsername">Username</label>
				<input id="loginUsername" name="loginUsername" type="text" placeholder="e.g. bartSimpson" required>
			</p>
			<p>
				<label for="loginPassword">Password</label>
				<input id="loginPassword" name="loginPassword" type="password" required>
			</p>

			<button type="submit" name="loginButton">Log In</button>
			
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
			
		</form>
	</div>

</body>
</html>