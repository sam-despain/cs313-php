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
		$myQuery = 'SELECT furniture.sku,
			furniture.width,
			furniture.height,
			furniture.depth,
			images.link,
			type.name,
			collection.name,
			finish.name FROM images
			JOIN furniture ON images.id = furniture.imageid
			JOIN type ON type.id = furniture.typeid
			JOIN collection ON collection.id = furniture.collectionid
			JOIN finish ON finish.id = furniture.finishid
			WHERE (collection.name = \'' . $_POST["collection"] . '\' OR finish.name = \'' . $_POST["finish"] . '\') OR type.name = \'' . $_POST["type"] . '\';';
		
		foreach ($db->query($myQuery) as $row)
		{
			echo '<div>';
			echo '<h3>' . $row['type'] . '</h3>';
			echo '<img src="' . $row['link'] . '">';
			echo '<p>Dimensions: ' . $row['width'] . ' x ' . $row['height'] . ' x ' . $row['depth'] . '</p>';
			echo '<p>Collection: ' . $row['collection'] . '</p>';
			echo '<p>Finish: ' . $row['finish'] . '</p>';
			echo '</div>';
		}
		?>
		<div><a href="dataAccess.php">Back</a></div>
	</body>
</html>