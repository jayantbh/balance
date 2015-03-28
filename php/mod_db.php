<?php
	require_once 'init.php';
	if(isset($_POST["entry"])){
		$item = $_POST["entry"];
		$name = $_POST["name"];
		$transaction = $_POST["trans"];
		$query = "INSERT INTO transactions(name, item, transaction) VALUES ('".$name."','".$item."',$transaction)";
	}
	else{
		$name = $_POST["name"];
		$query = "DELETE FROM `transactions` WHERE name = '".$name."' ORDER BY date DESC LIMIT 1";
	}
	if(!mysqli_query($con,$query))
		echo "error";
?>