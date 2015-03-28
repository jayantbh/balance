<?php
	$con=mysqli_connect("localhost","jayantbh_flat","cyberom1","flatmate");
	if (mysqli_connect_errno()) {
		die("<script>alert(\"Database connection failed. Reload, try again later or inform jb@jayantbhawal.in.\");</script>");
	}
	date_default_timezone_set("Asia/Kolkata");
?>