<!-- 
@TODO  
-->
<?php // PARSING 
    include 'app_config.php';
	include 'includes/session_functions.php';
	include 'includes/page_asset.php';
    $form_name ="Ganti Password";
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
  include 'includes/db.php';
  $messages = '';
  if($_SERVER["REQUEST_METHOD"] == "POST"){
	$oldPwd = mysqli_real_escape_string($db, $_POST['old_password']);
	$id = mysqli_real_escape_string($db, $_SESSION['userid']);
	
	$sql = "";
	if($role == 1){
		$sql = "SELECT admin.id FROM admin WHERE admin.id = '$id' AND admin.password = MD5('$oldPwd');";
	}elseif($role == 2){
		$sql = "SELECT dosen.id FROM dosen WHERE dosen.id = '$id' AND dosen.password = MD5('$oldPwd');";
	}elseif($role == 3){
		$sql = "SELECT mahasiswa.id FROM mahasiswa WHERE mahasiswa.id = '$id' AND mahasiswa.password = MD5('$oldPwd');";
	}
	
	$result = mysqli_query($db, $sql);
	$count = mysqli_num_rows($result);
	if($count == 1){
		$newPwd = mysqli_real_escape_string($db, $_POST['new_password']);
		$confirmNewPwd = mysqli_real_escape_string($db, $_POST['re_password']);
		if($newPwd === $confirmNewPwd){
			$query = "";
			
			if($role == 1){
				$query = "UPDATE admin SET admin.password = MD5('$newPwd') WHERE admin.id = '$id';";
			}elseif($role == 2){
				$query = "UPDATE dosen SET dosen.password = MD5('$newPwd') WHERE dosen.id = '$id';";
			}elseif($role == 3){
				$query = "UPDATE mahasiswa SET mahasiswa.password = MD5('$newPwd') WHERE mahasiswa.id = '$id';";
			}
			
			$result = mysqli_query($db, $query);
			$messages = 'Password anda telah berhasil diubah';
		}else{
			$messages = 'Password baru yang anda masukkan tidak sama!';
		}
	}else{
		$messages = 'Password lama yang anda masukkan salah!';
	}
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
							<div class="col-sm-8"">
								<p><?php echo $messages; ?></p>
							</div>
						</div>
                        <div class="row">
                        
                            <div class="col-sm-8">

                                <form class="form-horizontal" role="form" method="post">

                                    <div class='form-group'>
                                        <label for="old_password" class="col-sm-2 control-label">
                                            Old Password </label>
                                        <div class="col-sm-6">
                                            <input type="password" class="form-control" id="old_password" name="old_password">
                                        </div>
                                        <span class="col-sm-4 control-label">
                                        </span>
                                    </div>

                                    <div class='form-group'>
                                        <label for="new_password" class="col-sm-2 control-label">
                                            New Password </label>
                                        <div class="col-sm-6">
                                            <input type="password" class="form-control" id="new_password" name="new_password">
                                        </div>
                                        <span class="col-sm-4 control-label">
                                        </span>
                                    </div>

                                    <div class='form-group'>
                                        <label for="re_password" class="col-sm-2 control-label">
                                            Re-Password </label>
                                        <div class="col-sm-6">
                                            <input type="password" class="form-control" id="re_password" name="re_password">
                                        </div>
                                        <span class="col-sm-4 control-label">
                                        </span>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-sm-offset-2 col-sm-6">
                                            <input type="submit" class="btn btn-warning btn-block " value="Ganti Password">
                                        </div>
                                    </div>

                                </form>
                            </div>
                            <!-- col-sm-8 -->

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