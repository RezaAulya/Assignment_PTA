<?php // PARSING 
	$get_id = $_SESSION['getId'];
    include 'app_config.php';
	include 'includes/session_functions.php';
	include 'includes/page_asset.php';
    include 'includes/db.php';
    // QUERY Here !!
	
    $sql = "SELECT kelas.kelas_nama, kelas.kelas_code FROM kelas WHERE kelas.kelasid = '$get_id';";
    $result = mysqli_query($db, $sql);
    $ambil = mysqli_fetch_array($result);
    $userid = mysqli_real_escape_string($db, $_SESSION['userid']);
    $get_nama_kelas = $ambil['kelas_nama'];
    $get_kode_kelas = $ambil['kelas_code'];
	
	
	if($_SERVER["REQUEST_METHOD"] == "POST"){
		if(isset($_FILES['kumpul_tugas']) && $_POST['idtugas'] !== '0') {
			$tugasinfoid = mysqli_real_escape_string($db, $_POST['idtugas']);
			if(empty($_FILES['kumpul_tugas']['name'])==false){
				

				$sqlx = "SELECT tugasinfo.kelasid, tugas.pengajarid, tugas.nama_tugas, mahasiswa.nama_lengkap FROM tugasinfo JOIN mahasiswa ON tugasinfo.userid = mahasiswa.id JOIN tugas ON tugasinfo.tugasid = tugas.tugasid WHERE tugasinfo.tugasinfoid = '$tugasinfoid';";
				$resultx = mysqli_query($db, $sqlx);
				$ambilx = mysqli_fetch_array($resultx);
				
				$kelasid = $ambilx['kelasid'];
				$nama_tugas =  $ambilx['nama_tugas'];
				$dosenid =  $ambilx['pengajarid'];
				$nama_lengkap = $ambilx['nama_lengkap'];
    
				$deskripsi = mysqli_real_escape_string($db, $_POST['deskripsi_tugas']);
				$file_name = $_FILES['kumpul_tugas']['name'];
				$tampungFileName = explode('.', $file_name);
				$file_ext = strtolower($tampungFileName[(count($tampungFileName)-1)]);
				$folder_tugas = md5($file_name.$nama_tugas).$userid;
				$file_size = $_FILES['kumpul_tugas']['size'];
				$file_tmp = $_FILES['kumpul_tugas']['tmp_name'];
				$file_type = $_FILES['kumpul_tugas']['type'];
				
				
                $expensions= array("doc", "docx", "pdf", "xlsx","ppt","pptx", "zip", "rar");
				
				if(in_array($file_ext,$expensions)=== false){
					$msg ="File yang anda masukkan tidak valid.";
					echo $msg;
					exit;
				}
				
				if(empty($msg)==true){
					$nama_file = $nama_tugas."_".str_replace("'", "_", $nama_lengkap)."_".$userid.".".$file_ext;
					$nama_file = str_replace(' ', '_', $nama_file);
					
					$path_jawaban = "uploads/tugas_kumpul/".$folder_tugas."/";
					
					if (!file_exists($path_jawaban)) { mkdir($path_jawaban, 0777, true); }
					if(file_exists($path_jawaban.$nama_file)){ unlink($path_jawaban.$nama_file);}
					
					move_uploaded_file($file_tmp, $path_jawaban.$nama_file);
					
					//UPDATE tugasinfo
					$fp = mysqli_real_escape_string($db, $path_jawaban.$nama_file);
					$sql = "UPDATE tugasinfo SET keterangan = '$deskripsi', path_jawaban = '$fp' WHERE tugasinfo.userid = '$userid' AND tugasinfo.tugasinfoid = '$tugasinfoid';";
					mysqli_query($db, $sql);
					
					$notif_msg = mysqli_real_escape_string($db, " mengumpulkan tugas $nama_tugas");
					$notif = "INSERT INTO notif_dosen (notif_msg, userid_from, userid_to, kelasid) VALUES ('$notif_msg', '$userid', '$dosenid', '$kelasid');";
					mysqli_query($db, $notif);
					
					$msg = 'Berhasil mengumpulkan tugas.';
					
				}
			}
		}
	}
	
    $form_name ='Kelas ' . $get_nama_kelas . ' - <b>(' . $get_kode_kelas . ')</b>';
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
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="nav-tabs-custom">
                                    <ul class="nav nav-tabs">
                                        <li class="active">
                                            <a data-toggle="tab" href="#tab1" aria-expanded="true">Aktivitas Kelas</a>
                                        </li>
                                        <li class="">
                                            <a data-toggle="tab" href="#tab2" aria-expanded="false">Tugas</a>
                                        </li>
                                        <li class="">
                                            <a data-toggle="tab" href="#tab3" aria-expanded="false">Quiz</a>
                                        </li>
                                        <li class="">
                                            <a data-toggle="tab" href="#tab4" aria-expanded="false">Anggota Kelas</a>
                                        </li>

                                    </ul>


                                    <?php if (!empty($msg)) { ?>
                                    <script>
                                        $(document).ready(function () {
                                            toastr.success('<?= $msg ?>');
                                        });
                                    </script>
                                    <?php } ?>
                                    <div class="tab-content">
                                        <div id="tab1" class="tab-pane active">
                                            <div class="form-horizontal">
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <hr>
                                                        <h3 class="box-title text-black">
                                                            Aktifitas Terbaru
                                                        </h3>
                                                        <hr>
                                                        <table class="table table-hover">
                                                            <tbody>
                                                                <!-- LOOPING DATA BEGIN HERE  -->
                                                                <?php
                                                                    include 'includes/db.php';
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
        
                                                                   
                                                                ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- TAB 2 -->
                                        <div id="tab2" class="tab-pane">
                                            <div class="form-horizontal">
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <hr>
                                                        <h3 class="box-title text-black">
                                                            Tugas
                                                        </h3>
                                                        <hr>
                                                        <form class="form-horizontal" id="fileform" role="form" method="post" enctype="multipart/form-data">

                                                            <div class="form-group ">
                                                                <div class="col-sm-12">
                                                                    <select id="idtugas" class="form-control select2" name="idtugas">
                                                                        <option value="0">Pilih tugas ...</option>
                                                                        <?php
                                                                                    $query = "SELECT * FROM tugasinfo JOIN tugas ON tugasinfo.tugasid = tugas.tugasid WHERE tugasinfo.path_jawaban IS NULL AND tugasinfo.deadline > NOW() AND tugasinfo.userid = '$userid' AND tugasinfo.kelasid = '$get_id'";
                                                                                    $result = mysqli_query($db, $query);
                                                                                    while ($row = mysqli_fetch_array($result)){
                                                                                        echo '<option value="'.$row['tugasinfoid'].'">'.$row['nama_tugas'].'</option>';
                                                                                    }
                                                                                ?>
                                                                    </select>

                                                                </div>
                                                                <span class="control-label">
                                                                </span>
                                                            </div>
                                                            <div class="form-group ">
                                                                <div class="col-sm-12">
                                                                    <textarea class="form-control" name="deskripsi_tugas" rows="5" placeholder="Ketik Keterangan Tugas kamu disini" required></textarea>
                                                                </div>
                                                                <span class="control-label">
                                                                </span>
                                                            </div>

                                                            <div class='form-group'>
                                                                <label for="kumpul_tugas" class="col-sm-2 control-label">
                                                                    Upload File
                                                                    <font color="green">
                                                                        <b>( *rar, *zip )</b>
                                                                    </font>
                                                                </label>
                                                                <div class="col-sm-10">
                                                                    <div class="input-group image-preview">
                                                                        <input type="text" class="form-control image-preview-filename" disabled="disabled">
                                                                        <span class="input-group-btn">
                                                                            <button type="button" class="btn btn-default image-preview-clear" style="display:none;">
                                                                                <span class="fa fa-remove"></span>
                                                                                Clear </button>
                                                                            <div class="btn btn-warning image-preview-input">
                                                                                <span class="fa fa-repeat"></span>
                                                                                <span class="image-preview-input-title">
                                                                                    File Browse</span>
                                                                                <input type="file" accept="application/zip, .rar, image/png, image/jpeg, image/gif, application/pdf, application/msword, application/vnd.ms-excel, application/vnd.ms-powerpoint, text/plain, application/pdf"
                                                                                    name="kumpul_tugas" class="required" />
                                                                            </div>
                                                                        </span>
                                                                    </div>
                                                                </div>

                                                                <span class="col-sm-4">
                                                                </span>
                                                            </div>
                                                            <hr>
                                                            <div class="form-group">
                                                                <div class=" col-sm-12">
                                                                    <input type="submit" class="btn btn-success btn-large btn-block margin-bottom" value="KIRIM TUGAS">
                                                                </div>
                                                            </div>

                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- TAB3 -->
                                        <div id="tab3" class="tab-pane">
                                            <div class="form-horizontal">
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <hr>
                                                        <h3 class="box-title text-black">
                                                            Kuis
                                                        </h3>
                                                        <hr>
                                                        <table class="table table-striped table-bordered table-hover dataTable no-footer">
                                                            <thead>
                                                                <tr>
                                                                    <th>#</th>
                                                                    <th>Nama Quiz</th>
                                                                    <th>Kategori</th>
                                                                    <th>Durasi</th>
                                                                    <th>End Date</th>
                                                                    <th>Status</th>
                                                                    <th>Nilai</th>
                                                                    <th>Action</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <!-- LOOPING DATA BEGIN HERE BUAT QUIZ  -->
                                                                <?php
                                                                            $userid = mysqli_real_escape_string($db, $_SESSION['userid']);
                                                                            $sql = "SELECT quiz.quizid, quiz.quiz_nama, quiz_kategori.nama_kategori, quiz.waktu, IFNULL(quiz_start.end_date, '-') AS end_date FROM quiz JOIN quiz_kategori ON quiz.idkategori = quiz_kategori.id LEFT JOIN quiz_start ON quiz_start.quizid = quiz.quizid LEFT JOIN kelas ON quiz_start.kelasid = kelas.kelasid WHERE quiz_start.kelasid = '$get_id'";
                                                                            
                                                                            $result = mysqli_query($db, $sql);
                                                                            $counter = 1;
                                                                            while ($row = mysqli_fetch_array($result)){
                                                                                $end_date = $row['end_date'];
                                                                                $action = '';
                                                                                if($end_date != '-'){
                                                                                    $confirm = "Anda akan mengerjakan Quiz ".$row['quiz_nama']." dengan waktu maksimal ".$row['waktu']." menit.";
                                                                                    $today = date("Y-m-d H:i:s");
                                                                                    if($end_date > $today){
                                                                                        $status = 'Sedang Berjalan';
                                                                                        $action = '<a href="'.$base_url.'mhs/kelas/do-quiz/'.$row['quizid'].'/'.$get_id.'" onclick="return confirm(\''.$confirm.'\');" style="text-decoration: underline;"> Kerjakan Quiz Ini</a>';
                                                                                    }else{
                                                                                        $status = 'Sudah Selesai';
                                                                                        $action = '-';
                                                                                    }
                                                                                }
                                                                                
                                                                                $quizid = $row['quizid'];
                                                                                $nilaiInt = 0;
                                                                                $nilai = "SELECT IFNULL(quiz_temp.jawaban, 0) as jawaban, quizinfo.quiz_jawaban FROM quiz_temp JOIN quizinfo ON quiz_temp.idsoal = quizinfo.infoid WHERE quiz_temp.mahasiswaid = '$userid' AND quizinfo.quizid = '$quizid';";
                                                                                $nilaiResult = mysqli_query($db, $nilai);
                                                                                $jumlahSoal = mysqli_num_rows($nilaiResult);
                                                                                while($rowNilai = mysqli_fetch_array($nilaiResult)){
                                                                                    if($rowNilai['jawaban'] == $rowNilai['quiz_jawaban']){
                                                                                        $nilaiInt++;
                                                                                    }
                                                                                }
                                                                                
                                                                                $cekBolehLihat ='';
                                                                                if($jumlahSoal != 0){
                                                                                    $nilaiPrint = (float)($nilaiInt/$jumlahSoal)*100;
                                                                                    if($nilaiPrint !=0){
                                                                                        $cekBolehLihat =  '<a href="'.$base_url.'mhs/quiz/result/'.$row['quizid'].'">'.round($nilaiPrint, 2).'</a>';
                                                                                    }else{
                                                                                        $cekBolehLihat = 0;
                                                                                    }
                                                                                }else{
                                                                                    $nilaiPrint =0;
                                                                                }
                                                                                if($nilaiPrint != 0){
                                                                                    $action = 'Anda Sudah mengerjakan soal ini';
                                                                                }
                                                                                
                                                                                $tableRow = '<tr><td>'.$counter.'</td><td>'.$row['quiz_nama'].
                                                                                    '</td><td>'.$row['nama_kategori'].
                                                                                    '</td><td>'.$row['waktu'].
                                                                                    '</td><td>'.$end_date.
                                                                                    '</td><td>'.$status.
                                                                                    '</td><td>'.$cekBolehLihat.
                                                                                    '</td><td>'.$action.'</td></tr>';
                                                                                echo $tableRow;
                                                                                $counter++;
                                                                            }
                                                                            if($counter == 1){
                                                                                echo '<tr><td></td><td>Anda Tidak Memili Tugas </td><td></td><td></td><td></td><td></td><td></td><td></td></tr>';
                                                                            }
                                                                        ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

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
                                                                echo $ambilResult['total'] . ' Anggota'
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
                                    <!-- nav-tabs-custom -->

                                </div>
                                <!-- col-sm-12 -->

                            </div>
                            <!-- row -->
                        </div>
                        <!-- Body -->
                    </div>
                    <!-- /.box -->
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



<?php 
    include 'includes/page_footer.php';
?>