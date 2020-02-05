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
		<div>
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
				foreach ($db->query('SELECT * FROM type ORDER BY type;') as $row)
				{
					echo '<option>' . $row['name'] . '</option>';
				}
				?>
			</select>
		</div>
		<?php
		foreach ($db->query('SELECT furniture.width, furniture.height, furniture.depth, images.link, type.name t, collection.name c, finish.name f FROM images INNER JOIN furniture ON images.id=furniture.imageid INNER JOIN type ON type.id=furniture.typeid INNER JOIN collection ON collection.id = furniture.collectionid INNER JOIN finish ON finish.id = furniture.finishid;') as $row)
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