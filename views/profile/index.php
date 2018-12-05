<?php // PARSING
    include 'app_config.php';
	include 'includes/session_functions.php';
	include 'includes/page_asset.php';
?>

<!-- TITLE -->
<title> Profile </title>

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

                <div class="well">
                    <div class="row">
                        <div class="col-sm-6">
                            <button class="btn-cs btn-sm-cs" onclick="javascript:printDiv('printablediv')">
                                <span class="fa fa-print"></span> Print </button>

                            <a href="profile-edit" class='btn-cs btn-sm-cs' style='text-decoration: none;' role='button'>
                                <i class='fa fa-edit'></i> Edit Profile</a>
                            <a href="profile-cpass" class='btn-cs btn-sm-cs' style='text-decoration: none;' role='button'>
                                <i class='fa fa-lock'></i> Ganti Password</a>
                        </div>

                        <div class="col-sm-6">
                            <ol class="breadcrumb">
                                <li>
                                    <a href="<?= $base_url . 'dashboard' ?>">
                                        <i class="fa fa-laptop"></i> Dashboard</a>
                                </li>
                                <li class="active">Profil Saya</li>
                            </ol>
                        </div>
                    </div>
                </div>

                <?php 
                        include 'includes/db.php';
                        // QUERY Here !!
                        $id = mysqli_real_escape_string($db, $_SESSION['userid']);
						$query = "";
						switch($role){
							case 1:
								$query = "SELECT admin.username, admin.nama_lengkap, admin.email, DATE_FORMAT(admin.created_on, '%a, %d %M %Y') AS join_date FROM admin WHERE admin.id = '$id'";
								break;
							case 2:
								$query = "SELECT dosen.username, dosen.nama_lengkap, dosen.email, DATE_FORMAT(dosen.created_on, '%a, %d %M %Y') AS join_date, dosen.bidang_ahli, dosen.phone FROM dosen WHERE dosen.id = '$id'";
								break;
							case 3:
								$query = "SELECT mahasiswa.username, mahasiswa.nama_lengkap, mahasiswa.email, mahasiswa.nim, mahasiswa.phone,  DATE_FORMAT(mahasiswa.created_on, '%a, %d %M %Y') AS join_date FROM mahasiswa WHERE mahasiswa.id = '$id'";
								break;
						}
                        
                        $result = mysqli_query($db, $query);
                        $ambil = mysqli_fetch_array($result);
						
                    ?>

                <div id="printablediv">
                    <section class="panel">
                        <div class="profile-view-head">
                            <a href="#">
                                <img src="<?= $_SESSION['photo'] ?>" alt="" /> </a>

                            <?php 
                                        echo '<h1>' . $ambil['nama_lengkap'] .'</h1>';
										if($role == 2){
											echo '<p>' . $ambil['bidang_ahli'] .'</p>';
										}elseif($role == 3){
											echo '<p>' . $ambil['nim'] .'</p>';
										}
									?>
                        </div>

                        <div class="panel">
                            <div class="box">
                                <div class="box-header" style="background-color: #fff;">
                                    <h2 class="box-title text-black">
                                        <b>Personal Information</b>
                                    </h2>
                                </div>
                                <div class="box-body" style="padding: 0px;">
                                    <table class="table table-hover">
                                        <tbody>
                                            <tr>
                                                <td>Nama Lengkap</td>
                                                <td>
                                                    <?php echo ': ' .$ambil['nama_lengkap'] ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Email</td>
                                                <td>
                                                    <?php echo ': ' .$ambil['email'] ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Tanggal Join</td>
                                                <td>
                                                    <?php echo ': ' .$ambil['join_date'] ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>No. Hp</td>
                                                <td>
                                                    <?php 
														if($role !== 1){
															echo ': ' .$ambil['phone'];
														}else{
															echo ': -';
														}
													?>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </section>
</aside>










<script language="javascript" type="text/javascript">
    function printDiv(divID) {
        //Get the HTML of div
        var divElements = document.getElementById(divID).innerHTML;
        //Get the HTML of whole page
        var oldPage = document.body.innerHTML;

        //Reset the page's HTML with div's HTML only
        document.body.innerHTML =
            "<html><head><title></title></head><body>" +
            divElements + "</body>";

        //Print Page
        window.print();

        //Restore orignal HTML
        document.body.innerHTML = oldPage;
    }

    function closeWindow() {
        location.reload();
    }

    function check_email(email) {
        var status = false;
        var emailRegEx = /^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}$/i;
        if (email.search(emailRegEx) == -1) {
            $("#to_error").html('');
            $("#to_error").html("The To field must contain a valid email address.").css(
                "text-align", "left").css(
                "color", 'red');
        } else {
            status = true;
        }
        return status;
    }


    $("#send_pdf").click(function () {
        var to = $('#to').val();
        var subject = $('#subject').val();
        var message = $('#message').val();
        var id = "2";
        var error = 0;

        if (to == "" || to == null) {
            error++;
            $("#to_error").html("");
            $("#to_error").html("The To field is required.").css("text-align", "left").css(
                "color", 'red');
        } else {
            if (check_email(to) == false) {
                error++
            }
        }

        if (subject == "" || subject == null) {
            error++;
            $("#subject_error").html("");
            $("#subject_error").html("The Subject field is required.").css("text-align",
                "left").css(
                "color", 'red');
        } else {
            $("#subject_error").html("");
        }

        if (error == 0) {
            $.ajax({
                type: 'POST',
                url: "http://127.0.0.1/school/teacher/send_mail",
                data: 'to=' + to + '&subject=' + subject + "&id=" + id +
                    "&message=" + message,
                dataType: "html",
                success: function (data) {
                    location.reload();
                }
            });
        }
    });
</script>

<?php 
include 'includes/page_footer.php';
?>