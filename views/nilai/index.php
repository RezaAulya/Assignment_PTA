<?php // PARSING
	ob_start();
    include 'app_config.php';
	include 'includes/session_functions.php';
	include 'includes/page_asset.php';
	include 'includes/db.php';
	
	$query = "SELECT tugas.nama_tugas FROM tugas WHERE tugasid = (SELECT tugasinfo.tugasid FROM tugasinfo WHERE tugasinfo.tugasinfoid = 1);";
	$result = mysqli_query($db, $query);
	$ambil = mysqli_fetch_array($result);
	$judul_tugas = $ambil['nama_tugas'];
	$form_name = "Input Nilai <i>".$judul_tugas."</i>  - ";
	
	$sql = "SELECT nama_lengkap FROM mahasiswa WHERE id = (SELECT userid FROM tugasinfo WHERE tugasinfoid = '$lpTugasinfoid');";
	$result = mysqli_query($db, $sql);
	if(!$result){
		header("Location: ".$base_url."homepage");
		
		exit;
	}
	$ambil = mysqli_fetch_array($result);
	
    $form_name .= $ambil['nama_lengkap'];
?>

<!-- TITLE -->
<title> <?=$form_name?> </title>

<!-- ADDITIONAL ASSETS BELOW (Optional) -->

<?php // END OF ASSETS
  include 'includes/page_header.php'; // </head>
  include 'includes/page_topbar.php'; // TOPBAR

//  USER ROLE
  include 'includes/role.php';

// POST  
	
	
    $userid = mysqli_real_escape_string($db, $_SESSION['userid']);

	if($_SERVER["REQUEST_METHOD"] == "POST"){
		$nilai = $_POST['grade'];
		if(is_numeric($nilai)){
			$sql = "UPDATE tugasinfo SET nilai = '$nilai' WHERE tugasinfoid = '$lpTugasinfoid';";
			$result = mysqli_query($db, $sql);
		}
		header('Location: '.$_SESSION['back_input']);
		unset($_SESSION['back_input']);
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
                                <a href="dashboard">
                                    <i class="fa fa-laptop"></i>
                                    Dashboard
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
                                                Nama Tugas
                                            </label>
                                            <div class="col-sm-6">	
												<input type="text" class="form-control" name="judul_tugas" value="<?php echo $judul_tugas?>" disabled>  
                                            </div>
                                            <span class="col-sm-4 control-label">
                                            </span>
                                        </div>
										<div class='form-group'>
                                            <label for="nama_tugas" class="col-sm-2 control-label">
                                                Nilai
                                            </label>
                                            <div class="col-sm-6">	
												<input type="number" class="form-control" name="grade" min="0" max="100" value="0" required>
                                            </div>
                                            <span class="col-sm-4 control-label">
                                            </span>
                                        </div>

                                        <!-- GET ID USER-->
                                        <input type="hidden" class="form-control" id="pengajarid" name="pengajarid" value="<?php echo $userid;?>">	
                                            <div class="form-group">
                                                <div class="col-sm-offset-2 col-sm-6">
                                                    <input type="submit" class="btn btn-success btn-block margin-bottom" value="Beri Nilai">
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



<?php 
    include 'includes/page_footer.php';
?>