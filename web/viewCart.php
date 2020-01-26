<?php
include 'header.html';
?>
<html>
	<body>
		<h1>Your Cart</h1>
		<ul>
		<?php
		session_start();
		$_SESSION["cart"]=array();
		function testInput($data) {
			$data = trim($data);
			$data = stripslashes($data);
			$data = htmlspecialchars($data);
			return $data;
		}
		//$cartItems = testInput($_POST["items"]);	
		if (isset($_POST["submit"])) {
			if (!empty($_POST["items"])) {
				foreach($_POST["items"] as $val) {
					array_push($_SESSION["cart"],$val);
					echo "<li>".$val."</li>";
				}
			}
		}
		echo sizeof($_SESSION["cart"]);
		?>
		</ul>
		<a href="browseItems.php">Back</a>
		<a href="checkout.php">Checkout</a>
	</body>
</html>