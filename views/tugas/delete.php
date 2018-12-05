<?php // PARSING
    //echo "<script>console.log( 'Debug Objects: " . $_SESSION['getId'] . "' );</script>";
    $get_id = $_SESSION['getId'];
	include 'includes/session_functions.php';
	include 'includes/db.php';
	
	$get_id = mysqli_real_escape_string($db, $get_id);
	$userid = mysqli_real_escape_string($db, $_SESSION['userid']);
	$query = "SELECT tugas.file_name, tugas.file_module FROM tugas WHERE tugas.tugasid = '$get_id' AND tugas.pengajarid = '$userid';"; //cuman yg buat soal yg bisa hapus

	$ambil = mysqli_fetch_array(mysqli_query($db, $query));

	if(file_exists("uploads/tugas/".$ambil['file_name'])){
		unlink("uploads/tugas/".$ambil['file_name']);
	}
	if(file_exists("uploads/tugas/".$ambil['file_module'])){
		unlink("uploads/tugas/".$ambil['file_module']);
	}
    $sql = "DELETE FROM tugas WHERE tugas.tugasid = '$get_id' AND tugas.pengajarid = '$userid';"; //cuman yg buat soal yg bisa hapus
    $result = mysqli_query($db, $sql);
	
	$sql = "DELETE FROM tugasinfo WHERE tugas.tugasid = '$get_id';";
    $result = mysqli_query($db, $sql);
	header('Location: ../tugas');
	exit;
?>
