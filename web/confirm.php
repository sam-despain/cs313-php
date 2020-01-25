<?php
include 'header.html';
?>
<html>
	<body>
	<?php
	function testInput($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}
	
	$address = testInput($_POST["address"]);
	$city = testInput($_POST["city"]);
	$state = testInput($_POST["state"]);
	$zip = testInput($_POST["zipCode"]);
	?>
	<p>Ship to:<br/> 
		<?php
		echo $address."<br/>".$city.", ".$state." ".$zip;
		?>
	</p>
	</body>
</html>