<?php

include('config.php');

if($_SESSION["consent"] != -1)
{
	header("Location: webpageDemo.php");
}

if($_SERVER["REQUEST_METHOD"] == "POST")
{
	$selectedRadio = $_POST['consent'];
	if ($selectedRadio == 'yes')
	{
		$file = explode(PHP_EOL, file_get_contents("accounts.txt"));
		foreach($file as $line) {
			list($username, $password, $consent) = explode("||", $line);
			//$password = trim($password);
			$consent = intval(trim($consent));
			if(strtolower($username) == $_SESSION['userid'])
			{
				break;
			}
		}
		//Update to give consent
		$oldLine = $username . "||" . $password . "||-1";
		$newLine = $username . "||" . $password . "||1";
		$_SESSION["consent"] = 1;
		$str = file_get_contents("accounts.txt");
		$str = str_replace($oldLine, $newLine, $str);
		file_put_contents("accounts.txt", $str);
	}
	else if($selectedRadio == 'no')
	{
		$file = explode(PHP_EOL, file_get_contents("accounts.txt"));
		foreach($file as $line) {
			list($username, $password, $consent) = explode("||", $line);
			//$password = trim($password);
			$consent = intval(trim($consent));
			if(strtolower($username) == $_SESSION['userid'])
			{
				break;
			}
		}
		//Update to not give consent
		$oldLine = $username . "||" . $password . "||-1";
		$newLine = $username . "||" . $password . "||0";
		$_SESSION["consent"] = 0;
		$str = file_get_contents("accounts.txt");
		$str = str_replace($oldLine, $newLine, $str);
		file_put_contents("accounts.txt", $str);
	}
	else
	{
		
	}
	header("location:consentpage.php");
}
?>

<!DOCTYPE HTML>
<html lang="en">
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="main.css">
	<link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet"> 
	<title>Consent</title>
</head>
<header>
<img src="NKU banner.jpg" alt="NKU_banner" height="100" width="auto">
</header>
<body>
	<div id="consentDiv">
    
 Study Title: On-line MemChem Study Tool of Chemistry Students<P>
Name of Principal Investigator: Dr. KC Russell and Dr. Qi Li<p>
Principal Investigator Telephone Number: 859-572-5758<p>
You are invited to participate in research that being conducting to evaluate the online, Chemistry learning tool, MemChem.. This study will be conducted with Chemistry students at Northern Kentucky University. 
Participant data in this study will be collected automatically when they login to the MemChem system. The collected information will include their login id, login time, the tiles used for each game, the time needed to complete each game and number of attempts needed to complete each game. To evaluate the efficiency of the learning tool, we would like to ask for your permission to use your grades, exam and quiz scores from your fall and spring CHE 310 and CHE 311 courses.<p> 
Your MemChem records and grades will be treated as confidential information. That is, your identity will be protected by removing your name before any data is processed. An id number will be assigned and used in the system to associate with your records and any grade reports. Those de-identified information will be stored on our secure server and will use a password protected computer to access the research data. Only our research team member will have access to the data. <p>
Participating in this research study is voluntary. Your decision to allow or not allow your data to be used in this study will have no effect on your education or how you are treated in class. Any insights gained from this study will be used to benefit future classes. If you decide later that you would prefer that your data not be included, you may withdraw it at any time.<p> 
If you have questions about the study, please contact Dr. Li at 859-572-5758; <liq2@nku.edu>. You may also reach Dr. KC Russell at 859-572- 6110; <russellk@nku.edu>. If you have questions about your rights as a participant in this research, please contact Andrea Lambert South, Ph.D., Institutional Review Board, Northern Kentucky University, at 859-572-6911 or at irbchair@nku.edu.<p>
Please indicate if you will allow or not allow your data to be used in this research study. We appreciate your help.<p>
 (The time/data will be recorded automatically by the server)
   
    
    
</div>
	<form method="POST">
		<input type="radio" name="consent" id="yes" value="yes">
		<label for="yes">Yes</label><br>
	
		<input type="radio" name="consent" id="no" value="no">
		<label for="no">No</label><br>
		<input type="submit" value="Submit">
	</form>
</body>
</html>