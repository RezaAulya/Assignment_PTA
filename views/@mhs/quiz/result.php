<!-- 
@TODO  
-->
<?php // PARSING 
	ob_start();
	$get_id = $_SESSION['getId'];
	
    include 'app_config.php';
	include 'includes/session_functions.php';
	include 'includes/page_asset.php';
	include 'includes/db.php';
	$userid = $_SESSION['userid'];
	
	$data = "";
	$sql = "SELECT quiz.quiz_nama, quizinfo.infoid, quizinfo.quiz_soal, quizinfo.quiz_jawaban, quizinfo.quiz_jawaban_1, quizinfo.quiz_jawaban_2, quizinfo.quiz_jawaban_3, quizinfo.quiz_jawaban_4, quizinfo.quiz_jawaban_5, quiz_temp.jawaban FROM quiz LEFT JOIN quizinfo ON quiz.quizid = quizinfo.quizid LEFT JOIN quiz_temp ON quiz_temp.idsoal = quizinfo.infoid WHERE quiz.quizid = '$get_id' AND quiz_temp.mahasiswaid = '$userid' GROUP BY quizinfo.infoid;";
	$result = mysqli_query($db, $sql);
	$header_name = "";
	
	while($row = mysqli_fetch_array($result)){
		$header_name = $row['quiz_nama'];
		$pilihan = array();
		if($row['quiz_jawaban_1'] != ''){
			array_push($pilihan, $row['quiz_jawaban_1']);
		}
		if($row['quiz_jawaban_2'] != ''){
			array_push($pilihan, $row['quiz_jawaban_2']);
		}
		if($row['quiz_jawaban_3'] != ''){
			array_push($pilihan, $row['quiz_jawaban_3']);
		}
		if($row['quiz_jawaban_4'] != ''){
			array_push($pilihan, $row['quiz_jawaban_4']);
		}
		if($row['quiz_jawaban_5'] != ''){
			array_push($pilihan, $row['quiz_jawaban_5']);
		}
		if(count($pilihan) == 0){
			break;
		}
		$checked = $row['jawaban'];
		$tampungJawaban = "<tr>";
		$counter = 1;
		$benar = false;
		for($i=0; $i<count($pilihan); $i++){
			$spanClass = '';
			if($i == 2){
				$tampungJawaban .= "</tr><tr>";
			}
			if($row['jawaban'] == $row['quiz_jawaban']){
				$benar = true;
			}else{
				if(($i+1) == $row['jawaban']){
					$spanClass = ' style="color: red; font-weight: bold;"';
				}
				if(($i+1) == $row['quiz_jawaban']){
					$spanClass = ' style="color: green; font-weight: bold;"';
				}
			}
			
			if($checked == ($i+1)){
				$tampungJawaban .= "<td><input id=\"option".($i+1)."\" value=\"".($i+1)."\" name=\"option".$row['infoid']."\" type=\"radio\" checked disabled>
					<label for=\"option".($i+1)."\"><span class=\"fa-stack radio-button\"><i class=\"active fa fa-check\"></i></span>
					<span$spanClass>".$pilihan[$i]."</span></label></td>";
			}else{
				$tampungJawaban .= "<td><input id=\"option".($i+1)."\" value=\"".($i+1)."\" name=\"option".($i+1)."\" type=\"radio\" disabled>
					<label for=\"option".($i+1)."\"><span class=\"fa-stack radio-button\"><i class=\"active fa fa-check\"></i></span>
					<span$spanClass>".$pilihan[$i]."</span></label></td>";
			}
		}
		
		$tampungJawaban .= "</tr>";
		if(!$benar){
			$data.='<section class="panel"><div class="panel-body bio-graph-info" style="background-color: #ff00002f;">';
		}else{
			$data.='<section class="panel"><div class="panel-body bio-graph-info">';
		}
		
		
	$data.= '<div id="printablediv" class="box-body">
                         <div class="row">
                             <div class="col-sm-12">
                                 <div class="clearfix">
                                     <div class="question-body">
                                         
                                         <label class="lb-content question-color">
                                             '.$row['quiz_soal'].'
                                         </label>
                                     </div>

                                     <div class="question-answer">
                                         <table class="table">
                                             '.$tampungJawaban.'
                                         </table>
                                     </div>
                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>
             </section>';
			 $counter++;
	}
	$nilaiInt = 0;
	$nilai = "SELECT IFNULL(quiz_temp.jawaban, 0) as jawaban, quizinfo.quiz_jawaban FROM quiz_temp JOIN quizinfo ON quiz_temp.idsoal = quizinfo.infoid WHERE quiz_temp.mahasiswaid = '$userid' AND quizinfo.quizid = '$get_id';";
	$nilaiResult = mysqli_query($db, $nilai);
	$jumlahSoal = mysqli_num_rows($nilaiResult);

	while($rowNilai = mysqli_fetch_array($nilaiResult)){
		if($rowNilai['jawaban'] == $rowNilai['quiz_jawaban']){
			$nilaiInt++;
		}
	}
	
	$nilaiPrint = (float)($nilaiInt/$jumlahSoal)*100;
	
    $form_name ="Quiz Detail - ".$header_name;
?>

<!-- TITLE -->
<title>
	<?=$form_name?>
</title>

<!-- ADDITIONAL ASSETS BELOW (Optional) -->
<link rel="stylesheet" href="<?= $base_url . 'assets/BACKEND/checkbox/checkbox.css' ?>">
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
						<div class="col-sm-6" id="countDownMe">Nilai Anda:
							<?=round($nilaiPrint, 2);?>
						</div>
						<div class="col-sm-6">
							<ol class="breadcrumb">
								<li>
									<a href="<?= $base_url . 'dashboard' ?>">
										<i class="fa fa-laptop"></i> Dashboard</a>
								</li>
								<li>
									<a href="<?= $base_url . 'quiz/' ?>">Quiz</a>
								</li>
								<li class="">
									<a href="<?= $base_url . 'quiz/'.$get_id ?>">
										<?= $header_name ?>
									</a>
								</li>
								<li class="active">Result</li>
							</ol>
						</div>

					</div>
				</div>

				<?php
					echo $data;
				?>


					<div class="col-sm-6">
						<hr>
					</div>
			</div>
		</div>
	</section>
</aside>

<?php 
    include 'includes/page_footer.php';
?>