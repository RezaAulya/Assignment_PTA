<?php // PARSING
    echo "<script>console.log( 'Debug Objects: " . $_SESSION['getId'] . "' );</script>";
    $get_id = $_SESSION['getId'];
	include 'includes/session_functions.php';
	include 'includes/db.php';
	
	$get_id = mysqli_real_escape_string($db, $get_id);
    $sql = "DELETE FROM mahasiswa WHERE mahasiswa.id = '$get_id';";
    $result = mysqli_query($db, $sql);
    $ambil = mysqli_fetch_array($result);
	header('Location: ../mahasiswa');
	exit;
?>
