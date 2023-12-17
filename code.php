<?php

$host = 'localhost';
$dbname = 'heraf';
$User = 'root';
$pass = 'betty';

$pdo = new PDO("mysql:host=$host;dbname=$dbname", $User, $pass);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// $employ = $pdo->prepare("select * from employer;");
// $employ->execute();

// $emp1 = $employ->fetchAll(PDO::FETCH_ASSOC)[0];

// echo $emp1['id'];
// $employ->execute();

// while ($row = $employ->fetch(PDO::FETCH_ASSOC))
// {
// 	echo $row['id'];
// 	echo "<br>";
// }


if ($_POST and basename($_SERVER['PHP_SELF']) != "search.php")
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

// echo basename($_SERVER['PHP_SELF']);
if (isset($emp1) and (basename($_SERVER['PHP_SELF']) == "profile.php" or basename($_SERVER['PHP_SELF']) == "employ.php"))
{
	$employer_id = $emp1['id'];
	$skil = $pdo->prepare("SELECT skill FROM skills WHERE employer_id = $employer_id");
	$skil->execute();
	$skil = $skil->fetchAll(PDO::FETCH_ASSOC);
	// echo $skil[0]['skill'];
	// echo sizeof($skil);
}

if (isset($emp1) and (basename($_SERVER['PHP_SELF']) == "profile.php" or basename($_SERVER['PHP_SELF']) == "employ.php"))
{
	$employer_id = $emp1['id'];
	$proj = $pdo->prepare("SELECT * FROM projects WHERE employer_id = $employer_id");
	$proj->execute();
	$proj = $proj->fetchAll(PDO::FETCH_ASSOC);
	// echo $proj[0]['id'];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' and basename($_SERVER['PHP_SELF']) == "search.php")
{
	// echo $_POST['name'];
	$herfa = $_POST['name'];
	$sqll = "SELECT * FROM employer WHERE elherfa = \"$herfa\"";
	$heraf = $pdo->prepare($sqll);
	$heraf->execute();
	$heraf = $heraf->fetchAll(PDO::FETCH_ASSOC);
	// echo $heraf[0]['first_name']. " " . $heraf[0]['last_name'];
}

?>
