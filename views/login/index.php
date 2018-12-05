<?php
    include 'includes/db.php';
    ob_start();
    session_start();
    
    if(isset($_SESSION['logged'])){
        header("Location: dashboard");
        exit;
    }
    
    $error = '';
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $username = mysqli_real_escape_string($db, $_POST['username']);
        $password = mysqli_real_escape_string($db, $_POST['password']);
		
		$users = array("dosen", "mahasiswa");
		$counter = 2;
		foreach($users as $user){
			$query = "SELECT id, username, nama_lengkap,   email FROM ".$user." WHERE (username = '$username' AND password = md5('$password')) OR (email = '$username' AND password = md5('$password'));";
			
			$result = mysqli_query($db, $query);
			
			$count = mysqli_num_rows($result);
			if($count == 1){
				$row = mysqli_fetch_array($result);
				$_SESSION['username'] = $row['username'];
                $_SESSION['nama_lengkap'] = $row['nama_lengkap'];
                //$_SESSION['nim'] = $row['nim'];                
				$_SESSION['useremail'] = $row['email'];
				if($user == "dosen"){
					$_SESSION['role'] = 2;
				}elseif($user == "mahasiswa"){
					$_SESSION['role'] = 3;
				}else{
					die();
				}
				
				$_SESSION['userid'] = $row['id'];
				$_SESSION['logged'] = TRUE;
				$expensions= array("jpeg", "jpg", "png", "gif");
				$found = false;
				for ($i = 0; $i < count($expensions); $i++){
					if(file_exists('uploads/users/'.md5($_SESSION["username"]).$_SESSION['userid'].'.'.$expensions[$i])){
						$_SESSION['photo'] = $base_url.'uploads/users/'.md5($_SESSION["username"]).$_SESSION['userid'].'.'.$expensions[$i];
						$found = true;
						break;
					}
				}
				if(!$found){
					$_SESSION['photo'] = $base_url . '/uploads/images/default.png';
				}
				header("Location: dashboard");
				exit;
			}else{
				$error = 'Username atau Password Salah';
			}
		}
    }
?>

    <!DOCTYPE html>
    <html class="white-bg-login" lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <title>Sign in</title>
        <link rel="SHORTCUT ICON" href="uploads/images/favicon.png" />
        <!-- bootstrap 3.0.2 -->
        <link href="assets/BACKEND/bootstrap/bootstrap.min.css" rel="stylesheet" type="text/css">
        <!-- font Awesome -->
        <link href="assets/BACKEND/fonts/font-awesome.css" rel="stylesheet" type="text/css">
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
            <div class="header text-red">
            <center>
                <img width='50' height='50' src='uploads/images/favicon.png' />
            </center>
            </div>
            <form method="post">
                <div class="body white-bg">

                    <?php
                        if (!empty($error)) {
                            echo "<div class=\"alert alert-danger alert-dismissable\">
                            <button aria-hidden=\"true\" data-dismiss=\"alert\" class=\"close\" type=\"button\">×</button>
                            $error
                        </div>";
                        }
                    ?>

                        <div class="form-group">
                            <input required class="form-control" placeholder="Username atau Email" name="username" type="text" autofocus value="">
                        </div>
                        <div class="form-group">
                            <input required class="form-control" placeholder="Password" name="password" type="password">
                        </div>

                       


                        <input type="submit" class="btn btn-lg btn-success btn-block" value="Masuk" />
                        <hr>
                        <p>
                            Belum punya akun?
                            <a href="register">Klik disini untuk membuat akun</a>
                        </p>
                </div>
            </form>

        </div>

        <script type="text/javascript" src="assets/BACKEND/inilabs/jquery.js"></script>
        <script type="text/javascript" src="assets/BACKEND/bootstrap/bootstrap.min.js"></script>

    </body>

    </html>