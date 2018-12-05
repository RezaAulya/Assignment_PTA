<?php // PARSING
    include 'app_config.php';
	include 'includes/session_functions.php';
	include 'includes/page_asset.php';
	ob_start();
	$form_name ="Edit Profil";
?>
<!-- TITLE -->
<title> <?=$form_name?> </title>

<!-- ADDITIONAL ASSETS BELOW (Optional) -->
<link type="text/css" rel="stylesheet" href="<?= $base_url . 'assets/BACKEND/datepicker/datepicker.css '?>">
<script type="text/javascript" src="<?php echo $base_url . 'assets/BACKEND/datepicker/datepicker.js' ?>"></script>

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

                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">
                                <i class="fa icon-teacher"></i>Edit Profil</h3>


                            <ol class="breadcrumb">
                                <li>
                                    <a href="<?= $base_url . 'dashboard' ?>">
                                        <i class="fa fa-laptop"></i> Dashboard</a>
                                </li>
                                <li>
                                    <a href="<?= $base_url . 'profile' ?>">Edit Profil</a>
                                </li>
                                <li class="active">Edit Profile</li>
                            </ol>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->

                        <?php 
                            include 'includes/db.php';
                            // QUERY Here !!
                            $id = mysqli_real_escape_string($db, $_SESSION['userid']);
							$sql = "";
							
							if($role == 1){
								$sql = "SELECT admin.id, admin.username, admin.nama_lengkap, admin.email FROM admin WHERE admin.id ='$id';";
							}elseif($role == 2){
								$sql = "SELECT dosen.id, dosen.username, dosen.nama_lengkap, dosen.email, dosen.phone, dosen.bidang_ahli FROM dosen WHERE dosen.id ='$id';";
							}elseif($role == 3){
								$sql = "SELECT mahasiswa.id, mahasiswa.username, mahasiswa.nama_lengkap, mahasiswa.email, mahasiswa.phone, mahasiswa.nim FROM mahasiswa WHERE mahasiswa.id ='$id';";
							}
							
                            $result = mysqli_query($db, $sql);
                            $ambil = mysqli_fetch_array($result);
							
							//update DB
							if($_SERVER["REQUEST_METHOD"] == "POST"){
								$nama_lengkap = $_POST['nama_lengkap'];
								$email = $_POST['email'];
								$phone = $_POST['phone'];
								$photo = $_FILES['photo'];
								
								$query = "";
								if($role == 1){
									$query = "UPDATE admin SET ";
								}elseif($role == 2){
									$query = "UPDATE dosen SET ";
								}elseif($role == 3){
									$query = "UPDATE mahasiswa SET ";
								}
								
								$modifierid = $_SESSION['userid'];
								$description = 'Mengganti ';
								$type = 0;
								
								
								//photo
								if(isset($_FILES['photo'])){
									if(empty($_FILES['photo']['name'])==false){
										$errors = array();
										$file_name = $_FILES['photo']['name'];
										$tampungFileName = explode('.', $file_name);
										
										$file_ext=strtolower($tampungFileName[(count($tampungFileName)-1)]);
										$jpg_name = md5($ambil["username"]).$id.'.'.$file_ext;
										$file_size =$_FILES['photo']['size'];
										$file_tmp =$_FILES['photo']['tmp_name'];
										$file_type=$_FILES['photo']['type'];
										
										$expensions= array("jpeg", "jpg", "png", "gif");
										
										if(in_array($file_ext,$expensions)=== false){
											$errors[]="File yang anda masukkan tidak valid.";
											exit;
										}
										
										if($file_size > 1048576){
											$errors[]='Ukuran foto tidak boleh lebih dari 1 MB.';
											exit;
										}
										
										
										if(empty($errors)==true){
											for ($i = 0; $i < count($expensions); $i++){
												$f = md5($_SESSION["username"]).$_SESSION['userid'].'.'.$expensions[$i];
												if(file_exists('uploads/users/'.$f)){
													unlink("uploads/users/".$f);
												}
											}
											
											move_uploaded_file($file_tmp, "uploads/users/".$jpg_name);
											$_SESSION['nama_lengkap'] = $nama_lengkap;
											$_SESSION['useremail'] = $email;
											
											$expensions= array("jpeg", "jpg", "png", "gif");
											
											$found = false;
											for ($i = 0; $i < count($expensions); $i++){
												$f = md5($_SESSION["username"]).$_SESSION['userid'].'.'.$expensions[$i];
												if(file_exists('uploads/users/'.$f)){
													$_SESSION['photo'] = $base_url.'uploads/users/'.$f;
													$found = true;
													break;
												}
											}
											if(!$found){
												$_SESSION['photo'] = $base_url . '/uploads/images/default.png';
											}
											
											$description .= 'foto profil, ';
										}else{
											print_r($errors);
											exit;
										}
									}
								}
								
								if($nama_lengkap !== $ambil['nama_lengkap']){
									$prm = mysqli_real_escape_string($db, $nama_lengkap);
									$query.= "nama_lengkap = '$prm', ";
									$description .= 'nama lengkap ke '.$prm.', ';
								}
								
								if($email !== $ambil['email']){
									$prm = mysqli_real_escape_string($db, $email);
									$query.= "email = '$prm', ";
									$description .= 'email ke '.$prm.', ';
								}
								
								if($role == 3){
									if($nim !== $ambil['nim']){
										$prm = mysqli_real_escape_string($db, $_POST['nim']);
										$query.= "nim = '$prm', ";
										$description .= 'nim ke '.$prm.', ';
									}
								}
								
								if(($role == 2) || ($role == 3)){
									if($phone !== $ambil['phone']){
										$prm = mysqli_real_escape_string($db, $_POST['phone']);
										$query.= "phone = '$prm', ";
										$description .= 'phone ke '.$prm.', ';
									}
									
								}
								$query.= "WHERE id = '$id';";
								
								if (strpos($query, ', WHERE ') !== false) {
									$query = str_replace(', WHERE ', ' WHERE ', $query);
								}else{
									echo $query;
									header('Location: profile'); //tamper ato error ato ngapain lah.
									exit;
								}
								
								$hasil = mysqli_query($db, $query);
								
								//Add Log
								$queryLog = "INSERT INTO log_users_modify (id, userid, description, modifierid, date_modify, type) VALUES (NULL, '$id', '$description', '$modifierid', CURRENT_TIMESTAMP, '$type');";
								$addLog = mysqli_query($db, $queryLog);

								//Jika sudah update clear variabel $_SESSION['getId']
								unset($_SESSION['getId']);
								header('Location: profile');
								exit;
							}
							
                        ?>

                        <div class="box-body">
                            <div class="row">
                                <div class="col-sm-10">
                                    <form class="form-horizontal" role="form" method="post" enctype="multipart/form-data">

										<div class='form-group'>
                                            <label for="username" class="col-sm-2 control-label">
                                                Username </label>
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control" id="username" name="username" disabled value="<?php echo $ambil['username']?> ">
                                            </div>
                                            <span class="col-sm-4 control-label">
                                            </span>
                                        </div>
										
                                        <div class='form-group'>
                                            <label for="nama_lengkap" class="col-sm-2 control-label">
                                                Nama Lengkap </label>
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" value="<?php echo $ambil['nama_lengkap']?>">

                                            </div>
                                            <span class="col-sm-4 control-label">
                                            </span>
                                        </div>
                                        <?php 
                                            if($role == 3){
                                        ?>
                                         <div class='form-group'>
                                            <label for="nama_lengkap" class="col-sm-2 control-label">
                                                <b>NIM</b> </label>
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control" id="nim" name="nim" value="<?php echo $ambil['nim']?>">

                                            </div>
                                            <span class="col-sm-4 control-label">
                                            </span>
                                        </div>
                                        <?php }?>

                                        <div class='form-group'>
                                            <label for="email" class="col-sm-2 control-label">
                                                Email </label>
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control" id="email" name="email" value="<?php echo $ambil['email']?>">
                                            </div>
                                            <span class="col-sm-4 control-label">
                                            </span>
                                        </div>

                                        

                                        <div class='form-group'>
                                            <label for="phone" class="col-sm-2 control-label">
                                                No. handphone </label>
                                            <div class="col-sm-6">
												<?php 
													if ($role == 1){
														echo '<input readonly type="text" class="form-control" id="phone" name="phone" value="-">';
													}else{
														echo '<input type="text" class="form-control" id="phone" name="phone" value="'.$ambil['phone'].'">';
													}
												?>
                                                
                                            </div>
                                            <span class="col-sm-4 control-label">
                                            </span>
                                        </div>

                                        <div class='form-group'>
                                            <label for="photo" class="col-sm-2 control-label">
                                                Photo </label>
                                            <div class="col-sm-6">
                                                <div class="input-group image-preview">
                                                    <input type="text" class="form-control image-preview-filename" disabled="disabled">
                                                    <span class="input-group-btn">
                                                        <button type="button" class="btn btn-default image-preview-clear" style="display:none;">
                                                            <span class="fa fa-remove"></span>
                                                            Clear </button>
                                                        <div class="btn btn-success image-preview-input">
                                                            <span class="fa fa-repeat"></span>
                                                            <span class="image-preview-input-title">
                                                                File Browse</span>
                                                            <input type="file" accept="image/png, image/jpeg, image/gif" name="photo" />
                                                        </div>
                                                    </span>
                                                </div>
                                            </div>

                                            <span class="col-sm-4">
                                            </span>
                                        </div>

                                        

                                        <div class="form-group">
                                            <div class="col-sm-offset-2 col-sm-8">
                                                <input type="submit" class="btn btn-success" value="Update Data ">
                                            </div>
                                        </div>

                                    </form>
                                </div>
                                <!-- col-sm-8 -->
                            </div>
                        </div>
                    </div>

                <!-- JS -->
                <script type="text/javascript">
                $('#jod').datepicker();

                $(document).on('click', '#close-preview', function(){ 
                    $('.image-preview').popover('hide');
                    // Hover befor close the preview

                    $('.image-preview').hover(
                        function () {
                        $('.image-preview').popover('show');
                        $('.content').css('padding-bottom', '120px');
                        }, 
                        function () {
                        $('.image-preview').popover('hide');
                        $('.content').css('padding-bottom', '20px');
                        }
                    );    
                });

                $(function() {
                    // Create the close button
                    var closebtn = $('<button/>', {
                        type:"button",
                        text: 'x',
                        id: 'close-preview',
                        style: 'font-size: initial;',
                    });
                    closebtn.attr("class","close pull-right");
                    // Set the popover default content
                    $('.image-preview').popover({
                        trigger:'manual',
                        html:true,
                        title: "<strong>Preview</strong>"+$(closebtn)[0].outerHTML,
                        content: "There's no image",
                        placement:'bottom'
                    });
                    // Clear event
                    $('.image-preview-clear').click(function(){
                        $('.image-preview').attr("data-content","").popover('hide');
                        $('.image-preview-filename').val("");
                        $('.image-preview-clear').hide();
                        $('.image-preview-input input:file').val("");
                        $(".image-preview-input-title").text("File Browse");
                    }); 
                    // Create the preview image
                    $(".image-preview-input input:file").change(function (){     
                        var img = $('<img/>', {
                            id: 'dynamic',
                            width:250,
                            height:200,
                            overflow:'hidden'
                        });      
                        var file = this.files[0];
                        var reader = new FileReader();
                        // Set preview image into the popover data-content
                        reader.onload = function (e) {
                            $(".image-preview-input-title").text("File Browse");
                            $(".image-preview-clear").show();
                            $(".image-preview-filename").val(file.name);            
                            img.attr('src', e.target.result);
                            $(".image-preview").attr("data-content",$(img)[0].outerHTML).popover("show");
                            $('.content').css('padding-bottom', '120px');
                        }        
                        reader.readAsDataURL(file);
                    });  
                });
                </script>



                </div>
            </div>
        </section>
    </aside>

<?php 
include 'includes/page_footer.php';
?>