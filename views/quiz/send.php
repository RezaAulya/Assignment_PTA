<?php // PARSING
	ob_start();
	$qId = $_SESSION['getId'];
    $kId = $_SESSION['idKelas'];
    include 'app_config.php';
	include 'includes/session_functions.php';
	include 'includes/page_asset.php';
	include 'includes/db.php';
	
	$qId = mysqli_real_escape_string($db, $qId);
	$kId = mysqli_real_escape_string($db, $kId);
	
	
    $form_name = "Kirim Quiz";
?>

<!-- TITLE -->
<title> <?=$form_name?> </title>

<!-- ADDITIONAL ASSETS BELOW (Optional) -->
<link type="text/css" rel="stylesheet" href="<?php echo $base_url . 'assets/BACKEND/datepicker/datepicker.css '?>">
<script type="text/javascript" src="<?php echo $base_url . 'assets/BACKEND/datepicker/datepicker.js' ?>"></script>
<?php // END OF ASSETS
  include 'includes/page_header.php'; // </head>
  include 'includes/page_topbar.php'; // TOPBAR

//  USER ROLE
  include 'includes/role.php';
  
// POST
	if($_SERVER["REQUEST_METHOD"] == "POST"){
		$end_date = $_POST["tbp"];
		$sql = "INSERT INTO quiz_start (id, kelasid, quizid, end_date) VALUES (NULL, '$kId', '$qId', '$end_date 23:59:59')";
		$result = mysqli_query($db, $sql);
		$userid = $_SESSION['userid'];		
		$qry = "SELECT mahasiswaid FROM kelasinfo WHERE kelasid = '$kId';";
		$r = mysqli_query($db, $qry);
		
		while($row = mysqli_fetch_array($r)){
			$mhsId = $row['mahasiswaid'];
			//quiz_temp
			$sql = "SELECT infoid FROM quizinfo WHERE quizid = '$qId';";
			$result = mysqli_query($db, $sql);
			
			while($dataInfo = mysqli_fetch_array($result)){
				$infoid = $dataInfo['infoid'];
				$k = "INSERT INTO quiz_temp (id, mahasiswaid, idsoal, jawaban) VALUES (NULL, '$mhsId', '$infoid', NULL);";
				$j = mysqli_query($db, $k);
				
			}
			
			$notif = "INSERT INTO notif_mhs (notif_msg, userid_from, userid_to, kelasid) VALUES (' mengadakan Quiz, dengan deadline <b>$end_date</b>', '$userid', '$mhsId', '$kId');";
			$result = mysqli_query($db, $notif);
		}
		
		
		header('Location: '.$base_url.'kelas-view/'.$idKelas);
		
		exit;
	}
	
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
                                <a href="<?=$base_url.'dashboard'?>">
                                    <i class="fa fa-laptop"></i>
                                    Dashboard
                                </a>
                            </li>
							
							<li>
                                <a href="<?=$base_url.'kelas'?>">
                                    <i class="fa fa-laptop"></i>
                                    Kelola Kelas
                                </a>
                            </li>
							
                            <li class="active">
                                <?=$form_name?>
                            </li>
                        </ol>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="col-sm-10">
                                    <form class="form-horizontal" role="form" method="post" enctype="multipart/form-data">

                                        <div class='form-group'>
                                            <label for="nama_tugas" class="col-sm-2 control-label">
                                                Batas Tanggal Quiz
                                            </label>
                                            <div class="col-sm-6">	
												<input type="text" class="form-control" id="tbp" name="tbp" placeholder="Tanggal Batas Pengerjaan" value="" required>
                                            </div>
                                            <span class="col-sm-4 control-label">
                                            </span>
                                        </div>
										
                                        <div class="form-group">
                                            <div class="col-sm-offset-2 col-sm-6">
                                                <input type="submit" class="btn btn-success btn-block margin-bottom" value="Mulai Quiz">
                                            </div>
                                        </div>

                                    </form>
                                </div>

                            </div>
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
<script type="text/javascript">
    $('#tbp').datepicker({
        startView: 3,
		format: 'yyyy-mm-dd',
		startDate: '+0d'
    });
</script>


<?php 
    include 'includes/page_footer.php';
?>