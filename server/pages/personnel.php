<?php
    include_once(__DIR__.'/../classes/session.class.php');
    include_once(__DIR__.'/../classes/user.class.php');
    include_once(__DIR__.'/../classes/department.class.php');
    include_once(__DIR__.'/../classes/status.class.php');
    include_once(__DIR__.'/../templates/personnel.tpl.php');
    include_once(__DIR__.'/../templates/common.tpl.php');


	$session = new Session();

	if (!$session->isLoggedIn()){
		header("Location: authentication.php");
		exit();
	}

    $admins = User::getAdmins();

    $agents = User::getAgents();

    $clients = User::getClients();

    $departments = Department::getDepartments();

    $statuses = Status::getStatuses();

    drawHeader("personnel");
    drawPersonnel($admins, $agents, $clients);
    drawDeparmentBar($departments, $statuses);
    drawFooter();
?>