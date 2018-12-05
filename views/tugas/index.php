<!-- 
@TODO List yang ditampilkan berdasarkan dosen (WHERE userid),
-->
<?php // PARSING 
    include 'app_config.php';
	include 'includes/session_functions.php';
	include 'includes/page_asset.php';
    $form_name ="Tugas";
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
                                                <th>#</th>
                                                <th>Judul Tugas</th>
                                                <th>Deskripsi Tugas</th>
                                                <th>Aktif di Kelas</th>
                                                <th>Deadline</th>
                                                <th>File</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                include 'includes/db.php';
												$id = mysqli_real_escape_string($db, $_SESSION['userid']);
                                                // QUERY Here !!
                                                $sql = "SELECT tugas.tugasid, tugas.nama_tugas, tugas.deskripsi, tugas.file_name, IFNULL(tugasinfo.deadline, '-') AS deadline, IFNULL(kelas.kelas_nama, '-') AS kelas_nama FROM tugas LEFT JOIN tugasinfo ON tugas.tugasid = tugasinfo.tugasid LEFT JOIN kelas ON tugasinfo.kelasid = kelas.kelasid WHERE tugas.pengajarid = '$id' GROUP BY tugas.tugasid;";
                                                $x = 1;
                                                $confirm ="Apakah Kamu yakin ingin menghapus data ini?";
                                                $result = mysqli_query($db, $sql);
                                                while ($row = mysqli_fetch_array($result)){
                                                    echo 
                                                    "<tr>
                                                        <td>".$x++ ."</td>
                                                        <td>".$row['nama_tugas']."</td>
                                                        <td>".$row['deskripsi']."</td>                                                                
                                                        <td>".$row['kelas_nama']."</td>                                                                
                                                        <td>".$row['deadline']."</td>                                                                
                                                        <td data-title='File'>
                                                            <a href='".$base_url."uploads/tugas/".$row['file_name']."' class='btn btn-success btn-xs mrg' data-placement='top' data-toggle='tooltip'
                                                                data-original-title='Download'>Download File</a>
                                                        </td>
                                                    
                                                        <td>
                                                            <a href='tugas-view/" . $row["tugasid"] . " ' class='btn btn-success btn-xs mrg' data-placement='top' 
                                                                data-toggle='tooltip' data-original-title='Lihat Yang Sudah Mengumpulkan Tugas'><i class='fa fa-check-square-o'></i>
                                                            </a>
															<a href='tugas-delete/" . $row["tugasid"] . " ' onclick='return confirm(\"Anda yakin untuk menghapus tugas ini?\");'
                                                                class='btn btn-danger btn-xs mrg' data-placement='top' data-toggle='tooltip'
                                                                data-original-title='Delete'>
                                                                <i class='fa fa-trash-o'></i>
                                                            </a>
                                                
                                                        </td>


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