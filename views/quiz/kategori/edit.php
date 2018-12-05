<?php // PARSING 
    $get_id = $_SESSION['getId'];
	ob_start();
    include 'app_config.php';
	include 'includes/session_functions.php';
	include 'includes/page_asset.php';
	include 'includes/db.php';
	
	$userid = mysqli_real_escape_string($db, $_SESSION['userid']);
	$get_id = mysqli_real_escape_string($db, $get_id);
	$sql = "SELECT nama_kategori FROM quiz_kategori WHERE dibuat_oleh = '$userid' AND id = '$get_id'";
    $result = mysqli_query($db, $sql);
    $row = mysqli_fetch_array($result);
	$nama_header = $row['nama_kategori'];
	$form_name = "Edit Kategori - ".$nama_header;
	
?>

<!-- TITLE -->
<title> <?=$form_name?> </title>

<!-- ADDITIONAL ASSETS BELOW (Optional) -->

<?php // END OF ASSETS
  include 'includes/page_header.php'; // </head>
  include 'includes/page_topbar.php'; // TOPBAR

  //  USER ROLE
  include 'includes/role.php';
  
  if($_SERVER["REQUEST_METHOD"] == "POST"){
	
  	$nama_kategori = mysqli_real_escape_string($db, $_POST['title']);
  	$query = "UPDATE quiz_kategori SET nama_kategori = '$nama_kategori' WHERE quiz_kategori.id = '$get_id' AND dibuat_oleh = '$userid';";
  	$result = mysqli_query($db, $query);
  	
  	header("Location: ../../quiz/kategori");
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
                                <a href="<?= $base_url . 'dashboard' ?>">
                                    <i class="fa fa-laptop"></i> Dashboard</a>
                            </li>
                            <li>
                                <a href="<?= $base_url . 'quiz/kategori' ?>">Kategori</a>
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
                                <form class="form-horizontal" role="form" method="post">
                                    <div class='form-group'>
                                        <label for="title" class="col-sm-2 control-label">
                                            Judul Kategori
                                            <span class="text-red">*</span>
                                        </label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="title" name="title" placeholder="Ex : Pemograman Jaringan" value="<?= $nama_header?>">
                                        </div>
                                        <span class="col-sm-4 control-label">
                                        </span>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-sm-offset-2 col-sm-8">
                                            <input type="submit" class="btn btn-success" value="Update Ketegori">
                                        </div>
                                    </div>
                                </form>
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