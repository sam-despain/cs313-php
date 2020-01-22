<html>
	<body>
		<?php
		$name = testInput($_POST["name"]);
		$email = testInput($_POST["emailAddress"]);
		$major = testInput($_POST["major"]);
		$comments = testInput($_POST["comments"]);
		
		function testInput ($data) {
			$data = trim($data);
			$data = stripslashes($data);
			$data = htmlspecialchars($data);
			return $data;
		}
		?>
		<p>Name: <?php echo $name; ?></p>
		<p>Email: <a href="mailto:<?php echo $email; ?>"><?php echo $email; ?></a></p>
		<p>Major: <?php echo $major; ?> </p>
		<p>Comments: <?php echo $comments; ?> </p>
	</body>
</html>