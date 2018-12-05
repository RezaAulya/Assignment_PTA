<?php
    include 'includes/db.php';
    ob_start();
    session_start();
    
    if(isset($_SESSION['logged'])){
        if($_SESSION['role'] == 1){
			header("Location: dashboard");
			exit;
		}else{
			header("Location: logout");
			exit;
		}
    }
    
    $error = '';
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $username = mysqli_real_escape_string($db, $_POST['username']);
        $password = mysqli_real_escape_string($db, $_POST['password']);
        $query = "SELECT admin.id, admin.username, admin.password, admin.nama_lengkap, admin.email FROM admin WHERE (admin.username = '$username' AND admin.password = md5('$password')) OR (admin.email = '$username' AND admin.password = md5('$password'))";
        $result = mysqli_query($db, $query);
        
        $count = mysqli_num_rows($result);
        if($count == 1){
            $row = mysqli_fetch_array($result); 
            $_SESSION['username'] = $row['username'];
            $_SESSION['nama_lengkap'] = $row['nama_lengkap'];
            $_SESSION['useremail'] = $row['email'];
            $_SESSION['role'] = 1;
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
            $error = 'Invalid credentials.';
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
    <link rel="SHORTCUT ICON" href="uploads/images/site.png" />
    <!-- bootstrap 3.0.2 -->
    <link href="assets/BACKEND/bootstrap/bootstrap.min.css" rel="stylesheet" type="text/css">
    <!-- font Awesome -->
    <link href="assets/BACKEND/fonts/font-awesome.css" rel="stylesheet" type="text/css">
    <!-- Style -->
    <link href="assets/BACKEND/inilabs/style.css" rel="stylesheet" type="text/css">
    <!-- iNilabs css -->
    <link href="assets/BACKEND/inilabs/inilabs.css" rel="stylesheet" type="text/css">
    <link href="assets/BACKEND/inilabs/responsive.css" rel="stylesheet" type="text/css">
</head>

<body class="white-bg-login">

    <div class="col-md-4 col-md-offset-4 marg" style="margin-top:30px;">
        <center>
            <img width='50' height='50' src=uploads/images/site.png />
        </center>
        <center>
            <h4>E-Assignment</h4>
        </center>
    </div>


    <div class="form-box" id="login-box">
        <div class="header">Admin Login</div>
        <form method="post">

            <!-- style="margin-top:40px;" -->

			<div style = "font-size:11px; color:#cc0000; margin-top:10px"><?php echo $error; ?></div>
            <div class="body white-bg">
                <div class="form-group">
                    <input class="form-control" placeholder="Username atau Email" name="username" type="text" autofocus value="">
                </div>
                <div class="form-group">
                    <input class="form-control" placeholder="Password" name="password" type="password">
                </div>
                <input type="submit" class="btn btn-lg btn-success btn-block" value="SIGN IN" />
				
            </div>
        </form>
		
    </div>


    <script type="text/javascript" src="assets/BACKEND/inilabs/jquery.js"></script>
    <script type="text/javascript" src="assets/BACKEND/bootstrap/bootstrap.min.js"></script>

</body>

</html>