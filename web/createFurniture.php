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
		$typeQuery = 'SELECT id, name FROM type ORDER BY id WHERE name = \'' . htmlspecialchars($_POST['type']) . '\';';
		$stmt = $db->prepare($typeQuery);
		echo $typeQuery;
		$finishInput = htmlspecialchars($_POST['finish']);
		$collectionInput = htmlspecialchars($_POST['collection']);
		//$image = htmlspecialchars($_POST['imageInput']);
		$sku = htmlspecialchars($_POST['skuInput']);
		$width = htmlspecialchars($_POST['widthInput']);
		$height = htmlspecialchars($_POST['heightInput']);
		$depth = htmlspecialchars($_POST['depthInput']);
		/*
		
		$stmt->execute();
		$typeInput = $stmt->fetchAll(PDO::FETCH_ASSOC);
		
		$finishQuery = 'SELECT id, name FROM finish;';
		$stmt = $db->prepare($finishQuery);
		$stmt->execute();
		$finishes = $stmt->fetchAll(PDO::FETCH_ASSOC);
		
		$collectionQuery = 'SELECT id, name FROM collection;';
		$stmt = $db->prepare($collectionQuery);
		$stmt->execute();
		$collections = $stmt->fetchAll(PDO::FETCH_ASSOC);*/
		
		
		$insertQuery = 'INSERT INTO furniture (typeID, finishID, collectionID, sku, width, height, depth)
			VALUES (:type, :finish, :collection, :sku, :width, :height, :depth);';
		?>
		<p>Creating new furniture...</p>
	</body>
</html>