<?php
	$role = $_SESSION['role'];
	switch ($role) {
		case 1:
		include 'includes/side_menu_admin.php';
		$_SESSION['rolename'] = "Administrator";
		break;
	case 2:
		include 'includes/side_menu_dosen.php';
		$_SESSION['rolename'] = "Dosen";
		break;
	case 3:
		include 'includes/side_menu_mhs.php';
		$_SESSION['rolename'] = "Mahasiswa";
		break;
	default:
		header("Location: ".$base_url."homepage");
  }
?>