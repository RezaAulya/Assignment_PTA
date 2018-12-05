<?php
	include_once 'includes/session_functions.php';
?>
	<div class="col-sm-8">
		<div class="box">
			<div class="box-body" style="padding: 0px;height: 280px">
				<div class="box">
					<div class="box-header" style="background-color: #222;">
						<h3 class="title">
							<?php 
							if($_SESSION['role'] == 2){
								echo '<h3 class="box-title text-black"><i class="fa fa fa-clock-o"></i>';
								echo '&nbsp;&nbsp;<b>5 Aktifitas Mahasiswa Terakhir</b></h3>';
							}else{
								echo '<h3 class="box-title text-black"><i class="fa fa fa-clock-o"></i>';
								echo '&nbsp;&nbsp;<b>5 Aktifitas Dosen Terakhir</b></h3>';								
							}
							?>
						</h3>
					</div>

					<div class="box-body" style="padding: 0px;">
						<table class="table table-hover">
							<tbody>
								<!-- LOOPING DATA BEGIN HERE  -->
								<?php
										include 'includes/db.php';
										$userid = mysqli_real_escape_string($db, $_SESSION['userid']);
										$sql = "";						
										if($_SESSION['role'] == 2){
											$sql = "SELECT mahasiswa.nama_lengkap as dari, notif_dosen.notif_msg, notif_dosen.notif_date, kelas.kelas_nama, notif_dosen.kelasid FROM notif_dosen JOIN mahasiswa ON notif_dosen.userid_from = mahasiswa.id JOIN kelas ON notif_dosen.kelasid = kelas.kelasid WHERE notif_dosen.userid_to = '$userid' ORDER BY notif_dosen.notif_date DESC;";
										}elseif($_SESSION['role'] == 3){
											$sql = "SELECT dosen.nama_lengkap as dari, notif_mhs.notif_msg, notif_mhs.notif_date, kelas.kelas_nama, notif_mhs.kelasid FROM notif_mhs JOIN dosen ON notif_mhs.userid_from = dosen.id JOIN kelas ON notif_mhs.kelasid = kelas.kelasid WHERE notif_mhs.userid_to = '$userid' ORDER BY notif_mhs.notif_date DESC;";
										}elseif($_SESSION['role'] == 1){
											$sql = "SELECT dosen.nama_lengkap as dari, notif_mhs.notif_msg, notif_mhs.notif_date, kelas.kelas_nama, notif_mhs.kelasid FROM notif_mhs JOIN dosen ON notif_mhs.userid_from = dosen.id JOIN kelas ON notif_mhs.kelasid = kelas.kelasid WHERE notif_mhs.userid_to = '$userid' ORDER BY notif_mhs.notif_date DESC;";
										}
										
										$result = mysqli_query($db, $sql);
										
										$counter = 0;
										while ($row = mysqli_fetch_array($result)){
											$link = "";
											if($_SESSION['role'] == 2){
												$link = $base_url.'kelas-view/'.$row['kelasid'];
											}elseif($_SESSION['role'] == 3){
												$link = $base_url.'mhs/kelas/view/'.$row['kelasid'];
											}
											
											$timestamp = strtotime($row['notif_date']);
											$dateNotif = date('d/M/Y', $timestamp);
											
											echo '<tr>
												<td>'.$dateNotif.'</td>
													<td><b> '.$row['dari'].'</b>' .$row['notif_msg'].' <i> '.$row['kelas_nama'].'</i> </td>
													<td>
														<a href="' . $link . '" class="btn bg-blue-mdvk btn-xs mrg" style="background-color:#00bcd4;color:#fff;"
															data-placement="top" data-toggle="tooltip" data-original-title="View">
															<span class="fa fa-check-square-o"></span>
														</a>
													</td>
												</tr>';
											$counter++;
											if($counter == 5){
												break;
											}
										}
										if ($counter == 0){
											echo '<tr><td>No notification.</td><td></td><td></td></tr>';
										}
									?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>