<?php // PARSING
    echo "<script>console.log( 'Debug Objects: " . $_SESSION['getId'] . "' );</script>";
    $get_id = $_SESSION['getId'];
    include 'app_config.php';
	include 'includes/session_functions.php';
	include 'includes/page_asset.php';
?>
<!-- TITLE -->
<title> Profile Dosen </title>
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
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb">
                                    <li>
                                        <a href="<?= $base_url . 'dashboard' ?>">
                                            <i class="fa fa-laptop"></i> Dashboard</a>
                                    </li>
                                    <li>
                                        <a href="<?= $base_url . 'dosen' ?>">Tabel Dosen</a>
                                    </li>
                                    <li class="active">Personal Informasi</li>
                                </ol>
                            </div>
                        </div>
                    </div>

                    <?php 
                        include 'includes/db.php';
                        // QUERY Here !!
						$get_id = mysqli_real_escape_string($db, $get_id);
                        $sql = "SELECT dosen.id, dosen.username, dosen.email, dosen.nama_lengkap, dosen.bidang_ahli, DATE_FORMAT(created_on, '%a, %d %M %Y') AS join_date, dosen.phone, dosen.dob FROM dosen WHERE dosen.id = '$get_id';";
                        $result = mysqli_query($db, $sql);
                        $ambil = mysqli_fetch_array($result);
                    ?>

                    <div id="printablediv">
                        <section class="panel">
                            <div class="profile-view-head">
                                <a href="#">
                                    <img src="<?= $base_url . 'uploads/images/default.png' ?>" alt="" /> </a>

                                <?php 
                                        echo '<h1>' . $ambil['nama_lengkap'] .'</h1>';
                                        echo '<p>' . $ambil['bidang_ahli'] .'</p>';
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
                                                        <?php echo ': ' .$ambil['phone'] ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>D O B</td>
                                                    <td>
                                                        <?php echo ': ' .$ambil['dob'] ?>
                                                    </td>
                                                </tr>



                                            </tbody>
                                        </table>
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
//Jika sudah update clear variabel $_SESSION['getId']
unset($_SESSION['getId']);
include 'includes/page_footer.php';
?>