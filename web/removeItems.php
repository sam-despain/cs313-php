<?php
include 'header.html';
session_start();
?>
<html>
	<body>
		<h1>Your Cart</h1>
		<form action="viewCart.php" method="post">
			<?php
			$item=$_POST['item'];
			while (list ($key1,$val1) = @each ($item)) {
				echo "$key1 , $val1,<br>";
				unset($_SESSION['cart'][$val1]);
			}
			function testInput($data) {
				$data = trim($data);
				$data = stripslashes($data);
				$data = htmlspecialchars($data);
				return $data;
			}
			while (list ($key, $val) = each ($_SESSION["cart"])) { 
				echo "<input type=\"checkbox\" name=\"item[]\" value=\"".$key."\">".$key.": ".$val."<br>"; 
			}
			print_r($_SESSION);
			?>
			<p><input class="submit" type="submit" name="submit" value="Remove"></p>
		</form>
		<a style="padding:10px" href="browseItems.php">Back</a>
		<a style="padding:10px" href="checkout.php">Checkout</a>
	</body>
</html>