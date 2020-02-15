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
		if ($type_id == NULL) {
			$type_id = 0;
		}
		
		$newWidth = htmlspecialchars($_POST['widthInput']);
		$newHeight = htmlspecialchars($_POST['heightInput']);
		$newDepth = htmlspecialchars($_POST['depthInput']);
		
		$modifyQuery = 'UPDATE furniture SET ';
		if ($newSku != NULL) {
			$modifyQuery .= 'sku = :newSku';
		}
		if ($type_id != 0) {
			if ($newSku != NULL) {
				$modifyQuery .= ', ';
			}
			$modifyQuery .= 'typeid = :type_id';
		}
		if ($newWidth != 0) {
			if ($newSku != NULL || $type_id != 0) {
				$modifyQuery .= ', ';
			}
			$modifyQuery .= 'width = :newWidth';
		}
		if ($newHeight != 0) {
			if ($newSku != NULL || $type_id != 0 || $newWidth != 0) {
				$modifyQuery .= ', ';
			}
			$modifyQuery .= 'height = :newHeight';
		}
		if ($newDepth != 0) {
			if ($newSku != NULL || $type_id != 0 || $newWidth != 0 || $newHeight != 0) {
				$modifyQuery .= ', ';
			}
			$modifyQuery .= 'depth = :newDepth';
		}
		
		$modifyQuery .= ' WHERE sku = :sku;';
		echo $modifyQuery;
		echo '<br>$sku=' . $sku . '<br>$newSku=' . $newSku . '<br>$type_id=' . $type_id;
		$stmt = $db->prepare($modifyQuery);
		$stmt->bindValue(':sku', $sku, PDO::PARAM_INT);
		if ($newSku != NULL) {
			$stmt->bindValue(':newSku', $newSku, PDO::PARAM_STR);
		}
		if ($type_id != 0) {
			$stmt->bindValue(':type_id', $type_id, PDO::PARAM_STR);
		}
		if ($newWidth != 0) {
			$stmt->bindValue(':newWidth', $newWidth, PDO::PARAM_STR);
		}
		if ($newHeight != 0) {
			$stmt->bindValue(':newHeight', $newHeight, PDO::PARAM_STR);
		}
		if ($newDepth != 0) {
			$stmt->bindValue(':newDepth', $newDepth, PDO::PARAM_STR);
		}
		$stmt->execute();
		
		$newPage = "dataAccess.php";
		header ("Location: $newPage");
		die();
		?>
	</body>
</html>