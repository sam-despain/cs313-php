<html>
	<body>
		<h1>Your Cart</h1>
		<?php
		function testInput($data) {
			$data = trim($data);
			$data = stripslashes($data);
			$data = htmlspecialchars($data);
			return $data;
		}
		$cartItems = testInput($cartItems);
		if (isset($_POST["submit"])) {
			if (!empty($_POST["items"])) {
				foreach($_POST["items"] as $val) {
					echo "<p>".$val."</p>";
				}
			}
		}
		?>
	</body>
</html>