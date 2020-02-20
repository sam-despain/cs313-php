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
	<head>
		<link rel="stylesheet" type="text/css" href="mainStyle.css"/>
	</head>
	<body>
		<form action="teamActivity07-storeAccount.php" method="post">
			<p>Username<br><input type="text" name="username" placeholder="Username"></p>
			<p>Password<br><input type="password" name="password" placeholder="Password"></p>
			<p>Retype password<br><input type="password" name="pwrepeat" placeholder="Retype Password"></p>
			<p><input type="submit" value="Create account"></p>
		</form>
	</body>
</html>