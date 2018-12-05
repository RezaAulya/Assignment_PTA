<?php
	include 'includes/db.php';
	ob_start();
	session_start();
	
	if(isset($_SESSION['logged'])){
		header("Location: dashboard");
		exit;
	}
	
	$error = '';
	$msg = '';
	if($_SERVER["REQUEST_METHOD"] == "POST"){
		/*
			TODO LIST
		*Validasi setiap input, 
		*username hanya angka dan huruf, sesungguhnya tidak lah boleh mengandung symbol dan spasi :D
		*email harus ada @ dan domain email harus jelas
		*dsb
		*Check duplicate
		*include 'check_duplicate.php'
		*jquery dipasang di event on leave focus.
		*misal focus leave username -> check duplicate username
		*misal focus leave email -> check duplicate email
		*/
		
		$username = mysqli_real_escape_string($db, $_POST['username']);
		$password = mysqli_real_escape_string($db, $_POST['password']);
		$full_name = mysqli_real_escape_string($db, $_POST['full_name']);
		$email = mysqli_real_escape_string($db, $_POST['email']);
		$role = mysqli_real_escape_string($db, $_POST['r1']);
		
		$query = "";
		switch(strtolower($role)){
			case "dosen":
				$query = "INSERT INTO dosen (id, username, password, nama_lengkap, email) VALUES (NULL, '$username', MD5('$password'), '$full_name', '$email')";
				break;
			case "mahasiswa":
				$query = "INSERT INTO mahasiswa (id, username, password, nama_lengkap, email) VALUES (NULL, '$username', MD5('$password'), '$full_name', '$email')";
				break;
			default:
				//hindari tamper data buat register admin
				die("Register failed.");
		}
		//$table = strtolower($role);
		
		$result = mysqli_query($db, $query);
		
		$msg = 'Successfully Register. Please <a href="login">Login</a>';
	}
	
?>

	<!DOCTYPE html>
	<html class="white-bg-login" lang="en">

	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
		<title>Register</title>
		<link rel="SHORTCUT ICON" href="uploads/images/favicon.png" />
		<!-- bootstrap 3.0.2 -->
		<link href="assets/BACKEND/bootstrap/bootstrap.min.css" rel="stylesheet" type="text/css">
		<!-- font Awesome -->
		<link href="assets/BACKEND/fonts/font-awesome.css" rel="stylesheet" type="text/css">
		<link href="assets/radio.css" rel="stylesheet" type="text/css">
		<!-- Style -->
		<link href="assets/BACKEND/inilabs/themes/default/style.css" rel="stylesheet" type="text/css">
		<!-- iNilabs css -->
		<link href="assets/BACKEND/inilabs/inilabs.css" rel="stylesheet" type="text/css">
		<link href="assets/BACKEND/inilabs/responsive.css" rel="stylesheet" type="text/css">
	</head>

	<body class="white-bg-login">

		<div class="col-md-4 col-md-offset-4 marg" style="margin-top:30px;">

		</div>


		<div class="form-box" id="login-box">
			<div class="header">
				<center>
					<img width='50' height='50' src=uploads/images/favicon.png />
				</center>
			</div>
			<form method="post">

				<div class="body white-bg">

					<?php
                        if (!empty($msg)) {
                            echo "<div class=\"alert alert-success alert-dismissable\">
                            <button aria-hidden=\"true\" data-dismiss=\"alert\" class=\"close\" type=\"button\">×</button>
							$msg
						</div>";
						header("Location: ".$base_url."login");
                        }
                    ?>
						<div class="form-group">
							<input class="form-control" placeholder="Nama Lengkap" name="full_name" type="text" autofocus value="" required>
						</div>
						<div class="form-group">
							<p>
								<span id="xx" style="color: red; display: none;">Username yang anda pilih sudah terdaftar</span>
							</p>
							<input class="form-control" placeholder="Username" name="username" type="text" autofocus value="" required>
						</div>
						<div class="form-group">
							<span id="x" style="color: red; display: none;">Email yang anda masukkan sudah terdaftar</span>
							<input class="form-control" placeholder="example@domain.com" name="email" type="email" pattern="[a-zA-Z0-9!#$%&amp;'*+\/=?^_`{|}~.-]+@[a-zA-Z0-9-]+(\.[a-zA-Z0-9-]+)*"
							    required>
						</div>
						<div class="form-group">
							<input class="form-control" placeholder="Your password" name="password" type="password" required>
						</div>
						<hr>
						<div class="form-group">
							<p class="text-yellow">Mendaftar sebagai:</p>
							<p>
								<input type="radio" id="test1" name="r1" value="Dosen">
								<label for="test1">Dosen</label>
								&nbsp; &nbsp; &nbsp;
								<input type="radio" id="test3" name="r1" value="Mahasiswa" checked>
								<label for="test3">Mahasiswa</label>
							</p>

						</div>

						<input type="submit" class="btn btn-lg btn-success btn-block" value="Buat Akun" />

						<hr>
						<span>
							<label>Sudah punya akun?
								<a href="login">Klik disini untuk masuk</a>
							</label>
						</span>
				</div>
			</form>

		</div>


		<script type="text/javascript" src="assets/BACKEND/inilabs/jquery.js"></script>
		<script type="text/javascript" src="assets/BACKEND/bootstrap/bootstrap.min.js"></script>
		<script>
			$("input[name=username]")
				.focusout(function () {
					$.post("<?php echo $base_url.'includes/check_duplicate.php';?>", {
							username: $("input[name=username]").val(),
							email: $("input[name=email]").val()
						},
						function (data, status) {
							if (data == 1) {
								$("input[name=username]").css("border-color", "red");
								$("input[name=email]").css("border-color", "#e2e7eb");
								$("input[value=REGISTER]").prop("disabled", true);
								document.getElementById('x').style.display = 'none';
								document.getElementById('xx').style.display = 'block';
							} else if (data == 2) {
								$("input[name=email]").css("border-color", "red");
								$("input[name=username]").css("border-color", "#e2e7eb");
								$("input[value=REGISTER]").prop("disabled", true);
								document.getElementById('x').style.display = 'block';
								document.getElementById('xx').style.display = 'none';
							} else if (data == 3) {
								document.getElementById('x').style.display = 'block';
								document.getElementById('xx').style.display = 'block';
								$("input[name=username]").css("border-color", "red");
								$("input[name=email]").css("border-color", "red");
							} else {
								document.getElementById('x').style.display = 'none';
								document.getElementById('xx').style.display = 'none';
								$("input[name=username]").css("border-color", "#e2e7eb");
								$("input[name=email]").css("border-color", "#e2e7eb");
								$("input[value=REGISTER]").prop("disabled", false);
							}
						});
				});

			$("input[name=email]")
				.focusout(function () {
					$.post("<?php echo $base_url.'includes/check_duplicate.php';?>", {
							username: $("input[name=username]").val(),
							email: $("input[name=email]").val()
						},
						function (data, status) {
							if (data == 1) {
								$("input[name=username]").css("border-color", "red");
								$("input[name=email]").css("border-color", "#e2e7eb");
								$("input[value=REGISTER]").prop("disabled", true);
								document.getElementById('x').style.display = 'none';
								document.getElementById('xx').style.display = 'block';
							} else if (data == 2) {
								$("input[name=email]").css("border-color", "red");
								$("input[name=username]").css("border-color", "#e2e7eb");
								$("input[value=REGISTER]").prop("disabled", true);
								document.getElementById('x').style.display = 'block';
								document.getElementById('xx').style.display = 'none';
							} else if (data == 3) {
								document.getElementById('x').style.display = 'block';
								document.getElementById('xx').style.display = 'block';
								$("input[name=username]").css("border-color", "red");
								$("input[name=email]").css("border-color", "red");
							} else {
								document.getElementById('x').style.display = 'none';
								document.getElementById('xx').style.display = 'none';
								$("input[name=username]").css("border-color", "#e2e7eb");
								$("input[name=email]").css("border-color", "#e2e7eb");
								$("input[value=REGISTER]").prop("disabled", false);
							}
						});

				});
		</script>
	</body>

	</html>