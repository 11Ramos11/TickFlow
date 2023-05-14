<?php
    include_once(__DIR__.'/../classes/session.class.php');
    include_once(__DIR__.'/../classes/user.class.php');
    include_once(__DIR__.'/../templates/personnel.tpl.php');
    include_once(__DIR__.'/../templates/common.tpl.php');

	$session = new Session();

	if (!$session->isLoggedIn()){
		header("Location: authentication.php");
		exit();
	}

    $users = User::getAllUsers();

    $admins = array_filter($users, function($user){
        return $user->isAdmin();
    });

    $agents = array_filter($users, function($user){
        return $user->isAgent();
    });

    $clients = array_filter($users, function($user){
        return $user->isClient();
    });

    drawHeader("personnel");
    drawPersonnel($admins, $agents, $clients);
    drawFooter();
?>