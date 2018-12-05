<?php // PARSING 
	ob_start();
    include 'app_config.php';
	include 'includes/session_functions.php';
	include 'includes/page_asset.php';
    $form_name ="Tambah Quiz";
?>

<!-- TITLE -->
<title>
    <?=$form_name?>
</title>


<!-- ADDITIONAL ASSETS BELOW (Optional) -->
<link rel="stylesheet" href="<?php echo $base_url . 'assets/BACKEND/datetimepicker/datetimepicker.css' ?>">
<link rel="stylesheet" href="<?php echo $base_url . 'assets/BACKEND/editor/jquery-te-1.4.0.css' ?>">
<script type="text/javascript" src="<?php echo $base_url . 'assets/BACKEND/editor/jquery-te-1.4.0.min.js' ?>"></script>
<script type="text/javascript" src="<?php echo $base_url . 'assets/BACKEND/datetimepicker/moment.js' ?>"></script>
<script type="text/javascript" src="<?php echo $base_url . 'assets/BACKEND/datetimepicker/datetimepicker.js' ?>"></script>

<link rel="stylesheet" href="<?php echo $base_url . 'assets/BACKEND/select2/css/select2.css' ?>">
<link rel="stylesheet" href="<?php echo $base_url . 'assets/BACKEND/select2/css/select2-bootstrap.css' ?>">
<script type="text/javascript" src="<?php echo $base_url . 'assets/BACKEND/select2/select2.js' ?>"></script>


<?php // END OF ASSETS
  include 'includes/page_header.php'; // </head>
  include 'includes/page_topbar.php'; // TOPBAR
  
  //  USER ROLE
  include 'includes/role.php';
  
	$counter = 0;
	$cat = array();
	$userid = mysqli_real_escape_string($db, $_SESSION['userid']);
	$sql = "SELECT * FROM quiz_kategori WHERE dibuat_oleh = '$userid';";
	$result = mysqli_query($db, $sql);
	while ($row = mysqli_fetch_array($result)){
		array_push($cat,"<option value=\"".$row['id']."\">".$row['nama_kategori']."</option>");
		$counter++;
	}
	
	if($_SERVER["REQUEST_METHOD"] == "POST"){
		$quiz_nama = mysqli_real_escape_string($db, $_POST['name']);
		$waktu = mysqli_real_escape_string($db, $_POST['duration']);
		$idkategori = mysqli_real_escape_string($db, $_POST['classes']);
		$query = "INSERT INTO quiz (quizid, quiz_nama, waktu, idkategori, pengajarid) VALUES (NULL, '$quiz_nama', '$waktu', '$idkategori', '$userid');";
		$result = mysqli_query($db, $query);
		
		header("Location: ../quiz");
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
                            <li>
                                <a href="<?= $base_url . 'quiz' ?>">Quiz</a>
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
                                <form class="form-horizontal" role="form" method="post">

                                    <div class='form-group'>
                                        <label for="name" class="col-sm-2 control-label">
                                            Judul Quiz
                                            <span class="text-red">*</span>
                                        </label>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control" id="name" name="name" value="" placeholder="Judul Quiz">
                                        </div>
                                        <span class="col-sm-4 control-label">
                                        </span>
                                    </div>

                                    <div class="form-group">
                                        <label for="classes" class="col-sm-2 control-label">
                                            Kategori </label>
                                        <div class="col-sm-4">
                                            <div class="input-group">
                                                <select name="classes" id='classes' class='form-control select2'>
                                                    <?php
													foreach($cat as $categori){
														echo $categori;
													}
												?>
                                                </select>

                                                <span class="input-group-addon btn btn-danger">
                                                    <a href="<?php echo $base_url.'quiz/kategori-add'; ?>" </a>
                                                        <i class="fa fa-plus"></i>
                                                        Quick Add </a>
                                                </span>


                                            </div>
                                        </div>
                                        <span class="col-sm-2 control-label">
                                            <?php if($counter == 0){ $_SESSION['from'] = 'add-quiz'; echo 'Belum ada Koleksi Kategori Quiz,  <a href="'.$base_url.'quiz/kategori-add">Klik disini</a> untuk membuat kategori.';}?>
                                        </span>
                                        <span class="col-sm-4 control-label">
                                        </span>
                                    </div>

                                    <div class='form-group' id='durationDiv'>
                                        <label for="duration" class="col-sm-2 control-label">
                                            Durasi </label>
                                        <div class="col-sm-3">
                                            <input type="text" class="form-control" id="duration" name="duration" value="" placeholder="30" maxlength="3">
                                        </div>
                                        <label for="duration" class="col-sm-2 control-label">
                                            <b>Menit</b>
                                        </label>

                                        <span class="col-sm-4 control-label">
                                        </span>
                                    </div>

                                    



                                    <div class="form-group">
                                        <div class="col-sm-offset-2 col-sm-4">
                                            <?php
											if($counter > 0){
												echo '<input type="submit" class="btn btn-success btn-block margin-bottom" value="Simpan">';
											}else{
												echo '<input type="submit" class="btn btn-success btn-block margin-bottom" value="Simpan" disabled>';
											}
										?>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>


                <script type="text/javascript">
                    $(".select2").select2();
                    $('#dob').datepicker({
                        startView: 2
                    });

                    $('#classesID').change(function (event) {
                        var classesID = $(this).val();
                        if (classesID === '0') {
                            $('#sectionID').val(0);
                        } else {
                            $.ajax({
                                async: false,
                                type: 'POST',
                                url: "http://127.0.0.1/school/student/sectioncall",
                                data: "id=" + classesID,
                                dataType: "html",
                                success: function (data) {
                                    $('#sectionID').html(data);
                                }
                            });

                            $.ajax({
                                async: false,
                                type: 'POST',
                                url: "http://127.0.0.1/school/student/optionalsubjectcall",
                                data: "id=" + classesID,
                                dataType: "html",
                                success: function (data2) {
                                    $('#optionalSubjectID').html(data2);
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
                                img.attr('src', e.target.result);
                                $(".image-preview").attr("data-content", $(img)[0].outerHTML).popover(
                                    "show");
                                $('.content').css('padding-bottom', '100px');
                            }
                            reader.readAsDataURL(file);
                        });
                    });
                </script>

            </div>
        </div>
    </section>
</aside>




<?php 
    include 'includes/page_footer.php';
?>