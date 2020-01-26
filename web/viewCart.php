<?php
include 'header.html';
session_start();
?>
<html>
	<body>
		<h1>Your Cart</h1>
		<form action="viewCart.php" method="post">
			<?php
			$_SESSION["cart"]=array();
			function testInput($data) {
				$data = trim($data);
				$data = stripslashes($data);
				$data = htmlspecialchars($data);
				return $data;
			}
			
			if (isset($_POST["remove"])) {
				if (!empty($_POST["items"])) {
					foreach($_POST["items"] as $val) {
						array_push($_SESSION["cart"],$val);
						echo "<p><input class=\"radioCheck\" type=\"checkbox\" value=\"".$val."\">".$val."</p>";
					}
				}
			}
			//echo sizeof($_SESSION["cart"]);
			?>
			<p><input class="submit" type="submit" name="remove" value="Remove"></p>
		</form>
		<a href="browseItems.php">Back</a>
		<a href="checkout.php">Checkout</a>
	</body>
</html>