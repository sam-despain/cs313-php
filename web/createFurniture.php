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
		$sku = htmlspecialchars($_POST['skuInput']);
		
		$typeQuery = 'SELECT id, name FROM type WHERE name = \'' . htmlspecialchars($_POST['typeInput']) . '\';';
		$stmt = $db->prepare($typeQuery);
		$stmt->execute();
		$typeInput = $stmt->fetchAll(PDO::FETCH_ASSOC);
		$type_id = $typeInput[0]['id'];
		
		$width = htmlspecialchars($_POST['widthInput']);
		$height = htmlspecialchars($_POST['heightInput']);
		$depth = htmlspecialchars($_POST['depthInput']);
		
		$insertQuery = 'INSERT INTO furniture (typeID, sku, width, height, depth)
			VALUES (:type_id, :sku, :width, :height, :depth);';
		$stmt = $db->prepare($insertQuery);
		$stmt->bindValue(':type_id', $type_id, PDO::PARAM_INT);
		$stmt->bindValue(':sku', $sku, PDO::PARAM_STR);
		$stmt->bindValue(':width', $width, PDO::PARAM_STR);
		$stmt->bindValue(':height', $height, PDO::PARAM_STR);
		$stmt->bindValue(':depth', $depth, PDO::PARAM_STR);
		$stmt->execute();
		
		$newPage = "dataAccess.php";
		header ("Location: $newPage");
		die();
		echo "All's good?";
		?>
	</body>
</html>