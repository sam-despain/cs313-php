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
		<form action="dataDisplay.php" method="post">
			<div>
				<h3>Furniture type</h3>
				<?php
				foreach ($db->query('SELECT * FROM type ORDER BY type;') as $row)
				{
					echo '<p><input name="type" type="checkbox">' . $row['name'] . '</p>';
				}
				?>
			</div>
			<div>
				<h3>Finish</h3>
				<?php
				foreach ($db->query('SELECT * FROM finish ORDER BY finish;') as $row)
				{
					echo '<p><input name="finish" type="checkbox">' . $row['name'] . '</p>';
				}
				?>
			</div>
			<div>
				<h3>Collection</h3>
				<?php
				foreach ($db->query('SELECT * FROM collection ORDER BY collection;') as $row)
				{
					echo '<p><input name="collection" type="checkbox">' . $row['name'] . '</p>';
				}
				?>
			</div>
			<input type="submit" value="Submit">
		</form>
	</body>
</html>