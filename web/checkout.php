<?php
include 'header.html';
?>
<html>
	<body>
		<h1>Checkout</h1>
		<form action="confirm.php" method="post">
			<p>Address:<input type="text" name="address"></p>
			<p>City:<input type="text" name="city"></p>
			<p>State:<input type="text" name="state"></p>
			<p>ZIP code:<input type="number" name="zipCode"></p>
			<p><input class="submit" type="submit" name="submit"></p>
		</form>
		<a href="viewCart.php">Back to cart</a>
	</body>
</html>