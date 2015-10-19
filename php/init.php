<?php
	$con=mysqli_connect("HOST_NAME","USER_NAME","PASSWORD","DB_NAME");
	if (mysqli_connect_errno()) {
		die("<script>alert(\"Database connection failed. Reload, try again later or inform jb@jayantbhawal.in.\");</script>");
	}
	date_default_timezone_set("Asia/Kolkata");
?>
