<?php function drawUserInfo($user){ 

	$clientSelected = "";
	$agentSelected = "";
	$adminSelected = "";
	
	switch($user->role){
		case "Client":
			$clientSelected = "selected";
			break;
		case "Agent":
			$agentSelected = "selected";
			break;
		case "Admin":
			$adminSelected = "selected";
			break;

	}	
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
			<input id="name-editor" class="profile-editor" value="<?= $user->name?>">
			<input id="email-editor" class="profile-editor" value="<?= $user->email?>">
			<?php if ($user->role == "Admin") { ?>
			<select id="role-editor" class="profile-editor">
				<option selected="<?=$clientSelected?>" id="Client" value="Client">Client</option>
				<option selected="<?=$agentSelected?>" id="Agent" value="Agent">Agent</option>
				<option selected="<?=$adminSelected?>" id="Admin" value="Admin">Admin</option>	
			</select> 
			<?php } ?>
			<section id="edit-buttons">
				<button type="button" id="cancel-button"> Cancel </button>
				<button id="submit-button"> Submit </button>
			</section>
		</form>
	</aside>

<?php } ?>