<?php

$host = 'localhost';
$dbname = 'heraf';
$User = 'root';
$pass = 'betty';

$pdo = new PDO("mysql:host=$host;dbname=$dbname", $User, $pass);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if ($_POST and basename($_SERVER['PHP_SELF']) != "search.php" and basename($_SERVER['PHP_SELF']) != "employ.php" and basename($_SERVER['PHP_SELF']) != "profile.php" and basename($_SERVER['PHP_SELF']) != "newacount.php")
{
	$email = $_POST['email'];
	$password = $_POST['password'];
	$sql = "SELECT * FROM employer WHERE email = \"$email\" AND pass_word = \"$password\"";

	$stmt = $pdo->prepare($sql);
	$stmt->execute();
	$user = $stmt->fetch(PDO::FETCH_ASSOC);
	if (!$user)
	{
		$sql = "SELECT * FROM clients WHERE email = \"$email\" AND pass_word = \"$password\"";
		$stmt = $pdo->prepare($sql);
		$stmt->execute();
		$user = $stmt->fetch(PDO::FETCH_ASSOC);
	}

	if (session_status() == PHP_SESSION_NONE)
		session_start();
	$_SESSION['user'] = $user;


	if ($user and $email == $user['email'] and $password == $user['pass_word']) {
		header('Location: profile.php');
		exit;
	} else if ($_POST) {
		echo "Invalid email or password";
	}
}
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (isset($_SESSION['user']))
	$emp1 = $_SESSION['user'];

if (isset($_SESSION['employ']))
	$empp = $_SESSION['employ'];

if (isset($emp1) and basename($_SERVER['PHP_SELF']) == "profile.php")
{
	$employer_id = $emp1['id'];
	$skil = $pdo->prepare("SELECT skill FROM skills WHERE employer_id = $employer_id");
	$skil->execute();
	$skil = $skil->fetchAll(PDO::FETCH_ASSOC);

	$found = false;

	if (isset($_POST['addskill'])){
		foreach ($skil as $s) {
			if ($s['skill'] === $_POST['addskill']) {
				$found = true;
				break;
			}
		}
	}
	if (isset($_POST['addskill']) and !$found){
		$new = $_POST['addskill'];
	$adding = "INSERT INTO skills (employer_id, skill) VALUES ($employer_id, \"$new\")";
	$add = $pdo->prepare($adding);
	$add->execute();
	header("refresh:0.0001; url=profile.php");
	}

	if (isset($_POST['projName']) and isset($_POST['infoproj']) and isset($_FILES["photoProj"])){

		$targetDirectory = "images/";
		$originalFileName = $_POST['projName'] . $employer_id . ".jpg";
		$targetFilePath = $targetDirectory . $originalFileName;
		$check = getimagesize($_FILES["photoProj"]["tmp_name"]);
		if ($check !== false) {
        	move_uploaded_file($_FILES["photoProj"]["tmp_name"], $targetFilePath);
        } else {
            echo "File is not an image.";
        }

		$photoProj = $_POST['projName'] . $employer_id . ".jpg";
		$projName = $_POST['projName'];
		$infoproj = $_POST['infoproj'];
		$adding_project = "INSERT INTO projects (employer_id, project_name, photo, details) VALUES ($employer_id, \"$projName\", \"$photoProj\", \"$infoproj\")";
		$add_project = $pdo->prepare($adding_project);
		$add_project->execute();
		header("refresh:0.0001; url=profile.php");
	}
}



if (isset($emp1) and basename($_SERVER['PHP_SELF']) == "profile.php")
{
	$employer_id = $emp1['id'];
	$proj = $pdo->prepare("SELECT * FROM projects WHERE employer_id = $employer_id");
	$proj->execute();
	$proj = $proj->fetchAll(PDO::FETCH_ASSOC);
}



if ($_SERVER['REQUEST_METHOD'] === 'POST' and basename($_SERVER['PHP_SELF']) == "search.php")
{
	$herfa = $_POST['name'];
	$sqll = "SELECT * FROM employer WHERE elherfa = \"$herfa\"";
	$heraf = $pdo->prepare($sqll);
	$heraf->execute();
	$heraf = $heraf->fetchAll(PDO::FETCH_ASSOC);
	$_SESSION['employ'] = $heraf;
}

if (isset($_POST['name']) and basename($_SERVER['PHP_SELF']) == "employ.php")
{

	if (isset($empp)){
		$_SESSION['employer'] = $empp[$_POST['name']];
	}
}

if (isset($_POST['comment']))
{
	$client_id = $emp1['id'];
	$employer_id = $_SESSION['employer']['id'];
	$new_comment = $_POST['comment'];
	$comment = "INSERT INTO review (employer_id, review, rate, client_id) VALUES ($employer_id, \"$new_comment\", 3, $client_id)";
	$add_comment = $pdo->prepare($comment);
	$add_comment->execute();
	header("refresh:0.0001; url=employ.php");
}

if (isset($_SESSION['employer']))
	$emp2 = $_SESSION['employer'];

if (isset($emp2) and basename($_SERVER['PHP_SELF']) == "employ.php")
{
	$employer_id = $emp2['id'];
	$proj = $pdo->prepare("SELECT * FROM projects WHERE employer_id = $employer_id");
	$proj->execute();
	$proj = $proj->fetchAll(PDO::FETCH_ASSOC);
}

if (isset($emp2) and basename($_SERVER['PHP_SELF']) == "employ.php")
{
	$employer_id = $emp2['id'];
	$skil = $pdo->prepare("SELECT skill FROM skills WHERE employer_id = $employer_id");
	$skil->execute();
	$skil = $skil->fetchAll(PDO::FETCH_ASSOC);
}

if (isset($emp2) and basename($_SERVER['PHP_SELF']) == "employ.php")
{
	$employer_id = $emp2['id'];
	$rev = $pdo->prepare("SELECT * FROM review WHERE employer_id = $employer_id");
	$rev->execute();
	$rev = $rev->fetchAll(PDO::FETCH_ASSOC);

	$cli = $pdo->prepare("SELECT client_id FROM review WHERE employer_id = $employer_id");
	$cli->execute();
	$cli = $cli->fetchAll(PDO::FETCH_ASSOC);
}

if (isset($emp1) and isset($emp1['elherfa']) and basename($_SERVER['PHP_SELF']) == "profile.php")
{
	$employer_id = $emp1['id'];
	$rev = $pdo->prepare("SELECT * FROM review WHERE employer_id = $employer_id");
	$rev->execute();
	$rev = $rev->fetchAll(PDO::FETCH_ASSOC);

	$cli = $pdo->prepare("SELECT client_id FROM review WHERE employer_id = $employer_id");
	$cli->execute();
	$cli = $cli->fetchAll(PDO::FETCH_ASSOC);
}

if ($_POST and basename($_SERVER['PHP_SELF']) == "newacount.php")
{
	$emps = $pdo->prepare("SELECT email FROM employer");
	$emps->execute();
	$clis = $pdo->prepare("SELECT email FROM clients");
	$clis->execute();
	$emps = $emps->fetchAll(PDO::FETCH_ASSOC);
	$clis = $clis->fetchAll(PDO::FETCH_ASSOC);
	$found = false;

	if (isset($_POST['email'])){
		foreach ($emps as $s) {
			if ($s['email'] === $_POST['email']) {
				$found = true;
				break;
			}
		}
	}

	if (isset($_POST['email'])){
		foreach ($clis as $s) {
			if ($s['email'] === $_POST['email']) {
				$found = true;
				break;
			}
		}
	}

	if (!$found)
	{
		$targetDirectory = "images/";
		$originalFileName = $_POST['email'] . ".jpg";
		$targetFilePath = $targetDirectory . $originalFileName;
		$check = getimagesize($_FILES["photo"]["tmp_name"]);
		if ($check !== false) {
			move_uploaded_file($_FILES["photo"]["tmp_name"], $targetFilePath);
		} else {
			echo "File is not an image.";
		}

		$first_name = $_POST['first_name'];
		$last_name = $_POST['last_name'];
		$email = $_POST['email'];
		$pass_word = $_POST['pass_word'];
		$country = $_POST['Country'];
		$governorate = $_POST['governorate'];
		$photo = $_POST['email'] . ".jpg";
		$phone = $_POST['phone'];
		if ($_POST['ifemp'] == "yes")
		{
			$elherfa = $_POST['jobInfo'];
			$about = $_POST['aboutyou'];
			$new_acc = "INSERT INTO employer (first_name, last_name, email, pass_word, country, governorate, photo, phone, elherfa, about) VALUES (\"$first_name\", \"$last_name\", \"$email\", \"$pass_word\", \"$country\", \"$governorate\", \"$photo\", \"$phone\", \"$elherfa\", \"$about\")";
			$add_new_acc = $pdo->prepare($new_acc);
			$add_new_acc->execute();
		}
		else
		{
			$new_acc = "INSERT INTO clients (first_name, last_name, email, pass_word, country, governorate, photo, phone) VALUES (\"$first_name\", \"$last_name\", \"$email\", \"$pass_word\", \"$country\", \"$governorate\", \"$photo\", \"$phone\")";
			$add_new_acc = $pdo->prepare($new_acc);
			$add_new_acc->execute();
		}

		header('Location: login.php');
	}
	else{
		echo "Error: you already have account";
	}
}

?>
