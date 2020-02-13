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
		echo $type = htmlspecialchars($_POST['typeInput']) . "<br/>";
		echo $finish = htmlspecialchars($_POST['finishInput']) . "<br/>";
		echo $collection = htmlspecialchars($_POST['collectionInput']) . "<br/>";
		//$image = htmlspecialchars($_POST['imageInput']);
		echo $sku = htmlspecialchars($_POST['skuInput']) . "<br/>";
		echo $width = htmlspecialchars($_POST['widthInput']) . "<br/>";
		echo $height = htmlspecialchars($_POST['heightInput']) . "<br/>";
		echo $depth = htmlspecialchars($_POST['depthInput']) . "<br/>";
		
		$myQuery = 'INSERT INTO furniture (typeID, finishID, collectionID, sku, width, height, depth)
			VALUES (:type, :finish, :collection, :sku, :width, :height, :depth);';
		?>
		<p>Creating new furniture...</p>
	</body>
</html>