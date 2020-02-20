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
		<form action="teamActivity07-checkAccount.php" method="post">
			<p>Username<br><input type="text" name="username" placeholder="Username"></p>
			<p>Password<br><input type="password" name="password" placeholder="Password"></p>
			<p><input type="submit" value="Log in"></p>
		</form>
		<p><a href="teamActivity07-signup.php">Back to sign-up</a></p>
		<?php
		echo $_SESSION['username'];
		?>
	</body>
</html>