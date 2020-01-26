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
			while (list ($key, $val) = each ($_SESSION["cart"])) { 
			echo $key.": ".$val."<br/>"; 
		}
			print_r($_SESSION);
			?>
			<p><input class="submit" type="submit" name="submit" value="Remove"></p>
		</form>
		<a href="browseItems.php">Back</a>
		<a href="checkout.php">Checkout</a>
	</body>
</html>