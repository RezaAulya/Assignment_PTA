<!-- 
@TODO  
-->

<?php // PARSING 
    include 'app_config.php';
	include 'includes/session_functions.php';
	include 'includes/page_asset.php';
    $form_name="Kelola Kelas";
?>
<!-- TITLE -->
<title> <?=$form_name?> </title>

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
                            <?= $form_name?>
                        </h3>


                        <ol class="breadcrumb">
                            <li>
                                <a href="dashboard">
                                    <i class="fa fa-laptop"></i>
                                    Dashboard
                                </a>
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
                                <h5 class="page-header">
                                    <a href="<?= $base_url . 'kelas-add' ?>">
                                        <i class="fa fa-plus"></i>
                                        Tambah Kelas 
                                    </a>
                                </h5>
                                <div id="hide-table">
                                    <table id="example1" class="table table-striped table-bordered table-hover dataTable no-footer">
                                        <thead>
                                            <tr>
                                                <th class="col-sm-1">#</th>
                                                <th class="col-sm-1">Nama Kelas</th>
                                                <th class="col-sm-3">Deskripsi Kelas</th>
                                                <th class="col-sm-3">Kode Kelas</th>
                                                <th class="col-sm-1">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                include 'includes/db.php';
                                                // QUERY Here !!
                                                $sql = "SELECT kelas.kelasid, kelas.kelas_nama, kelas.kelas_deskripsi, kelas.kelas_code FROM kelas";
												if($role == 2){
													$id = mysqli_real_escape_string($db, $_SESSION['userid']);
													$sql .= " WHERE kelas.dibuat_oleh = '$id'";
												}
												
                                                $x = 1;
                                                $result = mysqli_query($db, $sql);
                                                while ($row = mysqli_fetch_array($result)){
                                                    echo "<tr>
                                                            <td data-title='#'>" .$x++ ."</td>
                                                            <td data-title='#'>" .$row["kelas_nama"] ."</td>
                                                            <td data-title='#'>" .$row["kelas_deskripsi"] ."</td>
                                                            <td data-title='#'>" .$row["kelas_code"] ."</td>
                                                            <td data-title='#'>
                                                                <a href='kelas-view/" . $row["kelasid"] . "'class='btn btn-success btn-xs mrg' data-placement='top' 
                                                                    data-toggle='tooltip' data-original-title='Buka Aktifitas Kelas'><i class='fa fa-check-square-o'></i>
                                                                </a>
                                                                <a href='kelas-edit/" . $row["kelasid"] . " ' class='btn btn-warning btn-xs mrg' data-placement='top' 
                                                                    data-toggle='tooltip' data-original-title='Edit Kelas'><i class='fa fa-edit'></i>
                                                                </a>
                                                                
                                                                <a href='#' onclick='if(confirm(\"Apakah anda yakin akan menghapus kelas yang dipilih?\")){window.location.href = \"kelas-delete/" . $row["kelasid"] . "\";}' class='btn btn-danger btn-xs mrg' data-placement='top' 
                                                                    data-toggle='tooltip' data-original-title='Hapus Kelas'><i class='fa fa-trash-o'></i>
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