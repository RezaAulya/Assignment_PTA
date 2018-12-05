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
	
	//udah pernah masuk/belum
	$sql = "SELECT id FROM quiz_start_mhs WHERE kelasid = '$lpKelasId' AND quizid = '$get_id' AND mahasiswaid = '$userid';";
	$result = mysqli_query($db, $sql);
	$count = mysqli_num_rows($result);
	
	if($count == 0){
		$sql = "SELECT waktu FROM quiz WHERE quizid = '$get_id';";
		$result = mysqli_query($db, $sql);
		$row = mysqli_fetch_array($result);
		
		$today = date("Y-m-d H:i:s");
		$endTime = strtotime("+".$row['waktu']." minutes", strtotime($today));
		$prmEnd = date("Y-m-d H:i:s", $endTime);
		
		$sql = "INSERT INTO quiz_start_mhs (kelasid, quizid, end_date, mahasiswaid) VALUES ('$lpKelasId', '$get_id', '$prmEnd', '$userid');";
		$result = mysqli_query($db, $sql);	
		
	}
	
	if($_SERVER["REQUEST_METHOD"] == "POST"){
		foreach($_POST as $idSoal => $jawaban){
			$val = mysqli_real_escape_string($db, $jawaban);
			$sql = "UPDATE quiz_temp SET jawaban = '$val' WHERE mahasiswaid = '$userid' AND idsoal = '$idSoal';";
			mysqli_query($db, $sql);
			
			
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
		$q = "INSERT INTO quiz_nilai (id, quizid, nilai, mhs_id, kelasid) VALUES(NULL, '$get_id', '$nilaiPrint', '$userid', '$lpKelasId');";
		$sql = mysqli_query($db, $q);
		header("Location: ".$base_url.'mhs/quiz/result/'.$get_id);
		exit;
	}
	
	$data = "";
	$sql = "SELECT quiz.quiz_nama, quizinfo.infoid, quizinfo.quiz_soal, quizinfo.quiz_jawaban, quizinfo.quiz_jawaban_1, quizinfo.quiz_jawaban_2, quizinfo.quiz_jawaban_3, quizinfo.quiz_jawaban_4, quizinfo.quiz_jawaban_5 FROM quiz LEFT JOIN quizinfo ON quiz.quizid = quizinfo.quizid WHERE quiz.quizid = '$get_id'";
	$result = mysqli_query($db, $sql);
	$header_name = "";
	$jumlahSoal = 1;
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
		$checked = $row['quiz_jawaban'];
		$tampungJawaban = "<tr>";
		$counter = 1;
		
		for($i=0; $i<count($pilihan); $i++){
			if($i == 2){
				$tampungJawaban .= "</tr><tr>";
			}
			
			$tampungJawaban .= "<td>
								<input id=\"option".$jumlahSoal."_".($i+1)."\" value=\"".($i+1)."\" name=\"".$row['infoid']."\" type=\"radio\">
									<label for=\"option".$jumlahSoal."_".($i+1)."\">
									<span class=\"fa-stack radio-button\">
									<i class=\"active fa fa-check\"></i></span>
									".$pilihan[$i]."</label>
								</td>";
		}
		
		$tampungJawaban .= "</tr>";
		
		
	$data.= '<section class="panel">
                 <div class="panel-body bio-graph-info">
                     <div id="printablediv" class="box-body">
                         <div class="row">
                             <div class="col-sm-12">
                                 <div class="clearfix">
                                     <div class="question-body">
                                         
                                         <label class="lb-content question-color">
                                             <b>Soal ke '.$jumlahSoal.'</b>
										 </label>
										 <hr>
										 <label class="lb-content">
											<p xss="removed"><i>' . $row['quiz_soal']  .'</i></p>
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
			 $jumlahSoal++;
	}
	
    $form_name ="Quiz Detail - ".$header_name;
?>
  
<!-- TITLE -->
<title>
    <?=$form_name?>
</title>

<!-- ADDITIONAL ASSETS BELOW (Optional) -->
<link rel="stylesheet" href="<?= $base_url . 'assets/BACKEND/checkbox/checkbox.css' ?>">
<link rel="stylesheet" href="<?= $base_url . 'assets/BACKEND/inilabs/form/fuelux.min.css' ?>">

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
						<style type="text/css">
							.fuelux .wizard .step-content {
								border: 0px;
							}
						</style>
                        <div class="col-sm-12 do-not-refresh">
                            <div class="callout callout-warning">
								<h4>Quiz : <?= $header_name ?> </h4>
								<br>
								<div class="" id="countDownMe"><h4>Tersisa</h4>
							</div>
						</div>
						
                        

                    </div>
                </div>
				
                <form method="POST" id="formjawaban">
				<?php
					echo $data;
				?>
				</div>
				<div class="form-group">
					<div class="col-sm-offset-0 col-sm-12">
						<input type="submit" id='kumpulkan' class="btn btn-success btn-block margin-bottom" value="Finish">
					</div>
				</div>
				
				</form>
				<div class="col-sm-6">
					<hr>
				</div>
            </div>
        </div>
    </section>
</aside>

<script type="text/javascript">
var stop = true;
function createCountDown(elementId, date){
	if(date == '-'){
		document.getElementById(elementId).innerHTML = "-";
		return;
	}
    var countDownDate = new Date(date).getTime();
    var x = setInterval(function(){
      var now = new Date().getTime();
      var distance = (countDownDate) - (now);
      var days = Math.floor(distance / (1000 * 60 * 60 * 24));
      var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
      var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
      var seconds = Math.floor((distance % (1000 * 60)) / 1000);

      document.getElementById(elementId).innerHTML = "<h4>Waktu Tersisa : <b>" + hours + ":"+  minutes + ":" + seconds + "</b></h4>";

      if (distance < 0){
        clearInterval(x);
		document.getElementById(elementId).innerHTML = countDownDate;
      }
	}, 1000);
}

var checkAPI = setInterval(function(){
	$.post("<?= $base_url ?>mhs/quiz/countdown",
	{
		quizid: "<?php echo $get_id; ?>"
	},
	
	function(data,status){
		if(data == 'true'){
			document.getElementById('formjawaban').submit();
		}
	});
}, 5000);



<?php
	$sql = "SELECT quiz_start_mhs.end_date FROM quiz_start_mhs WHERE quiz_start_mhs.quizid = '$get_id' AND mahasiswaid = '$userid';";
	$result = mysqli_query($db, $sql);
	while($row = mysqli_fetch_array($result)){
		echo "createCountDown('countDownMe', \"".$row['end_date']."\");";
	}
?>
	
	
	
	
</script>
<?php 
    include 'includes/page_footer.php';
?>