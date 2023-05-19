<?php function drawProfile($user){ 

	$session = new Session();	
	$sessionUser = $session->getUser();
?>
	<aside class="right-sidebar">
	
	<section class="profile">
		<section id="profile-info" class="active">
			<img src="../images/profile.png" alt="Profile Picture" class="edit-profile-img">
			<h2 id="name-info"><?= $user->name ?></h2>
			<p id="email-info"><?= $user->email ?></p>
			<p id="role-info"><?= $user->role ?></p>
			<button class="button" id="edit-user-button">Edit</button>
		</section>
		<section id="edit-profile">
		<img src="../images/profile.png" alt="Profile Picture" class="edit-profile-img">
			<form action="../actions/editUser.action.php" method="post" class="active">
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
				<section class="edit-buttons">
					<button class="button" type="button" id="cancel-button">Cancel</button>
					<button class="button" id="submit-button">Save</button>
				</section>
			</form>
			<?php if ($sessionUser->id == $user->id) { ?>
			<form action="../actions/changePassword.action.php" id="password-editor">
				<label for="pwd">New Password</label>
				<input id="new-password" class="password profile-editor" name="pwd">
				<label for="pwd">Confirm Password</label>
				<input id="confirm-password" class="password profile-editor" name="confirm-pwd">
				<section class="edit-buttons">
					<button class="button" type="button" id="cancel-password-button">cancel</button>
					<button class="button">Save</button>
				</section>
			</form>
			<button class="button active" type="button" id="change-password-button">Change Password</button>
			<?php } ?>
		</section>
	</section>
	</aside>

<?php } ?>