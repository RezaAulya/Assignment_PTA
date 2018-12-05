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
	$_SESSION['back'] = $base_url.'quiz/pertanyaan-view/'.$get_id;
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
			
			if($checked == ($i+1)){
				$tampungJawaban .= "<td><input id=\"option".($i+1)."\" value=\"".($i+1)."\" name=\"option".$row['infoid']."\" type=\"radio\" checked disabled>
					<label for=\"option".($i+1)."\"><span class=\"fa-stack radio-button\"><i class=\"active fa fa-check\"></i></span>
					<span>".$pilihan[$i]."</span></label></td>";
			}else{
				$tampungJawaban .= "<td><input id=\"option".($i+1)."\" value=\"".($i+1)."\" name=\"option".($i+1)."\" type=\"radio\" disabled>
					<label for=\"option".($i+1)."\"><span class=\"fa-stack radio-button\"><i class=\"active fa fa-check\"></i></span>
					<span>".$pilihan[$i]."</span></label></td>";
			}
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
                                             Soal ke ' . $jumlahSoal.' <br><i><a href="'. $base_url . 'quiz/pertanyaan-edit/'.$row['infoid'].'" target="_blank"><i class="fa fa-edit"> edit pertanyaan |</i></a>
											 <a href="'. $base_url . 'quiz/pertanyaan-delete/'.$row['infoid'].'"><i class="fa fa-trash"> hapus pertanyaan</i></a></i>
                                         </label>
                                         <hr>
                                         <label class="lb-content">
                                            <p xss="removed">'.$row['quiz_soal'].'</p>
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
                            <!-- <button class="btn-cs btn-sm-cs" onclick="javascript:printDiv('printablediv')">
                                <span class="fa fa-print"></span> Print </button> -->
                            <a href="<?= $base_url . 'quiz/add-pertanyaan/'.$get_id; ?>" class='btn-cs btn-sm-cs' style='text-decoration: none;' role='button'>
                                <i class='fa fa-plus'></i> Tambah Pertanyaan</a>
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
                                <li class="active">Detail Pertanyaan</li>
                            </ol>
                        </div>

                    </div>
                </div>
				
                
				<?php
					if($jumlahSoal==0){
						echo "Tidak ada Entri";
					}else{
						echo $data;
					}
					
				?>
				
				
				

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
                </script>

            </div>
        </div>
    </section>
</aside>




<?php 
    include 'includes/page_footer.php';
?>