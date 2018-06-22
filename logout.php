<?
/**************************** LOGOUT FORWARDER *****************************/
	require_once "session.php";
	logout();
	exit (header ("Location: index.php")); 
?>