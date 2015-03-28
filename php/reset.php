<?php
	require_once 'init.php';
	$query = 'UPDATE `stats` SET `lastcleared`=NOW()';
	if(!mysqli_query($con,$query))
		die("<script>alert('Error clearing balance!')</script>");
	header("Location: ../");
?>