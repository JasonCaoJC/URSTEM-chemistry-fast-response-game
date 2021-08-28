<?php



include("config.php");



$user = $_SESSION['userid'];

$consent = $_SESSION['consent'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	$name = $user;

	$count = $_POST['countTotal'];

	$set = $_POST['setUsed'];

	$finished = $_POST['status'];

	$start = $_POST['start'];

	$finish = $_POST['finish'];

	$elapsed = $_POST['elapsed'];

	

	$line = $name . "||" . $start . "||" . $finish . "||" . $elapsed ."||" . $set . "||" . $finished . "||" . $count . PHP_EOL;

	

	$file = fopen("generalRecord.txt","a");

	fwrite($file, $line);

	fclose($file);

	

	if($consent == 1)

	{

		$file = fopen("record.txt","a");

		fwrite($file, $line);

		fclose($file);

	}

}

?>