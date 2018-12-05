<?php // PARSING
    $get_id = $_SESSION['getId'];
    include 'app_config.php';
	include 'includes/session_functions.php';
	include 'includes/page_asset.php';
	include 'includes/db.php';
	
	$sql = "SELECT nama_tugas FROM tugas WHERE tugasid = '$get_id';";
	$result = mysqli_query($db, $sql);
	$ambil = mysqli_fetch_array($result);
	
	$form_name ='Tugas - ' . $ambil['nama_tugas'];
	include 'includes/page_asset.php';
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
                                <a href="<?= $base_url . 'dashboard' ?>">
                                    <i class="fa fa-laptop"></i> Dashboard</a>
                            </li>
                            <li>
                                <a href="<?= $base_url . 'tugas' ?>">Kelola Tugas</a>
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

                                <div id="hide-table">
                                    <table id="example1" class="table table-striped table-bordered table-hover dataTable no-footer">
                                        <thead>
                                            <tr>
                                                <th>Nama Mahasiswa</th>
                                                <th>Status</th>
                                                <th>Jawaban</th>
                                                <th>Nilai</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <!-- LOOPING DATA BEGIN HERE  -->
                                            <?php
                                                include 'includes/db.php';
                                                $userid = mysqli_real_escape_string($db, $_SESSION['userid']);
                                                $sql = "SELECT tugasinfo.nilai, tugasinfo.tugasinfoid, mahasiswa.nama_lengkap, tugasinfo.path_jawaban FROM tugasinfo JOIN mahasiswa ON tugasinfo.userid = mahasiswa.id WHERE tugasinfo.tugasid = '$get_id'";
                                                $_SESSION['back_input'] = $base_url.'tugas-view/'.$get_id;
                                                $result = mysqli_query($db, $sql);
                                                $counter = 0;
                                                while ($row = mysqli_fetch_array($result)){
                                                    $nilai = $row['nilai'];
                                                    if($nilai == -1){
                                                        $nilai = "-";
                                                    }
                                                    
                                                    if($row['path_jawaban'] === NULL){
                                                        echo '<tr style="color: red;"><td>'.$row['nama_lengkap'].'</td><td><font color="red">Belum mengumpulkan</font></td><td>-</td><td>-</td><td>-</td></tr>';
                                                    }else{
                                                        $path = $row['path_jawaban'];
                                                        echo '<tr style="color: green;"><td>'.$row['nama_lengkap'].'</td><td><font color="green"><b>Sudah mengumpulkan</b></font></td><td><a href='.$base_url.$path.'>Download jawaban</td><td>'.$nilai.'</td><td><a href="'.$base_url.'tugas-nilai/'.$row['tugasinfoid'].'">Input Nilai</a></td></tr>';
                                                    }
                                                    
                                                    $counter++;
                                                    if($counter == 7){
                                                        break;
                                                    }
                                                }
                                            ?>
                                        </tbody>
                                    </table>
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
        </div>
    </section>
</aside>

<!-- JS -->

<?php 
    include 'includes/page_footer.php';
?>