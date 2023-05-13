<?php function drawAuthentication($error){ ?>

<html>  
<head>  
    <title>PHP login system</title>  
    <link rel = "stylesheet" type = "text/css" href ="../styles/auth_style.css">   
    <script src="../scripts/authentication_animation.js"> </script>
</head>  
<body>  
	<div class="container" id="container">
		<div class="form-container sign-up-container">
			<form action="../actions/register.action.php" method="post">
				<h1>Create Account</h1>
				<input type="text" name="name" placeholder="Name"/>
				<input type="email" name="email" placeholder="Email" />
				<input type="password" name="pwd" placeholder="Password" />
				<?php if ($error != null) $error->draw("reg"); ?>
				<button>Sign Up</button>
			</form>
		</div>
		<div class="form-container sign-in-container">
			<form action="../actions/login.action.php" method="post">
				<h1>Sign in</h1>
				<input type="email" name="email" placeholder="Email" />
				<input type="password" name="pwd" placeholder="Password" />
				<?php if ($error != null) $error->draw("log"); ?>
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
</html>  

<?php } ?>