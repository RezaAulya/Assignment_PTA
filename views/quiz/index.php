<!-- 
@TODO  
-->
<?php // PARSING 
    include 'app_config.php';
	include 'includes/session_functions.php';
	include 'includes/page_asset.php';
    $form_name ="Daftar Quiz";
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
  if($_SERVER["REQUEST_METHOD"] == "POST"){
	  if(isset($_POST['kelasid']) AND isset($_POST['quizid'])){
		  
	  }
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
                                <div class="col-sm-12">

                                    <h5 class="page-header">
                                        <a href="<?= $base_url . 'quiz/add' ?>">
                                            <i class="fa fa-plus"></i>
                                            Tambahkan Quiz </a>
                                    </h5>
                                    <div id="hide-table">
                                        <table id="example1" class="table table-striped table-bordered table-hover dataTable no-footer">
                                            <thead>
                                                <tr>
                                                    <th class="col-sm-1">#</th>
                                                    <th class="col-sm-3">Judul Quiz</th>
                                                    <th class="col-sm-3">Kategori</th>
                                                    <th class="col-sm-2">Durasi (menit)</th>
                                                    <th class="col-sm-2">Tindakan</th>
                                                </tr>
                                            </thead>
                                            <tbody>
											<?php
												$userid = $_SESSION['userid'];
												$sql = "SELECT * FROM quiz JOIN quiz_kategori ON quiz.idkategori = quiz_kategori.id WHERE pengajarid = '$userid';";
												$counter = 0;
												$result = mysqli_query($db, $sql);
												while ($row = mysqli_fetch_array($result)){
													$counter++;
													echo '<tr><td data-title="#">'.$counter.'</td>';
													echo '<td data-title="Judul Ujian">'.$row['quiz_nama'].'</td>';
													echo '<td data-title="Nama Kategori">'.$row['nama_kategori'].'</td>';
													echo '<td data-title="Durasi">'.$row['waktu'].'</td>';
													echo '<td data-title="Tindakan">';
													echo "<a href=\"".$base_url . "quiz/add-pertanyaan/".$row['quizid']."\" class='btn btn-primary btn-xs mrg' data-placement='top' data-toggle='tooltip'";
													echo "data-original-title='Tambahkan Pertanyaan kedalam Quiz ini'>";
													echo "<i class='fa fa-plus'></i></a>";
													echo "<a href=\"".$base_url . "quiz/pertanyaan-view/".$row['quizid']."\" class='btn btn-primary btn-xs mrg' data-placement='top' data-toggle='tooltip'";
													echo "data-original-title='Lihat Pertanyaan'>";
													echo "<i class='fa fa-check-square-o'></i></a>";
													echo "<a href=\"".$base_url . "quiz/edit/".$row['quizid']."\" class='btn btn-warning btn-xs mrg' data-placement='top' data-toggle='tooltip' data-original-title='Edit'><i class='fa fa-edit'></i></a>";
													echo "<a href=\"".$base_url . "quiz/delete/".$row['quizid']."\" onclick=\"return confirm('Apakah anda yakin akan menghapus quiz dan semua pertanyaan yang ada didalam quiz ini?')\"  class=\"btn btn-danger btn-xs mrg\" data-placement=\"top\" data-toggle=\"tooltip\"";
													echo "data-original-title=\"Menghapus\"><i class='fa fa-trash-o'></i></a></tr>";
												}
											?>
                                                
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