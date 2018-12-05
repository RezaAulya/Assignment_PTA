<?php
    echo "<script>console.log( 'Debug Objects: " . $_SESSION['getId'] . "' );</script>";
    $get_id = $_SESSION['getId'];
	include 'includes/session_functions.php';
	include 'includes/db.php';
	
	$get_id = mysqli_real_escape_string($db, $get_id);
	$userid = mysqli_real_escape_string($db, $_SESSION['userid']);
	
	$sql = "SELECT kelas_code, dibuat_oleh FROM kelas WHERE kelasid = '$get_id';";
	$result = mysqli_query($db, $sql);
	echo $result;
	
	if($result != ""){
		echo "<script>alert('xx');</script>";
	}else{
		$ambil = mysqli_fetch_array($result);
		$pengajarid = $ambil['dibuat_oleh'];
		$kode_kelas = $ambil['kelas_code'];
		$sql = "INSERT INTO kelasinfo (kelasid, mahasiswaid, pengajarid, kelas_kode) VALUES ('$get_id', '$userid', '$pengajarid', '$kode_kelas');";
		$result = mysqli_query($db, $sql);
		header('Location: ../');
		exit;
	}
    
?>
