<!-- 
@TODO  
-->
<?php // PARSING 
    error_reporting(0);
	ob_start();
	$get_id = $_SESSION['getId'];
    include 'app_config.php';
	include 'includes/session_functions.php';
	include 'includes/page_asset.php';
	include 'includes/db.php';
	
	$userid = mysqli_real_escape_string($db, $_SESSION['userid']);
	$get_id = mysqli_real_escape_string($db, $get_id);
	$sql = "SELECT quiz_nama, waktu FROM quiz WHERE quizid = '$get_id' AND pengajarid = '$userid';";
	$result = mysqli_query($db, $sql);
    $ambil = mysqli_fetch_array($result);
	
    $form_name ="Edit Quiz - ".$ambil['quiz_nama'];
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
		$query = "UPDATE quiz SET quiz_nama = '$quiz_nama', waktu = '$waktu', idkategori = '$idkategori' WHERE quizid = '$get_id' AND pengajarid = '$userid';";
		$result = mysqli_query($db, $query);
		
		header("Location: ../");
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
                            <li><a href="<?= $base_url . 'quiz' ?>">Quiz</a></li>                            
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
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control" id="name" name="name" value="<?php echo $ambil['quiz_nama'];?>" placeholder="Judul Quiz">
                                        </div>
                                        <span class="col-sm-4 control-label">
                                        </span>
                                    </div>

									<div class='form-group'>
                                        <label for="classes" class="col-sm-2 control-label">
                                            Kategori </label>
											
                                        <div class="col-sm-6">
                                            <select name="classes" id='classes' class='form-control select2'>
												<?php
													foreach($cat as $categori){
														echo $categori;
													}
												?>
                                            </select>
											
                                        </div>
                                        <span class="col-sm-2 control-label"><?php if($counter == 0){ $_SESSION['from'] = 'add-quiz'; echo 'Anda belum menambahkan kategori. <a href="'.$base_url.'quiz/kategori-add">Klik disini</a> untuk menambahkan kategori.';}?>
                                        </span>
                                    </div>

                                    <div class='form-group' id='durationDiv'>
                                        <label for="duration" class="col-sm-2 control-label">
                                            Durasi  </label>
                                        <div class="col-sm-5">
                                            <input type="text" class="form-control" id="duration" name="duration" value="<?php echo $ambil['waktu'];?>" placeholder="30" maxlength="3">
                                        </div>
                                        <label for="duration" class="col-sm-2 control-label">
                                            Menit  </label>
                                        
                                        <span class="col-sm-4 control-label">
                                        </span>
                                    </div>



                                    <!--div class='form-group' id='enddateDiv'>
                                        <label for="enddate" class="col-sm-2 control-label">
                                            Batas Akhir Pengerjaan </label>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control" id="enddate" name="enddate" value="" placeholder="Tanggal Akhir">
                                        </div>
                                        <span class="col-sm-4 control-label">
                                        </span>
                                    </div-->

                                    <br>
                                    <br>
                                    <br>
                                    <br>
                                    <br>
                                    <br>
                                    <br>
                                    <br>
                                    <br>


                                    <div class="form-group">
                                        <div class="col-sm-offset-2 col-sm-6">
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
                
				
				<!--script type="text/javascript">
                    $('#description').jqte();
                    $('#type').change(function () {
                        var type = $(this).val();
                        if (type == 2) {
                            $('#startdatetimeDiv').hide();
                            $('#enddatetimeDiv').hide();
                            $('#startdateDiv').hide();
                            $('#enddateDiv').hide();
                        } else if (type == 4) {
                            $('#startdateDiv').show();
                            $('#enddateDiv').show();

                            $('#startdatetimeDiv').hide();
                            $('#enddatetimeDiv').hide();

                            $('#startdate').datetimepicker({
                                viewMode: 'years',
                                format: 'DD-MM-YYYY'
                            });
                            $('#enddate').datetimepicker({
                                viewMode: 'years',
                                format: 'DD-MM-YYYY'
                            });
                        } else if (type == 5) {
                            $('#startdatetimeDiv').show();
                            $('#enddatetimeDiv').show();

                            $('#enddateDiv').hide();
                            $('#startdateDiv').hide();

                            $('#startdatetime').datetimepicker({
                                viewMode: 'years',
                                format: 'DD-MM-YYYY hh:mm a'
                            });
                            $('#enddatetime').datetimepicker({
                                viewMode: 'years',
                                format: 'DD-MM-YYYY hh:mm a'
                            });
                        }
                    });
                    $(function () {
                        $('#startdateDiv').hide();
                        $('#enddateDiv').hide();
                        $('#startdatetimeDiv').hide();
                        $('#enddatetimeDiv').hide();
                        $('#validDaysDiv').hide();
                        $('#costDiv').hide();
                    });

                    $("#classes").change(function () {
                        var id = $(this).val();
                        if (parseInt(id)) {
                            if (id === '0') {
                                $('#sectionID').val(0);
                            } else {
                                $.ajax({
                                    type: 'POST',
                                    url: "http://127.0.0.1/school/online_exam/getSection",
                                    data: {
                                        "id": id
                                    },
                                    dataType: "html",
                                    success: function (data) {
                                        $('#section').html(data);
                                    }
                                });

                                $.ajax({
                                    type: 'POST',
                                    url: "http://127.0.0.1/school/online_exam/getSubject",
                                    data: {
                                        "classID": id
                                    },
                                    dataType: "html",
                                    success: function (data) {
                                        $('#subject').html(data);
                                    }
                                });
                            }
                        }
                    });
                </script-->
            </div>
        </div>
    </section>
</aside>




<?php 
    include 'includes/page_footer.php';
?>