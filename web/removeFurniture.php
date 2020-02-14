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
		
		$insertQuery = 'DELETE FROM furniture WHERE sku = :sku;';
		$stmt = $db->prepare($insertQuery);
		$stmt->bindValue(':sku', $sku, PDO::PARAM_STR);
		$stmt->execute();
		
		$newPage = "dataAccess.php";
		header ("Location: $newPage");
		die();
		?>
	</body>
</html>