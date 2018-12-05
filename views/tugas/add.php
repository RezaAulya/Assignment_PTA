<?php // PARSING
	ob_start();
    include 'app_config.php';
	include 'includes/session_functions.php';
	include 'includes/page_asset.php';
	
    $form_name ="Tambah Tugas";
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
		if(isset($_FILES['tugasfile'])){
			if(empty($_FILES['tugasfile']['name'])==false){
				$nama_tugas = mysqli_real_escape_string($db, $_POST['nama_tugas']);
				$deskripsi = mysqli_real_escape_string($db, $_POST['deskripsi']);
				$errors = array();
				$file_name = $_FILES['tugasfile']['name'];
				$tampungFileName = explode('.', $file_name);
				
				$file_ext = strtolower($tampungFileName[(count($tampungFileName)-1)]);
				$tugas_name = md5($file_name.$nama_tugas).$id.'.'.$file_ext;
				$file_size = $_FILES['tugasfile']['size'];
				$file_tmp = $_FILES['tugasfile']['tmp_name'];
				$file_type = $_FILES['tugasfile']['type'];
				$filepath = mysqli_real_escape_string("uploads/tugas/".$tugas_name);
				$expensions= array("doc", "docx", "pdf", "txt");
				
				if(in_array($file_ext,$expensions)=== false){
					$errors[]="File yang anda masukkan tidak valid.";
					exit;
				}
				
				if(empty($errors)==true){
					if(file_exists("uploads/tugas/".$tugas_name)){
						unlink("uploads/tugas/".$tugas_name);
					}
					move_uploaded_file($file_tmp, "uploads/tugas/".$tugas_name);
					$sql = "INSERT INTO tugas (tugasid, nama_tugas, deskripsi, file_name, pengajarid) VALUES (NULL, '$nama_tugas', '$deskripsi', '$tugas_name', '$userid');";
					$result = mysqli_query($db, $sql);
					header('Location: tugas');
				}else{
					print_r($errors);
					exit;
				}
			}
		}
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
                                                <span class="text-red"> *</span>
                                            </label>
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control" id="nama_tugas" name="nama_tugas" required>

                                            </div>
                                            <span class="col-sm-4 control-label">
                                            </span>
                                        </div>

                                        <!-- GET ID USER-->
                                        <input type="hidden" class="form-control" id="pengajarid" name="pengajarid" value="<?php echo $userid;?>">

                                        <div class='form-group'>
                                            <label for="File" class="col-sm-2 control-label">
                                                File Tugas </label>
                                            <div class="col-sm-6">
                                                <div class="input-group file-preview">
                                                    <input type="text" class="form-control file-preview-filename" disabled="disabled">
                                                    <span class="input-group-btn">
                                                        <button type="button" class="btn btn-default file-preview-clear" style="display:none;">
                                                            <span class="fa fa-remove"></span>
                                                            Clear </button>
                                                        <div class="btn btn-success image-preview-input">
                                                            <span class="fa fa-repeat"></span>
                                                            <span class="image-preview-input-title">
                                                                File Browse</span>
                                                            <input type="file" accept="application/text, application/vnd.openxmlformats-officedocument.wordprocessingml.document, application/pdf" name="tugasfile" required/>
                                                        </div>
                                                    </span>
                                                </div>
                                            </div>

                                            <span class="col-sm-4">
                                            </span>
                                        </div>

                                            <div class='form-group'>
                                                <label for="deskripsi" class="col-sm-2 control-label">
                                                    Deskripsi Tugas </label>
                                                <div class="col-sm-6">
                                                    <textarea class="form-control" style="resize:none;" id="deskripsi" name="deskripsi"></textarea>
                                                </div>
                                            </div>
											
                                            <div class="form-group">
                                                <div class="col-sm-offset-2 col-sm-6">
                                                    <input type="submit" class="btn btn-success btn-block margin-bottom" value="Buat Tugas ">
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