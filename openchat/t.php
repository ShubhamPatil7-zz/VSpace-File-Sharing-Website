<?php
	require_once "..\const.php";
	$users = array();
	require_once '..\users.php';
	require_once "..\functions\error.php"; 

	if ( isset ($_SESSION[PASS_ATTR]) && isset ($_SESSION[USER_ATTR]) && isset ($users[$_SESSION[USER_ATTR]]) && $_SESSION[PASS_ATTR] == $users[$_SESSION[USER_ATTR]])
		header('location:index.php');
	else
		echo 'fuck you!';
?>