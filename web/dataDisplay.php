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
include 'back.html';
?>
<html>
	<body>
		<?php
		$type = htmlspecialchars($_POST["type"]);
		$sku = htmlspecialchars($_POST["sku"]);
		
		$myQuery = 'SELECT t.name, t.image, f.sku, f.width, f.height, f.depth
			FROM furniture f
			JOIN type t ON t.id = f.typeid
			WHERE name = \'' . $type . '\' OR sku = \'' . $sku . '\'
			ORDER BY t.name;';
		
		foreach ($db->query($myQuery) as $row)
		{
			echo '<div class="fittedDiv">';
			echo '<h3>' . $row['name'] . '</h3>';
			echo '<img src="' . $row['image'] . '">';
			echo '<p>SKU: #' . $row['sku'] . '</p>';
			echo '<p>Dimensions: ' . $row['width'] . ' x ' . $row['height'] . ' x ' . $row['depth'] . '</p>';
			echo '</div>';
		}
		$newPage = "dataAccess.php";
		if ($type = NULL && $sku = NULL) {
			header ("Location: $newPage");
		}
		?>
		
	</body>
</html>