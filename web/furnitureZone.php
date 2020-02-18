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
	<head>
		
	</head>
	<body>
		<h1>FurnitureZone</h1>
		<div class="fittedDiv">
			<button class="dropButton"><h3>Create new furniture</h3></button>
			<form class="contents" action="createFurniture.php" method="post">
				<p class="fittedDiv" style="padding-right: 20px;">Furniture type<br>
					<select name="typeInput">
						<?php
						foreach ($db->query('SELECT * FROM type ORDER BY type.name;') as $row)
						{
							echo '<option>' . $row['name'] . '</option>';
						}
						?>
					</select>
				</p>
				<p>SKU #<br><input type="number" name="skuInput"></p>
				<p>Dimensions<br>
				<input type="number" name="widthInput" placeholder="Width"><br>
				<input type="number" name="heightInput" placeholder="Height"><br>
				<input type="number" name="depthInput" placeholder="Depth"></p>
				<p><input type="submit" value="Create"></p>
			</form>
		</div>
		<div class="fittedDiv">
			<button class="dropButton"><h3>Search for furniture</h3></button>
			<form class="contents" action="displayFurniture.php" method="post">
				<p>SKU #<br>
					<select name="sku">
						<option></option>
						<?php
						foreach ($db->query('SELECT sku FROM furniture ORDER BY sku;') as $row)
						{
							echo '<option>' . $row['sku'] . '</option>';
						}
						?>
					</select>
				</p>
				<p>Furniture type<br>
					<select name="type">
						<option></option>
						<?php
						foreach ($db->query('SELECT * FROM type ORDER BY type.name;') as $row)
						{
							echo '<option>' . $row['name'] . '</option>';
						}
						?>
					</select>
				</p>
				<p><input type="submit" value="Search"></p>
			</form>
		</div>
		<br>
		<?php
		$myQuery = 'SELECT t.name, t.image, f.sku, f.width, f.height, f.depth
			FROM furniture f
			JOIN type t ON t.id = f.typeid
			ORDER BY t.name;';
		foreach ($db->query($myQuery) as $row)
		{
			echo '<div class="fittedDiv">';
			echo '<h3 style="text-align: center">' . $row['name'] . '</h3>';
			echo '<img src="' . $row['image'] . '">';
			echo '<p>SKU: #' . $row['sku'] . '</p>';
			echo '<p>Dimensions: ' . $row['width'] . ' x ' . $row['height'] . ' x ' . $row['depth'] . '</p>';
			echo '<button class="dropButton">Edit</button>';
			echo '<form class="contents" action="modifyFurniture.php" method="post">';
			echo '<p><input type="hidden" name="sku" value="' . $row['sku'] . '"></p>';
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