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
		$typeInput = htmlspecialchars($_POST['typeInput']) . "<br/>";
		$finishInput = htmlspecialchars($_POST['finishInput']) . "<br/>";
		$collectionInput = htmlspecialchars($_POST['collectionInput']) . "<br/>";
		//$image = htmlspecialchars($_POST['imageInput']);
		$sku = htmlspecialchars($_POST['skuInput']) . "<br/>";
		$width = htmlspecialchars($_POST['widthInput']) . "<br/>";
		$height = htmlspecialchars($_POST['heightInput']) . "<br/>";
		$depth = htmlspecialchars($_POST['depthInput']) . "<br/>";
		
		$typeQuery = 'SELECT id, name FROM type ORDER BY id;';
		$stmt = $db->prepare($typeQuery);
		$stmt->execute();
		$types = $stmt->fetchAll(PDO::FETCH_ASSOC);
		
		$finishQuery = 'SELECT id, name FROM finish;';
		$stmt = $db->prepare($finishQuery);
		$stmt->execute();
		$finishes = $stmt->fetchAll(PDO::FETCH_ASSOC);
		
		$collectionQuery = 'SELECT id, name FROM collection;';
		$stmt = $db->prepare($collectionQuery);
		$stmt->execute();
		$collections = $stmt->fetchAll(PDO::FETCH_ASSOC);
		
		$type_id = NULL;
		foreach ($types as $t) {
			if ($t['name'] == $typeInput) {
				$type_id = $t['id'];
			}
			echo $type_id;
		}
		
		$insertQuery = 'INSERT INTO furniture (typeID, finishID, collectionID, sku, width, height, depth)
			VALUES (:type, :finish, :collection, :sku, :width, :height, :depth);';
		?>
		<p>Creating new furniture...</p>
	</body>
</html>