<?php function drawAuthentication($error, $success, $session){ ?>

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
				<button>Sign Up</button>
				<input type="hidden" name="csrf" value="<?=$session->token?>">
			</form>
		</div>
		<div class="form-container sign-in-container">
			<form action="../actions/login.action.php" method="post">
				<h1>Sign in</h1>
				<input type="email" name="email" placeholder="Email" />
				<input type="password" name="pwd" placeholder="Password" />
				<button>Sign In</button>
				<input type="hidden" name="csrf" value="<?=$session->token?>">
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
	</div>
	<?php if ($error != null) { ?>
		<div class="snack-bar" id="error" data-code=<?=$error->code?> > <?= $error->msg ?> </div>
	<?php } ?>
	<?php if ($success != null) { ?>
		<div class="snack-bar" id="success" data-code=<?=$success->code?> > <?= $success->msg ?> </div>
	<?php } ?>
</body>     
</html>  

<?php } ?>