<?php
	include 'includes/db.php';
	$userid = mysqli_real_escape_string($db, $_SESSION['userid']);
	
	$query = "SELECT (SELECT COUNT(kelasinfo.kelasid) FROM kelasinfo WHERE kelasinfo.mahasiswaid = '$userid') AS kelasCount, (SELECT COUNT(tugasinfo.tugasid) FROM tugasinfo WHERE tugasinfo.userid = '$userid' AND tugasinfo.path_jawaban IS NULL) AS tugasCount";
	$result = mysqli_query($db, $query);
	
	//-1 = error on database connection
	$kelasCount = -1;
	$tugasCount = -1;
	
	if($result){
		$row = mysqli_fetch_array($result);
		$kelasCount = $row['kelasCount'];
		$tugasCount = $row['tugasCount'];
	}
	
?>

<!-- 1 -->
<div class="col-lg-6 col-xs-12">
    <div class="small-box ">
        <a class="small-box-footer bg-mdvk-dark" href="<?= $base_url . 'mhs/kelas' ?>">
            <div class="icon bg-mdvk-light" style="padding: 9.5px 18px 8px 18px;">
                <i class="fa icon-academicmain text-black"></i>
            </div>
            <div class="inner ">
                <h3 class="text-black"> <?php echo $kelasCount; ?> </h3>
                <p class="text-black">
                    Kelas Saya Ikuti</p>
            </div>
        </a>
    </div>
</div>
<!-- 2 -->
<div class="col-lg-6 col-xs-12">
    <div class="small-box ">
        <a class="small-box-footer bg-mdvk-dark" href="<?= $base_url . 'mhs/tugas' ?>">
            <div class="icon bg-mdvk-light" style="padding: 9.5px 18px 8px 18px;">
                <i class="fa icon-routine text-black"></i>
            </div>
            <div class="inner ">
                <h3 class="text-black"> <?php echo $tugasCount; ?> </h3>
                <p class="text-black">
                    Tugas yang belum diselesaikan </p>
            </div>
        </a>
    </div>
</div>
</div>
