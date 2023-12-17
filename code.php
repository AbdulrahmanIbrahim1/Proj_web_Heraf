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


if ($_POST and basename($_SERVER['PHP_SELF']) != "search.php" and basename($_SERVER['PHP_SELF']) != "employ.php")
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

if (isset($_SESSION['employ']))
	$empp = $_SESSION['employ'];


// echo basename($_SERVER['PHP_SELF']);
if (isset($emp1) and basename($_SERVER['PHP_SELF']) == "profile.php")
{
	$employer_id = $emp1['id'];
	$skil = $pdo->prepare("SELECT skill FROM skills WHERE employer_id = $employer_id");
	$skil->execute();
	$skil = $skil->fetchAll(PDO::FETCH_ASSOC);
	// echo $skil[0]['skill'];
	// echo sizeof($skil);
}



if (isset($emp1) and basename($_SERVER['PHP_SELF']) == "profile.php")
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
	$_SESSION['employ'] = $heraf;
	// echo $heraf[0]['first_name']. " " . $heraf[0]['last_name'];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' and basename($_SERVER['PHP_SELF']) == "employ.php")
{
	// print_r(json_decode(file_get_contents('php://input'), true));
	// $data = file_get_contents("php://input");
	// $user = json_decode($date);
	// echo $user;
	// echo $_POST['name'];
	if (isset($empp))
		$emp2 = $empp[$_POST['name']];
}

if (isset($emp2) and basename($_SERVER['PHP_SELF']) == "employ.php")
{
	$employer_id = $emp2['id'];
	$proj = $pdo->prepare("SELECT * FROM projects WHERE employer_id = $employer_id");
	$proj->execute();
	$proj = $proj->fetchAll(PDO::FETCH_ASSOC);
	// echo $proj[0]['id'];
}

if (isset($emp2) and basename($_SERVER['PHP_SELF']) == "employ.php")
{
	$employer_id = $emp2['id'];
	$skil = $pdo->prepare("SELECT skill FROM skills WHERE employer_id = $employer_id");
	$skil->execute();
	$skil = $skil->fetchAll(PDO::FETCH_ASSOC);
	// echo $skil[0]['skill'];
	// echo sizeof($skil);
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
	// echo $cli[0]['client_id'];
	// echo sizeof($cli);

	// for ($i = 0; $i < sizeof($cli); $i++)
	// {
	// 	$client_id = $cli[$i]['client_id'];
	// 	$run = "SELECT * FROM clients WHERE id = $client_id";
	// 	$clie = $pdo->prepare($run);
	// 	$clie->execute();
	// 	$clie = $clie->fetch(PDO::FETCH_ASSOC);
	// 	// echo $clie['first_name'];
	// 	// echo $clie['id'];
	// 	// echo sizeof($clie);
	// }
}



?>
