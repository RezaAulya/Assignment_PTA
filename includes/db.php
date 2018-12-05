<?php
	date_default_timezone_set("Asia/Jakarta");	
	include_once('app_config.php');
	
	$db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE) OR die("Something went wrong with db connection :(");
	
	
?>