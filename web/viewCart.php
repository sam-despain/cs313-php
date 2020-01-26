<?php
include 'header.html';
session_start();
?>
<html>
	<body>
		<h1>Your Cart</h1>
		<form action="" method="post">
			<?php
			$_SESSION["cart"]=array();
			function testInput($data) {
				$data = trim($data);
				$data = stripslashes($data);
				$data = htmlspecialchars($data);
				return $data;
			}
			
			if (isset($_POST["submit"])) {
				if (!empty($_POST["items"])) {
					//foreach($_POST["items"] as $val) {
					while (list ($key, $val) = each ($_POST["items"])) { 
						array_push($_SESSION["cart"],$val);
						echo "<p><input class=\"radioCheck\" type=\"checkbox\" value=\"".$key."\">".$val."</p>";
					}
				}
			}
			print_r($_SESSION);
			?>
			<p><input class="submit" type="submit" name="submit" value="Remove"></p>
		</form>
		<a href="browseItems.php">Back</a>
		<a href="checkout.php">Checkout</a>
	</body>
</html>