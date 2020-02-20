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
include 'back.html';
?>
<html>
	<body>
		<?php
		$myName = '';
		$myQuery = "SELECT username FROM accounts WHERE username = $_SESSION['username']";
		foreach($db->query($myQuery) as $row) {
			$myName = $row['username'];
		}
		if (isset($_SESSION['username'])) {
			echo "<h1>Welcome, $myName.</h1>";
		} else {
			header("Location: teamActivity07-signin.php");
			die();
		}
		?>
	</body>
</html>