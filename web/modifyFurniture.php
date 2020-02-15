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
echo "<h1>Be sure to use a unique SKU number.</h1>";
?>
<html>
	<body>
		<?php
		$sku = htmlspecialchars($_POST['sku']);
		if ($sku == NULL) {
			$sku = 0;
		}
		$newSku = htmlspecialchars($_POST['skuInput']);
		
		$typeQuery = 'SELECT id, name FROM type WHERE name = \'' . htmlspecialchars($_POST['typeInput']) . '\';';
		$stmt = $db->prepare($typeQuery);
		$stmt->execute();
		$typeInput = $stmt->fetchAll(PDO::FETCH_ASSOC);
		$type_id = $typeInput[0]['id'];
		
		$newWidth = htmlspecialchars($_POST['widthInput']);
		$newHeight = htmlspecialchars($_POST['heightInput']);
		$newDepth = htmlspecialchars($_POST['depthInput']);
		
		$modifyQuerySKU = 'UPDATE furniture SET sku = :newSku WHERE sku = :sku;';
		$modifyQueryT = 'UPDATE furniture SET typeid = :type_id WHERE sku = :sku;';
		if ($newSku != NULL) {
			$stmt = $db->prepare($modifyQuerySKU);
			$stmt->bindValue(':sku', $sku, PDO::PARAM_STR);
			$stmt->bindValue(':newSku', $newSku, PDO::PARAM_STR);
			$stmt->execute();
			echo "<p>New SKU: " . $sku . "</p>";
		}
		if ($type_id != NULL) {
			$stmt = $db->prepare($modifyQueryT);
			$stmt->bindValue(':sku', $sku, PDO::PARAM_STR);
			$stmt->bindValue(':type_id', $type_id, PDO::PARAM_STR);
			$stmt->execute();
			echo "<p>New type: " . $typeInput . "</p>";
		}/*
		$newPage = "dataAccess.php";
		header ("Location: $newPage");*/
		die();
		?>
	</body>
</html>