<?php
	
	include 'includes/session_functions.php';
	include 'includes/db.php';
	
	
	$userid = mysqli_real_escape_string($db, $_SESSION['userid']);
	if($_SERVER["REQUEST_METHOD"] == "POST"){
		$quizid = $_POST['quizid'];
		$sql = "SELECT end_date FROM quiz_start_mhs WHERE quizid = '$quizid' AND mahasiswaid = '$userid';";
		$ambil = mysqli_fetch_array(mysqli_query($db, $sql));
		
		$deadlineTime = strtotime($ambil['end_date']);
		$nowTime = strtotime(date("Y-m-d H:i:s"));
		if($deadlineTime < $nowTime){
			echo "true";
		}else{
			echo "false";
		}
	}
	
?>
