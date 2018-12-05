<?php
	$get_id = $_SESSION['getId'];
	include 'includes/session_functions.php';
	include 'includes/db.php';
	
	$get_id = mysqli_real_escape_string($db, $get_id);
    $sql = "DELETE FROM quizinfo WHERE quizinfo.infoid = '$get_id';";
    $result = mysqli_query($db, $sql);
    $ambil = mysqli_fetch_array($result);
	header('Location: '.$_SESSION['back']);
	unset($_SESSION['back']);
	exit;


?>