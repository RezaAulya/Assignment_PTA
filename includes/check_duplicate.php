<?php
	include_once '../app_config.php';
		/*
			TODO LIST
		*session buat csrf/api key
		*hanya bisa diakses originnya host server
		*/
	
	function checkUser($lpUsername){
		$db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
		$username = mysqli_real_escape_string($db, $lpUsername);
		$query = "SELECT username FROM dosen WHERE username = '$username'";
		$result = mysqli_query($db, $query);
		$hasil = 0;
		
		$count = mysqli_num_rows($result);
		
		$hasil+=$count;
		$query = "SELECT username FROM mahasiswa WHERE username = '$username'";
		$result = mysqli_query($db, $query);
		$count = mysqli_num_rows($result);
		$hasil+=$count;
		return $hasil;
	}
	
	function checkEmail($lpEmail){
		$db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
		$email = mysqli_real_escape_string($db, $lpEmail);
		$query = "SELECT email FROM dosen WHERE email = '$email'";
		$result = mysqli_query($db, $query);
		$hasil = 0;
		
		$count = mysqli_num_rows($result);
		
		$hasil+=$count;
		$query = "SELECT email FROM mahasiswa WHERE email = '$email'";
		$result = mysqli_query($db, $query);
		$count = mysqli_num_rows($result);
		$hasil+=$count;
		return $hasil;
	}
	
	if(isset($_POST['username']) && isset($_POST['email'])){
		$result1 = checkUser($_POST['username']);
		$result2 = checkEmail($_POST['email']);
		if($result1 != 0 && $result2 == 0){
			echo 1;
		}elseif($result1 == 0 && $result2 != 0){
			echo 2;
		}elseif($result1 != 0 && $result2 != 0){
			echo 3;
		}else{
			echo -1;
		}
		
	}
?>