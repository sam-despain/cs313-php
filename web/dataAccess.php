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
			<select name="type">
				<option>-Furniture type-</option>
				<?php
				foreach ($db->query('SELECT * FROM type ORDER BY type;') as $row)
				{
					echo '<option>' . $row['name'] . '</option>';
				}
				?>
			</select>
			<select name="finish">
				<option>-Finish-</option>
				<?php
				foreach ($db->query('SELECT * FROM finish ORDER BY finish;') as $row)
				{
					echo '<option>' . $row['name'] . '</option>';
				}
				?>
			</select>
			<select name="collection">
				<option>-Collection-</option>
				<?php
				foreach ($db->query('SELECT * FROM collection ORDER BY collection;') as $row)
				{
					echo '<option>' . $row['name'] . '</option>';
				}
				?>
			</select>
			<input type="submit" value="Submit">
		</form>
	</body>
</html>