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
		<form action="createFurniture.php" method="post">
			<h2>Create New Furniture</h2>
			<p>Furniture type:
				<select name="typeInput">
					<?php
					foreach ($db->query('SELECT * FROM type ORDER BY type.name;') as $row)
					{
						echo '<option>' . $row['name'] . '</option>';
					}
					?>
				</select>
			</p>
			<p>Finish:
				<select name="finishInput">
					<?php
					foreach ($db->query('SELECT * FROM finish ORDER BY finish.name;') as $row)
					{
						echo '<option>' . $row['name'] . '</option>';
					}
					?>
				</select>
			</p>
			<p>Collection:
				<select name="collectionInput">
					<?php
					foreach ($db->query('SELECT * FROM collection ORDER BY collection.name;') as $row)
					{
						echo '<option>' . $row['name'] . '</option>';
					}
					?>
				</select>
			</p>	
			<p>Image:<input type="file" name="imageInput" accept="image/*"></p>
			<p>SKU #:<input type="text" name="skuInput" placeholder="AA0000 or ZAAA-0000"></p>
			<p>Dimensions:<input type="number" name="widthInput" placeholder="Width">
			<input type="number" name="heightInput" placeholder="Height">
			<input type="number" name="depthInput" placeholder="Depth"></p>
			<p><input type="submit" value="Create"></p>
		</form>
		<form action="dataDisplay.php" method="post">
			<h2>Search for furniture</h2>
			<p>
				<select name="type">
					<option>-Furniture type-</option>
					<?php
					foreach ($db->query('SELECT * FROM type ORDER BY type.name;') as $row)
					{
						echo '<option>' . $row['name'] . '</option>';
					}
					?>
				</select>
			</p>
			<p>
				<select name="finish">
					<option>-Finish-</option>
					<?php
					foreach ($db->query('SELECT * FROM finish ORDER BY finish.name;') as $row)
					{
						echo '<option>' . $row['name'] . '</option>';
					}
					?>
				</select>
			</p>
			<p>
				<select name="collection">
					<option>-Collection-</option>
					<?php
					foreach ($db->query('SELECT * FROM collection ORDER BY collection.name;') as $row)
					{
						echo '<option>' . $row['name'] . '</option>';
					}
					?>
				</select>
			</p>
			<p><input type="submit" value="Search"></p>
		</form>
		<?php
		$myQuery = 'SELECT fr.sku,
			fr.width,
			fr.height,
			fr.depth,
			i.link,
			t.name tname,
			c.name cname,
			fi.name fname FROM furniture fr
			JOIN images i ON fr.imageid = i.id
			JOIN type t ON t.id = fr.typeid
			JOIN collection c ON c.id = fr.collectionid
			JOIN finish fi ON fi.id = fr.finishid
			ORDER BY t.name;';
		foreach ($db->query($myQuery) as $row)
		{
			echo '<div class="furnitureItems">';
			echo '<h3>' . $row['tname'] . '</h3>';
			echo '<img src="' . $row['link'] . '">';
			echo '<p>SKU: #' . $row['sku'] . '</p>';
			echo '<p>Dimensions: ' . $row['width'] . ' x ' . $row['height'] . ' x ' . $row['depth'] . '</p>';
			echo '<p>Collection: ' . $row['cname'] . '</p>';
			echo '<p>Finish: ' . $row['fname'] . '</p>';
			echo '</div>';
		}
		?>
	</body>
</html>