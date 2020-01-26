<?php
include 'header.html';
?>
<html>
	<body>
		<h1>Your Cart</h1>
		<ul>
		<?php
		function testInput($data) {
			$data = trim($data);
			$data = stripslashes($data);
			$data = htmlspecialchars($data);
			return $data;
		}
		$cartItems = testInput($_POST["items"]);
		if (isset($_POST["submit"])) {
			if (!empty($_POST["items"])) {
				foreach($_POST["items"] as $val) {
					echo "<li>".$val."</li>";
				}
			}
		}
		echo $cartItems;
		?>
		</ul>
		<a href="browseItems.php">Back</a>
		<a href="checkout.php">Checkout</a>
	</body>
</html>