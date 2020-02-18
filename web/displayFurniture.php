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
		if ($sku == NULL) {
			$sku = 0;
		}
		
		$myQuery = 'SELECT t.name, t.image, f.sku, f.width, f.height, f.depth
			FROM furniture f
			JOIN type t ON t.id = f.typeid
			WHERE name = \'' . $type . '\' OR sku = ' . $sku . '
			ORDER BY t.name;';
		
		foreach ($db->query($myQuery) as $row) {
			echo '<div class="fittedDiv">';
			echo '<h3 style="text-align: center">' . $row['name'] . '</h3>';
			echo '<img src="' . $row['image'] . '">';
			echo '<p>SKU: #' . $row['sku'] . '</p>';
			echo '<p>Dimensions: ' . $row['width'] . ' x ' . $row['height'] . ' x ' . $row['depth'] . '</p>';
			echo '<button class="dropButton">Edit</button>';
			echo '<form class="contents" action="modifyFurniture.php" method="post">';
			echo '<p><input type="hidden" name="sku" value="' . $row['sku'] . '"></p>';
			echo '<p>NEW SKU #<br><input type="number" name="skuInput"></p>';
			echo '<p>NEW Furniture type<br>';
			echo '<select name="typeInput">';
			echo '<option></option>';
			foreach ($db->query('SELECT name FROM type ORDER BY name;') as $row){
				echo '<option>' . $row['name'] . '</option>';
			};
			echo '</select>';
			echo '</p>';
			echo '<p>NEW Dimensions<br>';
			echo '<input type="number" name="widthInput" placeholder="Width"><br>';
			echo '<input type="number" name="heightInput" placeholder="Height"><br>';
			echo '<input type="number" name="depthInput" placeholder="Depth"></p>';
			echo '<p><input type="submit" value="Save"></p>';
			echo '</form>';
			echo '<button class="dropButton">Remove</button>';
			echo '<form class="contents" action="removeFurniture.php" method="post">';
			echo '<p><input type="hidden" name="sku" value="' . $row['sku'] . '"></p>';
			echo '<p><input type="submit" value="CONFIRM REMOVE"></p>';
			echo '</form>';
			echo '</div>';
		}
		?>
		<script src="home.js"></script>
	</body>
</html>