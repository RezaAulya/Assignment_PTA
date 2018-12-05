<!-- 
@TODO "Validasi Duplicate Nama Kelas" 
@TODO "Kirim Notifikasi jika kelas berhasil dibuat" 
-->

<?php // PARSING
	ob_start();
    include 'app_config.php';
	include 'includes/session_functions.php';
	include 'includes/page_asset.php';
	
    $form_name ="Tambah Kelas";
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
	include 'includes/db.php';
	
    $userid = mysqli_real_escape_string($db, $_SESSION['userid']);
	if($_SERVER["REQUEST_METHOD"] == "POST"){

		$kelas_nama = mysqli_real_escape_string($db, $_POST['kelas_nama']);
		$kelas_deskripsi = mysqli_real_escape_string($db, $_POST['kelas_deskripsi']);
		$kelas_code = mysqli_real_escape_string($db, $_POST['kelas_code']);
		$create_by = mysqli_real_escape_string($db, $_POST['create_by']);

        $query = "INSERT INTO kelas (kelas_nama, kelas_deskripsi, kelas_code, dibuat_oleh ) VALUES ('$kelas_nama','$kelas_deskripsi','$kelas_code','$create_by')";
		$result = mysqli_query($db, $query);
		
		$resId = mysqli_query($db, "SELECT kelas.kelasid FROM kelas WHERE kelas.kelas_code = '$kelas_code';");
		$ambilId = mysqli_fetch_array($resId);
        header("Location: kelas-view/".$ambilId['kelasid']);
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
                                                
                                                return strtoupper($Hash); 
                                                } 
                                        ?>
                                            <div class='form-group'>
                                                <label for="kelas_code" class="col-sm-2 control-label">
                                                    Kode Kelas
                                                </label>
                                                <div class="col-sm-6">
                                                    <input readonly type="text" class="form-control" id="kelas_code" name="kelas_code" value="<?php echo genMix(6); ?>">
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
										<?php
											if($role == 1){
												$q = "SELECT dosen.id, dosen.nama_lengkap FROM dosen;";
												$ex = mysqli_query($db, $q);
												
												echo '<div class="form-group">
															<label for="pengajar" class="col-sm-2 control-label">
																Pengajar </label>
													<div class="col-sm-6">
														<select class="form-control" name="pengajar">';
												while ($row = mysqli_fetch_array($ex)){
													echo   '<option value="'.$row['id'].'">'.$row['nama_lengkap'].'</option>';
												}
												echo '</select>
												</div>
												</div>';
											}
										?>
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