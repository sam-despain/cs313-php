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
		<div class="fittedDiv"><a href="dataAccess.php">Back</a></div>
		<?php
		$collection = htmlspecialchars($_POST["collection"]);
		$finish = htmlspecialchars($_POST["finish"]);
		$type = htmlspecialchars($_POST["type"]);
		$sku = htmlspecialchars($POST["sku"]);
		
		echo $myQuery = 'SELECT fr.sku,
			fr.width,
			fr.height,
			fr.depth,
			i.link,
			t.name tname,
			c.name cname,
			fi.name fname FROM images i
			JOIN furniture fr ON i.id = fr.imageid
			JOIN type t ON t.id = fr.typeid
			JOIN collection c ON c.id = fr.collectionid
			JOIN finish fi ON fi.id = fr.finishid
			WHERE (c.name = \'' . $collection . '\' OR fi.name = \'' . $finish . '\') OR (t.name = \'' . $type . '\' OR fr.sku = \'' . $sku . '\')
			ORDER BY t.name;';
		
		foreach ($db->query($myQuery) as $row)
		{
			echo '<div class="fittedDiv">';
			echo '<h3>' . $row['tname'] . '</h3>';
			echo '<img src="' . $row['link'] . '">';
			echo '<p>SKU: #' . $row['sku'] . '</p>';
			echo '<p>Dimensions: ' . $row['width'] . ' x ' . $row['height'] . ' x ' . $row['depth'] . '</p>';
			echo '<p>Collection: ' . $row['cname'] . '</p>';
			echo '<p>Finish: ' . $row['fname'] . '</p>';
			echo '</div>';
		}
		?>
	</body>
</html>