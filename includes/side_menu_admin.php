<div class="wrapper row-offcanvas row-offcanvas-left">
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="left-side sidebar-offcanvas">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
            <!-- Sidebar user panel -->
            <div class="user-panel">
                <div class="pull-left image">
                    <img style="display:block" src="<?= $_SESSION['photo'] ?>" class="img-circle" alt="" />
                </div>

                <div class="pull-left info">
                    <p>
                        <?php echo $_SESSION['nama_lengkap']; ?>
                    </p>
                    <a href="<?= $base_url . 'profile' ?>">
                        <i class="fa fa-hand-o-right color-green"></i>
                        Profil Saya </a>
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


                <!-- SUB MENU USER -->
                <li class="treeview ">
                    <a href="#">
                        <i class="fa icon-subject"></i>
                        <span>Tabel User</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li class="<?php if (strpos($pwd, 'dosen/') !== false) {  echo 'active';}?>">
                            <a href="<?= $base_url . 'dosen' ?>">
                                <i class="fa icon-teacher"></i>
                                <span>Tabel Dosen</span>
                            </a>
                        </li>
                        <li class="<?php if (strpos($pwd, 'mahasiswa/') !== false) {  echo 'active';}?>">
                            <a href="<?= $base_url . 'mahasiswa' ?>">
                                <i class="fa icon-student"></i>
                                <span>Tabel Mahasiswa</span>
                            </a>
                        </li>
                    </ul>
                </li>




                <!-- SUB MENU KELAS -->
                <li class="treeview ">
                    <a href="#">
                        <i class="fa fa-graduation-cap"></i>
                        <span>Kelola Kelas</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li class="<?php if (strpos($pwd, 'kelas/') !== false) {  echo 'active';}?>">
                            <a href="<?= $base_url . 'kelas' ?>">
                                <i class="fa fa-sitemap"></i>
                                <span>Tabel Kelas</span>
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


                <!-- SUB MENU TUGAS -->
                <li class="treeview ">
                    <a href="#">
                        <i class="fa icon-subject"></i>
                        <span>Kelola Tugas</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li class="<?php if ($pwd === '/tugas/') {  echo 'active';}?>">
                            <a href="<?= $base_url . 'tugas' ?>">
                                <i class="fa fa-sitemap"></i>
                                <span>Tabel Tugas</span>
                            </a>
                        </li>

                    </ul>
                </li>


                <!-- SUB MENU QUIZ -->
                <li class="treeview ">
                    <a href="#">
                        <i class="fa icon-exam"></i>
                        <span>Kelola Quiz</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li class="<?php if (strpos($pwd, 'kategori') !== false) {  echo 'active';}?>">
                            <a href="<?= $base_url . 'quiz/kategori' ?>">
                                <i class="fa fa-question-circle"></i>
                                <span>Kategori Quiz</span>
                            </a>
                        </li>
                        <li class="<?php if (strpos($pwd, 'bank') !== false) {  echo 'active';}?>">
                            <a href="<?= $base_url . 'quiz/bank' ?>">
                                <i class="fa icon-markmain"></i>
                                <span>Pertanyaan</span>
                            </a>
                        </li>
                        <li class="<?php if (strpos($pwd, 'quiz/') !== false) {  echo 'active';}?>">
                            <a href="<?= $base_url . 'quiz' ?>">
                                <i class="fa fa-flask"></i>
                                <span class="text-green">Daftar Quiz</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- ######################################################### -->
                <!--                        MAHASISWA                          -->
                <!-- ######################################################### -->
                
                <!-- SUB MENU MHS - KELAS 
                <li class="treeview ">
                    <a href="#">
                        <i class="fa fa-graduation-cap"></i>
                        <span>@MHS - Kelas Saya</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li class="<?php if (strpos($pwd, '/mhs/kelas') !== false) {  echo 'active';}?>">
                            <a href="<?= $base_url . 'mhs/kelas' ?>">
                                <i class="fa fa-sitemap"></i>
                                <span>Tabel Kelas</span>
                            </a>
                        </li>
                        <?php
                            include 'includes/db.php';
                            // QUERY Here !!
                            $getID= $_SESSION['userid'];                            
                            $sql = "SELECT * FROM kelas WHERE create_by='$getID';";
                            $result = mysqli_query($db, $sql);
                            $ceking ="";
                            if (strpos($pwd, 'mhs/kelas/view/') !== false) {  $ceking = 'active';}

                            while ($row = mysqli_fetch_array($result)){
                                echo '<li class="' . $ceking .  '"><a href=" ' . $base_url . 'mhs/kelas/view/' . $row['kelasid']. ' "><i class="fa fa-star"></i><span>' . $row['kelas_nama'] .' </span></a></li>' ;
                            }
                        ?>
                            <li class="<?php if (strpos($pwd, 'mhs/kelas/join') !== false) {  echo 'active';}?>">
                                <a href="<?= $base_url . 'mhs/kelas/join' ?>">
                                    <i class="fa fa-plus"></i>
                                    <span>Join Kelas</span>
                                </a>
                            </li>
                    </ul>
                </li>
-->






                <!-- ######################################################### -->
                <!--                        ADMIN ONLY                         -->
                <!-- ######################################################### -->

                <!-- SUB MENU @ADMIN 
                <li class="treeview ">
                    <a href="#">
                        <i class="fa icon-administrator"></i>
                        <span>Administrator</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li class="<?php if (strpos($pwd, 'profile-cpass') !== false) {  echo 'active';}?>">
                            <a href="<?= $base_url . 'profile-cpass' ?>">
                                <i class="fa icon-reset_password"></i>
                                <span>Reset Password</span>
                            </a>
                        </li>
                        <li class="">
                            <a href="#">
                                <i class="fa fa-download"></i>
                                <span>Backup</span>
                            </a>
                        </li>
                        <li class="">
                            <a href="#">
                                <i class="fa fa-upload"></i>
                                <span>Import</span>
                            </a>
                        </li>

                    </ul>
                </li-->

            </ul>

        </section>
        <!-- /.sidebar -->
    </aside>