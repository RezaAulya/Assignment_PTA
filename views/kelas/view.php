<!-- 
@TODO aksi button kirim tugas : input data ke tbl_tugas dan aktifitas kelas (selected)
-->

<?php // PARSING 
error_reporting(0);
    $get_id = $_SESSION['getId'];
    include 'app_config.php';
	include 'includes/session_functions.php';
	include 'includes/page_asset.php';
    include 'includes/db.php';

    $get_id = mysqli_real_escape_string($db, $get_id);
	//SEND Data
	$msg = '';
	if($_SERVER["REQUEST_METHOD"] == "POST"){
		if(isset($_FILES['tugasfile'])){
			if(empty($_FILES['tugasfile']['name'])==false){
				$nama_tugas = mysqli_real_escape_string($db, $_POST['judul_tugas']);
				$deskripsi = mysqli_real_escape_string($db, $_POST['deskripsi_tugas']);
				$errors = array();
				$file_name = $_FILES['tugasfile']['name'];
				$tampungFileName = explode('.', $file_name);
				
				$file_ext = strtolower($tampungFileName[(count($tampungFileName)-1)]);
				$tugas_name = md5($file_name.$nama_tugas).$id.'.'.$file_ext;
				$file_size = $_FILES['tugasfile']['size'];
				$file_tmp = $_FILES['tugasfile']['tmp_name'];
				$file_type = $_FILES['tugasfile']['type'];
				$filepath = mysqli_real_escape_string($db, "uploads/tugas/".$tugas_name);
				$expensions= array("doc", "docx", "pdf", "png", "jpg", "xlsx","ppt","pptx", "zip", "rar");
				
				if(in_array($file_ext,$expensions)=== false){
					$msg ="File yang anda masukkan tidak valid.";
					exit;
				}
				
				if(empty($msg)==true){
					if(file_exists("uploads/tugas/".$tugas_name)){ unlink("uploads/tugas/".$tugas_name);}
 					move_uploaded_file($file_tmp, "uploads/tugas/".$tugas_name);
					
					$userid = $_SESSION['userid'];
					$sql = "INSERT INTO tugas (tugasid, nama_tugas, deskripsi, file_name, pengajarid) VALUES (NULL, '$nama_tugas', '$deskripsi', '$tugas_name', '$userid');";
					
					$result = mysqli_query($db, $sql);
					
					//tugasid
					$sql = "SELECT tugasid FROM tugas WHERE nama_tugas = '$nama_tugas' AND file_name = '$tugas_name' AND pengajarid = '$userid' AND deskripsi = '$deskripsi';";
					$result = mysqli_query($db, $sql);
					$ambil = mysqli_fetch_array($result);
					$tugasid = $ambil['tugasid'];
					
					//deadline
					$tgl = $_POST['tbp'];
					$jam = $_POST['jbp'];
					$jamDeadline = '';
					$tampungJam = explode(':', $jam);
					if(strlen($tampungJam[0]) == 1){
						$jamDeadline = ' 0'.$tampungJam[0].':'.$tampungJam[1].':00';
					}else{
						$jamDeadline = ' '.$tampungJam[0].':'.$tampungJam[1].':00';
					}
					$deadline = $tgl.$jamDeadline;
					
					//mahasiswa kelas
					$qry = "SELECT mahasiswaid FROM kelasinfo WHERE kelasid = '$get_id';";
					
					$r = mysqli_query($db, $qry);
					while($row = mysqli_fetch_array($r)){
						$mhsId = $row['mahasiswaid'];
						$x = "INSERT INTO tugasinfo (tugasid, kelasid, userid, deadline, path_jawaban) VALUES ('$tugasid', '$get_id', '$mhsId', '$deadline', NULL);";
						
						mysqli_query($db, $x);
						$dTimestamp = strtotime($deadline);
                        $dDate = date('d M Y ', $dTimestamp);
                        $sPce =' Jam ';
                        $dJam = date('H:i', $dTimestamp);
                        $dGabung = $dDate . $sPce . $dJam;
						$notif = "INSERT INTO notif_mhs (notif_msg, userid_from, userid_to, kelasid) VALUES (' mengirimkan tugas  <b> $nama_tugas </b> dengan deadline <b> $dGabung </b> ', '$userid', '$mhsId', '$get_id');";
						
						mysqli_query($db, $notif);
						
					}
					$msg = 'Tugas Berhasil dibuat.';
				}
			}
		}
	}
	
    $sql = "SELECT kelas.kelas_nama, kelas.kelas_code FROM kelas WHERE kelas.kelasid = '$get_id';";
    $result = mysqli_query($db, $sql);
    $ambil = mysqli_fetch_array($result);
    
    $get_nama_kelas =  $ambil['kelas_nama'];
    $get_kode_kelas =  $ambil['kelas_code'];
    $form_name = 'Kelas ' . $get_nama_kelas . ' - <b>(' . $get_kode_kelas . ')</b>';
    $form_title = 'Kelas | ' . $get_nama_kelas ;
?>

<!-- TITLE -->
<title>
    <?=$form_title?>
</title>
<!-- ADDITIONAL ASSETS BELOW (Optional) -->
<link type="text/css" rel="stylesheet" href="<?php echo $base_url . 'assets/BACKEND/datepicker/datepicker.css '?>">
<script type="text/javascript" src="<?php echo $base_url . 'assets/BACKEND/datepicker/datepicker.js' ?>"></script>
<link rel="stylesheet" href="<?php echo $base_url . 'assets/BACKEND/timepicker/timepicker.css' ?>">
<script type="text/javascript" src="<?php echo $base_url . 'assets/BACKEND/timepicker/timepicker.js' ?>"></script>

<link rel="stylesheet" href="<?php echo $base_url . 'assets/BACKEND/select2/css/select2.css' ?>">
<link rel="stylesheet" href="<?php echo $base_url . 'assets/BACKEND/select2/css/select2-bootstrap.css' ?>">
<link rel="stylesheet" href="<?php echo $base_url . 'assets/activity.css' ?>">
<script type="text/javascript" src="<?php echo $base_url . 'assets/BACKEND/select2/select2.js' ?>"></script>


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
                                <a href="<?= $base_url . 'kelas' ?>">Kelola Kelas</a>
                            </li>
                            <li class="active">
                                <?= $form_name?>
                            </li>
                        </ol>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <div class="box-body">
                        <div>
                            <label for="error" class="col-sm-12 control-label">
                                <?php if (!empty($msg)) { ?>
                                <script>
                                    $(document).ready(function () {
                                        toastr.success('<?= $msg ?>');
                                    });
                                </script>
                                <?php } ?>
                            </label>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="nav-tabs-custom">
                                    <ul class="nav nav-tabs">
                                        <li class="active">
                                            <a data-toggle="tab" href="#tab1" aria-expanded="true">Aktifitas Kelas</a>
                                        </li>
                                        <li class="">
                                            <a data-toggle="tab" href="#tab2" aria-expanded="false">Tugas</a>
                                        </li>
                                        <li class="">
                                            <a data-toggle="tab" href="#tab3" aria-expanded="false">Quiz</a>
                                        </li>
                                        <li class="">
                                            <a data-toggle="tab" href="#tab4" aria-expanded="true">Anggota Kelas</a>
                                        </li>
                                    </ul>


                                    <!-- TAB CONTENT -->
                                    <div class="tab-content">
                                        <!-- TAB1 -->
                                        <div id="tab1" class="tab-pane active">
                                            <div class="form-horizontal">
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <hr>
                                                        <h3 class="box-title text-black">
                                                            Aktifitas Terbaru
                                                        </h3>
                                                        <hr>
                                                        <!-- LOOPING DATA BEGIN HERE  -->
                                                        <?php
                                                            include 'includes/db.php';

                                                            // FROM MHS
                                                            $sql = "SELECT notif_dosen.notif_date, mahasiswa.nama_lengkap as dari, mahasiswa.id as idMhs, mahasiswa.username as potoMhs, notif_dosen.notif_msg FROM notif_dosen JOIN mahasiswa ON notif_dosen.userid_from = mahasiswa.id WHERE notif_dosen.kelasid = '$get_id'  ORDER BY notif_dosen.notif_date DESC LIMIT 10;";
                                                            $counter = 0;
                                                            $expensions= array("jpeg", "jpg", "png", "gif");                                                            
                                                            $result = mysqli_query($db, $sql); 
                                                            echo '<h4>DARI MAHASISWA</h4><br>';                                                                                                                
                                                            while ($row = mysqli_fetch_array($result)){
                                                                $photoPath = $base_url.'uploads/images/default.png';
                                                                for($i = 0; $i<count($expensions); $i++){
                                                                    if(file_exists('uploads/users/'.md5($row["potoMhs"]).$row["idMhs"].'.'.$expensions[$i])){
                                                                        $photoPath = $base_url.'uploads/users/'.md5($row["potoMhs"]).$row["idMhs"].'.'.$expensions[$i];
                                                                    }
                                                                    //break;
                                                                }
                                                               
                                                                $timeStamp = $row['notif_date'];
                                                                $timeStamp = date( "m/d/Y", strtotime($timeStamp));
                                                                $jamStamp = $row['notif_date'];                                                                
                                                                $jamStamp = date( "H:i", strtotime($jamStamp));
                                                                

                                                                echo '<ul class="cbp_tmtimeline">
                                                                        <li>
                                                                            <time class="cbp_tmtime" datetime=""><span>'.$jamStamp.'</span> <span>'.$timeStamp.'</span></time>
                                                                            <div class="cbp_tmicon bg-info"> <img class="img-circle" src="' . $photoPath . '" alt="User Image"></div>
                                                                            <div class="cbp_tmlabel">
                                                                                <h2><a href="javascript:void(0);">'.$row ['dari'].'</a></h2>
                                                                                <p>' . $row['notif_msg'] . '</p>
                                                                            </div>
                                                                        </li>
                                                                    </ul>  
                                                                ';

                                                                $counter++;
                                                            } if($counter ==0){echo '<br>Tidak ada Aktifitas.<br><br><br><br>';}

                                                            echo '<hr>';

                                                            // FROM DOSEN
                                                            $sql2 = "SELECT dosen.nama_lengkap as dari, dosen.id as idDosen, dosen.username as potoDosen, notif_mhs.notif_msg, notif_mhs.notif_date FROM notif_mhs JOIN dosen ON notif_mhs.userid_from = dosen.id JOIN kelas ON notif_mhs.kelasid = kelas.kelasid WHERE notif_mhs.kelasid = '$get_id' ORDER BY notif_mhs.notif_date DESC LIMIT 10;";
                                                            $counter = 0;                                                                    
                                                            $expensions= array("jpeg", "jpg", "png", "gif");                                                                    
                                                            $result = mysqli_query($db, $sql2);    
                                                            echo '<h4>DARI DOSEN</h4><br>';
                                                            while ($row = mysqli_fetch_array($result)){
                                                                $photoPath = $base_url.'uploads/images/default.png';
                                                                for($i = 0; $i < count($expensions); $i++){
                                                                    if(file_exists('uploads/users/'.md5($row["potoDosen"]).$row["idDosen"].'.'.$expensions[$i])){
                                                                        $photoPath = $base_url.'uploads/users/'.md5($row["potoDosen"]).$row["idDosen"].'.'.$expensions[$i];
                                                                    }
                                                                    // break;
                                                                }
                                                                $dari = $row['dari'];
                                                                if($dari == $_SESSION['nama_lengkap']){
                                                                    $dari = $_SESSION['nama_lengkap'] . ' (saya)';
                                                                }
                                                                $timeStamp = $row['notif_date'];
                                                                $timeStamp = date( "m/d/Y", strtotime($timeStamp));
                                                                $jamStamp = $row['notif_date'];                                                                
                                                                $jamStamp = date( "H:i", strtotime($jamStamp));
                                                                
                                                                echo '<ul class="cbp_tmtimeline">
                                                                        <li>
                                                                            <time class="cbp_tmtime" datetime=""><span>'.$jamStamp.'</span> <span>'.$timeStamp.'</span></time>
                                                                            <div class="cbp_tmicon bg-info"> <img class="img-circle" src="' . $photoPath . '" alt="User Image"></div>
                                                                            <div class="cbp_tmlabel">
                                                                                <h2><a href="javascript:void(0);">'.$dari.'</a></h2>
                                                                                <p>' . $row['notif_msg'] . '</p>
                                                                            </div>
                                                                        </li>
                                                                    </ul>  
                                                                ';


                                                                $counter++;
                                                            } if($counter ==0){echo '<br>Tidak ada Aktifitas.<br><br><br><br>';}
                                                            
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- TAB2 -->
                                        <div id="tab2" class="tab-pane">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <hr>
                                                    <h3 class="box-title text-black">
                                                        Daftar Tugas -
                                                        <?= $get_nama_kelas ?>
                                                    </h3>
                                                    <hr>
                                                    <?php 
                                                        $qGetDaftarTugas = "SELECT COUNT(tugasinfo.kelasid) AS CEK FROM tugasinfo WHERE tugasinfo.kelasid ='$get_id' ;";
                                                        $rGetDaftarTugas = mysqli_query($db, $qGetDaftarTugas);
                                                        $aGetDaftarTugas = mysqli_fetch_array($rGetDaftarTugas);
                                                        $cekTotalTugas = '';
                                                        // cEk
                                                        if(strpos($aGetDaftarTugas['CEK'], '0') !== false){
                                                            $cekTotalTugas = 'hidden';
                                                            echo 'Kelas ' . $get_nama_kelas . ' <b>belum memiliki tugas</b> apapun !';
                                                        }
                                                    ?>
                                                    <div id="hide-table">
                                                        <table class="table table-striped table-bordered table-hover dataTable no-footer <?= $cekTotalTugas  ?>">
                                                            <thead>
                                                                <tr>
                                                                    <th>#</th>
                                                                    <th>Judul Tugas</th>
                                                                    <th>Deskripsi Tugas</th>
                                                                    <th>Deadline</th>
                                                                    <th>File</th>
                                                                    <th>Action</th>
                                                                </tr>
                                                            </thead>

                                                            <tbody>
                                                                <?php
                                                                    include 'includes/db.php';
                                                                    $id = mysqli_real_escape_string($db, $_SESSION['userid']);
                                                                    // QUERY Here !!
                                                                    $sql = "SELECT tugas.tugasid, tugas.nama_tugas, tugas.deskripsi, tugas.file_name, IFNULL(tugasinfo.deadline, '-') AS deadline, IFNULL(kelas.kelas_nama, '-') AS kelas_nama FROM tugas LEFT JOIN tugasinfo ON tugas.tugasid = tugasinfo.tugasid LEFT JOIN kelas ON tugasinfo.kelasid = kelas.kelasid WHERE tugasinfo.kelasid = '$get_id' GROUP BY tugas.tugasid;";
                                                                    $x = 1;
                                                                    $confirm ="Apakah Kamu yakin ingin menghapus data ini?";
                                                                    $result = mysqli_query($db, $sql);
                                                                    while ($row = mysqli_fetch_array($result)){
                                                                        $tugasId = $row['tugasid'];

                                                                        // QUERY  
                                                                        $queryHitungSudahMenyelesaikanTugas = "SELECT COUNT(tugasinfo.path_jawaban) AS YangSudah, COUNT(tugasinfo.tugasid) AS totalMhs FROM tugasinfo WHERE tugasinfo.tugasid='$tugasId'";
                                                                        $resultSudahMenyelesaikanTugas = mysqli_query($db, $queryHitungSudahMenyelesaikanTugas);
                                                                        $ambilResultSudahMenyelesaikanTugas = mysqli_fetch_array($resultSudahMenyelesaikanTugas);
                                                                        $ARSMT1 = $ambilResultSudahMenyelesaikanTugas['YangSudah'];
                                                                        $ARSMT2 = $ambilResultSudahMenyelesaikanTugas['totalMhs'];
                                                                        
                                                                        echo 
                                                                        "<tr>
                                                                            <td>".$x++ ."</td>
                                                                            <td>".$row['nama_tugas']."</td>
                                                                            <td>".$row['deskripsi']."</td>                                                                
                                                                            <td>".$row['deadline']."</td>                                                                
                                                                            <td data-title='File'>
                                                                                <a href='".$base_url."uploads/tugas/".$row['file_name']."' class='btn btn-success btn-xs mrg' data-placement='top' data-toggle='tooltip'
                                                                                    data-original-title='Download'>Download File</a>
                                                                            </td>
                                                                        
                                                                            <td>
                                                                                <a href='" . $base_url . "/tugas-view/" . $row["tugasid"] . "' target='_blank' class='btn btn-success btn-xs mrg' data-placement='top' 
                                                                                    data-toggle='tooltip' data-original-title='Lihat Yang Sudah Mengumpulkan Tugas'><i class='fa fa-check-square-o'></i>&#160;&#160;(" . $ARSMT1 ." of " . $ARSMT2 .") telah menyelesaikan tugas
                                                                                </a>
                                                                            </td>
                                                                        </tr>"; 
                                                                    }
                                                                ?>
                                                            </tbody>
                                                        </table>

                                                        <hr>
                                                        <h3 class="box-title text-black">
                                                            Buat Tugas
                                                        </h3>
                                                        <hr>
                                                        <form class="form-horizontal" role="form" method="post" enctype="multipart/form-data">
                                                            <div class='form-group'>

                                                                <div class="col-sm-6">
                                                                    <input type="text" class="form-control" id="judul_tugas" name="judul_tugas" placeholder="Judul Tugas *" value="" required>
                                                                </div>

                                                                <div class="col-sm-4">
                                                                    <input type="text" class="form-control" id="tbp" name="tbp" placeholder="Tanggal Batas Pengerjaan" value="" required>
                                                                </div>
                                                                <div class="col-sm-2">
                                                                    <input type="text" class="form-control" id="jbp" name="jbp" placeholder="Jam Batas Pengerjaan" value="23:59" required>
                                                                </div>
                                                                <span class="col-sm-12 control-label">
                                                                </span>
                                                            </div>

                                                            <div class="form-group ">
                                                                <div class="col-sm-12">
                                                                    <textarea class="form-control" name="deskripsi_tugas" rows="5" placeholder="Deskripsi Tugas" required></textarea>
                                                                </div>
                                                                <span class="control-label">
                                                                </span>
                                                            </div>


                                                            <div class='form-group'>
                                                                <label for="tugasfile" class="col-sm-4 control-label">
                                                                    Upload Materi Pembahasan
                                                                    <!-- <b>(*.pdf, *.img, *)</b> -->
                                                                </label>
                                                                <div class="col-sm-8">
                                                                    <div class="input-group image-preview">
                                                                        <input type="text" class="form-control image-preview-filename" disabled="disabled">
                                                                        <span class="input-group-btn">
                                                                            <button type="button" class="btn btn-default image-preview-clear" style="display:none;">
                                                                                <span class="fa fa-remove"></span>
                                                                                Clear </button>
                                                                            <div class="btn btn-success image-preview-input">
                                                                                <span class="fa fa-repeat"></span>
                                                                                <span class="image-preview-input-title">
                                                                                    File Browse</span>
                                                                                <input type="file" accept="application/zip, .rar, image/png, image/jpeg, image/gif, application/pdf, application/msword, application/vnd.ms-excel, application/vnd.ms-powerpoint, text/plain, application/pdf"
                                                                                    name="tugasfile" required />
                                                                            </div>
                                                                        </span>
                                                                    </div>
                                                                </div>

                                                                <span class="col-sm-4">
                                                                </span>
                                                            </div>
                                                            <div class="form-group">
                                                                <div class="col-sm-12">
                                                                    <input type="submit" class="btn btn-success btn-large" value="KIRIM TUGAS">
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <!-- col-sm-8 -->

                                                </div>
                                            </div>
                                        </div>

                                        <!-- TAB3 -->
                                        <div id="tab3" class="tab-pane  <?= $cembunyikan;?>">
                                            <div class="form-horizontal">
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <hr>
                                                        <h3 class="box-title text-black">
                                                            <a href="<?=$base_url.'quiz/add'?>">Koleksi Kuis Saya</a>
                                                        </h3>
                                                        <hr>

                                                        <?php 
                                                            $userid = mysqli_real_escape_string($db, $_SESSION['userid']);
                                                            $qCek = "SELECT COUNT(pengajarid) AS c FROM quiz WHERE quiz.pengajarid ='$userid' ;";
                                                            $resultqCek = mysqli_query($db, $qCek);
                                                            $ambilqCek = mysqli_fetch_array($resultqCek);
                                                            
                                                            
                                                            if($ambilqCek['c'] == 0){
                                                                echo 'Ups, Tampaknya anda belum memiliki koleksi quiz';
                                                                echo ' <h5 class="page-header">
                                                                            <a href=' . $base_url . 'quiz/add>
                                                                                <i class="fa fa-plus"></i>
                                                                                Buat Koleksi Kuis ?
                                                                            </a>
                                                                        </h5>';
                                                            }else{

                                                        ?>

                                                        <table class="table table-striped table-bordered table-hover dataTable no-footer ">
                                                            <thead>
                                                                <tr>
                                                                    <th>#</th>
                                                                    <th>Nama Quiz</th>
                                                                    <th>Kategori</th>
                                                                    <th>Durasi</th>
                                                                    <th>Status</th>
                                                                    <th>Action</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <!-- LOOPING DATA BEGIN HERE BUAT QUIZ  -->
                                                                <?php
                                                                    $sql = "SELECT quiz.quizid, quiz.quiz_nama, quiz_start.kelasid, quiz_kategori.nama_kategori, quiz.waktu, IFNULL(quiz_start.end_date, '-') AS end_date FROM quiz JOIN quiz_kategori ON quiz.idkategori = quiz_kategori.id LEFT JOIN quiz_start ON quiz_start.quizid = quiz.quizid LEFT JOIN kelas ON quiz_start.kelasid = kelas.kelasid WHERE pengajarid = '$userid' GROUP BY quizid;";
																	$result = mysqli_query($db, $sql);
																	while ($row = mysqli_fetch_array($result)){
																		$status = $row['end_date'];
																		$action = '<a href="'.$base_url . 'quiz/send/'.$row['quizid']. '/'.$get_id.'" class="btn btn-primary btn-xs mrg" data-placement="top" data-toggle="tooltip" data-original-title="Mulai Quiz di kelas ini"><i class="fa fa-plus"></i></a>';
																		if($row['kelasid'] == $get_id){
																			if($status != '-'){
																				$today = date("Y-m-d H:i:s");
																				if($status > $today){
																					$action = 'Sedang Proses';
																				}else{	
																					//$action = '<a href="'.$base_url . 'quiz/send/'.$row['quizid']. '/'.$get_id.'" class="btn btn-primary btn-xs mrg" data-placement="top" data-toggle="tooltip" data-original-title="Lihat Jawaban Mahasiswa"><i class="fa fa-check-square-o"></i></a>';
																					$action = '-';
																					$status = "Selesai";
																				}
																			}
																		}else{
																			$status = "-";
																		}
																		
																		echo '<tr><td>'.$counter.'</td><td>'.$row['quiz_nama'].
																			 '</td><td>'.$row['nama_kategori'].
																			 '</td><td>'.$row['waktu'].
																			 ' Menit</td><td id="status'.$row['quizid'].'">'.$status.
																			 '</td><td id="action'.$row['quizid'].'">'.$action.'</td></tr>';
                                                                    }
                                                                ?>
                                                            </tbody>
                                                        </table>
                                                        <!-- tutup Kurung -->
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                                <?php 
                                                if($ambilqCek['c'] == 0){}else{?>

                                                <hr>
                                                <h3 class="box-title text-black">
                                                    Daftar Nilai Kuis -
                                                    <?= $get_nama_kelas ?>
                                                </h3>
                                                <hr>
                                                <table id="" class="table table-striped table-bordered table-hover dataTable no-footer">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Nama Quiz</th>
                                                            <th>Nama Mahasiswa</th>
                                                            <th>Nilai</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <!-- LOOPING DATA BEGIN HERE QUIZ ACTIVE -->
                                                        <?php
                                                            //$q = "SELECT quiz.quiz_nama, mahasiswa.nama_lengkap, quiz_nilai.nilai FROM quiz_nilai JOIN mahasiswa ON quiz_nilai.mhs_id = mahasiswa.id JOIN quiz ON quiz_nilai.id = quiz.quizid WHERE quiz_nilai.kelasid = '$get_id'";  
                                                            $q = "SELECT * FROM quiz_nilai WHERE kelasid = '$get_id';";  
                                                            $result = mysqli_query($db, $q);
                                                            $nomer = 1;

                                                            while($row = mysqli_fetch_array($result)){
                                                                $idquiz = $row['quizid'];
                                                                $idmhs = $row['mhs_id'];
                                                                $h = mysqli_query($db, "SELECT quiz_nama FROM quiz WHERE quizid = '$idquiz'");
                                                                $hasil = mysqli_fetch_array($h);
                                                                $ha = mysqli_query($db, "SELECT nama_lengkap FROM mahasiswa WHERE id = '$idmhs'");
                                                                $hasil2 = mysqli_fetch_array($ha);

                                                                echo "<tr><td>".$nomer."</td>
                                                                        <td>".$hasil['quiz_nama']."</td>
                                                                        <td>".$hasil2['nama_lengkap']."</td>
                                                                       <td>".$row['nilai']."</td></tr>";
                                                                    
                                                                $nomer++;
                                                            }

                                                        ?>
                                                    </tbody>
                                                </table>
                                                <?php } ?>
                                            </div>
                                        </div>

                                        <!-- TAB4 -->
                                        <div id="tab4" class="tab-pane">
                                            <div class="form-horizontal">
                                                <div class="container">
                                                    <div class="row">
                                                        <div class="col-md-8">

                                                            <hr>
                                                            <h3 class="box-title text-black">
                                                                <?php
                                                                $queryCountKelas = "SELECT COUNT(kelasinfo.kelasid) AS total FROM kelasinfo WHERE kelasinfo.kelasid='$get_id';";
                                                                $resultTotalAnggota = mysqli_query($db, $queryCountKelas);
                                                                $ambilResult = mysqli_fetch_array($resultTotalAnggota);
                                                                $TOT_ANGGOTA = $ambilResult['total'];
                                                                echo $TOT_ANGGOTA . ' Anggota';
                                                            ?>
                                                            </h3>
                                                            <hr>
                                                            <div class="people-nearby">
                                                                <?php
                                                                $expensions= array("jpeg", "jpg", "png", "gif");
                                                                $query = "SELECT mahasiswa.nama_lengkap, mahasiswa.username, mahasiswa.id, ifnull(mahasiswa.nim, '-') AS nim FROM kelasinfo JOIN mahasiswa ON kelasinfo.mahasiswaid = mahasiswa.id WHERE kelasinfo.kelasid = '$get_id';";
                                                                $result = mysqli_query($db, $query);
                                                                while ($row = mysqli_fetch_array($result)){
                                                                    $nama = $row['nama_lengkap'];
                                                                    $nim = $row['nim'];
                                                                    $photoPath = $base_url.'uploads/images/default.png';
                                                                    for($i = 0; $i<count($expensions); $i++){
                                                                        if(file_exists('uploads/users/'.md5($row["username"]).$row["id"].'.'.$expensions[$i])){
                                                                            $photoPath = $base_url.'uploads/users/'.md5($row["username"]).$row["id"].'.'.$expensions[$i];
                                                                            break;
                                                                        }
                                                                    }

                                                                    echo
                                                                            '<div class="nearby-user">
                                                                                <div class="row">
                                                                                    <div class="col-md-2 col-sm-2">
                                                                                        <img src="' . $photoPath . '" alt="user" class="profile-photo-lg">
                                                                                    </div>
                                                                                    <div class="col-md-7 col-sm-7">
                                                                                        <h5>
                                                                                        <a href="#" class="profile-link">' . $row['nama_lengkap'] . '</a>
                                                                                        </h5>
                                                                                        <p>' . (($nim == '') ? 'NIM tidak ada!' : 'NIM : ' . $nim ). '</p>
                                                                                        <p class="text-muted">Member of '.$form_title.'</p>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        <hr>
                                                                        ';
                                                                    }
                                                                ?>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- nav-tabs-custom -->
                </div>
                <!-- col-sm-12 -->
            </div>
        </div>
    </section>
</aside>

<!-- JS -->
<script>
    $(".select2").select2();
    $('#deadlinedate').datepicker();

    $('#classesID').change(function (event) {
        var classesID = $(this).val();
        if (classesID === '0') {
            $('#subjectID').val(0);
            $('#sectionID').val('');
        } else {
            $('#sectionID').val('');
            $.ajax({
                type: 'POST',
                data: "id=" + classesID,
                dataType: "html",
                success: function (data) {
                    $('#subjectID').html(data);
                }
            });

            $.ajax({
                type: 'POST',
                data: "id=" + classesID,
                dataType: "html",
                success: function (data) {
                    $('#sectionID').html(data);
                }
            });
        }
    });

    $(document).on('click', '#close-preview', function () {
        $('.image-preview').popover('hide');
        // Hover befor close the preview
        $('.image-preview').hover(
            function () {
                $('.image-preview').popover('show');
                $('.content').css('padding-bottom', '100px');
            },
            function () {
                $('.image-preview').popover('hide');
                $('.content').css('padding-bottom', '20px');
            }
        );
    });

    $(function () {
        // Create the close button
        var closebtn = $('<button/>', {
            type: "button",
            text: 'x',
            id: 'close-preview',
            style: 'font-size: initial;',
        });
        closebtn.attr("class", "close pull-right");
        // Set the popover default content
        $('.image-preview').popover({
            trigger: 'manual',
            html: true,
            title: "<strong>Preview</strong>" + $(closebtn)[0].outerHTML,
            content: "There's no image",
            placement: 'bottom'
        });
        // Clear event
        $('.image-preview-clear').click(function () {
            $('.image-preview').attr("data-content", "").popover('hide');
            $('.image-preview-filename').val("");
            $('.image-preview-clear').hide();
            $('.image-preview-input input:file').val("");
            $(".image-preview-input-title").text("File Browse");
        });
        // Create the preview image
        $(".image-preview-input input:file").change(function () {
            var img = $('<img/>', {
                id: 'dynamic',
                width: 250,
                height: 200,
                overflow: 'hidden'
            });
            var file = this.files[0];
            var reader = new FileReader();
            // Set preview image into the popover data-content
            reader.onload = function (e) {
                $(".image-preview-input-title").text("File Browse");
                $(".image-preview-clear").show();
                $(".image-preview-filename").val(file.name);
            }
            reader.readAsDataURL(file);
        });
    });
</script>
<!-- XXX -->


<script>
    function createCountDown(elementId, date) {
        if (date == '-') {
            document.getElementById(elementId).innerHTML = "-";
            return;
        }
        var countDownDate = new Date(date).getTime();
        var x = setInterval(function () {
            var now = new Date().getTime();
            var distance = (countDownDate) - (now);
            var days = Math.floor(distance / (1000 * 60 * 60 * 24));
            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);

            document.getElementById(elementId).innerHTML = days + "d " + hours + "h " + minutes + "m " +
                seconds + "s ";
            document.getElementById("action" + elementId.replace('status', '')).innerHTML = "Sedang Proses";

            if (distance < 0) {
                clearInterval(x);
                document.getElementById(elementId).innerHTML = "Selesai";
            }
        }, 1000);
    }
    <?php
	$sql = "SELECT quiz.quizid, quiz_start.kelasid, IFNULL(quiz_start.end_date, '-') AS end_date FROM quiz JOIN quiz_kategori ON quiz.idkategori = quiz_kategori.id LEFT JOIN quiz_start ON quiz_start.quizid = quiz.quizid LEFT JOIN kelas ON quiz_start.kelasid = kelas.kelasid WHERE pengajarid = '$userid' AND quiz_start.kelasid = '$get_id';";
	$result = mysqli_query($db, $sql);
	while($row = mysqli_fetch_array($result)){
		$today = date("Y-m-d H:i:s");
		if($row['end_date'] > $today){
			echo "createCountDown('status".$row['quizid']."', \"".$row['end_date']."\");";
		}
	}
?>
</script>
<script type="text/javascript">
    $('#tbp').datepicker({
        startView: 3,
        format: 'yyyy-mm-dd',
        startDate: '+0d'
    });

    $('#jbp').timepicker({
        defaultTime: 'value',
        minuteStep: 1,
        disableFocus: true,
        template: 'dropdown',
        showMeridian: false
    });
    $(function () {
        // Create the close button
        var closebtn = $('<button/>', {
            type: "button",
            text: 'x',
            id: 'close-preview',
            style: 'font-size: initial;',
        });
        closebtn.attr("class", "close pull-right");
    });
</script>

<?php 
    include 'includes/page_footer.php';
?>