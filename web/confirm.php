<?php
include 'header.html';
session_start();
?>
<html>
	<body>
		<p>Items:<br/>
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
		
		while (list ($key, $val) = each ($_SESSION["cart"])) { 
			echo $key.": ".$val."<br/>"; 
		}
		?>
		</p>
		<p>Ship to:<br/> 
			<?php
			echo $address."<br/>".$city.", ".$state." ".$zip;
			?>
		</p>
	</body>
</html>