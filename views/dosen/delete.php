<?php // PARSING
    echo "<script>console.log( 'Debug Objects: " . $_SESSION['getId'] . "' );</script>";
    $get_id = $_SESSION['getId'];
	include 'includes/session_functions.php';
	include 'includes/role.php';
	
	if($role == 1){
		include 'includes/db.php';
		
		$get_id = mysqli_real_escape_string($db, $get_id);
		$sql = "DELETE FROM dosen WHERE dosen.id = '$get_id';";
		$result = mysqli_query($db, $sql);
		
		header('Location: ../dosen');
		exit;
	}else{
		header('Location: ../logout');
		exit;
	}
?>
