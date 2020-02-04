<?php
include 'header.html';
try
{
  $user = 'postgresql-octagonal-32045';
  $password = 'Cori4ntumr';
  $db = new PDO('pgsql:host=localhost;dbname=database', $user, $password);

  // this line makes PDO give us an exception when there are problems,
  // and can be very helpful in debugging! (But you would likely want
  // to disable it for production environments.)
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (PDOException $ex)
{
  echo 'Error!: ' . $ex->getMessage();
  die();
}
?>
<html>
	<body>
		
	</body>
</html>