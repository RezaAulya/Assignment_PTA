<?php // PARSING 
	ob_start();
	$get_id = $_SESSION['getId'];
    include 'app_config.php';
	include 'includes/session_functions.php';
	include 'includes/page_asset.php';
    include 'includes/db.php';
    // QUERY Here !!
	$id = $_SESSION['userid'];
	$get_id = mysqli_real_escape_string($db, $get_id);
	
    $sql = "SELECT tugasinfo.kelasid, tugas.pengajarid, tugas.nama_tugas, mahasiswa.nama_lengkap FROM tugasinfo JOIN mahasiswa ON tugasinfo.userid = mahasiswa.id JOIN tugas ON tugasinfo.tugasid = tugas.tugasid WHERE tugasinfo.tugasinfoid = '$get_id';";
    $result = mysqli_query($db, $sql);
    $ambil = mysqli_fetch_array($result);
    
	$kelasid = $ambil['kelasid'];
    $nama_tugas =  $ambil['nama_tugas'];
    $dosenId =  $ambil['pengajarid'];
	$nama_lengkap = $ambil['nama_lengkap'];
    $form_name = 'Kumpulkan Tugas - ' . $nama_tugas;
?>

<!-- TITLE -->
<title> <?=$form_name?> </title>
<!-- ADDITIONAL ASSETS BELOW (Optional) -->
<link type="text/css" rel="stylesheet" href="<?php echo $base_url . 'assets/BACKEND/datepicker/datepicker.css '?>">
<script type="text/javascript" src="<?php echo $base_url . 'assets/BACKEND/datepicker/datepicker.js' ?>"></script>
<link rel="stylesheet" href="<?php echo $base_url . 'assets/BACKEND/timepicker/timepicker.css' ?>">
<script type="text/javascript" src="<?php echo $base_url . 'assets/BACKEND/timepicker/timepicker.js' ?>"></script>
<link rel="stylesheet" href="<?php echo $base_url . 'assets/BACKEND/select2/css/select2.css' ?>">
<link rel="stylesheet" href="<?php echo $base_url . 'assets/BACKEND/select2/css/select2-bootstrap.css' ?>">
<script type="text/javascript" src="<?php echo $base_url . 'assets/BACKEND/select2/select2.js' ?>"></script>

<?php // END OF ASSETS
  include 'includes/page_header.php'; // </head>
  include 'includes/page_topbar.php'; // TOPBAR


//  USER ROLE
  include 'includes/role.php';
  
	if($_SERVER["REQUEST_METHOD"] == "POST"){
		if(isset($_FILES['kumpul_tugas'])){
			if(empty($_FILES['kumpul_tugas']['name'])==false){
				$deskripsi = mysqli_real_escape_string($db, $_POST['deskripsi_tugas']);
				$file_name = $_FILES['kumpul_tugas']['name'];
				$tampungFileName = explode('.', $file_name);
				$userid = $_SESSION['userid'];
				$file_ext = strtolower($tampungFileName[(count($tampungFileName)-1)]);
				$folder_tugas = md5($file_name.$nama_tugas).$id;
				$file_size = $_FILES['kumpul_tugas']['size'];
				$file_tmp = $_FILES['kumpul_tugas']['tmp_name'];
				$file_type = $_FILES['kumpul_tugas']['type'];
				
                $expensions = array("doc", "docx", "pdf", "xlsx","ppt","pptx", "zip", "rar");
                
				
				if(in_array($file_ext,$expensions)=== false){
					$msg ="File yang anda masukkan tidak valid.";
					echo $msg;
					exit;
				}
				
				if(empty($msg)==true){
					$nama_file = $nama_tugas."_".str_replace("'", "_", $nama_lengkap)."_".$id.".".$file_ext;
					$nama_file = str_replace(' ', '_', $nama_file);
					
					$path_jawaban = "uploads/tugas_kumpul/".$folder_tugas."/";
					$revisi = false;
					if (!file_exists($path_jawaban)) { mkdir($path_jawaban, 0777, true); }
					if(file_exists($path_jawaban.$nama_file)){ $revisi = true; unlink($path_jawaban.$nama_file);}
					
					move_uploaded_file($file_tmp, $path_jawaban.$nama_file);
					
					
					//UPDATE tugasinfo
					$fp = mysqli_real_escape_string($db, $path_jawaban.$nama_file);
                    // $sql = "UPDATE tugasinfo SET keterangan = '$deskripsi', path_jawaban = '$fp' WHERE tugasinfo.tugasid = '$get_id' AND tugasinfo.userid = '$id';";
					$sql = "UPDATE tugasinfo SET keterangan = '$deskripsi', path_jawaban = '$fp' WHERE tugasinfo.userid = '$userid' AND tugasinfo.tugasinfoid = '$get_id';";
					mysqli_query($db, $sql);
					
					$notif_msg = mysqli_real_escape_string($db, " mengumpulkan tugas $nama_tugas");
					if($revisi){
						$notif_msg = mysqli_real_escape_string($db, "merevisi tugas $nama_tugas");
					}
                    
                    $notif = "INSERT INTO notif_dosen (notif_msg, userid_from, userid_to, kelasid) VALUES ('$notif_msg', '$id', '$dosenId', '$kelasid');";
					mysqli_query($db, $notif);
					
					$msg = 'Berhasil mengumpulkan tugas.';
					
					header("Location: ..");
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
                                <a href="<?= $base_url . 'dashboard' ?>">
                                    <i class="fa fa-laptop"></i> Dashboard</a>
                            </li>
                            <li>
                                <a href="<?= $base_url . '/mhs/tugas' ?>">Tugas</a>
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
                                            <a data-toggle="tab" href="#tab1" aria-expanded="true">Kumpul Tugas</a>
                                        </li>
                                    </ul>
									
                                    <div class="tab-content">
                                        <div id="tab1" class="tab-pane active">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <form class="form-horizontal" role="form" method="post" enctype="multipart/form-data">
                                                        <div class="form-group ">
                                                            <div class="col-sm-12">
                                                                <textarea class="form-control" name="deskripsi_tugas" rows="5" placeholder="Ketik Keterangan Tugas kamu disini"></textarea>
                                                            </div>
                                                            <span class="control-label">
                                                            </span>
                                                        </div>

                                                        <div class='form-group'>
                                                            <label for="kumpul_tugas" class="col-sm-2 control-label">
                                                                Upload File </label>
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
                                                                            <input type="file" accept="application/zip, .rar, application/pdf, application/msword, application/vnd.ms-excel, application/vnd.ms-powerpoint, application/pdf" name="kumpul_tugas" />
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
                                                <!-- col-sm-8 -->
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
        <!-- row -->
        </div>
        <!-- Body -->
        </div>
        <!-- /.box -->

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