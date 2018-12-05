<!-- 
@TODO  
-->
<?php // PARSING 
    include 'app_config.php';
    $form_name ="JUDUL FORM";
?>
<?php // CEK SESSION
    session_start();
    if(!isset($_SESSION['username'])){
		header("location: homepage");
    }
// LOAD MAIN ASSETS   
  include 'includes/page_asset.php';
?>
<!-- TITLE -->
<title> <?=$form_name?> </title>

<!-- ADDITIONAL ASSETS BELOW (Optional) -->

<?php // END OF ASSETS
  include 'includes/page_header.php'; // </head>
  include 'includes/page_topbar.php'; // TOPBAR

//  USER ROLE
	$role = 0;
	switch (strtolower($_SESSION['role'])) {
	case "admin":
	$role = 1;
	include 'includes/side_menu_admin.php';
	break;
	case "pengajar":
	$role = 2;
	include 'includes/side_menu_dosen.php';
	break;
	case "mahasiswa":
	$role = 3;
	include 'includes/side_menu_mhs.php';
	break;
	default:
	header("location: homepage");
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
                                    <p>-- BEGIN HERE -- </p>

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