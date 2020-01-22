<html>
	<body>
		<?php
		$name = $_POST["name"];
		$email = $_POST["emailAddress"];
		$major = $_POST["major"];
		$comments = $_POST["comments"];
		?>
		<p>Name: <?php echo $name; ?></p>
		<p>Email: <a href="mailto:<?php echo $email; ?>"><?php echo $email; ?></a></p>
		<p>Major: <?php echo $major; ?> </p>
		<p>Comments: <?php echo $comments; ?> </p>
	</body>
</html>