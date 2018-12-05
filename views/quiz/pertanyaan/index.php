<!-- 
@TODO  
-->
<?php // PARSING 
	ob_start();
	$get_id = $_SESSION['getId'];
    include 'app_config.php';
	include 'includes/session_functions.php';
	include 'includes/page_asset.php';
	include 'includes/db.php';
	
	$sql = "SELECT quiz.quiz_nama, quizinfo.quiz_nomor, quizinfo.quiz_soal, quizinfo.quiz_jawaban, quizinfo.quiz_jawaban_1, quizinfo.quiz_jawaban_2, quizinfo.quiz_jawaban_3, quizinfo.quiz_jawaban_4, quizinfo.quiz_jawaban_5 FROM quiz JOIN quizinfo ON quiz.quizid = quizinfo.quizid WHERE quiz.quizid = '$get_id';";
	$counter = 0;
	$result = mysqli_query($db, $sql);
	$header_name = "-";
	$pertanyaan = array();
	while($row = mysqli_fetch_array($result)){
		$header_name = $row['quiz_nama'];
		$data = "";
		array_push($pertanyaan, $data);
	}
		
	
    $form_name ="Daftar Pertanyaan ".$row[''];
?>

<!-- TITLE -->
<title>
    <?=$form_name?>
</title>

<!-- ADDITIONAL ASSETS BELOW (Optional) -->

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
                                <h5 class="page-header">
                                    <a href="<?= $base_url . 'quiz/bank-add' ?>">
                                        <i class="fa fa-plus"></i>
                                        Tambahkan Pertanyaan </a>
                                </h5>
                                <div id="hide-table">
                                    <table id="example1" class="table table-striped table-bordered table-hover dataTable no-footer">
                                        <thead>
                                            <tr>
                                                <th class="col-sm-1">#</th>
                                                <th class="col-sm-1">Kategori Quiz</th>
                                                <th class="col-sm-3">Pertanyaan</th>
                                                <th class="col-sm-1">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    1 </td>
                                                <td>
                                                    Aritmatika Dasar</td>
                                                <td>
                                                    Quiz </td>

                                                <td>
                                                    <a href="<?= $base_url . 'quiz/bank-view/1' ?>" class='btn btn-success btn-xs mrg' data-placement='top' data-toggle='tooltip'
                                                        data-original-title='View'>
                                                        <i class='fa fa-check-square-o'></i>
                                                    </a>
                                                    <a href="<?= $base_url . 'quiz/bank-edit/1' ?>" class='btn btn-warning btn-xs mrg'
                                                        data-placement='top' data-toggle='tooltip' data-original-title='Edit'>
                                                        <i class='fa fa-edit'></i>
                                                    </a>
                                                    <a href="#id" onclick="return confirm('are you sure?')"
                                                        class="btn btn-danger btn-xs mrg" data-placement="top" data-toggle="tooltip"
                                                        data-original-title="Delete">
                                                        <i class='fa fa-trash-o'></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
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