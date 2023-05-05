<?php

	include_once("util.php");

	session_start();

	if (isset($_SESSION["email"])){
		header("Location: landing.php");
	} 

	if (isset($_SESSION["error"])){
		$error = ($_SESSION["error"]);
	} else {
		$error = null;
	}

	function register_error($error){
		if ($error != null) 
			if ($error->page == "Register") {
				echo "<p id='register-error' class='error'> $error->msg </p>";
		}
	}

	function login_error($error){
		if ($error != null) 
			if ($error->page == "Login") {
				echo "<p id='login-error' class='error'> $error->msg </p>";
		}
	}
?>

<html>  
<head>  
    <title>PHP login system</title>  
    <link rel = "stylesheet" type = "text/css" href = "style.css">   
</head>  
<body>  
	<div class="container" id="container">
		<div class="form-container sign-up-container">
			<form action="queries/register.php" method="post">
				<h1>Create Account</h1>
				<input type="text" name="name" placeholder="Name" />
				<input type="email" name="email" placeholder="Email" />
				<input type="password" name="pwd" placeholder="Password" />
				<?= register_error($error) ?>
				</p>
				<button>Sign Up</button>
			</form>
		</div>
		<div class="form-container sign-in-container">
			<form action="queries/login.php" method="post">
				<h1>Sign in</h1>
				<input type="email" name="email" placeholder="Email" />
				<input type="password" name="pwd" placeholder="Password" />
				<?= login_error($error) ?>
				<a href="#">Forgot your password?</a>
				<button>Sign In</button>
			</form>
		</div>
		<div class="overlay-container">	
			<div class="overlay">
				<div class="overlay-panel overlay-left">
					<h1>Already registered?</h1>
					<p>Login with your current account</p>
					<button class="ghost" id="signIn">Sign In</button>
				</div>
				<div class="overlay-panel overlay-right">
					<h1>Don't have an account yet?</h1>
					<p>Create a new account!</p>
					<button class="ghost" id="signUp">Sign Up</button>
				</div>
			</div>
		</div>
	</div>
</body>     
<script src="auth_page_animation.js"> </script>
</html>  
