<!-- 
@TODO  
-->
<?php // PARSING 
    include 'app_config.php';
	include 'includes/session_functions.php';
	include 'includes/page_asset.php';
    $form_name ="Tabel Dosen";
    
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
                                                <th class="col-sm-1">#</th>
                                                <th class="col-sm-2">Nama Lengkap</th>
                                                <th class="col-sm-2">Foto Dosen</th>
                                                <th class="col-sm-1">Email</th>
                                                <th class="col-sm-2">Bidang Ahli</th>
                                                <th class="col-sm-2">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                include 'includes/db.php';

                                                // QUERY Here !!
                                                $sql = "SELECT dosen.id, dosen.username, dosen.nama_lengkap, dosen.email, IFNULL(bidang_ahli, '-') as bidang_ahli, created_on FROM dosen;";
												
												$expensions= array("jpeg", "jpg", "png", "gif");
                                                $x = 1;
                                                $result = mysqli_query($db, $sql);
                                                while ($row = mysqli_fetch_array($result)){
													$photoPath = $base_url.'uploads/images/default.png';
													
													for($i = 0; $i<count($expensions); $i++){
														
														if(file_exists('uploads/users/'.md5($row["username"]).$row["id"].'.'.$expensions[$i])){
															$photoPath = $base_url.'uploads/users/'.md5($row["username"]).$row["id"].'.'.$expensions[$i];
															break;
														}
													}
													
                                                    echo
                                                        "<tr>
                                                        <td>".$x++ ."</td>
                                                        <td>".$row["nama_lengkap"]."</td>
                                                        <td align=center><img src=".$photoPath." width=64px/></td>
                                                        <td>".$row["email"]. "</td>                                                 
                                                        <td>".$row["bidang_ahli"]. "</td>                                                 

                                                        <td>
                                                        <a href='dosen-view/" . $row["id"] . " ' class='btn btn-success btn-xs mrg' data-placement='top' 
                                                        data-toggle='tooltip' data-original-title='View'><i class='fa fa-check-square-o'></i>
                                                        </a>

                                                        <a href='dosen-edit/" . $row["id"] . " ' class='btn btn-warning btn-xs mrg' data-placement='top' 
                                                        data-toggle='tooltip' data-original-title='Edit'><i class='fa fa-edit'></i>
                                                        </a>

                                                        <a href='#' onclick='if(confirm(\"Apakah anda yakin akan menghapus dosen yang dipilih?\")){window.location.href = \"dosen-delete/" . $row["id"] . "\";}' class='btn btn-danger btn-xs mrg' data-placement='top' 
                                                        data-toggle='tooltip' data-original-title='Delete'><i class='fa fa-trash-o'></i>
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