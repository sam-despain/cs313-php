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
		<?php
		$myQuery = 'SELECT fr.sku, fr.width, fr.height, fr.depth, i.link, t.name, c.name, fi.name FROM images i
			JOIN furniture fr ON i.id=fr.imageid
			JOIN type t ON t.id=fr.typeid
			JOIN collection c ON c.id = fr.collectionid
			JOIN finish fi ON fi.id = fr.finishid';
		foreach ($db->query($myQuery) as $row)
		{
			echo '<div>';
			echo '<h3>' . $row['t'] . '</h3>';
			echo '<img src="' . $row['link'] . '">';
			echo '<p>Dimensions: ' . $row['width'] . ' x ' . $row['height'] . ' x ' . $row['depth'] . '</p>';
			echo '<p>Collection: ' . $row['c'] . '</p>';
			echo '<p>Finish: ' . $row['f'] . '</p>';
			echo '</div>';
		}
		?>
	</body>
</html>