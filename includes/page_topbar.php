<?php 
    // QUERY Here !!
    include 'includes/db.php';
    
    $id = mysqli_real_escape_string($db, $_SESSION['userid']);
    $query = "SELECT * FROM mahasiswa WHERE mahasiswa.id = '$id'";
    $result = mysqli_query($db, $query);
    $ambil = mysqli_fetch_array($result);



    $qCountNotif = "";
	if($_SESSION['role'] == 2){
		$qCountNotif = "SELECT COUNT(notif_dosen.notif_msg) AS tNotif FROM notif_dosen WHERE userid_to = '$id' AND status='0';";
	}elseif($_SESSION['role'] == 3){
		$qCountNotif = "SELECT COUNT(notif_mhs.notif_msg) AS tNotif FROM notif_mhs WHERE userid_to = '$id' AND status= '0'";
    }else{
        $qCountNotif = "SELECT COUNT(notif_mhs.notif_msg) AS tNotif FROM notif_mhs WHERE userid_to = '$id' AND status= '0'";
    }
    $rCountNotif = mysqli_query($db, $qCountNotif);
    //$aCountNotif = mysqli_fetch_array($rCountNotif);

   // $totalNotif = $aCountNotif['tNotif'];
    
?>
<!-- header logo: style can be found in header.less -->
<header class="header">
    <a href="<?= $base_url . 'dashboard'?>" class="logo">
        <!-- Add the class icon to your logo image or logo icon to add the margining -->
        <img width="32" height="32" src="<?= $base_url . 'uploads/images/site.png' ?>">
        <?= $app_name ?>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </a>


        <div class="navbar-right">
            <ul class="nav navbar-nav">
                <!-- Site Start -->
                <li class="dropdown notifications-menu">
                    <a target="_blank" href="<?= $base_url . 'homepage'?>" class="dropdown-toggle" data-toggle="tooltip" title=" Visit Web" data-placement="bottom">
                        <i class="fa fa-globe"></i>
                    </a>
                </li>
                <!-- Site Close -->

                <!-- Messages: style can be found in dropdown.less-->
                <li class="dropdown messages-menu">
                    <a href="#" class="dropdown-toggle bukanotif" data-toggle="dropdown">
                        <i class="fa fa-bell-o"></i>
                        <span class="label label-pill label-danger countoL" style="border-radius:10px;"></span>

                    </a>
                    <ul class='dropdown-menu pefek'></ul>
                </li>

                <li class="dropdown user user-menu">
                    <a href="<?= $base_url . '#' ?>" class="dropdown-toggle" data-toggle="dropdown">
                        <img class="user-logo" src="<?= $base_url . 'uploads/images/gear.png' ?>" alt="" />
                        <span>
                            <?php echo $_SESSION['username'];?>
                            <i class="caret"></i>
                        </span>
                    </a>

                    <ul class="dropdown-menu">

                        <!-- Menu Body -->
                        <center>
                            <h4>
                                <?php echo $_SESSION['nama_lengkap'];?>
                            </h4>
                        </center>
                        <li class="user-body">
                            <div class="col-xs-6 text-center">
                                <a href="<?= $base_url . 'profile' ?>">
                                    <div>
                                        <i class="fa fa-briefcase"></i>
                                    </div>
                                    Profile Saya
                                </a>

                            </div>
                            <div class="col-xs-6 text-center">
                                <a href="<?= $base_url . 'profile-cpass' ?>">
                                    <div>
                                        <i class="fa fa-lock"></i>
                                    </div>
                                    Password
                                </a>
                            </div>
                        </li>

                        <!-- Menu Footer-->
                        <li class="user-footer">

                            <div class="text-center">
                                <a href="<?= $base_url . 'logout' ?>">
                                    <div>
                                        <i class="fa fa-power-off"></i>
                                    </div>
                                    LOG OUT
                                </a>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>



<!-- MyNotif-->
<script>
$(document).ready(function(){
 
 function load_unseen_notification(view = '')
 {
  $.ajax({
   url:"<?= $base_url?>fetch.php",
   method:"POST",
   data:{view:view},
   dataType:"json",
   success:function(data)
   {
    $('.pefek').html(data.notification);
    if(data.unseen_notification > 0)
    {
     $('.countoL').html(data.unseen_notification);
    }
   }
  });
 }
 
 load_unseen_notification();
 
 $(document).on('click', '.bukanotif', function(){
     $.ajax({
        url:"<?= $base_url?>fetchUpdate.php"
     })
  $('.countoL').html('');
  load_unseen_notification('yes');
  
 });
 
 setInterval(function(){ 
  load_unseen_notification();; 
 }, 5000);
 
});
</script>
