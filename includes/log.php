<?php
	include 'includes/db.php';

		/*
			TODO LIST
		*session buat csrf/api key
		*hanya bisa diakses originnya host server
		*/
	
	function addLog($lpUsername){
		$username = mysqli_real_escape_string($db, $lpUsername);
		$query = "SELECT users.username FROM users WHERE users.username = '$username'";
		$result = mysqli_query($db, $query);
		
		$count = mysqli_num_rows($result);
		if($count == 1){
			return true;
		}else{
			return false;
		}
	}
	
	function checkEmail($lpEmail){
		$email = mysqli_real_escape_string($db, $lpEmail);
		$query = "SELECT users.email FROM users WHERE users.email = '$email'";
		$result = mysqli_query($db, $query);
		
		$count = mysqli_num_rows($result);
		if($count == 1){
			return true;
		}else{
			return false;
		}
	}
	
	if(isset($_POST['username']) || isset($_POST['email'])){
		if(isset($_POST['username'])){
			echo checkUser($_POST['username']);
		}
		if(isset($_POST['email'])){
			echo checkEmail($_POST['email']);
		}
	}
?>