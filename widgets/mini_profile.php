<?php
    include_once 'includes/session_functions.php';
    
    //mhs
    $id = mysqli_real_escape_string($db, $_SESSION['userid']);
    $query = "SELECT * FROM mahasiswa WHERE mahasiswa.id = '$id'";
    $result = mysqli_query($db, $query);
    $ambil = mysqli_fetch_array($result);

?>
<div class="col-sm-4">
    <section class="panel">
        <div class="profile-view-head">
            <a href="<?= $base_url . 'profile'?> ">
                <img  src="<?= $_SESSION['photo'] ?>" class="img-circle" alt="" />
                
            </a>

            <h1><?php echo $_SESSION['nama_lengkap']; ?></h1>
            <?php
            if($_SESSION['role'] == 2){
                echo '<p>Dosen</p>';
            }else{
                echo '<p>'.$ambil['nim'].'</p>';
            }
            ?>

        </div>
        <table class="table table-hover">
            <tbody>
            <!-- LOOPING DATA BEGIN HERE  -->
                <tr>
                    <td>
                        <i class="glyphicon glyphicon-user text-mdvk-dark"></i>
                    </td>
                    <td>Username</td>
                    <td><?php echo $_SESSION['username']; ?></td>
                </tr>
                <tr>
                    <td>
                        <i class="fa fa-envelope text-mdvk-dark"></i>
                    </td>
                    <td>Email</td>
                    <td><?php echo $_SESSION['useremail']; ?></td>
                </tr>
                <tr>
                    <td>
                        <i class=" fa fa-graduation-cap text-mdvk-dark"></i>
                    </td>
                    <td>Saya adalah Seorang </td>
                    <td>
                        <?php  echo $_SESSION['rolename']; ?>
                    </td>
                </tr>
            </tbody>
        </table>
    </section>
</div>