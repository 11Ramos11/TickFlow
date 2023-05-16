<?php function drawProfile($user){ 

	$session = new Session();	
	$sessionUser = $session->getUser();
?>
	<aside class="right-sidebar">
	
		<section id="profile-info" class="active">
		<img src="../images/profile.png" alt="Profile Picture" class="edit-profile-img">
			<h2 id="name-info"><?= $user->name ?></h2>
			<p id="email-info"><?= $user->email ?></p>
			<p id="role-info"><?= $user->role ?></p>
			<button class="button" id="edit-user-button">Edit</button>
		</section>
		<section id="edit-profile">
		<img src="../images/profile.png" alt="Profile Picture" class="edit-profile-img">
			<form action="../actions/editUser.action.php" method="post">
				<input type="hidden" name="id" value="<?=$user->id?>">
				<input id="name-editor" class="profile-editor" name="name">
				<input id="email-editor" class="profile-editor" name="email">
				<?php if ($sessionUser->role == "Admin") { ?>
				<select id="role-editor" class="profile-editor" name="role">
					<option id="Client" value="Client">Client</option>
					<option id="Agent" value="Agent">Agent</option>
					<option id="Admin" value="Admin">Admin</option>	
				</select> 
				<?php } ?>
				
				<section id="edit-buttons">
					<button class="button" type="button" id="cancel-button">Cancel</button>
					<button class="button" id="submit-button">Save Changes</button>
				</section>
			</form>
			<?php if ($sessionUser->id == $user->id) { ?>
			<form action="../actions/changePassword.action.php" id="password-editor">
				<input id="new-password" class="password profile-editor" name="pwd">
				<input id="confirm-password" class="password profile-editor" name="pwd">
				<button class="button">Save Password</button>
			</form>
			<button class="button" type="button" id="change-password-button">Change Password</button>
			<?php } ?>
		</section>
	</aside>

<?php } ?>