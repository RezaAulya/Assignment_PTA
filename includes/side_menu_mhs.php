<?php 
    include 'includes/db.php';
    // QUERY Here !!
    $id = mysqli_real_escape_string($db, $_SESSION['userid']);
    $query = "SELECT * FROM mahasiswa WHERE mahasiswa.id = '$id'";
    $result = mysqli_query($db, $query);
    $ambil = mysqli_fetch_array($result);

    // Cek NIM
    $prmNIM = '';
    $linkPropil ='';
    if($ambil['nim'] ==''){
        $prmNIM = '<label class="blink_me text-red"><b>Lengkapi NIM</b></label>';
        $linkPropil ='<a href="' . $base_url . 'profile-edit">' ;
    }else{
        $prmNIM = $ambil['nim'];
        $linkPropil ='<a href="' . $base_url . 'profile">' ;        
    }

?>
<div class="wrapper row-offcanvas row-offcanvas-left">
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="left-side sidebar-offcanvas">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
            <!-- Sidebar user panel -->
            <div class="user-panel">
                <div class="pull-left image">
                    <img style="display:block" src="<?= $_SESSION['photo'] ?>" class="" alt="" />
                </div>

                <div class="pull-left info">
                    <p class="text-black">
                        <?= $ambil['nama_lengkap']; ?>
                    </p>
                    <?= $linkPropil ?>
                        <i class="fa fa-hand-o-right "></i>
                        <?php echo $prmNIM?> </a>
                </div>
            </div>

            <!-- sidebar menu: : style can be found in sidebar.less -->
            <ul class="sidebar-menu">
                <li class="<?php if (strpos($pwd, 'dashboard/') !== false) {  echo 'active';}?>">
                    <a href="<?= $base_url . 'dashboard' ?>">
                        <i class="fa fa-laptop"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <!-- ######################################################### -->
                <!--                        MAHASISWA                          -->
                <!-- ######################################################### -->

                <!-- SUB MENU MHS - KELAS -->
                <li class="treeview ">
                    <a href="#">
                        <i class="fa icon-academicmain"></i>
                        <span>Kelas</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">

                        <?php
						
                            include 'includes/db.php';
                            // QUERY Here !!
                                                     
                            $sql = "SELECT kelas.kelasid, kelas.kelas_nama FROM kelasinfo JOIN kelas ON kelasinfo.kelasid = kelas.kelasid WHERE kelasinfo.mahasiswaid ='$id';";
                            $result = mysqli_query($db, $sql);
                            $ceking ="";
                            
                            while ($row = mysqli_fetch_array($result)){
                                if(strpos($pwd, 'mhs/kelas/view/' . $row['kelasid']) !== false) {
                                    $ceking = 'active'; 
                                }else{
                                    $ceking='';
                                }

                                echo '<li class="' . $ceking .  '">
                                        <a href=" ' . $base_url . 'mhs/kelas/view/' . $row['kelasid']. ' ">
                                        <i class="fa fa-star"></i><span> ' . $row['kelas_nama'] .' </span></a>
                                      </li>' ;    
                            }
                        ?>
                            <li class="<?php if ($pwd == '/mhs/kelas/') {  echo 'active';}?>">
                                <a href="<?= $base_url . 'mhs/kelas' ?>">
                                    <i class="fa fa-sitemap"></i>
                                    <span>Kelola Kelas</span>
                                </a>
                            </li>
                            <li class="<?php if (strpos($pwd, 'mhs/kelas/join') !== false) {  echo 'active';}?>">
                                <a href="<?= $base_url . 'mhs/kelas/join' ?>">
                                    <i class="fa fa-plus"></i>
                                    <span>Join Kelas</span>
                                </a>
                            </li>
                    </ul>
                </li>

                <li class="<?php if (strpos($pwd, 'mhs/tugas') !== false) {  echo 'active';}?>">
                    <a href="<?= $base_url . 'mhs/tugas' ?>">
                        <i class="fa icon-subject"></i>
                        <span>Daftar Tugas</span>
                    </a>
                </li>
            </ul>

        </section>
        <!-- /.sidebar -->
    </aside>