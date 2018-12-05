<!-- 
@TODO "Validasi Duplicate Nama Kelas" 
@TODO "Kirim Notifikasi jika kelas berhasil dibuat" 
-->

<?php // PARSING 
    include 'app_config.php';
    $form_name ="Edit Kelas";
?>
<?php // CEK SESSION
    session_start();
    if(!isset($_SESSION['username'])){
		header("location: homepage");
    }
// LOAD MAIN ASSETS   
  include 'includes/page_asset.php';
?>
<!-- TITLE -->
<title> <?=$form_name?> </title>

<!-- ADDITIONAL ASSETS BELOW (Optional) -->

<?php // END OF ASSETS
  include 'includes/page_header.php'; // </head>
  include 'includes/page_topbar.php'; // TOPBAR

//  USER ROLE
	$role = 0;
	switch (strtolower($_SESSION['role'])) {
	case "admin":
	$role = 1;
	include 'includes/side_menu_admin.php';
	break;
	case "pengajar":
	$role = 2;
	include 'includes/side_menu_dosen.php';
	break;
	case "mahasiswa":
	$role = 3;
	include 'includes/side_menu_mhs.php';
	break;
	default:
	header("location: homepage");
  }

  

// POST  
include 'includes/db.php';
ob_start();
$error = '';
    $msg = '';
    $userid =$_SESSION['userid'];

	if($_SERVER["REQUEST_METHOD"] == "POST"){

		$kelas_nama = mysqli_escape_string($db, $_POST['kelas_nama']);
		$kelas_deskripsi = mysqli_escape_string($db, $_POST['kelas_deskripsi']);
		$kelas_code = mysqli_real_escape_string($db, $_POST['kelas_code']);
		$create_by = mysqli_real_escape_string($db, $_POST['create_by']);

        $query = "INSERT INTO kelas (kelas_nama, kelas_deskripsi, kelas_code, create_by ) VALUES ('$kelas_nama','$kelas_deskripsi','$kelas_code','$create_by')";
		$result = mysqli_query($db, $query);
		
		$msg = 'Successfully Created a Class <a href="kelas">Kelas</a>';
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
                                            <label for="kelas_nama" class="col-sm-2 control-label">
                                                Nama Kelas
                                                <span class="text-red"> *</span>
                                            </label>
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control" id="kelas_nama" name="kelas_nama" required>

                                            </div>
                                            <span class="col-sm-4 control-label">
                                            </span>
                                        </div>

                                        <!-- GET ID USER-->
                                        <input type="hidden" class="form-control" id="create_by" name="create_by" value="<?php echo $userid;?>">

                                        <?php
                                            function genMix($qtd){ 
                                                $Caracteres = 'abcdefghijklmnopqrstuvwxyz0123456789'; 
                                                $QuantidadeCaracteres = strlen($Caracteres); 
                                                $QuantidadeCaracteres--; 
                                                
                                                $Hash=NULL; 
                                                    for($x=1;$x<=$qtd;$x++){ 
                                                        $Posicao = rand(0,$QuantidadeCaracteres); 
                                                        $Hash .= substr($Caracteres,$Posicao,1); 
                                                    } 
                                                
                                                return $Hash; 
                                                } 
                                        ?>
                                            <div class='form-group'>
                                                <label for="kelas_code" class="col-sm-2 control-label">
                                                    Kode Kelas
                                                </label>
                                                <div class="col-sm-6">
                                                    <input type="text" class="form-control" id="kelas_code" name="kelas_code" value="<?php echo genMix(6); ?>">
                                                </div>
                                                <span class="col-sm-4 control-label">
                                                </span>
                                            </div>

                                            <div class='form-group'>
                                                <label for="kelas_deskripsi" class="col-sm-2 control-label">
                                                    Deskripsi Kelas </label>
                                                <div class="col-sm-6">
                                                    <textarea class="form-control" style="resize:none;" id="kelas_deskripsi" name="kelas_deskripsi"></textarea>
                                                </div>

                                            </div>

                                            <div class="form-group">
                                                <div class="col-sm-offset-2 col-sm-6">
                                                    <input type="submit" class="btn btn-success btn-block margin-bottom" value="Buat Kelas ">
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