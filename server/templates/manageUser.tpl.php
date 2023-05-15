<?php function drawUserInfo($user){ 

	$session = new Session();	
?>
	<aside class="right-sidebar">
		<img src="../images/profile.png" alt="Profile Picture" class="profile-img">

		<section id="profile-info" class="active">
			<h2 id="name-info"><?= $user->name ?></h2>
			<p id="email-info"><?= $user->email ?></p>
			<p id="role-info"><?= $user->role ?></p>
			<button id="edit-user-button">Edit</button>
		</section>
		<form action="../action/editUser.action.php" id="edit-profile" method="post">
			<input id="name-editor" class="profile-editor" name="name">
			<input id="email-editor" class="profile-editor" name="email">

			<?php if ($session->user->id == $user->id) { ?>
			<input id="new-password" class="password profile-editor" name="pwd">
			<input id="confirm-password" class="password profile-editor" name="pwd">
			<?php } ?>
			<?php if ($session->user->role == "Admin") { ?>
			<select id="role-editor" class="profile-editor" name="role">
				<option id="Client" value="Client">Client</option>
				<option id="Agent" value="Agent">Agent</option>
				<option id="Admin" value="Admin">Admin</option>	
			</select> 
			<?php } ?>
			<section id="edit-buttons">
				<button type="button" id="cancel-button"> Cancel </button>
				<button id="submit-button"> Submit </button>
			</section>
		</form>
	</aside>

<?php } ?>