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
		$myQuery = 'SELECT furniture.sku, furniture.width, furniture.height, furniture.depth, images.link, type.name t, collection.name c, finish.name f FROM images INNER JOIN furniture ON images.id=furniture.imageid INNER JOIN type ON type.id=furniture.typeid INNER JOIN collection ON collection.id = furniture.collectionid INNER JOIN finish ON finish.id = furniture.finishid' + ' ORDER BY sku;';
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