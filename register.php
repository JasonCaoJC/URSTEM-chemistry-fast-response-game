<?php

if($_SERVER['REQUEST_METHOD'] == 'POST') {

	$enteredUsername = $_POST['username'];

	$enteredPassword = $_POST['password'];

	$passwordCheck = $_POST['passwordCheck'];

	$availableUser = true;

	

	

	

	$file = explode(PHP_EOL, file_get_contents("accounts.txt"));

	foreach($file as $line) {

		list($username, $password) = explode("||", $line);

		$enteredUsername = strtolower($enteredUsername);

		if($enteredUsername === strtolower($username)) {

			//Entered correctly

			$availableUser = false;

			break;

		}

	}

	

	if($availableUser == false) {

		header("location:register.php?msg=1"); //1 = user taken

	}

	elseif($enteredPassword !== $passwordCheck) {

		header("location:register.php?msg=2"); //2 = wrong password

	}

	elseif($availableUser == true) {

		$line = $enteredUsername . "||" . $enteredPassword . "||-1\n";

		$file = fopen("accounts.txt","a");

		fwrite($file, $line);

		fclose($file);

		header("location:register.php?msg=0"); //0 = creation successful

	}

}

?>

<!DOCTYPE HTML>

<html lang="en">

<head>

	<meta charset="utf-8">

	<link rel="stylesheet" type="text/css" href="main.css">

	<link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet"> 

	<title>Register</title>

</head>

<header>

<img src="NKU banner.jpg" alt="NKU_banner" height="100" width="auto">

</header>

<body>

	<h1>Register</h1>

	<?php

		if(isset($_GET['msg'])) {

			$msg = $_GET['msg'];

			if($msg == '0') {

				echo "<p>Account creation successful</p>";

			}

			elseif($msg == '1') {

				echo "<p>Username is already taken</p>";

			}

			elseif($msg == '2') {

				echo "<p>Passwords do not match</p>";

			}

		}

	?>

		<form method="POST">

			<label>Username</label>

			<input type="text" name="username" placeholder="Username" /> <br />

			<label>Password</label>

			<input type="password" name="password" placeholder="Password" /> <br />

			<label>Repeat Password</label>

			<input type="password" name="passwordCheck" placeholder="Repeat Password" /> <br />

			<input type="submit" value="Register" />

		</form>

		<br />

		<a href="login.php">Login</a>

</body>

</html>