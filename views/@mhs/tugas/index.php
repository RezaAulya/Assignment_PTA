<!-- 
@TODO List yang ditampilkan berdasarkan dosen (WHERE userid),
-->
<?php // PARSING 
    include 'app_config.php';
	include 'includes/session_functions.php';
	include 'includes/page_asset.php';
    $form_name ="@Mahasiswa - Daftar Tugas";
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
                                
                                <div id="hide-table">
                                    <table id="example1" class="table table-striped table-bordered table-hover dataTable no-footer">
                                        <thead>
                                            <tr>
                                                <!-- <th class="col-sm-0">#</th> -->
                                                <th class="col-sm-3">Judul Tugas</th>
                                                <th class="col-sm-2">Deskripsi Tugas</th>
                                                <th class="col-sm-1">Kelas</th>
                                                <th class="col-sm-2">Deadline</th>
                                                <th class="col-sm-1">File</th>
                                                <th class="col-sm-2">Nilai</th>
                                                <th class="col-sm-2">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                include 'includes/db.php';
												$id = mysqli_real_escape_string($db, $_SESSION['userid']);
                                                // QUERY Here !!
                                                $sql = "SELECT tugasinfo.tugasinfoid, tugasinfo.nilai, tugasinfo.path_jawaban, tugas.nama_tugas, tugas.deskripsi, kelas.kelas_nama, tugasinfo.deadline, tugas.file_name FROM tugasinfo JOIN tugas ON tugasinfo.tugasid = tugas.tugasid JOIN kelas ON tugasinfo.kelasid = kelas.kelasid WHERE tugasinfo.userid = '$id';";
                                                $x = 1;
                                                
                                                $result = mysqli_query($db, $sql);
                                                while ($row = mysqli_fetch_array($result)){
													$link = "<a href='".$base_url."uploads/tugas/".$row['file_name']."' target='__blank' class='btn btn-success btn-xs mrg' data-placement='top' data-toggle='tooltip' data-original-title='Download'>Download</a>";
													$status = "Belum Mengumpulkan";
													$action = "<a href='".$base_url."mhs/tugas/view/" . $row["tugasinfoid"] . " ' class='btn btn-success btn-xs mrg' data-placement='top'
                                                                data-toggle='tooltip' data-original-title='Kumpulkan Tugas'><i class='fa fa-check-square-o'></i>
                                                            </a>";
															
													if($row['path_jawaban'] != ""){
                                                        echo $status = $row['nilai'];
                                                        if($status = $row['nilai'] ==-1){
                                                            $status = 'Menunggu Dosen';
                                                        }else{
                                                            $status = $row['nilai'];
                                                        }
													}
													
													$deadlineTime = strtotime($row['deadline']);
													$nowTime = strtotime(date("Y-m-d H:i:s"));
													$style = "";
													if($deadlineTime < $nowTime){
														$action = "Deadline";
														$style = " style=\"background-color: #ff00003b;\"";
													}
                                                    echo 
                                                    "<tr".$style.">
                                                        <td>".$row['nama_tugas']."</td>
                                                        <td>".$row['deskripsi']."</td>
                                                        <td>".$row['kelas_nama']."</td>
                                                        <td>".$row['deadline']."</td>
                                                        
                                                        <td data-title='File'>".$link."</td>
                                                    
														<td>".$status."</td>
														
                                                        <td>".$action."</td>


                                                    </tr>"; 
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