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
		<select>
			<option>-Collection-</option>
			<?php
			foreach ($db->query('SELECT * FROM collection;') as $row)
			{
				echo '<option>' . $row['name'] . '</option>';
			}
			?>
		</select>
		<select>
			<option>-Finish-</option>
			<?php
			foreach ($db->query('SELECT * FROM finish;') as $row)
			{
				echo '<option>' . $row['name'] . '</option>';
			}
			?>
		</select>
		<select>
			<option>-Furniture type-</option>
			<?php
			foreach ($db->query('SELECT * FROM type;') as $row)
			{
				echo '<option>' . $row['name'] . '</option>';
			}
			?>
		</select>
		<p>
			<?php
			foreach ($db->query('SELECT * FROM images;') as $row)
			{
				echo '<img src=' . $row['name'] . '/>';
			}
			?>
		</p>
	</body>
</html>