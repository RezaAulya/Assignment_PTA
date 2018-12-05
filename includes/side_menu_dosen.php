<div class="wrapper row-offcanvas row-offcanvas-left">
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="left-side sidebar-offcanvas">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
            <!-- Sidebar user panel -->
            <div class="user-panel">
                <div class="pull-left image">
                    <img style="display:block" src="<?= $_SESSION['photo'] ?>" alt="" />
                </div>

                <div class="pull-left info">
                    <p class="text-black">
                        <?php echo $_SESSION['nama_lengkap']; ?>
                    </p>
                    <a href="<?= $base_url . 'profile' ?>">
                        <i class="fa fa-hand-o-right "></i>
                        <i>Dosen</i> </a>
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

                <!-- SUB MENU 1 -->
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
                            $getID = mysqli_real_escape_string($db, $_SESSION['userid']);
                            $sql = "SELECT kelas.kelasid, kelas.kelas_nama FROM kelas WHERE kelas.dibuat_oleh='$getID';";
                            $result = mysqli_query($db, $sql);
                            $ceking ="";
                            while ($row = mysqli_fetch_array($result)){
                                if(strpos($pwd, 'kelas-view/' . $row['kelasid']) !== false) {
                                     $ceking = 'active'; 
                                }else{
                                    $ceking='';
                                }

                                echo '<li class="' . $ceking .  '">
                                        <a href=" ' . $base_url . 'kelas-view/' . $row['kelasid']. ' ">
                                        <i class="fa fa-star"></i><span> ' . $row['kelas_nama'] .' </span></a>
                                    </li>' ;                                    
                            }
                        ?>
                            <li class="<?php if (strpos($pwd, 'kelas/') !== false) {  echo 'active';}?>">
                                <a href="<?= $base_url . 'kelas' ?>">
                                    <i class="fa icon-subject"></i>
                                    <span>Kelola Kelas</span>
                                </a>
                            </li>
                            <li class="<?php if (strpos($pwd, 'kelas-add/') !== false) {  echo 'active';}?>">
                                <a href="<?= $base_url . 'kelas-add' ?>">
                                    <i class="fa fa-plus"></i>
                                    <span>Buat Kelas</span>
                                </a>
                            </li>
                    </ul>
                </li>

                <!-- SUB MENU 2 -->
                <li class="treeview ">
                    <a href="#">
                        <i class="fa icon-subject"></i>
                        <span>Tugas</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li class="<?php if ($pwd === '/tugas/' || strpos($pwd, 'tugas-view/') == 1) {  echo 'active';}?>">
                            <a href="<?= $base_url . 'tugas' ?>">
                                <i class="fa icon-assignment"></i>
                                <span>Tabel Semua Tugas</span>
                            </a>
                        </li>
                        <!--li class="">
                            <a href="">
                                <i class="fa icon-assignment"></i>
                                <span>Buat Tugas</span>
                            </a>
                        </li-->
                    </ul>
                </li>

                <!-- SUB MENU 3 -->
                <li class="treeview ">
                    <a href="#">
                        <i class="fa fa-flask"></i>
                        <span>Quiz</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li class="<?php if (strpos($pwd, 'quiz/kategori') !== false) {  echo 'active';}?>">
                            <a href="<?= $base_url . 'quiz/kategori' ?>">
                                <i class="fa icon-subject"></i>
                                <span>Kategori Kuis</span>
                            </a>
                        </li>
                        <li class="<?php if ($pwd == '/quiz/add/') {  echo 'active';}?>">
                            <a href="<?= $base_url . 'quiz/add' ?>">
                                <i class="fa fa-plus"></i>
                                <span>Buat Kuis</span>
                            </a>
                        </li>
                        <li class="<?php if ($pwd == '/quiz/') {  echo 'active';}?>">
                            <a href="<?= $base_url . 'quiz' ?>">
                                <i class="fa fa-user-secret"></i>
                                <span>Tabel Kuis</span>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>

        </section>
        <!-- /.sidebar -->
    </aside>