<?php
    echo "<script>console.log( 'Debug Objects: " . $_SESSION['getId'] . "' );</script>";
    $get_id = $_SESSION['getId'];
	include 'includes/session_functions.php';
	include 'includes/db.php';
    
    // 1
	$get_id = mysqli_real_escape_string($db, $get_id);
    $sql = "DELETE FROM kelas WHERE kelas.kelasid = '$get_id';";
    $result = mysqli_query($db, $sql);
    $ambil = mysqli_fetch_array($result);

    // 2
    $sql = "DELETE FROM kelasinfo WHERE kelasinfo.kelasid = '$get_id';";
    $result = mysqli_query($db, $sql);
    $ambil = mysqli_fetch_array($result);


	header('Location: ../kelas');
	exit;
?>
