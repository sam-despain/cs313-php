<?php
include 'header.html';
session_start();
?>
<html>
	<body>
		<h1>Your Cart</h1>
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
					while (list ($key, $val) = each ($_POST["items"])) { 
						array_push($_SESSION["cart"],$val);
						echo "<p>".$val."</p>";
					}
				}
			}
			print_r($_SESSION);
			?>
		<a style="padding:10px" href="browseItems.php">Back</a>
		<a style="padding:10px" href="removeItems.php">Remove</a>
		<a style="padding:10px" href="checkout.php">Checkout</a>
	</body>
</html>