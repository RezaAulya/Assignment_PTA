<!-- 
@TODO  
-->
<?php // PARSING 
	ob_start();
    include 'app_config.php';
	include 'includes/session_functions.php';
	include 'includes/page_asset.php';
	include 'includes/db.php';
    $form_name ="Join Kelas";
	$msg = "";
	$kelasid = "";
	if($_SERVER["REQUEST_METHOD"] == "POST"){
		if(isset($_POST['kode_kelas'])){
			$id = mysqli_real_escape_string($db, $_SESSION['userid']);
			$kode_kelas = mysqli_real_escape_string($db, $_POST['kode_kelas']);
			
			$sql = "SELECT kelasid FROM kelasinfo WHERE kelasinfo.mahasiswaid = '$id' AND kelasinfo.kelas_kode = '$kode_kelas';";
			
			$result = mysqli_query($db, $sql);
			$count = mysqli_num_rows($result);
			
			if($count == 0){
				$sql = "SELECT kelasid, dibuat_oleh, kelas_nama FROM kelas WHERE kelas_code = '$kode_kelas';";
				$result = mysqli_query($db, $sql);
				$ada = mysqli_num_rows($result);
				if($ada != 0){
					$ambil = mysqli_fetch_array($result);
				
					$pengajarid = $ambil['dibuat_oleh'];
					$kelasid = $ambil['kelasid'];
					$kelas_nama = $ambil['kelas_nama'];
					
	
					//Insert Join Kelas
					$sql = "INSERT INTO kelasinfo (kelasid, mahasiswaid, pengajarid, kelas_kode) VALUES ('$kelasid', '$id', '$pengajarid', '$kode_kelas');";
					$result = mysqli_query($db, $sql);
					
					//Check Tugas Aktif di kelas yang dipilih
					//tugasid
					$sql = "SELECT tugasid, deadline FROM tugasinfo WHERE kelasid = '$kelasid' GROUP BY tugasid;";
					$result = mysqli_query($db, $sql);
					
					while ($row = mysqli_fetch_array($result)){
						$deadline = $row['deadline'];
						$tugasid = $row['tugasid'];
						$x = "INSERT INTO tugasinfo (tugasid, kelasid, userid, deadline, path_jawaban) VALUES ('$tugasid', '$kelasid', '$id', '$deadline', NULL);";
						mysqli_query($db, $x);
						$dd = date("d M Y H:i:s", strtotime($deadline));
						$linktugas ='<a href="' . $base_url .'mhs/tugas/">';					
						$notif = "INSERT INTO notif_mhs (notif_msg, userid_from, userid_to, kelasid) VALUES (' mengirimkan tugas $linktugas <b> $nama_tugas </b></a> dengan batas waktu pengumpulan $dd, '$pengajarid', '$id', '$kelasid');";
						mysqli_query($db, $notif);
					}
					//Check Quiz Aktif di kelas yang dipilih
					//quizid
					$sql = "SELECT * FROM quiz_start WHERE kelasid = '$kelasid' AND end_date > CURRENT_DATE";
					$result = mysqli_query($db, $sql);
					while ($row = mysqli_fetch_array($result)){
						$qId = $row['quizid'];
						$sql = "SELECT infoid FROM quizinfo WHERE quizid = '$qId';";
						$result = mysqli_query($db, $sql);
						while($dataInfo = mysqli_fetch_array($result)){
							$infoid = $dataInfo['infoid'];
							$k = "INSERT INTO quiz_temp (id, mahasiswaid, idsoal, jawaban) VALUES (NULL, '$id', '$infoid', NULL);";
							$j = mysqli_query($db, $k);
						}
						$dd = date("d M Y H:i:s", strtotime($row['end_date']));
						$notif = "INSERT INTO notif_mhs (notif_msg, userid_from, userid_to, kelasid) VALUES (' mengadakan Quiz, dengan deadline <b> $dd </b>', '$pengajarid', '$id', '$kelasid');";
						mysqli_query($db, $notif);
					}
					
					$notif = "INSERT INTO notif_dosen (notif_msg, userid_from, userid_to, kelasid) VALUES (' Telah Bergabung di Kelas ', '$id', '$pengajarid', '$kelasid');";
					mysqli_query($db, $notif);
					
					$msg = "Sukses Join Kelas [".$kode_kelas."] ".$kelas_nama;
					echo "<script>alert('$msg');</script>";
					header("Location: ".$base_url."mhs/kelas/view/".$kelasid);
					exit;
				}else{
					$msg = "Kode kelas tidak valid";
				}
				
			}else{
				$msg = "Anda sudah join kelas ini.";
			}
		}
	}
	if($msg != ""){
		echo "<script>alert('$msg');</script>";
		//header("Location: ".$base_url."mhs/kelas/view/".$kelasid);
		
	}
?>

<!-- TITLE -->
<title> <?=$form_name?> </title>

<!-- ADDITIONAL ASSETS BELOW (Optional) -->

<?php // END OF ASSETS
  include 'includes/page_header.php'; // </head>
  include 'includes/page_topbar.php'; // TOPBAR

//  USER ROLE
  include 'includes/role.php';
  
?>

<aside class="right-side">
    <section class="content">
        <div class="row">
            <div class="col-xs-12">

                <!-- box-header -->
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">
                            <i class="fa icon-teacher"></i>
                            <?=$form_name?>
                        </h3>


                        <ol class="breadcrumb">
                            <li>
                                <a href="<?= $base_url . 'dashboard' ?>">
                                    <i class="fa fa-laptop"></i> Dashboard</a>
                            </li>
                            <li>
                                <a href="<?= $base_url . 'quiz/kategori' ?>">Kategori</a>
                            </li>
                            <li class="active">
                                <?= $form_name?>
                            </li>
                        </ol>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <form class="form-horizontal" role="form" method="post">
                                    <div class='form-group'>
                                        <label for="kode_kelas" class="col-sm-2 control-label">
                                            Kode Kelas
                                            <span class="text-red">*</span>
                                        </label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="kode_kelas" name="kode_kelas" placeholder="Masukkan Kode Kelas dari dosen kamu disni" required>
                                        </div>
                                        <span class="col-sm-4 control-label">
                                        </span>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-sm-offset-2 col-sm-8">
                                            <input type="submit" class="btn btn-success" value="Join Kelas">
                                        </div>
                                    </div>
                                </form>
                            <!-- col-sm-12 -->
                        </div>
                        <!-- row -->
                    </div>
                    <!-- Body -->
                </div>
                <!-- /.box -->

            </div>
        </div>
    </section>
</aside>



<?php 
    include 'includes/page_footer.php';
?>