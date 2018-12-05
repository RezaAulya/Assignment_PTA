<?php

include 'app_config.php';
include 'includes/session_functions.php';
include 'includes/db.php';
$id = $_SESSION['userid'];
$update_query = "";
$role = $_SESSION['role'];
if($role == 2){
    $update_query = "UPDATE notif_dosen SET status = 1 WHERE userid_to='$id';"; 
}else{
    $update_query = "UPDATE notif_mhs SET status = 1 WHERE userid_to='$id';"; 
}
mysqli_query($db, $update_query);
?>