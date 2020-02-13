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
		$typeQuery = 'SELECT id, name FROM type WHERE name = \'' . htmlspecialchars($_POST['typeInput']) . '\';';
		$stmt = $db->prepare($typeQuery);
		$stmt->execute();
		$typeInput = $stmt->fetchAll(PDO::FETCH_ASSOC);
		$type_id = $typeInput[0]['id'];
		
		$finishQuery = 'SELECT id, name FROM finish WHERE name = \'' . htmlspecialchars($_POST['finishInput']) . '\';';
		$stmt = $db->prepare($finishQuery);
		$stmt->execute();
		$finishInput = $stmt->fetchAll(PDO::FETCH_ASSOC);
		$finish_id = $finishInput[0]['id'];
		/*
		$collectionQuery = 'SELECT id, name FROM collection WHERE name = \'' . htmlspecialchars($_POST['collectionInput']) . '\';';
		$stmt = $db->prepare($collectionQuery);
		$stmt->execute();
		$collectionInput = $stmt->fetchAll(PDO::FETCH_ASSOC);
		collection_id = $collectionInput[0]['id'];*/
		
		//$image = htmlspecialchars($_POST['imageInput']);
		$sku = htmlspecialchars($_POST['skuInput']);
		$width = htmlspecialchars($_POST['widthInput']);
		$height = htmlspecialchars($_POST['heightInput']);
		$depth = htmlspecialchars($_POST['depthInput']);
		
		$insertQuery = 'INSERT INTO furniture (typeID, finishID, collectionID, sku, width, height, depth)
			VALUES (:type_id, :finish_id, :collection_id, :sku, :width, :height, :depth);';
		?>
		<p>Creating new furniture...</p>
	</body>
</html>