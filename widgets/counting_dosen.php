<?php
	include 'includes/db.php';
	$userid = mysqli_real_escape_string($db, $_SESSION['userid']);
	$query = "";
	if($role == 2){
		$query = "SELECT (SELECT COUNT(kelas.kelasid) FROM kelas WHERE kelas.dibuat_oleh = '$userid') AS kelasCount, (SELECT COUNT(tugas.tugasid) FROM tugas WHERE tugas.pengajarid = '$userid') AS tugasCount,(SELECT COUNT(quiz.quizid) FROM quiz WHERE quiz.pengajarid = '$userid') AS quizCount";
	}elseif($role == 1){
		$query = "SELECT (SELECT COUNT(kelas.kelasid) FROM kelas) AS kelasCount, (SELECT COUNT(tugas.tugasid) FROM tugas) AS tugasCount,(SELECT COUNT(quiz.quizid) FROM quiz) AS quizCount";
	}else{
		die("tidak ada akses buat mahasiswa.");
	}
	$result = mysqli_query($db, $query);
	
	//-1 = error on database connection
	$kelasCount = -1;
	$tugasCount = -1;
	$quizCount = -1;
	
	if($result){
		$row = mysqli_fetch_array($result);
		$kelasCount = $row['kelasCount'];
		$tugasCount = $row['tugasCount'];
		$quizCount = $row['quizCount'];
	}
	
?>

<!-- 1 -->
<div class="col-lg-4 col-xs-4">
    <div class="small-box ">
        <a class="small-box-footer bg-mdvk-dark" href="<?= $base_url . 'kelas' ?>">
            <div class="icon bg-mdvk-light" style="padding: 9.5px 18px 8px 18px;">
                <i class="fa icon-subject text-black"></i>
            </div>
            <div class="inner ">
                <h3 class="text-black"> <?php echo $kelasCount; ?> </h3>
                <p class="text-black">
                    Kelola Kelas </p>
            </div>
        </a>
    </div>
</div>
<!-- 2 -->
<div class="col-lg-4 col-xs-4">
    <div class="small-box ">
        <a class="small-box-footer bg-mdvk-dark" href="<?= $base_url . 'tugas' ?>">
            <div class="icon bg-mdvk-light" style="padding: 9.5px 18px 8px 18px;">
                <i class="fa icon-routine text-black"></i>
            </div>
            <div class="inner ">
                <h3 class="text-black"> <?php echo $tugasCount; ?> </h3>
                <p class="text-black">
                    Koleksi Tugas </p>
            </div>
        </a>
    </div>
</div>



<?php
    $qTotalMHS = "SELECT COUNT(kelasinfo.pengajarid) AS TotalMHS FROM kelasinfo WHERE kelasinfo.pengajarid ='$userid';";
    $rTotalMhs = mysqli_query($db, $qTotalMHS);
    $aTotalMhs = mysqli_fetch_array($rTotalMhs);
    $TOT_MHS = $aTotalMhs['TotalMHS'];
?>
<!-- 3 -->
<div class="col-lg-4 col-xs-4">
    <div class="small-box ">
        <a class="small-box-footer bg-mdvk-dark" href="<?= $base_url . 'quiz' ?>">
            <div class="icon bg-mdvk-light" style="padding: 9.5px 18px 8px 18px;">
                <i class="fa fa-flask text-black"></i>
            </div>
            <div class="inner ">
                <h3 class="text-black"> <?php echo $quizCount; ?> </h3>
                <p class="text-black">
                    Koleksi Kuis </p>
            </div>
        </a>
    </div>
</div>
</div>