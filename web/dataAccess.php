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
		<div class="fittedDiv">
			<button class="dropButton"><h2>Modify furniture</h2></button>
			<form class="contents" action="modifyFurniture.php" method="post">
				<p>SKU #<br>
					<select name="sku">
						<?php
						foreach ($db->query('SELECT sku FROM furniture ORDER BY sku;') as $row)
						{
							echo '<option>' . $row['sku'] . '</option>';
						}
						?>
					</select>
				</p>
				<p>NEW SKU #<br><input type="number" name="skuInput"></p>
				<p>NEW Furniture type<br>
					<select name="typeInput">
						<option></option>
						<?php
						foreach ($db->query('SELECT name FROM type ORDER BY name;') as $row)
						{
							echo '<option>' . $row['name'] . '</option>';
						}
						?>
					</select>
				</p>
				<p>NEW Dimensions<br>
				<input type="number" name="widthInput" placeholder="Width">
				<input type="number" name="heightInput" placeholder="Height">
				<input type="number" name="depthInput" placeholder="Depth"></p>
				<p><input type="submit" value="Modify"></p>
			</form>
		</div>
		<div class="fittedDiv">
			<button class="dropButton"><h2>Create new furniture</h2></button>
			<form class="fittedDiv" action="createFurniture.php" method="post">
				<p>SKU #<br><input type="number" name="skuInput"></p>
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
				<p>Dimensions<br>
				<input type="number" name="widthInput" placeholder="Width">
				<input type="number" name="heightInput" placeholder="Height">
				<input type="number" name="depthInput" placeholder="Depth"></p>
				<p><input type="submit" value="Create"></p>
			</form>
		</div>
		<div class="fittedDiv">
			<button class="dropButton"><h2>Search for furniture</h2></button>
			<form class="contents" action="dataDisplay.php" method="post">
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
		<div class="fittedDiv">
			<button class="dropButton"><h2>Remove furniture</h2></button>
			<form class="contents" action="removeFurniture.php" method="post">
				<p>SKU #<br>
					<select name="sku">
						<?php
						foreach ($db->query('SELECT sku FROM furniture ORDER BY sku;') as $row)
						{
							echo '<option>' . $row['sku'] . '</option>';
						}
						?>
					</select>
				</p>
				<p><input type="submit" value="Remove"></p>
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
			echo '<h3>' . $row['name'] . '</h3>';
			echo '<img src="' . $row['image'] . '">';
			echo '<p>SKU: #' . $row['sku'] . '</p>';
			echo '<p>Dimensions: ' . $row['width'] . ' x ' . $row['height'] . ' x ' . $row['depth'] . '</p>';
			echo '</div>';
		}
		?>
		<script src="home.js"></script>
	</body>
</html>