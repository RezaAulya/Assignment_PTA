<?php // PARSING
    //echo "<script>console.log( 'Debug Objects: " . $_SESSION['getId'] . "' );</script>";
    $get_id = $_SESSION['getId'];
	include 'includes/session_functions.php';
	include 'includes/db.php';
	
	$get_id = mysqli_real_escape_string($db, $get_id);
	$userid = mysqli_real_escape_string($db, $_SESSION['userid']);
	
    $sql = "DELETE FROM quiz_kategori WHERE quiz_kategori.id = '$get_id' AND quiz_kategori.dibuat_oleh = '$userid';"; //cuman yg buat soal yg bisa hapus
    $result = mysqli_query($db, $sql);
	
	$sql = "DELETE FROM tugasinfo WHERE tugas.tugasid = '$get_id';";
    $result = mysqli_query($db, $sql);
	header('Location: ../kategori');
	exit;
?>
