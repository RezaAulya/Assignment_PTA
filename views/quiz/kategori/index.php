<!-- 
@TODO  
-->
<?php // PARSING 
    include 'app_config.php';
	include 'includes/session_functions.php';
	include 'includes/page_asset.php';
    $form_name ="Kategori Quiz";
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
                                    <a href="<?= $base_url . 'quiz/kategori-add' ?>">
                                        <i class="fa fa-plus"></i>
                                        Tambah Kategori Quiz 
                                    </a>
                                </h5>
                                <div id="hide-table">
                                    <table id="example1" class="table table-striped table-bordered table-hover dataTable no-footer">
                                        <thead>
                                            <tr>
                                                <th class="col-sm-1">#</th>
                                                <th class="col-sm-4">Judul Kategori</th>
                                                <th class="col-sm-1">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                include 'includes/db.php';

                                                // QUERY Here !!
												$userid = $_SESSION['userid'];
                                                $sql = "SELECT * FROM quiz_kategori WHERE dibuat_oleh = '$userid';";
                                                $x = 1;
                                                $result = mysqli_query($db, $sql);
                                                while ($row = mysqli_fetch_array($result)){
                                                    echo 
                                                    "<tr>
                                                        <td>".$x++ ."</td>
                                                        <td>" .$row["nama_kategori"] ."</td>
                                                        <td>
                                                            <a href='" . $base_url ."quiz/kategori-edit/" . $row["id"] . " ' class='btn btn-warning btn-xs mrg' data-placement='top' 
                                                                data-toggle='tooltip' data-original-title='Edit Kategori'><i class='fa fa-edit'></i>
                                                            </a>
                                                            <a href='kategori-delete/" . $row["id"] . "' onclick=\"return confirm('Apakah anda yakin akan menghapus kategori quiz ini?');\"class='btn btn-danger btn-xs mrg' data-placement='top' 
                                                                data-toggle='tooltip' data-original-title='Hapus Kategori'><i class='fa fa-trash-o'></i>
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
                </div>
            </div>
    </section>
</aside>



<?php 
    include 'includes/page_footer.php';
?>