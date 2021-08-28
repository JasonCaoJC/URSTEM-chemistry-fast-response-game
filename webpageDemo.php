<?php
	include("config.php");
	$user = $_SESSION['userid'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<title>Fast Response Chemistry Game</title>
	<link rel="icon" type="image/x-icon" href="https://www.nku.edu/etc/designs/nku-design/images/favicon.ico">
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--===============================================================================================-->
	<link rel="icon" type="image/png" href="images/icons/favicon.ico" />
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
	<!--===============================================================================================-->
	<link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/iconic/css/material-design-iconic-font.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
	<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
	<link href="https://fonts.googleapis.com/css2?family=Material+Icons" rel="stylesheet">
	<script src="node_modules/xbs-enjoyhint/enjoyhint.min.js"></script>

	<!-- From external libraries -->
	<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-scrollTo/2.1.2/jquery.scrollTo.min.js"></script>

	<!-- Enjoyhint library -->
	<link href="node_modules/xbs-enjoyhint/enjoyhint.css" rel="stylesheet">
	<script src="node_modules/xbs-enjoyhint/enjoyhint.min.js"></script>
</head>

<body>
	<section>
		<div class="wave wave1"></div>
		<div class="wave wave2"></div>
		<div class="wave wave3"></div>
		<div class="wave wave4"></div>
		<div class="circle1"></div>
		<div class="circle2"></div>
	</section>
	<div id="left-bar" class="material-bar">
		<div id="submit-btn-groups" class="top-btn d-grid gap-2">
			<div id="submit-btn" class="submit-btn">
				<span class="material-icons">check</span>
			</div>
			<div id="select-all-btn" class="submit-all-btn">
				<span class="material-icons">done_all</span>
			</div>
			<div id="back-btn" class="back-btn">
				<span class="material-icons">arrow_forward_ios</span>
			</div>
		</div>
		<div id="bottom-left-bar">
			<div class="material-title tag d-grid">
				<span id="material-title" class="tag-md">Orbitals</span>
			</div>
			<hr>
			<div id="description" class="description">
				Material description goes here
			</div>
			<hr>
			<div id="options-group" class="options-group">
			</div>
		</div>

	</div>

	<div id="main-page" class="container">
		<div class="game-playground col-lg-8">
			<div class="game-title">
				<p>Matching pictures and names of these chemical compounds</p>
			</div>
			<div class="cards-container">
				<div id="card-1" class="cards-group">
					<div class="card-face card-front"><img id="c1-front" src="images/card.jpg" alt=""></div>
					<div class="card-face card-back"><img id="c1-back" src="images/cardback.jpg" alt=""></div>
				</div>
				<div id="card-2" class="cards-group">
					<div class="card-face card-front"><img id="c2-front" src="images/card.jpg" alt=""></div>
					<div class="card-face card-back"><img id="c2-back" src="images/cardback.jpg" alt=""></div>
				</div>
				<div id="card-3" class="cards-group">
					<div class="card-face card-front"><img id="c3-front" src="images/card.jpg" alt=""></div>
					<div class="card-face card-back"><img id="c3-back" src="images/cardback.jpg" alt=""></div>
				</div>
				<div id="card-4" class="cards-group">
					<div class="card-face card-front"><img id="c4-front" src="images/card.jpg" alt=""></div>
					<div class="card-face card-back"><img id="c4-back" src="images/cardback.jpg" alt=""></div>
				</div>

				<div id="card-5" class="cards-group">
					<div class="card-face card-front"><img id="c5-front" src="images/card.jpg" alt=""></div>
					<div class="card-face card-back"><img id="c5-back" src="images/cardback.jpg" alt=""></div>
				</div>
				<div id="card-6" class="cards-group">
					<div class="card-face card-front"><img id="c6-front" src="images/card.jpg" alt=""></div>
					<div class="card-face card-back"><img id="c6-back" src="images/cardback.jpg" alt=""></div>
				</div>
				<div id="card-7" class="cards-group">
					<div class="card-face card-front"><img id="c7-front" src="images/card.jpg" alt=""></div>
					<div class="card-face card-back"><img id="c7-back" src="images/cardback.jpg" alt=""></div>
				</div>
				<div id="card-8" class="cards-group">
					<div class="card-face card-front"><img id="c8-front" src="images/card.jpg" alt=""></div>
					<div class="card-face card-back"><img id="c8-back" src="images/cardback.jpg" alt=""></div>
				</div>

				<div id="card-9" class="cards-group">
					<div class="card-face card-front"><img id="c9-front" src="images/card.jpg" alt=""></div>
					<div class="card-face card-back"><img id="c9-back" src="images/cardback.jpg" alt=""></div>
				</div>
				<div id="card-10" class="cards-group">
					<div class="card-face card-front"><img id="c10-front" src="images/card.jpg" alt=""></div>
					<div class="card-face card-back"><img id="c10-back" src="images/cardback.jpg" alt=""></div>
				</div>
				<div id="card-11" class="cards-group">
					<div class="card-face card-front"><img id="c11-front" src="images/card.jpg" alt=""></div>
					<div class="card-face card-back"><img id="c11-back" src="images/cardback.jpg" alt=""></div>
				</div>
				<div id="card-12" class="cards-group">
					<div class="card-face card-front"><img id="c12-front" src="images/card.jpg" alt=""></div>
					<div class="card-face card-back"><img id="c12-back" src="images/cardback.jpg" alt=""></div>
				</div>
				<div id="card-13" class="cards-group">
					<div class="card-face card-front"><img id="c13-front" src="images/card.jpg" alt=""></div>
					<div class="card-face card-back"><img id="c13-back" src="images/cardback.jpg" alt=""></div>
				</div>
				<div id="card-14" class="cards-group">
					<div class="card-face card-front"><img id="c14-front" src="images/card.jpg" alt=""></div>
					<div class="card-face card-back"><img id="c14-back" src="images/cardback.jpg" alt=""></div>
				</div>
				<div id="card-15" class="cards-group">
					<div class="card-face card-front"><img id="c15-front" src="images/card.jpg" alt=""></div>
					<div class="card-face card-back"><img id="c15-back" src="images/cardback.jpg" alt=""></div>
				</div>
				<div id="card-16" class="cards-group">
					<div class="card-face card-front"><img id="c16-front" src="images/card.jpg" alt=""></div>
					<div class="card-face card-back"><img id="c16-back" src="images/cardback.jpg" alt=""></div>
				</div>
			</div>
		</div>
		<div id="side-bar" class="side col-lg-4">
			<div class="side-bar">
				<div class="btn-group">
					<div class="reset-btn">
						<button id="reset-btn" type="button" class="btn btn-warning">Reset</button>
					</div>
					<div class="logout-btn">
						<a href="logout.php">
							<button id="logout-btn" type="button" class="btn btn-danger">Log out</button>
						</a>
					</div>
				</div>
				<p id="tag-description">Choose material to review:</p>
				<div id="tag-group" class="tag-group">
					<div id="orbitals" class="tag-select"><span class="tag-md">Orbitals</span><span
							class="tag-sm">12</span></div>
					<div id="func_group" class="tag-select"><span class="tag-md">Functional Groups</span><span
							class="tag-sm">15</span></div>
					<div id="pkas" class="tag-select"><span class="tag-md">pKa's</span><span class="tag-sm">13</span>
					</div>
					<div id="hnmr" class="tag-select"><span class="tag-md">1H NMR Chemical Shifts</span><span
							class="tag-sm">13</span></div>
					<div id="styrene" class="tag-select"><span class="tag-md">Styrene</span><span
							class="tag-sm">9</span></div>
					<div id="methylcyclohexene" class="tag-select"><span class="tag-md">1-Methylcyclohexene</span><span
							class="tag-sm">10</span></div>
					<div id="ir" class="tag-select"><span class="tag-md">IR</span><span class="tag-sm">10</span></div>
					<div id="sn2" class="tag-select"><span class="tag-md">SN2</span><span class="tag-sm">9</span></div>
					<div id="acronyms" class="tag-select"><span class="tag-md">Acronyms</span><span
							class="tag-sm">13</span></div>
					<div id="aa-sn" class="tag-select"><span class="tag-md">Amino Acids:<br>Structure to
							Name</span><span class="tag-sm">20</span></div>
					<div id="aa-s3" class="tag-select"><span class="tag-md">Amino Acids:<br>Structure to 3-letter
							code</span><span class="tag-sm">20</span></div>
					<div id="aa-s1" class="tag-select"><span class="tag-md">Amino Acids:<br>Structure to 1-letter
							code</span><span class="tag-sm">20</span></div>
				</div>
				<div id="matched-pairs" class="matched-pairs">
				</div>
			</div>
		</div>

		<div class="bottom col-lg-7">
			<div class="bottom-bar">
				<div class="timer-group">
					<div class="timer-icon"><img src="images/icons/timericon.svg" alt=""></div>
					<span class="em-title" id="hour">00</span>
					<span class="sp">:</span>
					<span class="em-title" id="minute">00</span>
					<span class="sp">:</span>
					<span class="em-title" id="second">00</span>
				</div>
				<div class="move-group">
					<span>Moves</span>
					<span id="move" class="em-title">0</span>
				</div>
				<div class="matched-group">
					<span>Matched</span>
					<span id="matched" class="em-title">0</span>
				</div>
			</div>
		</div>
	</div>

	<div id="congrats" class="limiter modal">
		<div class="container-congrats">
			<div class="wrap-congrats">
				<img class="congrats-icon" src="images/Succes.png" alt="">
				<h2>Woohoo! 👏</h2>
				<div class="content-2">
					<p>You made <span id="final-moves" class="em-title">00</span> moves in <span id="total-hours"
							class="em-title">00</span> : <span id="total-minutes" class="em-title">00</span> : <span
							id="total-seconds" class="em-title">00</span></p>
				</div>
				<button id="play-again" class="btn btn-warning">
					Play again
				</button>
			</div>
		</div>
	</div>

	<script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.4.0/dist/confetti.browser.min.js"></script>
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
	<script src="vendor/animsition/js/animsition.min.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
	<script src="vendor/select2/select2.min.js"></script>
	<script src="vendor/daterangepicker/moment.min.js"></script>
	<script src="vendor/daterangepicker/daterangepicker.js"></script>
	<script src="vendor/countdowntime/countdowntime.js"></script>
	<script src="js/main.js"></script>

</body>

</html>