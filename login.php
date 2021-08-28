<?php

$message = false;

include('config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$enteredUsername = $_POST['username'];
	$enteredPassword = $_POST['password'];
	$auth = false;
	$message = false;
	
	$file = preg_split('/[\r\n]/', file_get_contents("accounts.txt"));
	foreach($file as $line) {
		$data= explode("||", $line);
		//$password = trim($password);
		$enteredUsername = strtolower($enteredUsername);
		$consent = isset($data[3]) ? intval(trim($data[3])) : 0;
		/*
		echo $enteredUsername;
		echo $data[0];
		*/
		if($enteredUsername == $data[0] && $enteredPassword == $data[1]) {
			//Entered correctly
			$auth = true;
			break;
		}
	}
	if($auth == true) {
		$_SESSION['userid'] = $enteredUsername;
		$_SESSION['consent'] = $consent;
		if($consent == -1)
		{
			header('Location: consentpage.php');
		}
		elseif($consent != -1)
		{
			header('Location: webpageDemo.php');
		}
	}
	else {
		//Incorrect Login
		$message = true;
	}
	
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<title>Fast Response Chemistry Game</title>
	<link rel="icon" type="image/x-icon" href="https://www.nku.edu/etc/designs/nku-design/images/favicon.ico">
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" type="image/png" href="images/icons/favicon.ico" />
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
	<link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="fonts/iconic/css/material-design-iconic-font.min.css">
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
	<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
	<link href="https://fonts.googleapis.com/css2?family=Material+Icons" rel="stylesheet">
	<link href="https://webfonts.brand.ucsb.edu/webfont.min.css" rel="stylesheet">

</head>

<body>
	<section style="background: #FFFFFF;">
		<div class="wave_golden wave1"></div>
		<div class="wave_golden wave2"></div>
		<div class="wave_golden wave3"></div>
		<div class="wave_golden wave4"></div>
	</section>

	<div id="main-page" class="container login-container">
		<div class="main-page">
			<div class="nav flex-lg-row">
				<div class="logo-container">
					<img src="images/NKU_HRZTL.png">
					<p>Department of <br>Chemistry</p>
				</div>
				<a href="">
					<p>Contact</p>
				</a>

			</div>

			<div class="row flex-row">
				<div class="col-md-7 game-intro container-fluid">
					<h1 class="game-title-login">Chemistry Fast Response Game</h1>
					<p class="game-discription">Recalling fundamental chemical principles or facts is often the first
						step
						required in solving more
						sophisticated problems. The more rapidly a student can recall these basic facts, the more time
						they
						have
						to work on more advanced material. Some examples, taught within the first few weeks of the first
						semester of organic chemistry, include functional groups, hybridization and formal charge.</p>
					<br>
					<button id="btn-login" type="button" class="btn btn-warning"><span>Login</span></button>

				</div>

				<div class="col-md-5 bggraphic2">
					<img src="images/Female Scientist.svg" alt="">
				</div>
			</div>
		</div>
	</div>


	<div id="login" class="limiter modal fade">
		<div class="container-login100">
			<div class="wrap-login100 p-l-45 p-r-45 p-t-55 p-b-44">
				<form class="login100-form validate-form" action="login.php" method="POST">
					<?php if ($message == true) : ?>
						<svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
							<symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
								<path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
							</symbol>
							<symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
								<path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
							</symbol>
							<symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
								<path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
							</symbol>
						</svg>
						<div class="alert alert-danger d-flex align-items-center" role="alert">
							<svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
							<div style="padding-left: 15px">
								Hmm.. It looks like you have entered wrong username or password. Please try again!
							</div>
						</div>
						<script>
							let container = document.getElementById('main-page');
        					$("#login").modal('show');
        					container.className = "container login-container is-blurred";
						</script>
					<?php endif ?>
					<img class="login-icon img-rounded" src="images/icons/loginicon.PNG" alt="">
					<span class="login100-form-title p-b-30">
					</span>

					<div class="wrap-input100 validate-input m-b-23" data-validate="Username is required">
						<span class="label-input100">Username</span>
						<input class="input100" type="text" name="username" placeholder="Type your NKU username">
						<span class="focus-input100" data-symbol="&#xf206;"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Password is required">
						<span class="label-input100">Password</span>
						<input class="input100" type="password" name="password" placeholder="Last 5 of your student number">
						<span class="focus-input100" data-symbol="&#xf190;"></span>
					</div>

					<div class="text-right p-t-8 p-b-31">
						<a href="#">
							Forgot password?
						</a>
					</div>

					<div class="container-login100-form-btn">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
							<button class="login100-form-btn">
								Login
							</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>

	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
	<script src="vendor/animsition/js/animsition.min.js"></script>
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
	<script src="vendor/select2/select2.min.js"></script>
	<script src="vendor/daterangepicker/moment.min.js"></script>
	<script src="vendor/daterangepicker/daterangepicker.js"></script>
	<script src="vendor/countdowntime/countdowntime.js"></script>
	<script src="js/main.js"></script>

</body>

</html>