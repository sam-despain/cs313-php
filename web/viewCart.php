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
		$cartItems = testInput($_POST["items"]);
		if (isset($_POST["submit"])) {
			if (!empty($cartItems)) {
				foreach($cartItems as $val) {
					echo "<p>".$val."</p>";
				}
			}
		}
		?>
	</body>
</html>