<?php
include 'header.html';
session_start();
try
{
	$dbUrl = getenv('DATABASE_URL');

	$dbOpts = parse_url($dbUrl);

	$dbHost = $dbOpts["host"];
	$dbPort = $dbOpts["port"];
	$dbUser = $dbOpts["user"];
	$dbPassword = $dbOpts["pass"];
	$dbName = ltrim($dbOpts["path"],'/');

	$db = new PDO("pgsql:host=$dbHost;port=$dbPort;dbname=$dbName", $dbUser, $dbPassword);

	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (PDOException $ex)
{
	echo 'Error!: ' . $ex->getMessage();
	die();
}
?>
<html>
	<body>
		<?php
		$newPage = 'teamActivity07-signin.php';
		$username = htmlspecialchars($_POST["username"]);
		$_SESSION["username"] = $username;
		$hash = '';
		$password = htmlspecialchars($_POST["password"]);
		$searchQuery = "SELECT username, password FROM login WHERE username = '$username';";
		foreach ($db->query($searchQuery) as $row) {
			$hash = $row['password'];
		}
		if (password_verify($password, $hash)) {
			$newPage = 'teamActivity07-welcome.php';
			header("Location: $newPage");
			die();
		}
		header("Location: $newPage");
		die();
		?>
	</body>
</html>