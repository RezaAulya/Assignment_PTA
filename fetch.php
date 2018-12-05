<?php
    include 'app_config.php';
    include 'includes/session_functions.php';
    include 'includes/db.php';
?>

<?php
$id = $_SESSION['userid'];

if(isset($_POST['view'])){
    
    // ----
    $sql = "";						
    if($_SESSION['role'] == 2){
        $sql = "SELECT mahasiswa.nama_lengkap as dari, notif_dosen.notif_msg, notif_dosen.notif_date, kelas.kelas_nama, notif_dosen.kelasid FROM notif_dosen JOIN mahasiswa ON notif_dosen.userid_from = mahasiswa.id JOIN kelas ON notif_dosen.kelasid = kelas.kelasid WHERE notif_dosen.userid_to = '$id' ORDER BY notif_dosen.notif_date DESC;";
    }elseif($_SESSION['role'] == 3){
        $sql = "SELECT dosen.nama_lengkap as dari, notif_mhs.notif_msg, notif_mhs.notif_date, kelas.kelas_nama, notif_mhs.kelasid FROM notif_mhs JOIN dosen ON notif_mhs.userid_from = dosen.id JOIN kelas ON notif_mhs.kelasid = kelas.kelasid WHERE notif_mhs.userid_to = '$id' ORDER BY notif_mhs.notif_date DESC;";
    }elseif($_SESSION['role'] == 1){
        $sql = "SELECT dosen.nama_lengkap as dari, notif_mhs.notif_msg, notif_mhs.notif_date, kelas.kelas_nama, notif_mhs.kelasid FROM notif_mhs JOIN dosen ON notif_mhs.userid_from = dosen.id JOIN kelas ON notif_mhs.kelasid = kelas.kelasid WHERE notif_mhs.userid_to = '$id' ORDER BY notif_mhs.notif_date DESC;";
    }
    $result = mysqli_query($db, $sql);
    $output = '<li><ul class="menu">';
    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_array($result)) {
            $link = "";
            if($_SESSION['role'] == 2){
                $link = $base_url.'kelas-view/'.$row['kelasid'];
            }elseif($_SESSION['role'] == 3){
                $link = $base_url.'mhs/kelas/view/'.$row['kelasid'];
            }
            // short time
            $timestamp = strtotime($row['notif_date']);
            $dateNotif = date('H:i', $timestamp);
            // text limit 
            if (strlen($row['notif_msg']) > 45){$row['notif_msg'] = substr($row['notif_msg'], 0,20) . ' ...';}
            $output .= '
                        <li>
                            <a href="'.$link.'">
                                <div class="pull-left">
                                    <img class="img-circle" src="'.$base_url.'uploads/images/site.png">
                                </div>
                                <h4>'.$row['dari'].'
                                    <small>
                                        <i class="fa fa-clock-o"></i> 
                                    '.$dateNotif.' </small>
                                </h4><p>'.$row['notif_msg'].'</p>
                            </a>
                        </li>';
        }
        $output .= '</ul>
                    </li>
                    
                <li class="footer">
                    <a href="#"><center>Show All Notification</center></a>
                </li>';

    }else{
            $output .= '
            <li><a href="#" class="text-bold text-italic">No Notif Found</a></li>';
        }

        

    // Counting
    $sql = "";						
    if($_SESSION['role'] == 2){
        $status_query = "SELECT * FROM notif_dosen WHERE userid_to ='$id' AND status= 0";
    }elseif($_SESSION['role'] == 3){
        $status_query = "SELECT * FROM notif_mhs WHERE userid_to ='$id' AND status= 0";
    }elseif($_SESSION['role'] == 1){
        $sql = "SELECT dosen.nama_lengkap as dari, notif_mhs.notif_msg, notif_mhs.notif_date, kelas.kelas_nama, notif_mhs.kelasid FROM notif_mhs JOIN dosen ON notif_mhs.userid_from = dosen.id JOIN kelas ON notif_mhs.kelasid = kelas.kelasid WHERE notif_mhs.userid_to = '$userid' ORDER BY notif_mhs.notif_date DESC;";
    }

    $result_query = mysqli_query($db, $status_query);
    $count = mysqli_num_rows($result_query);
    $data = array(
        'notification' => $output,
        'unseen_notification'  => $count
    );

    echo json_encode($data);

}
?>