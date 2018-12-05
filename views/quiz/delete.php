<?php
    echo "<script>console.log( 'Debug Objects: " . $_SESSION['getId'] . "' );</script>";
    $get_id = $_SESSION['getId'];
    
	include 'includes/session_functions.php';
	include 'includes/db.php';
	$userid = $_SESSION['userid'];
	$get_id = mysqli_real_escape_string($db, $get_id);
	
    $sql = "DELETE FROM quizinfo WHERE userid = '$userid' AND quizid = '$get_id';";
    $result = mysqli_query($db, $sql);
	$sql = "DELETE FROM quiz WHERE pengajarid = '$userid' AND quizid = '$get_id';";
    $result = mysqli_query($db, $sql);
    
	header('Location: ../');
	exit;
?>
