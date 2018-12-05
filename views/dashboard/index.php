<!-- 
@TODO  
-->
<?php // PARSING
	include 'app_config.php';
	include 'includes/session_functions.php';
	include 'includes/page_asset.php';
?>
<!-- TITLE -->
<title> Dashboard </title>

<!-- ADDITIONAL ASSETS BELOW (Optional) -->
<script type="text/javascript" src="<?= $base_url . 'assets/BACKEND/highcharts/highcharts.js'?>"></script>


<?php // END OF ASSETS
  include 'includes/page_header.php'; // </head>
  include 'includes/page_topbar.php'; // TOPBAR
  include 'includes/role.php';
?>

<aside class="right-side">
	<section class="content">
		<div class="row">
			<div class="col-xs-12">
			</div>
			<?php
				//mahasiswa yg login.
				if($role == 3){
					include 'widgets/counting_mhs.php';
					include 'widgets/mini_profile.php';
				}else{
					include 'widgets/counting_dosen.php';
					include 'widgets/mini_profile.php';
					
				}
				?>
				<?php
					include 'widgets/notif.php';
				?>
		</div>
	</section>
</aside>



<?php 
	include 'includes/page_footer.php';
?>