<?php

	include_once(__DIR__.'/../classes/session.class.php');
	include_once(__DIR__.'/../templates/common.tpl.php');
	include_once(__DIR__.'/../templates/admin.tpl.php');
	include_once(__DIR__.'/../templates/personnel.tpl.php');
	include_once(__DIR__.'/../templates/profile.tpl.php');
	include_once(__DIR__.'/../classes/department.class.php');
	include_once(__DIR__.'/../classes/priority.class.php');
	include_once(__DIR__.'/../classes/status.class.php');
	include_once(__DIR__.'/../classes/scripter.class.php');

	$session = new Session();

	if (!$session->isLoggedIn()){
		header("Location: authentication.php");
		exit();
	}

	if (!$session->isAdmin()){
		$session->setError("No perms", "You don't have permission to access that page.");
		header("Location: dashboard.php");
		exit();
	}
	
	$departments = Department::getDepartments();
	$statuses = Status::getStatuses();
	$priorities = Priority::getPriorities();

	$handlers = array(
        "admin.js", 
        "responsiveness.js", 
        "snackbar.js"
    );
    $scripter = new Scripter("admin.js", $handlers);

	drawHeader("admin", $scripter, "admin");
	drawAdmin($departments, $statuses, $priorities, $session);
	drawDeparmentBar($departments, $statuses);
	drawFooter();
?>