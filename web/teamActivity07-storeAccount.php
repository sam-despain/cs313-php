<?php
include 'header.html';
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
		$newPage = 'teamActivity07-signup.php';
		$username = htmlspecialchars($_POST["username"]);
		$password = '';
		if ($_POST["password"] == $_POST["pwrepeat"]) {
			$password = password_hash(htmlspecialchars($_POST["password"]));
			echo "<p>Password validated</p>";
		} else {
			header("Location: $newPage");
			die();
		}
		$myQuery = "INSERT INTO login (username, password) VALUES (':username', ':password');";
		echo $myQuery;
		$stmt = $db->prepare($myQuery);
		echo "<p>Prepare successful</p>";
		$stmt->bindValue(':username', $username, PDO::PARAM_STR);
		echo "<p>Bind username successful</p>";
		$stmt->bindValue(':password', $password, PDO::PARAM_STR);
		echo "<p>Bind password successful</p>";
		echo $myQuery;
		$stmt->execute();
		$newPage = 'teamActivity07-welcome.php';
		header("Location: $newPage");
		die();
		?>
	</body>
</html>