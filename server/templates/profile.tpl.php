<?php function drawProfile($user, $departments){ 

	$session = new Session();	
	$sessionUser = $session->getUser();
	$department = Department::getDepatmentByID($user->department);
?>
	<aside class="right-sidebar center">
	
		<section class="profile">
			<section id="profile-info" class="active">
				<img src=<?=$user->getPhoto()?> alt="Profile Picture" class="edit-profile-img">
				<h2 id="name-info"><?= $user->name ?></h2>
				<p id="email-info"><?= $user->email ?></p>
				<p id="role-info"><?= $user->role ?></p>
				<p id="department-info"><?= $department->name ?></p>
				<button class="button" id="edit-user-button">Edit</button>
			</section>
			<section id="edit-profile">
				<img src=<?=$user->getPhoto()?> alt="Profile Picture" class="edit-profile-img">
				<form action="../actions/editUser.action.php" method="post" class="active" enctype="multipart/form-data">
					<?php if ($sessionUser->id == $user->id) { ?><input type="file" name="image"> <?php } ?>
					<input type="hidden" name="id" value="<?=$user->id?>">
					<input type="hidden" name="csrf" value="<?=$session->token?>">
					<input id="name-editor" class="profile-editor" name="name">
					<input id="email-editor" class="profile-editor" name="email">
					<?php if ($sessionUser->role == "Admin") { ?>
					<select id="role-editor" class="profile-editor" name="role">
						<option <?php if ($user->role == "Client") echo "selected"?> id="Client" value="Client">Client</option>
						<option <?php if ($user->role == "Agent") echo "selected"?> id="Agent" value="Agent">Agent</option>
						<option <?php if ($user->role == "Admin") echo "selected"?>  id="Admin" value="Admin">Admin</option>	
					</select> 
					<select id="department-editor" class="profile-editor" name="department">
						<?php foreach($departments as $department) { ?>
						<option id="<?=$department->name?>" value="<?=$department->id?>"><?=$department->name?></option>
						<?php } ?>
					</select> 
					<?php } ?>
					<section class="edit-buttons">
						<button class="button" type="button" id="cancel-button">Cancel</button>
						<button class="button" id="submit-button">Save</button>
					</section>
				</form>
				<?php if ($sessionUser->id == $user->id) { ?>
				<form action="../actions/changePassword.action.php" id="password-editor" method="post">
					<input type="hidden" name="id" value="<?=$user->id?>">
					<input type="hidden" name="csrf" value="<?=$session->token?>">
					<label for="pwd">New Password</label>
					<input id="new-password" class="password profile-editor" name="pwd" type="password">
					<label for="confirm-pwd">Confirm Password</label>
					<input id="confirm-password" class="password profile-editor" name="confirm-pwd" type="password">
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